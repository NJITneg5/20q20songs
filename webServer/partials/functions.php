<?php
require_once('../../rabbitMQ/path.inc');
require_once('../../rabbitMQ/get_host_info.inc');
require_once('../../rabbitMQ/rabbitMQLib.inc');

function login($email, $username, $password){
    $client = new rabbitMQClient("authenticationRabbitMQ.ini","authentication");

    $request = array();

    $request['type'] = "login";
    $request['email'] = $email;
    $request['username'] = $username;
    $request['password'] = $password;
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
