#!/usr/bin/php
<?php
require_once('../rabbitMQ/path.inc');
require_once('../rabbitMQ/get_host_info.inc');
require_once('../rabbitMQ/rabbitMQLib.inc');

/**
 * @param $song string SongID in Spotify, may be updated to an actual song (ex. 7L4G39PVgMfaeHRyi1ML7y)
 * @param $artist string ArtistID in Spotify, may be updated to an artist (ex. 6mQfAAqZGBzIfrmlZCeaYT)
 * @param $genre string genre in spotify (ex. rock, pop, jazz)
 * @param $instrumental string value between 0.0 and 1.0
 * @param $danceable string value between 0.0 and 1.0
 * @param $length string large value that is converted from x*60000
 * @return string The link to the spotify playlist
 */
function doSendSongs($song, $artist, $genre, $instrumental, $danceable, $length){

    require_once("../spotify/src/SpotifyWebAPI.php");
    require_once("../spotify/vendor/autoload.php");
    require_once("../spotify/config.php");

    $api = new SpotifyWebAPI\SpotifyWebAPI();
    $myfile = fopen("../spotify/accesstoken.txt", "r") or die("Unable to open file!");
    $access = fread($myfile, filesize("../spotify/accesstoken.txt"));
    $api->setAccessToken($access);

    $playlist = $api->createPlaylist([
        'name' => '20q20Songs Rabbit Playlist'
    ]);

    $playlistID = $playlist->id;

    $play = $api->getRecommendations([
        'limit' => '19',
        'market' => 'ES',
        'seed_artist' => $artist,
        'seed_genre' => $genre,
        'seed_tracks' => $song,
        'target_intrumentalness' => $instrumental,
        'target_danceability' => $danceable,
        'min_duration_ms' => $length
    ]);

    foreach ($play as $container) {
        foreach ($container as $object => $value) {
            echo $value->id . "\n";
            $api->addPlaylistTracks($playlistID, $value->id);
        }
    }

    $link = $playlist->external_urls->spotify;
    echo $playlist->external_urls->spotify;
    return $link;
}

function requestProcessor($request)
{
    echo "received request".PHP_EOL;
    var_dump($request);
    if(!isset($request['type']))
    {
        return "ERROR: unsupported message type";
    }
    switch ($request['type'])
    {
        case "sendSongs":
            return doSendSongs($request['song'],$request['artist'],$request['genre'],$request['instrumental'],$request['danceable'],$request['length']);
    }
    return array("returnCode" => '0', 'message'=>"Server received request and processed on Nate's VM");
}

$server = new rabbitMQServer("spotify.ini","testServer");

echo "GroupTestRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "GroupTestRabbitMQServer END".PHP_EOL;
exit();

?>

