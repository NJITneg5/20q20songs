<?php

require 'vendor/autoload.php';
require 'config.php';

$session = create_session();

$api = new SpotifyWebAPI\SpotifyWebAPI();

//print_r("stuff here");
if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());
    // $api->me() returns a php array
    $me = $api->me();
    $images = $me->images;
    echo "<pre>";
    print_r($me);
    echo "</pre>";
    echo "<br><br>";

    foreach ($images as $idx => $image) {
        echo "<img src='{$image->url}' /><br>";
    }
} else {
    $options = [
        'scope' => [
            'user-read-email',
        ],
    ];
    print_r("get not set");
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}
?>