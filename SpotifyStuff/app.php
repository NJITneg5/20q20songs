<?php
require 'vendor/autoload.php';
session_start();
$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A session for example.
$api->setAccessToken($_SESSION['access']);

// It's now possible to request data about the currently authenticated user
/*
print_r(
    $api->me()
);
*/

print_r(
    $api->me()
);

$playlists = $api->getUserPlaylists('anthony052001', [
    'limit' => 5
]);

foreach ($playlists->items as $playlist) {
    echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
}

$api->createPlaylist([
    'name' => '20q20songs playlist'
]);

$api->addPlaylistTracks('2KwIaLgt0EyMMVUnsTzLfh', [
    '07zVQBJfbOuaAhpT3stRFL',
]);



print_r("20q20songs playlist gen success");


/*echo "<pre>";
print_r(
    $api->getTrack('2iQPembmg5KvkqXU0sd6xo')
);
echo "</pre>";
*/
?>