<?php

class ContactsController extends Controller {

	public function send(){
		//check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
				'err' => 1,
                'msg' => trans('kuu-validation.unauthorized_attempt_to_create_setting')
            ) );
        }
		
		$name = Input::get( 'name' );
        $email = Input::get( 'email' );
        $category = Input::get( 'category' );
        $message_content = Input::get( 'message' );
		
		$mail_config = Config::get('mail');
		
		$toEamil = $mail_config['from']['address'];
		$toName = $mail_config['from']['name'];
		
		Mail::send('contact.mails.support', array( 'message_content' => $message_content ), function( $message ) use ($toEamil, $toName, $category){
			$message->from(Input::get( 'email' ), Input::get( 'name' ));
			$message->to($toEamil, $toName);
			$message->subject(trans('kuu-validation.keepusup_support_me') . $category);
		});
	
		return Response::json( array(
			'err' => 0
		) );
	}
	
	function contactSupport(){
		if( !Sentry::check() ) {
			return Redirect::route('login', array('lang' =>App::getLocale()));
		}
		
		$userGroup = "";
		foreach( Sentry::getUser()->groups()->get() as $group ){
			$userGroup .= $group->name . ", ";
		}
		
		$data_model = array(
			'useremail' 		=> Sentry::getUser()->email,
			'first_name' 		=> Sentry::getUser()->first_name,
			'last_name' 		=> Sentry::getUser()->last_name,
			'standard_message' 	=> "",
			'usergroup'			=> $userGroup,
		);
		
		return View::make('dashboard.contact-support', $data_model);
	}
	
	function contactSupportForCheck( $id ){
		if( !Sentry::check() ) {
			return Redirect::route('login', array('lang' =>App::getLocale()));
		}
		
		$userGroup = "";
		foreach( Sentry::getUser()->groups()->get() as $group ){
			$userGroup .= $group->name . ", ";
		}
		
		$UserSiteInfo = new UserSiteInfo();
		$checkInfo = $UserSiteInfo->getDetailUserSiteInfoByCheckId( $id );
		
		$kuu_config = Config::get('kuu');
		$standard_message = $kuu_config['contact_support_message'];
		
		$replace_array = array( "#url#", "#type#", "#availability#", "#response_time#" );
		$data_array = array( $checkInfo['url'], $checkInfo['type'],  $checkInfo['uptime'],  $checkInfo['response_speed'] );
		
		$standard_message = str_replace( $replace_array, $data_array, $standard_message );
		
		$data_model = array(
			'useremail' 		=> Sentry::getUser()->email,
			'first_name' 		=> Sentry::getUser()->first_name,
			'last_name' 		=> Sentry::getUser()->last_name,
			'standard_message' 	=> $standard_message,
			'usergroup'			=> $userGroup,
		);
		
		return View::make('dashboard.contact-support', $data_model);
	}
}