<?php
return array(


	'host' => $_ENV['MAIL_SERVER'],
	'port' => 587,

	'from' => array('address' => 'support@keepusup.com', 'name' => 'KeepUsUp Support'),

	'encryption' => 'tls',

	'username' => $_ENV['MAIL_USER'],
	'password' => $_ENV['MAIL_PASSWORD'],

);
