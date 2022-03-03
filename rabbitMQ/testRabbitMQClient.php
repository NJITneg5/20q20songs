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

/*function login($email, $username, $password){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$request = array();

	$request['type'] = "login";
	$request['email'] = $email;
	$request['username'] = $username;
	$request['password'] = $password;
	$response = $client->send_request($request);
	//$response = $client->publish($request);

	return $response;
}*/

/*function register($email, $username, $password){
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $request = array();

	$request['type'] = "register";
	$request['email'] = $email;
        $request['username'] = $username;
        $request['password'] = $password;
        $response = $client->send_request($request);
        //$response = $client->publish($request);

        return $response;
}*/
//echo " Group client received response: ".PHP_EOL;
//print_r($response);
//echo "\n\n";

echo $argv[0]." END".PHP_EOL;

