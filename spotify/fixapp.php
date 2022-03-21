<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SpotifyStuff</title>
</head>
<body>
<div>
    <div>
        Spotify Song
    </div>
    <form method="post">
        <p>1) What's your favorite song?</p>
        <input type="text" name="song" placeholder="song" autocomplete="off"><br>
        <p>2) Who's your favorite artist?</p>
        <input type="text" name="artist" placeholder="artist" autocomplete="off"> <br>
        <p>3) What's your favorite genre?</p>
        <input type="text" name="genre" placeholder="genre" autocomplete="off"> <br>
        <p>4) On a scale of 0 - 1 (use decimals) Do you Like songs that are heavily instrumental?</p>
        <input type="text" name="inst" placeholder="inst" autocomplete="off"><br>
        <p>4) On a scale of 0 - 1 Do you Like songs that are danceable?</p>
        <input type="text" name="dance" placeholder="dance" autocomplete="off"><br>
        <p>5) How long do you like your songs (use milliseconds: 60,000ms = 1minute)</p>
        <input type="text" name="time" placeholder="time" autocomplete="off"><br>
        <input type="submit" name="submit" value="SAVE">
    </form>
</div>
</body>
</html>
<?php


if (isset($_POST['song'])) {
    $song = "Song:" . $_POST['song'];
    $artist = "Artist:" . $_POST['artist'];
    $genre = "Genre:" . $_POST['genre'];
    echo $song . $artist . $genre;


    include(__DIR__ . '/src/SpotifyWebAPI.php');
    require 'vendor/autoload.php';

    session_start();
    $api = new SpotifyWebAPI\SpotifyWebAPI();

// Fetch the saved access token from somewhere. A session for example.
    $api->setAccessToken($_SESSION['access']);
//this creates the playlist we will then populate
    $playlist = $api->createPlaylist([
        'name' => '20q20songs Inputted 20 Song 3/14/22'
    ]);
    echo "created Playlist Named" . $playlist->name;
    $playlistid = $playlist->id;
    $options = [];
    echo "Recommendations for song:";
    //this gets a reccomendations object that is NOT in the playlist yet. it's its own separate thing.
    $play = $api->getRecommendations([
        'limit' => '19', //Starts counting at 0
        'market' => 'ES',
        'seed_artist' => $_POST['artist'],
        'seed_genre' => $_POST['genre'],
        'seed_tracks' => $_POST['song'],
        'target_instrumentalness' => $_POST['inst'],
        'target_danceability' => $_POST['dance'],
        'min_duration_ms' => $_POST['time']
    ]);
    //this prints the array of reccomendations
    echo "<pre>";
    print_r(
        $play
    );
    echo "</pre>";
    //this goes through the reccomendations, finds each song, and adds them to the prior created playlist's tracks
    foreach ($play as $container) {
        foreach ($container as $object => $value) {
            echo $value->id . "\n";
            $api->addPlaylistTracks($playlistid, $value->id);
        }
    }
}
