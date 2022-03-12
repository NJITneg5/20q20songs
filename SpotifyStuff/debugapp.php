<?php

include(__DIR__ . '/src/SpotifyWebAPI.php');
require 'vendor/autoload.php';

session_start();
$api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A session for example.
$api->setAccessToken($_SESSION['access']);

//pretty print for account data to access for php scripting (use when programming)
echo "<h3>" . "Data Dump of Auth Token" . "</h3>";
echo "________________________________________________________________________";
echo "<pre>";
print_r(
    $api->me()
);
echo "</pre>";

//format for getting things from the php array ex: this gets the userid of the authenticated user.
$me = $api->me();
$userid = $me->id;
echo "<h3>" . "The Users ID is " . "$userid" . "</h3>";

echo "<h3><u>" . "The Users last five playlists are" . "</u></h3>";
$playlists = $api->getUserPlaylists($userid, [
    'limit' => 5
]);

foreach ($playlists->items as $playlist) {
    echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
}
echo "________________________________________________________________________";
echo "<br><br><br><br>";

echo "Creating Playlist Named 20q20songs custom playlist";
$playlist = $api->createPlaylist([
    'name' => '20q20songs Truely 20 Song'
]);

$playlistid = $playlist->id;
//format for getting things from the php array ex: this gets the userid of the authenticated user.
echo "<h3>" . "The playlist ID is " . "$playlistid" . "</h3>";

echo "Pretty Print of the playlist info:" . "<pre>";
    print_r($playlists);
echo "</pre>";

$options = [];
echo "Recommendations for song:";
$play = $api->getRecommendations([
    'limit' => '19', //Starts counting at 0
    'market' => 'ES',
    'seed_artist' => '2Mu5NfyYm8n5iTomuKAEHI',
    'seed_genre' => 'soul',
    'seed_tracks' => '2GFExyKXf9383tSRSrEHEt',
    'min_danceability' => '1.0'
]);


echo "<pre>";
print_r($play);
echo "</pre>";

//$adding = $api -> addPlaylistTracks($playlistid, ['3qQVUOHJdgIFWJd0jrG9GE', '3qQVUOHJdgIFWJd0jrG9GE']);

foreach ($play as $container) {
    foreach($container as $object => $value){
        echo $value->id . "\n";
        $api -> addPlaylistTracks($playlistid, $value->id);
    }
}


print_r("\n\n 20q20songs playlist gen success");
