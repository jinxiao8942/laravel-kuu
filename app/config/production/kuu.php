<?php
return array(
	
	/*Mongo API Setting*/
	'apiurl' 				=> $_ENV['MONGO_APIURL'],
	'apikey' 				=> $_ENV['MONGO_APIKEY'],
	'alert_threshold' 		=> 2,
	'response_threshold' 	=> 5000,
	'interval' 				=> 300,

    /*Emf prameters*/
	'emf_salt' => 'b15257a5d6c5cb94eba69d3',

    'emf_logout_redirect' => 'https://app.emailmeform.com/builder/manager',
    'emf_login_page' => 'https://www.emailmeform.com/login.html',

	// Email Alert Configurations
	'cron_batch_size'		=> 500,  // 0 is all
	'email_from_address' 	=> "support@keepusup.com",
	'email_from_name' 		=> "KeepUsUp",
	'email_bcc' 			=> ['harrison.hung@gmail.com', 'andrei.tsygankov@gmail.com'],

);