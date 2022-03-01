#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password,$email)
{
	global $mydb

	$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

	$query = "select password from Users where email='$email';";
	$preResult= $mydb->query($query)
	$result= mysqli_fetch_array($preResult, MYSQLI_ASSOC);
	$finalResult= $result['password'];

	//check if result returns anything
	if ($preresult->num_rows == 0){
		echo "Null Result\n";
		return false;
	}

	//validate user info
	if ($finalResult == $password){
		echo "Successful Reseult\n";
		return true;
	}

	//return false in all other instances
	else{
		echo "Failed Result\n";
		return false
	}
}

function doRegistration($email, $username, $password){
	global $mydb;

	$server = new rabbitMQServer("testRabbitMQ.ini","testServer");


}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password'],$request['email'		]);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed on Nate's VM");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "GroupTestRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "GroupTestRabbitMQServer END".PHP_EOL;
exit();

$mydb= new mysqli('localhost','testUser','12345','testdb');
?>

