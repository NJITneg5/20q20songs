<?php
require_once('../../rabbitMQ/path.inc');
require_once('../../rabbitMQ/get_host_info.inc');
require_once('../../rabbitMQ/rabbitMQLib.inc');

session_start();

function login($email, $username, $password)
{
    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $request = array();

    $request['type'] = "login";
    $request['email'] = $email;
    $request['username'] = $username;
    $request['password'] = $password;
    $response = $client->send_request($request);
    //$response = $client->publish($request);

    return $response;
}

function findFriend($friend)
{
    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $request = array();

    $request['type'] = "findFriend";
    $request['friend'] = $friend;
    $response = $client->send_request($request);
    //$response = $client->publish($request);

    return $response;
}

function getSession($email, $username){
	
	$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

   	$request = array();

   	$request['type'] = "getSession";
	$request['email'] = $email;
	$request['username'] = $username;
   	$response = $client->send_request($request);
   	//$response = $client->publish($request);

   	return $response;
}

function register($email, $username, $password){

    $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $request = array();

	$request['type'] = "register";
	$request['email'] = $email;
        $request['username'] = $username;
        $request['password'] = $password;
        $response = $client->send_request($request);
        //$response = $client->publish($request);

        return $response;
}

function logging($origin, $msg){
    /*
     * @param string $origin should be server/file
     * @param string $msg should be the error message. Function should automatically append a time stamp
     */
    $client = new rabbitMQClient("loggingRabbitMQ.ini","logging");

    $request['type'] = "logging";
    $request['origin'] = $origin;
    $t=time();
    $sentMsg = date("Y-m-d\  h:i:sa",$t). " : " . $msg;
    $request['message'] = $sentMsg;
    $response = $client->send_request($request);

    return $response;
}
