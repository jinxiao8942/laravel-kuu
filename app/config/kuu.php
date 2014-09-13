<?php
return array(
	/*Check Limit num*/
	'check_create_limit_num'	=> 8,
	
	/*Mongo API Setting*/
	'apiurl' 				=> "http://23.23.237.206:8000",
	'apikey' 				=> "c3RhY2tvdmVyZmxvdy5",
	'alert_threshold' 		=> 2,
	'response_threshold' 	=> 5000,
	'interval' 				=> 300,

    /*Emf prameters*/
	'emf_salt' => 'b15257a5d6c5cb94eba69d3',
	'emf_logout_redirect' => 'https://emf2-internal.emailmeform.com/builder/manager',
    'emf_login_page' => 'https://emf2.emailmeform.com/login.html',

	/*Availability Status Setting*/
	'ava_good' 		=> 99.9,
	'ava_not_good' 	=> 99.5,
	'ava_bad' 		=> 0,
	
	/*Contact Sussport Message*/
	'contact_support_message' => "
Please let us know anything else about this problem:


=== Check Details ====
URL : #url#
Type : #type#
Availability: #availability#
Response Time: #response_time#
",


	// Email Alert Configurations

	'cron_batch_size'		=> 500,  // 0 is all
	'email_from_address' 	=> "support@dev.keepusup.com",
	'email_from_name' 		=> "KeepUsUp",
	'email_bcc' 			=> ['harrison.hung@gmail.com', 'andrei.tsygankov@gmail.com'],

	// time in seconds, how often to notify
	'alert_interval_24hrs' 			=> 58*60,  // 60 mins
	'alert_interval_over_24hrs' 	=> 24*60*60,  // a day

	'http_error_descriptions' 		=> array(
		"default"	=> "An unknown error occured, please contact technical support.",

		"300" =>  "Maximum redirects have been reached",

		"400" => "The request cannot be fulfilled due to bad syntax",
		"401" => "Authentication is required and has failed or has not yet been provided.",
		"402" => "Payment required.",
		"403" => "The request was a valid request, but the server is refusing to respond to it.",
		"404" => "The requested resource could not be found but may be available again in the future.",
		"405" => "A request was made of a resource using a request method not supported by that resource.",
		"406" => "The requested resource is only capable of generating acceptable content.",
		"407" => "The client must first authenticate itself with the proxy.",
		"408" => "The server timed out waiting for the request.",
		"409" => "Request could not be processed because of conflict in the request.",
		"410" => "Resource requested is no longer available and will not be available again.",

		"500" => "A generic error message, given when an unexpected condition was encountered.",
		"501" => "The server either does not recognize the request method.",
		"502" => "The server was acting as a gateway or proxy and received an invalid response.",
		"503" => "The server is currently unavailable.",
		"504" => "The server was acting as a gateway or proxy and did not receive a timely response from the upstream server.",

		"600" => "The provided url is not valid.",
		"700" => "Protocol not supported.",

 		"900" => "An unknown error occured, please contact technical support.",
		"901" => "Matching text or address cannot be found.",
	),
    //locale
    'default_locale' => 'en-us',
    'supported_locales' => array('en-us', 'te-st'),
    // 'default_locale' => 'te-st',
    // 'supported_locales' => array('en-us', 'te-st'),
    //Admin interface config
    'users_per_page' => 25,
    'checks_per_page' => 25
);