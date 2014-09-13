<?php
class CheckSiteController extends BaseController {
	private $siteInfo;
	private $mongoAPI;
	private $checkAlertEmail;
	private $check_create_limit_num;


	public function __construct(UserSiteInfo $siteInfo){
        //--
		$kuu_config = Config::get('kuu');
		$this->check_create_limit_num = $kuu_config['check_create_limit_num'];
	}

    private function store_check_info($parameters) {
        $check = new Check;
        $error_messages = array();
        if(!$check->user_store_check($parameters)) {
            $error_messages = $check->validate_errors;
        }
        else {
            $mess = $this->user_save_check_alert_emails($check->check_id);
            foreach($mess as  $error_message) {
                array_push($error_messages, $error_message);
            }
        }
        Session::flash('error_messages', $error_messages);
        $user_check_count = Check::get_user_check()->count();
        return Response::json( array(
            'err' => 0,
            'is_add_enable'		=> ( $user_check_count < $this->check_create_limit_num ) ? true : false,
        ) );
    }

    private function update_check_info($parameters) {
        if($check = Check::find($parameters['check_id'])){
            $error_messages = array();
            if(!$check->user_update_check($parameters)) {
                array_merge($error_messages, $check->validate_errors);
            }
            else {
                    $mess = $this->user_save_check_alert_emails($check->check_id);
                    Log::info('Mess: '.print_r($mess,true));
                    array_merge($error_messages, $mess);
            }
        }
        Session::flash('error_messages', $error_messages);
        return \Response::json(array('status'=>'OK'));
    }


    private function user_save_check_alert_emails($check_id = 0) {
        $input = \Input::all();
        $input['check_id'] = $check_id;
        $alert_email = CheckAlertEmail::user_update_alert_email($input);
        return $alert_email->validate_errors;
    }

    public function postAddSiteInfoHTTP(){
        $input = \Input::all();
        Log::info(print_r($input, true));
        $parameters = array(
            'type' => 'http',
            'url' => $input['http_url'],
            'post_body' => $input['post_body'],
            'phrases' => $input['http_phrases'],
            'host' => '',
        );
        return $this->store_check_info($parameters);
    }

    public function postAddSiteInfoHTTPS(){
        $input = \Input::all();
        $parameters = array(
            'type' => 'https',
            'url' => $input['https_url'],
            'post_body' => $input['post_body'],
            'phrases' => $input['https_phrases'],
            'host' => '',
        );
        return $this->store_check_info($parameters);
    }

    public function postAddSiteInfoDNS(){
        $input = \Input::all();
        $parameters = array(
            'type' => 'dns',
            'url' => 'http://'.$input['dns_host_name'],
            'edit_options' => 'change',
            'options' => '',
            'host' => $input['dns_ip'],
        );
        return $this->store_check_info($parameters);
    }

    public function testsiteinfo() {
        $input = \Input::all();
        if($input['type'] == 'auto')
            return $this->testSiteInfoAuto();
        $parameters = array(
            'type' => (isset($input['type'])) ? $input['type'] : '',
            'url' => (isset($input['url'])) ? $input['url'] : ((isset($input['dns_host_name'])) ? 'http://'.$input['dns_host_name'] : ''),
            'edit_options' => (isset($input['dns_ip'])) ? 'change' : '',
            'options' => '',
            'phrases' => (isset($input['phrases'])) ? $input['phrases'] : '',
            'host' => (isset($input['dns_ip'])) ? $input['dns_ip'] : '',
        );

        if(isset($input['check_id']))
            $parameters['check_id'] = $input['check_id'];
        $check = new Check;
        $error_messages = array();
        $success_message = 'Success testing!';
        if(!$check->user_validate($parameters, 'testing')) {
            $success_message = '';
            $error_messages = $check->validate_errors;
        }


        return Response::json( array(
            'error_messages' => $error_messages,
            'success_message' => $success_message,
        ) );
    }

    private function testSiteInfoAuto(){
        $input = \Input::all();
        $error_messages = array();
        $success_message = 'Success testing!';
        $types = array('http', 'https', 'dns');
        foreach($types as $type) {
            $parameters = array(
                'type' => $type,
                'url' => (isset($input['url'])) ? $input['url'] : '',
                'edit_options' => ($type == 'dns') ? 'change' : '',
                'options' => '',
                'phrases' => (isset($input['phrases'])) ? $input['phrases'] : '',
                'host' => ($type == 'dns') ? gethostbyname(Check::getDomainFromURLString($input['url'])) : '',
            );

            $check = new Check;
            if(!$check->user_validate($parameters, 'testing')) {
                $success_message = '';
                $error_messages = array_merge($error_messages, $check->validate_errors);
            }
        }
        return Response::json( array(
            'error_messages' => $error_messages,
            'success_message' => $success_message,
        ) );
    }


    public function postAddSiteInfoAuto(){
        $input = \Input::all();
        $error_messages = array();
        $types = array('http', 'https', 'dns');
        $i = 0;
        foreach($types as $type) {
            $parameters = array(
                'type' => $type,
                'url' => $input['url'],
                'edit_options' => 'change',
                'options' => '',
                'host' => ($type == 'dns') ? gethostbyname(Check::getDomainFromURLString($input['url'])) : '',
            );

            $check = new Check;
            if(!$check->user_store_check($parameters)) {
                $error_messages = array_merge($error_messages, $check->validate_errors);
            }
            else {
                $i++;
                $mess = $this->user_save_check_alert_emails($check->check_id);
                if($i == 1) {
                    foreach($mess as  $error_message) {
                        array_push($error_messages, $error_message);
                    }
                }
            }
        }
        Session::flash('error_messages', $error_messages);
        $user_check_count = Check::get_user_check()->count();
        return Response::json( array(
            'status'			=>'OK',
            'is_add_enable'		=> ( $user_check_count < $this->check_create_limit_num ) ? true : false,
        ) );
    }


    public function deleteCheck(){
        $check_id = Input::get( 'del_check_id' );
        if(!Check::delete_by_id($check_id)){
            Session::flash('error_messages', trans('kuu-validation.check_was_not_deleted'));
        }
        $user_check_count = Check::get_user_check()->count();

        return \Response::json(array(
            'is_add_enable'		=> ( $user_check_count < $this->check_create_limit_num ) ? true : false,
        ));
    }


    public function suspendCheck(){
        $suspend_check_id = Input::get( 'suspend_check_id' );
        Check::suspend_by_id($suspend_check_id);
    }


	
	public function refresh(){
		$userSiteInfo = new UserSiteInfo();
        $check_list = $userSiteInfo->getCheckSiteListByUserId(  Sentry::getUser()->id );
		return \Response::make( View::make('/dashboard/check-list', array('check_list' => $check_list)) );
	}
	
	public function getSiteInfo(){

		if($check = Check::find(Input::get('check_id', 0))) {


            return \Response::json(array(
                'check_id' => Input::get('check_id', 0),
                'type' => $check->type,
                'url' => $check->url,
                'host' => $check->host,
                'options' => json_decode($check->options),
                'alert_email' => $check->checkalertemail->toArray()
            ));
        }
        else
            return \Response::json(array(
                'check_id' => Input::get('check_id', 0),
                'type' => 'error',
            ));
	}



    public function editHTTPSiteInfo(){
        $input = \Input::all();
        $parameters = array(
            'check_id' => $input['checkid'],
            'type' => 'http',
            'url' => $input['http_url'],
            'phrases' => $input['http_phrases'],
            'post_body' => $input['post_body'],
            'host' => '',
        );
        return $this->update_check_info($parameters);
    }

    public function editHTTPSSiteInfo(){
        $input = \Input::all();
        $parameters = array(
            'check_id' => $input['checkid'],
            'type' => 'https',
            'url' => $input['https_url'],
            'phrases' => $input['https_phrases'],
            'post_body' => $input['post_body'],
            'host' => '',
        );
        return $this->update_check_info($parameters);
    }

    public function editDNSSiteInfo(){
        $input = \Input::all();
        $parameters = array(
            'check_id' => $input['checkid'],
            'type' => 'dns',
            'url' => 'http://'.$input['dns_host_name'],
            'edit_options' => 'change',
            'options' => '',
            'host' => $input['dns_ip'],
        );
        return $this->update_check_info($parameters);
    }


}