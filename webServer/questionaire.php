<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("partials/functions.php");

if(isset($_GET["searchSubmit"])) {
    $song = null;
    $artist = null;
    $genre = null;
    $instrumental = null;
    $danceable = null;
    $length = null;
    $link = null;

    $isValid = false;

    if (isset($_GET['seedSong'])) {
        $song = $_GET['seedSong'];
        $isValid = true;
    } else {
        logging("Webserver/questionnaire.php", "User did not set seed song");
        echo("You need to enter a Seed song"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if (isset($_GET['seedArtist'])) {
        $artist = $_GET['seedArtist'];
    } else {
        logging("Webserver/questionnaire.php", "User did not set seed artist");
        echo("You need to enter a Seed Artist"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if (isset($_GET['seedGenre'])) {
        $genre = $_GET['seedGenre'];
    } else {
        logging("Webserver/questionnaire.php", "User did not set seed genre");
        echo("You need to enter a genre"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if (isset($_GET['instrumental'])) {
        $instrumental = (int)$_GET['instrumental'];
        $instrumental = (float)$instrumental / 100.0;
        $instrumental = (string)$instrumental;
    } else {
        logging("Webserver/questionnaire.php", "User did not set an instrumental value");
        echo("You need to select a value for instrumental"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if (isset($_GET['danceable'])) {
        $danceable = (int)$_GET['danceable'];
        $danceable = (float)$danceable / 100.0;
        $danceable = (string)$danceable;

    } else {
        logging("Webserver/questionnaire.php", "User did not set a danceability");
        echo("You need to enter a value for danceability"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if (isset($_GET['minLength'])) {
        $length = (float)$_GET['minLength'];
        $length = (int)$length * 60000;
        $length = (string)$length;

    } else {
        logging("Webserver/questionnaire.php", "User did not set min length");
        echo("You need to enter a minimum length"); //TODO Bootstrap alerts.
        $isValid = false;
    }

    if ($isValid) {
        $link = sendSongs($song, $artist, $genre, $instrumental, $danceable, $length);
        var_dump($link);
    }
}
?>

<html lang="en">
<head>
    <title>20Q20Songs Questionnaire</title>
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
        .slideContainer {
            width: 100%; /* Width of the outside container */
        }

        /* The slider itself */
        .slider {
            width: 100%; /* Full-width */
            height: 10px; /* Specified height */
            background: #d3d3d3; /* Grey background */
            outline: none; /* Remove outline */
            opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s; /* 0.2 seconds transition on hover */
            transition: opacity .2s;

        }

        /* Mouse-over effects */
        .slider:hover {
            opacity: 1; /* Fully shown on mouse-over */
        }

        .slider::-moz-range-thumb {
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #04AA6D; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

    </style>
</head>
<body class = "bg-dark text-white-50">
<div class="container-fluid p-5 bg-success text-white text-center">
    <h1>20 Questions 20 Songs</h1>
</div>

<div class="container ">
    <h3>Please answer these questions to help us make a playlist for you:</h3>
    <form method = "GET" id = "questionnaire">
        <label for= "seedSong">Question 1: What song do you want to use as a Seed?</label><br>
        <input type = "text" id= "seedSong" name="seedSong" required/><br>

        <label for= "seedArtist">Question 2: What Artist do you want to use as a Seed?</label><br>
        <input type = "text" id= "seedArtist" name="seedArtist" required/><br>

        <label for= "seedGenre">Question 3: What genre would you like?</label><br>
        <input type = "text" id= "seedGenre" name="seedGenre" required/><br>

        <label for= "instrumental">Question 4: Do you want songs that are heavily instrumental? </label><br>
        <div class="slideContainer">
            <input type = "range" min="0" max="100" value="50" class="slider" id= "instrumental" name="instrumental" required/>
        </div>
        <p> Value: <span id="instrumentalOutput"></span></p><br>

        <label for= "danceable">Question 5: Do you want songs that are danceable?</label><br>
        <div class="slideContainer">
            <input type = "range" min="0" max="100" value="50" class="slider" id= "danceable" name="danceable" required/>
        </div>
        <p> Value: <span id="danceableOutput"></span></p><br>

        <label for= "minLength">Question 6: What is the minimum length that you want?(3.5 = 3mins 30secs)</label><br>
        <input type = "text" id= "minLength" name="minLength" required/><br>
        <!-- We will add more later...
                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q1">Question 1: BLAH</label><br>
                <input type = "" id= "q1" name="q1" required/><br>

                <label for= "q20">Question 20: BLAH</label><br>
                <input type = "" id= "q20" name="q20" required/><br>
        -->
        <input type="submit" name="searchSubmit" value="Search" class="btn btn-primary">
        <input type="reset" value="Clear Form" class="btn btn-warning" >
    </form>

    <?php if(isset($link)): ?>
        <h3 class="text-primary"><a href="<?php echo($link)?>">Here is a link to your Spotify Playlist</a></h3>
        <p>Song : <?php echo($song)?></p>
        <p>Artist : <?php echo($artist)?></p>
        <p>Genre : <?php echo($genre)?></p>
        <p>Instrumental : <?php echo($instrumental)?></p>
        <p>Danceable : <?php echo($danceable)?></p>
        <p>Length : <?php echo($length)?></p>
    <?php endif; ?>

</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4">
            <h3>How it works</h3>
            <p>Enter a seed song to put our algorithm in the right direction. </p>
            <p>Our Algorithm will ask you questions about what you like about it </p>
            <p>It will then compare to other songs and ask if you like those </p>
            <p>After that is done, you should have a 20 song playlist made with songs that are similar to your seed song and catered to you! </p>
        </div>
        <!--<div class="col-sm-4">
            <h3>Have an Account? Log in.</h3>
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

            <div id="id01" class="modal text-black-50">

                <form class="modal-content animate" action="/login.php" method="post">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>

                    <div class="container">
                        <h1>Log In</h1>
                        <input type="text" placeholder="Username" name="uname" required>

                        <input type="password" placeholder="Password" name="psw" required>

                        <button type="submit">Login</button>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                    </div>
                </form>
            </div>

            <script>
                // Get the modal
                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            </script>
        </div>-->
        <div class="col-sm-4">
            <h3>Privacy Policy</h3>
            <p>Sample stuff that would become privacy stuff later</p>
        </div>
    </div>
</div>

<script>
    var instrumentalSlider = document.getElementById("instrumental");
    var instrumentalOutput = document.getElementById("instrumentalOutput");
    instrumentalOutput.innerHTML = instrumentalSlider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    instrumentalSlider.oninput = function() {
        instrumentalOutput.innerHTML = this.value;
    }

    var danceableSlider = document.getElementById("danceable");
    var danceableOutput = document.getElementById("danceableOutput");
    danceableOutput.innerHTML = danceableSlider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    danceableSlider.oninput = function() {
        danceableOutput.innerHTML = this.value;
    }
</script>

</body>
</html>