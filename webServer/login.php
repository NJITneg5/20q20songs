<?php require_once("partials/functions.php") ?>

<html lang="en">
<head>
    <title>20Q20Songs Login</title>
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
        <h3>Log In</h3>
    </div>
    <div>
        <h3>Please log in with your username and password.</h3>
        <form method = "POST" id = "loginForm">
            <label for= "userEmail">Username/Email:</label><br>
            <input type = "text" id= "userEmail" name="userEmail" required/><br>

            <label for="pw">Password:</label><br>
            <input type="password" id="pw" name="pw" required/><br>

            <input type="submit" name="login" value="Login"/><br>
        </form>
    </div>
</body>
</html>

<?php
    if (isset($_POST["login"])){
        $userEmail = null;
        $user = null;
        $email = null;
        $password = null;
        $stmt = null;
        $params = null;
        $endings = [".com", ".org", ".net", ".int",".edu",".gov",".mil"];

        if (isset($_POST["userEmail"])) {
            $userEmail = $_POST["userEmail"];
        }

        if (isset($_POST["pw"])) {
            $password = $_POST["pw"];
        }

        $isValid = true; //used to determine if you have the info to safely query the db.

        if (!isset($userEmail) || !isset($password)) {
            $isValid = false;
        }

        foreach($endings as $end) {
            if (strpos($userEmail, "@") && strpos($userEmail, $end)) {
                $email = $userEmail;
                break;
            }
        }

        if (!isset($email)) {
            $user = $userEmail;
        }

        if(!isset($email) && !isset($user)){
            $isValid = false;
        }

        //Everything beyond here is somewhat temporary until we get Rabbit up and running.
        if($isValid){ //All DB query statements should go within these brackets
		    login($email, $user, $password);
            logging("Webserver/login.php", "Successful login: " . $user . ", " . $email);
            //TODO after the db verifies log in, we need to create a session.
        }
        else{
            logging("WebServer/login.php", "Could not log user in.");
            //echo("There was a validation issue"); //TODO This can be updated to use Bootstrap
        }
    }
?>
