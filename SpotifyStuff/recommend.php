<?php

require 'vendor/autoload.php';
session_start();
$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A session for example.
$api->setAccessToken($_SESSION['access']);

//pretty print for account data to access for php scripting (use when programming)
echo "<pre>";
print_r(
    $api->me()
);
echo "</pre>";
print_r(getRecommendations(5, '5rQEom98vgByjAZ4kIw2kL'));
//seed song is given

//reccomendations are compiled

?>