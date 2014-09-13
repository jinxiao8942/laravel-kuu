<?php
class CheckAlertEmail extends Eloquent{
	protected $table = 'checks_alert_email';
	public $timestamps = false;
    protected $primaryKey = 'alert_id';
    public $validate_errors = array();


	
	function __construct(array $attributes = array()){
		$query = "
			CREATE TABLE IF NOT EXISTS `{$this->table}` (
				`user_id` int(11) NOT NULL,
				`check_id` int(11) NOT NULL,
				`alert_id` int(11) NOT NULL AUTO_INCREMENT,
				`alert_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`alert_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
		";
		
		DB::statement($query);
	}

    public function check()
    {
        return $this->belongsTo('Check', 'check_id');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function get_error_message(){

        $res = '';
        foreach($this->validate_errors as $e) {
            $res .= $e.'<br>';
        }
        return $res;
    }

    private function  set_custom_attributes($v,$attributes){
        $validate_errors = $v->messages()->all();
        foreach($validate_errors as $message) {
            foreach($attributes as $key => $value)
                $message = str_ireplace(':'.$key, $value, $message);
            array_push($this->validate_errors, $message);
        }
    }

    public function validate($input_arr = array()){
        $this->validate_errors = array();
        $rules = array(
            'email' => 'required|email|in_database',
            //'check_id' => 'required|integer|exists:checks,check_id'
        );

        Validator::extend('in_database',function($attribute,$value,$parameters) use ($input_arr){
            Log::info('in database '.$value);
            return (CheckAlertEmail::where('check_id', '=',(isset($input_arr['check_id']) && ($c = $input_arr['check_id'])) ? $c : 0)->where('alert_email','=',$value)->count() == 0);
        });

        $validator = Validator::make($input_arr,$rules);
        if($validator->fails()) {
            $this->set_custom_attributes($validator,array('email' => $input_arr['email'], 'action' => $input_arr['action']));
            //$this->validate_errors = $validator->messages()->all();
            return false;
        }
        else
            return true;
    }

    public function store_alert_email($input_arr  = array()) {
        $input_arr['action'] = 'saving';
        if(!$this->validate($input_arr)){
            //$this->format_error_messages($input_arr['email'], 'adding');
            return false;
        }
        if($check = Check::find(intval($input_arr['check_id']))) {
            $this->check_id = $input_arr['check_id'];
            $this->user_id = $check->user_id;
            $this->alert_email = $input_arr['email'];
            if($this->save()) {
                return true;
            }
        }
        return false;
    }

    public function update_alert_email($input_arr  = array()) {
        $input_arr['action'] = 'updating';
        if(!$this->validate($input_arr)){
            //$this->format_error_messages($input_arr['email'], 'updating');
            return false;
        }
        if($check = Check::find(intval($input_arr['check_id']))) {
            $this->check_id = $input_arr['check_id'];
            $this->user_id = $check->user_id;
            $this->alert_email = $input_arr['email'];
            if($this->save()) {
                return true;
            }
        }
        return false;
    }

    static function user_update_alert_email($input_arr = array()){
        $error_messages = array();
        $emails = CheckAlertEmail::get_by_check_id($input_arr['check_id']);
        $current_emails = array();
        $input_emails = array_unique($input_arr['check_alert_email']);
        foreach($emails as $email){
            array_push($current_emails, $email->alert_email);
        }
        foreach($input_emails as $email) {
            if(!in_array($email, $current_emails)) {
                $alert_email = new CheckAlertEmail();
                if(!$alert_email->store_alert_email(array('check_id' => $input_arr['check_id'], 'email' => $email))) {
                    array_merge($error_messages, $alert_email->validate_errors);
                    Log::info('user_save_check_alert_emails: '.print_r($error_messages,true).'<br>'.print_r($alert_email->validate_errors,true));
                }
                else
                    array_push($current_emails, $email);

            }
        }
        foreach($current_emails as $email){
            if(!in_array($email, $input_emails)) {
                CheckAlertEmail::where('check_id', '=', $input_arr['check_id'])->where('alert_email', '=', $email)->delete();
            }
        }
        $alert_email = new CheckAlertEmail();
        $alert_email->validate_errors = $error_messages;
        return $alert_email;
    }

    static function get_by_check_id($check_id) {
        $emails = new CheckAlertEmail;
        return $emails->where('check_id','=',$check_id)->get();
    }


	function insert( $user_id, $check_id, $alert_email ){
		$query = "INSERT INTO {$this->table} SET user_id={$user_id}, check_id='{$check_id}', alert_email='{$alert_email}'";
		
		DB::statement($query);
	}
	
	function deleteDataByCheckId( $check_id ){
		$query = "DELETE FROM {$this->table} WHERE check_id={$check_id}";
		
		DB::delete( $query );
	}
	
	function getDataByCheckId( $check_id ){
		$query = "SELECT * FROM {$this->table} WHERE check_id={$check_id} ORDER BY alert_email";
		
		return DB::select( $query );
	}

	static function getAlertEmailsByMongoId( $mongo_id ) {
		return DB::select('SELECT * FROM checks LEFT JOIN checks_alert_email USING (check_id) 
			LEFT JOIN users ON checks_alert_email.user_id=users.id WHERE mongo_id = ?',
			array($mongo_id));	
	}
}