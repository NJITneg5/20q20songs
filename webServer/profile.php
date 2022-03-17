<?php
require_once("partials/functions.php");

$username = "temp";
$email = "temp@temp.temp";
$friendCode = "000000";
$result = array();

if(isset($_GET["email"])){
	$email = $_GET["email"];
}
elseif(isset($_SESSION["user"]["email"])){
	$email = $_SESSION["user"]["email"];
}
if(isset($_GET["username"])){
        $username = $_GET["username"];
}
elseif(isset($_SESSION["user"]["username"])){
        $username = $_SESSION["user"]["username"];
}

if(isset($_GET["friend_code"])){
        $friendCode = $_GET["friend_code"];
}
elseif(isset($_SESSION["user"]["friend_code"])){
        $friendCode = $_SESSION["user"]["friend_code"];
}



if(isset($_POST["searchSubmit"])){
    $searchFC = null;
    $isValid = false;

    if(isset($_POST["searchFC"])){
        $searchFC = $_POST["searchFC"];
        if(strlen($searchFC) == 6){
		$result = findFriend($searchFC);
		$username = $result["username"];
		$email = $result["email"];
		$friendCode = $result["friend_code"];
		die(header("Location: profile.php?email=$email&username=$username&friend_code=$friendCode"));
            //TODO work with Nick to get this to return a DB array?
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>20Q20Songs Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {-webkit-transform: scale(0)}
            to {-webkit-transform: scale(1)}
        }

        @keyframes animatezoom {
            from {transform: scale(0)}
            to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body onload = "onPageLoad()" class = "bg-dark text-white-50">
<div class="container-fluid p-5 bg-success text-white text-center">
    <h1>20 Questions 20 Songs</h1>
    <h3>Profile</h3>
    <button onclick="redirectLogout()" style="width:auto;">Logout</button>
    <script>
        function redirectLogout(){
            location.replace("logout.php")
        }
    </script>
</div>

<div class="container-fluid p-5 bg-gradient text-white-50">>
    <p>Username: <?php echo($username)?></p>
    <p>Email: <?php echo($email)?></p>
    <p>Friend Code: <?php echo($friendCode)?></p>

    <form method="POST" id="FriendSearch">
        <label for="searchFC">Enter the friend code you would like to search for: (6-digit number)</label>
        <input id="searchFC" name="searchFC" type="text">
        <input type="submit" name="searchSubmit" value="Search">
    </form>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <h3>How it works</h3>
            <p>Enter a seed song to point our algorithm in the right direction. </p>
            <p>Our Algorithm will ask you questions about what you like about it </p>
            <p>It will then compare to other songs and ask if you like those </p>
            <p>After that is done, you should have a 20 song playlist made with songs that are similar to your seed song and catered to you! </p>
        </div>
        <div class="col-sm-4">
            <h3>Privacy Policy</h3>
            <p>Sample stuff that would become privacy stuff later</p>
        </div>
    </div>
</div>

</body>
</html>
