<?php

require 'vendor/autoload.php';

    $session = new SpotifyWebAPI\Session('3d4c99d6c03f4179a47a552b20a16360', '8c45ea88219a47648dafc884c01cc4fe', 'http://localhost:8080/fixcallback.php');

$api = new SpotifyWebAPI\SpotifyWebAPI();

$state = $session->generateState();
$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
        'playlist-modify-private',
        'playlist-modify-public',
    ],
    'state' => $state,
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();
