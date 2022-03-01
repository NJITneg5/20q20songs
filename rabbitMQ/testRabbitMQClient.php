#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "This is a test message from Nick or Anthony going through Bryon's Queue to Nate's Server.";
}

function login($username, $password, $username){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$request = array();

	$request['type'] = "login";
	$request['username'] = $username;
	$request['password'] = $password;
	$request['email'] = $email;

	$response = $client->send_request($request);
	//$response = $client->publish($request);

	return $response;
}
//echo " Group client received response: ".PHP_EOL;
//print_r($response);
//echo "\n\n";

echo $argv[0]." END".PHP_EOL;

