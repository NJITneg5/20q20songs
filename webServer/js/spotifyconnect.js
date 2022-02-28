var redirect_uri = "https://127.0.0.1"

var client_id = "";
var client_secret = "";

const AUTHORIZE = "https://accounts.spotify.com/authorize"

function onPageLoad(){


}

function handleRedirect(){
    let code = getCode();
}


function getCode(){
    let code = null;
    const query = window.location.search;
    if (queryString.length > 0){
        const urlParams = new URLSearchParams(queryString);
        code = urlParams.get(code);
    }
    return code;
}

function requestAuthorization(){
    client_id = document.getElementById("clientId").value;
    client_secret = document.getElementById("clientSecret").value;
    localStorage.setItem("client_id", client_id);
    localStorage.setItem("client_secret", client_secret) //probably a bad idea to expose cleitn secret data.. oopsie.

    let url =  AUTHORIZE;
    url += "?client_id=" + client_id;
    url += "&response_type=code";
    url += "redirect_uri=" + encodeURI(redirect_uri);
    url += "&show_dialog=true";
    url += "&scope=user-read-private user-read-email user-modify-playback-state user-read-playback-position user-library-read streaming user-read-playback-state user-read-recently-played playlist-read-private";
    window.location.href = url; // Show Spotify's authorization screen


}