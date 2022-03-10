#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

global $mydb;
$mydb= new mysqli('localhost','it490','20q20songs','it490');

function doLogin($email,$username,$password)
{
	global $mydb;

	$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

	if ($username == null){
		$query = "select password from Users where email='$email';";
		$preResult= $mydb->query($query);
		$result= mysqli_fetch_array($preResult, MYSQLI_ASSOC);
		$finalResult= $result['password'];
	}
	elseif ($username != null){
		$query = "select password from Users where username='$username';";
                $preResult= $mydb->query($query);
                $result= mysqli_fetch_array($preResult, MYSQLI_ASSOC);
                $finalResult= $result['password'];
	}
	//check if result returns anything
	if ($preResult->num_rows == 0){
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
		return false;
	}
}

function doRegistration($email, $username, $password){
	global $mydb;

    $server = new rabbitMQServer("testRabbitMQ.ini","testServer");

	//generate friend code
	$uniquenum = false;	//check to make sure code is available
	$uniquecount = 0;	//only run unique check 10 times
	while (!$uniquenum && $uniquecount < 10){	//loop to generate code
		$newcode = rand(000000, 999999);
		$query = "select friend_code from Users where friend_code = '$newcode';";
		$preResult = $mydb->query($query);
		$result = mysqli_fetch_array($preResult, MYSQLI_ASSOC);
		$finalResult = $result['friend_code'];
		if (empty($finalResult)){
			$uniquenum = true;
			break;
		}
		$uniquecount++;
	}
	if ($uniquecount == 10 && !$uniquenum){
		echo "There was an error making the account, please try again";
		return false;
	}

	//insert data to db
    $stmt = mysqli_prepare($mydb, "INSERT INTO Users (email, username, password, friend_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $email, $username, $password, $newcode);
    $stmt->execute();

    echo "Successfully created account\n";
    return true;
}

function requestProcessor($request)
{
  //echo "received request".PHP_EOL;
  //var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
 	case "login":
	    return doLogin($request['email'],$request['username'],$request['password']);
	case "register":
		return doRegistration($request['email'],$request['username'],$request['password']);
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

//$mydb= new mysqli('localhost','it490','20q20songs','it490');
?>

