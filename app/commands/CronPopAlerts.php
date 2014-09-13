<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CronPopAlerts extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:CronPopAlerts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Checks pop alerts API and mails results.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		// How many alerts to request from mongo
		$count = Config::get('kuu.cron_batch_size');

		// KUU Email Settings
		$email_from_address 	= Config::get('kuu.email_from_address');
		$email_from_name 		= Config::get('kuu.email_from_name');
		$email_bcc 				= Config::get('kuu.email_bcc');

		// time in seconds, how often to notify
		$alert_interval_24hrs = Config::get('kuu.alert_interval_24hrs');  // 20 mins
		$alert_interval_over_24hrs = Config::get('kuu.alert_interval_over_24hrs');  // a day

		$http_error_descriptions = Config::get('kuu.http_error_descriptions');

		$url = Config::get('kuu.apiurl').'/rest/popalerts?api_key='.Config::get('kuu.apikey').'&count='.$count;

		$browser = new Buzz\Browser();
		$response = $browser->get($url);

		$response_array = json_decode($response->getContent());
		//$checkAlertEmail = new CheckAlertEmail();

		if(isset($response_array->Result) && $response_array->Result == 'OK') {

			$mail_counter = 0;

			foreach ($response_array->Records as $record_id => $record) {

				$record->time_formatted =  date("m/d H:i:s T", $record->timestamp - $record->downtime);
				$record->title = 'Site is '.Str::title($record->type);
				// $this->info('Record '.print_r($record, TRUE));

				$alert_emails = CheckAlertEmail::getAlertEmailsByMongoId($record->check_id);
//				$alert_emails = CheckAlertEmail::getAlertEmailsByMongoId('5357d420685fabd7490000a4');

				// $this->info('Alert Emails '.print_r($alert_emails, TRUE));


				//DB::select('SELECT * FROM checks LEFT JOIN checks_alert_email USING (check_id) 
				//	LEFT JOIN users ON checks_alert_email.user_id=users.id WHERE mongo_id = ?', 
				//	array('5322c33f3cdffe9926000099'));
				//	array($record->check_id));

				foreach ($alert_emails as $id => $email) {

					// $this->info('Alert email '.print_r($alert_emails, TRUE));

					$since_last_time = time() - strtotime($email->last_sent . " GMT");
					$times_sent = $email->times_sent;

					// $this->info('since_last_time '.$since_last_time.' '.$times_sent.' '.$alert_interval_24hrs.' '.$alert_interval_over_24hrs);
					// $this->info('down since '.$record->downtime.' '. (24*60*60) .'seconds in a day ' . $email_from_address.' '.$email_from_name);

					$isDown = $record->type == 'down';

					$trigger_send = false;

					// if total downtime less than a day, use $alert_interval_24hrs, otherwise use 
					if ( ($record->downtime < 24*60*60) && ( $since_last_time >= $alert_interval_24hrs ) )
						$trigger_send = true;
					elseif ( ($record->downtime >= 24*60*60) && ( $since_last_time >= $alert_interval_over_24hrs ) )
						$trigger_send = true;

					if($trigger_send || !$isDown ) {

						//$this->info($email->alert_email.' '.$email->first_name.' '.$email->last_name);
						$record->alert_email = $email;
						$record->protocol = $email->type;
						$record->http_error_descriptions = $http_error_descriptions;

						$email->subject = $record->title . " - " . $email->url . " - " . $email->type;

						$email->from_address = $email_from_address;
						$email->from_name = $email_from_name;
						$email->bcc_admin = $email_bcc;

						Mail::send('emails.cronalert', (array)$record, function($message) use ($email)
						{						
							$message->from( $email->from_address, $email->from_name );

                            // Remove To email name, you can set alerts to go to 3rd parties, name won't be valid
  						    // $message->to($email->alert_email, $email->first_name.' '.$email->last_name)

                            $message->to($email->alert_email)
						    	->subject( $email->subject );

						    foreach( $email->bcc_admin as $e )
						    	$message->bcc($e);
						    //$message->to('andrei.tsygankov@gmail.com', 'Andrei Tsygankov')->subject('Alerts');

						});
						$mail_counter++;

						//$this->info($email->alert_id.' '.$record->type.' '.$email->last_name);
						if($isDown) {
							CheckAlertEmail::where('alert_id', $email->alert_id)->update(
								array(
									'last_sent' => gmdate("Y-m-d H:i:s"),
									'times_sent' => $times_sent + 1
									));
						}
						else {
							CheckAlertEmail::where('alert_id', $email->alert_id)->update(
								array(
									'last_sent' => '0000-00-00 00:00:00',
									'times_sent' => 0
									));
						}
					}
				}

				// just send to admin
				/*
				if(!count($alert_emails)) {
					Mail::send('emails.cronalert', (array)$record, function($message)
					{
						$message->from('noreply@dev.keepusup.com', 'KeepUsUp');
					    $message->to('andrei.tsygankov@gmail.com', 'Admin')
					    	->subject('Alerts')					    	
					    	//->cc('harrison.hung@gmail.com')
					    	;
					});
					$mail_counter++;
				}
				*/
				
			}
			$this->info('Successfully sent '.$mail_counter.' emails');
		}
		else {
			if(isset($response_array->Result))
				$this->info('Failed with result='.$response_array->Result);
			else
				$this->info('Failed with to fetch REST API data');
		}
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		//	array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
