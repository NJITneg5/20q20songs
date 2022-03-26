<?php
require 'vendor/autoload.php';
session_start();
$session = new SpotifyWebAPI\Session(
    '3d4c99d6c03f4179a47a552b20a16360',
    '8c45ea88219a47648dafc884c01cc4fe',
    'http://localhost:8080/debugcallback.php'
);

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
header('Location: debugapp.php');
die();
