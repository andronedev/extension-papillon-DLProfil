<?php
// Ce script permet de resoudre le probleme de CORS (Cross Origin Resource Sharing)
// Utile pour télécharger la photo de profil pronote depuis un autre domaine 

// download image from url and send it to the client (avoid cross domain issues)
// prevent from remote file inclusion and other security issues

// get url from query string
$url = $_GET['url'];

// check if url is valid
if (filter_var($url, FILTER_VALIDATE_URL)) {
    // get image from url
    $img = file_get_contents($url);
    // get image type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $type = $finfo->buffer($img);
    // send headers to the client
    header('Content-Type: '.$type);
    header('Content-Length: ' . strlen($img));
    // set access control headers
    header('Access-Control-Allow-Origin: *');
    // send image to the client
    echo $img;
}
?>