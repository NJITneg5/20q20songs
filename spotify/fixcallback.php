<?php

require 'vendor/autoload.php';
require 'config.php';
session_start();
$session = create_session();

$state = $_GET['state'];

// Fetch the stored state value from somewhere. A session for example
/*
if ($state !== $storedState) {
    // The state returned isn't the same as the one we've stored, we shouldn't continue
    die('State mismatch');
}
*/
// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Store the access and refresh tokens somewhere. In a session for example
$_SESSION['access'] = $accessToken;
$_SESSION['refresh'] = $refreshToken;

// Send the user along and fetch some data!
header('Location: fixapp.php');
die();
