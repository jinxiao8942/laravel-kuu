<?php

$salt = 'b15257a5d6c5cb94eba69d3';
$base_url = 'http://dev.keepusup.com/';
$url = $base_url.'sso-login';

$json_value = new stdClass();
$json_value->emf_user_id = rand(10,1000);
$json_value->first_name = 'Test name';
$json_value->last_name = 'Last name';
//$json_value->emf_user_id = 860;
$json_value->email = 'emf.test'.$json_value->emf_user_id.'@test.com';
//$json_value->email = 'emf.test_860@test.com';
$json_value->signature = sha1($salt.$json_value->emf_user_id.$json_value->email);

$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_value));
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$error = curl_error($ch);
$header_size = curl_getinfo($ch,CURLINFO_HEADER_SIZE);
$result['header'] = substr($output, 0, $header_size);
$result['body'] = substr( $output, $header_size );
$result['http_code'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);
$result['last_url'] = curl_getinfo($ch,CURLINFO_EFFECTIVE_URL);
curl_close($ch);
$resarray = json_decode($result['body']);




echo 'HTTP code:'.$result['http_code'].'<br>Returned: '.$result['body'];
$token = (isset($resarray) && isset($resarray->token)) ? $resarray->token : false;
if($token)
    echo '<br><a href="'.$base_url.'emf/'.base64_encode($token).'">Enter KeepUsUp</a>';