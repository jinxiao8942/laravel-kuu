<?php
class Check extends Eloquent{
    protected $table = 'checks';
    public $timestamps = false;
    protected $primaryKey = 'check_id';

    
    private $rules = array(
        'http' => array('url' => 'required|url|http_exists|in_database'),
        'https' => array('url' => 'required|https_exists|in_database'),
        'dns' => array('host' => 'required|ip|ip_exists|in_database'),
        'admin_rules' => array(
            'url' => 'required|url|in_database',
            'type' => 'required|in:http,https,dns',
            'host' => 'ip|in_database',
        ),
    );

    private $use_rules = 'admin_rules';

    public $validate_errors = array();

    function __construct(array $attributes = array()){
        $this->validate_extends();
        //
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function checkalertemail()
    {
        return $this->hasMany('CheckAlertEmail','check_id');
    }

    private function validate_extends(){
        Validator::extend('json_decode', function ($attribute, $value, $parameters) {
            json_decode($value);
            return (($json_errorcode = json_last_error()) == JSON_ERROR_NONE);
        });

        Validator::extend('json_encode', function ($attribute, $value, $parameters) {
            json_encode( array(
                'phrases_to_match' => $value,
            ) );
            return (($json_errorcode = json_last_error()) == JSON_ERROR_NONE);
        });

        Validator::extend('http_exists', function($attribute,$value,$parameters) {
            return !in_array(Check::sendCurlRequest($value),array(404,0));
        });
        Validator::extend('https_exists',function($attribute,$value,$parameters){
            return !in_array(Check::sendCurlRequest($value,true),array(404,0));
        });
        Validator::extend('ip_exists',function($attribute,$value,$parameters){
            return Check::sendEchoRequest($value);
        });

    }

    public function validate($input_arr = array()){
        $this->validate_errors = array();
        //Log::info('in database'.print_r($input_arr, true));
        Validator::extend('in_database',function($attribute,$value,$parameters) use ($input_arr){
            //Log::info('in database'.print_r($parameters, true));
            if($attribute == 'host') {
                return (Check::where('check_id', '!=',(isset($input_arr['check_id']) && ($c = $input_arr['check_id'])) ? $c : 0)->where('user_id',$input_arr['user_id'])->where('type',$input_arr['type'])->where('host',$value)->count() == 0);
            }
            else {
                return (Check::where('check_id', '!=',(isset($input_arr['check_id']) && ($c = $input_arr['check_id'])) ? $c : 0)->where('user_id',$input_arr['user_id'])->where('type',$input_arr['type'])->where('url',($input_arr['type'] == 'https') ? str_replace('http://','https://',$value) : $value)->count() == 0);
            }
        });
        $rules = $this->rules[$this->use_rules];
        if(isset($input_arr['edit_options']) && $input_arr['edit_options'])
            $rules['options'] = 'json_decode';
        else {
            $rules['phrases'] = 'json_encode';
            $rules['post_body'] = 'json_encode';
        }

        $attributes = array(
            'url' => $input_arr['url'],
            'type' => $input_arr['type'],
            'action' => $input_arr['action']
        );
        $validator = Validator::make($input_arr,$rules);
        //$validator->setAttributeNames($attributes);
        if($validator->fails()) {
            $this->set_custom_attributes($validator,$attributes);
            //$this->validate_errors = $validator->messages()->all();
            return false;
        }
        else {
            return true;
        }
    }

    private function  set_custom_attributes($v,$attributes){
        $validate_errors = $v->messages()->all();
        foreach($validate_errors as $message) {
            foreach($attributes as $key => $value)
                $message = str_ireplace(':'.$key, $value, $message);
            array_push($this->validate_errors, $message);
        }
    }

    private function get_match(){
        if($this->options) {
            $options = json_decode($this->options);
            switch($this->type) {
                case 'dns':
                    $match = $this->host;
                    break;
                default:
                    $match = (isset($options->phrases_to_match) && $options->phrases_to_match) ? $options->phrases_to_match : null;
            }
            return $match;
        }
        else
            return null;
    }



    public function user_validate($input_arr, $action) {
        $input_arr['user_id'] = Sentry::getUser()->id;
        $input_arr['action'] = $action;
        $this->use_rules = $input_arr['type'];
        if(!$this->validate($input_arr)) {
            //$this->format_error_messages($input_arr['type'],($input_arr['type'] == 'dns') ? $input_arr['host'] : $input_arr['url'], $action);
            return false;
        }
        else
            return true;
    }

    public function user_store_check($input_arr = array()) {
        $input_arr['user_id'] = Sentry::getUser()->id;
        $this->use_rules = $input_arr['type'];
        return $this->store_check($input_arr);
    }

    public function user_update_check($input_arr = array()) {
        $this->use_rules = $input_arr['type'];
        return $this->update_check($input_arr);
    }

    public function delete_all_alert_email() {
        try {
            DB::beginTransaction();
            foreach($this->checkalertemail as $alert) {
                $alert->delete();
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollback();
            return false;
        }
        return true;
    }

    public function update_check($input_arr = array()) {
        $input_arr['user_id'] = $this->user_id;
        $input_arr['action'] = 'updating';
        if(!$this->validate($input_arr)) {
            //$this->format_error_messages($input_arr['type'],($input_arr['type'] == 'dns') ? $input_arr['host'] : $input_arr['url'], 'updating');
            return false;
        }

        $option = (isset($input_arr['edit_options']) && ($input_arr['edit_options'] == 'change'))
            ? $input_arr['options']
            : $option = json_encode( array(
                'phrases_to_match' => $input_arr['phrases'],
                'post_body' => $input_arr['post_body'],
                'url_path' => Check::getPathFromURLString( $input_arr['url'] )
            ) );

        $this->url =  $input_arr['url'];
        $this->domain = Check :: getDomainFromURLString( $input_arr['url'] );
        $this->type = $input_arr['type'];
        $this->host = ($this->type == 'dns') ? $input_arr['host'] : '';
        $this->options = $option;

        //Log::info("Json error:".json_last_error().' '.JSON_ERROR_NONE);
        if($this->save()) {
            $MongoAPI = new MongoAPI();
            $MongoAPI->updateCheckInMongo(
                $this->mongo_id,
                $this->type,
                'KUU-' . $this->user_id . '-' . $this->check_id,
                $this->domain.((($s = Check::getPathFromURLString( $input_arr['url'] )) != 'Homepage') ? '/'.$s : ''),
                $this->paused,
                $this->get_match()
            );
            array_push($this->validate_errors, 'Check information was not updated in Mongo.');
            return true;
        }
        else {
            array_push($this->validate_errors, 'Check information was not updated.');
            return false;
        }
    }

    public function store_check($input_arr = array()) {
        $input_arr['action'] = 'creating';
        if(!$this->validate($input_arr)) {
            //$this->format_error_messages($input_arr['type'],($input_arr['type'] == 'dns') ? $input_arr['host'] : $input_arr['url'], 'creating');
            return false;
        }

        $option = (isset($input_arr['edit_options']) && ($input_arr['edit_options'] == 'change'))
            ? $input_arr['options']
            : $option = json_encode( array(
                'phrases_to_match' => $input_arr['phrases'],
                'post_body' => $input_arr['post_body'],
                'url_path' => Check::getPathFromURLString( $input_arr['url'] )
            ) );

        $this->user_id =  intval($input_arr['user_id']);
        $this->url =  ($input_arr['type'] == 'https') ? str_replace('http://','https://',$input_arr['url']) : $input_arr['url'];
        $this->domain = Check :: getDomainFromURLString( $input_arr['url'] );
        $this->type = $input_arr['type'];
        $this->host = ($this->type == 'dns') ? $input_arr['host'] : '';
        $this->options = $option;
        $this->create_time = time();

        //Log::info("Json error:".json_last_error().' '.JSON_ERROR_NONE);
        if($this->save()) {
            $MongoAPI = new MongoAPI();
            $this->mongo_id = $MongoAPI->saveSiteInfoToMongo(
                $this->type,
                'KUU-' . $this->user_id . '-' . $this->check_id,
                $this->domain.((($s = Check::getPathFromURLString( $this->url )) != 'Homepage') ? '/'.$s : ''),
                $this->get_match()
            );
            if($this->mongo_id && $this->save())
                return true;
            else {
                array_push($this->validate_errors, 'Check information was not saved.');
                $this->delete();
                return false;
            }
        }
        else {
            array_push($this->validate_errors, 'Check information was not saved.');
            return false;
        }
    }

    static function suspend_by_id($check_id) {
        if($check = Check::find($check_id)) {
            return $check->suspend_check();
        }
        else
            return false;
    }

    public function suspend_check() {
        $this->paused = ($this->paused) ? 0 : 1;
        if($this->save()) {
            $MongoAPI = new MongoAPI();
            $MongoAPI->updateCheckInMongo(
                $this->mongo_id,
                $this->type,
                'KUU-' . $this->user_id . '-' . $this->check_id,
                $this->domain.((($s = Check::getPathFromURLString( $this->url )) != 'Homepage') ? '/'.$s : ''),
                $this->paused,
                $this->get_match()
            );
            return true;
        }
        else {
            return false;
        }
    }

    static function get_user_check( $user_id = 0 ) {
        if(!$user_id )
            $user_id = Sentry::getUser()->id;
        return Check::where('user_id', '=', $user_id);
    }

    static function delete_by_id($check_id) {
        if($check = Check::find($check_id)) {
            return $check->delete_check();
        }
        else
            return false;
    }

    public function delete_check() {
        $MongoAPI = new MongoAPI();
        $mongo_request = $MongoAPI->deleteCheckInMongo($this->mongo_id);
        Log::info($mongo_request);
        $mongo_result = json_decode($mongo_request);
        if(isset($mongo_result->Result) && ($mongo_result->Result == 'OK')) {
            try {
                DB::beginTransaction();
                foreach($this->checkalertemail as $alert) {
                    $alert->delete();
                }
                $this->delete();
                DB::commit();
            } catch (\PDOException $e) {
                DB::rollback();
                return false;
            }
            return true;
        }
        return false;
    }


    static function getDomainFromURLString( $url ){
        $parse = parse_url( $url );
        if( isset($parse['host']) ){
            return $parse['host'];
        }

        return '';
    }

    static function getPathFromURLString( $url ){
        $parse = parse_url( $url );

        if( !isset($parse['path']) || ( isset($parse['path']) && $parse['path'] == '/' ) ){
            // return $parse['host'];
            return 'Homepage';
        } else {
            return substr( $parse['path'], 1, strlen( $parse['path'] ) - 1 );
        }

        return '';
    }

    static function sendCurlRequest($url,$ssl=false){
        $curlInit = curl_init($url);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,5);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        if($ssl){
            curl_setopt($curlInit,CURLOPT_SSL_VERIFYPEER,false);
        }
        curl_exec($curlInit);
        $http_status = curl_getinfo($curlInit,CURLINFO_HTTP_CODE);
        curl_close($curlInit);
        return $http_status;
    }

    static function sendEchoRequest($host , $timeout = 1){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            exec(sprintf('ping -n 1 -w 5 %s', escapeshellarg($host)), $res, $rval);
        else
            exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
        return $rval === 0;
    }

}