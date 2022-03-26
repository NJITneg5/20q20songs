<?php

require 'vendor/autoload.php';

function create_session()
{

    $session = new SpotifyWebAPI\Session('3d4c99d6c03f4179a47a552b20a16360', '8c45ea88219a47648dafc884c01cc4fe', 'http://localhost:8080/debugcallback.php');

    return $session;
};
