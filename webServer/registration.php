<?php require_once("partials/functions.php") ?>

<?php
    if(isset($_POST["register"])){
        $email = null;
        $password = null;
        $confirm = null;
        $username = null;

        if(isset($_POST["email"])){
            $email = $_POST["email"];
        }

        if(isset($_POST["pw"])){
            $password = $_POST["pw"];
        }

        if(isset($_POST["confirmPw"])){
            $confirm = $_POST["confirmPw"];
        }

        if (isset($_POST["username"])) {
            $username = $_POST["username"];
        }

        $isValid = true;
        //check to see if passwords match before sending
        if($password == $confirm){
            //flash("Passwords match");
        }
        else{
            echo("Passwords don't match");//TODO use Bootstrap's warnings
            $isValid = false;
        }

        if(!isset($email) || !isset($password) || !isset($confirm)){
            $isValid = false;
        }

        if($isValid){
            $hash = password_hash($password, PASSWORD_BCRYPT);

	    //TODO Use RabbitMQ to insert the new user data into the DB
	    register($email, $username, $hash);
        die(header("Location:registration.php"));
        }
    }
?>
<html lang="en">
<head>
    <title>Bootstrap 5 Example</title>
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
    <h3>Registration</h3>
</div>
<div>
    <h3>Please register your account here.</h3>
    <form method ="POST" id = "regForm">
        <label for="email">Email</label><br>
        <input type= "email" id= "email" name= "email" required/><br>

        <label for= "user">Username:</label><br>
        <input type="text" id="user" name="username" required maxlength="60"/><br>

        <label for= "pw">Password</label><br>
        <input type= "password" id= "pw" name= "pw" required/><br>

        <label for= "confirmPw">Confirm Password</label><br>
        <input type= "password" id= "confirmPw" name= "confirmPw" required/><br>

        <input type= "submit" name= "register" value= "Register"/>
    </form>
</div>
</body>
</html>
