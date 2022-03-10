<?php

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
/*echo "Creating Playlist Named 20q20songs custom playlist";
$api->createPlaylist([
    'name' => '20q20songs custom playlist'
]);
*/


echo "Pretty Print of the playlist info:" . "<pre>";
    print_r($playlists);
echo "</pre>";


/*$api->addPlaylistTracks('2KwIaLgt0EyMMVUnsTzLfh', [
    '07zVQBJfbOuaAhpT3stRFL',
]);
*/

print_r("20q20songs playlist gen success");
