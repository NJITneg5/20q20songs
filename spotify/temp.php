<!DOCTYPE html>
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
    <form>
        <div class="form-group">
            <form method="post">
                <input type="text" name="song" placeholder="song" autocomplete="off"><br>
                <input type="text" name="artist" placeholder="artist" autocomplete="off"> <br>
                <input type="text" name="genre" placeholder="genre" autocomplete="off"> <br>
                <input type="submit" name="submit" value="SAVE">
            </form>
        </div>
    </form>
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
        <div class="col-sm-4">
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
        </div>
        <div class="col-sm-4">
            <h3>Privacy Policy</h3>
            <p>Sample stuff that would become privacy stuff later</p>
        </div>
    </div>
</div>

</body>
</html>