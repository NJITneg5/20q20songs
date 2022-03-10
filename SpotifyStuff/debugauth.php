<?php

require 'vendor/autoload.php';
require 'config.php';

$session = create_session();

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