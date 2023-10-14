<?php

// Google API configuration
define('GOOGLE_CLIENT_ID', '-');
define('GOOGLE_CLIENT_SECRET', '-');
define('GOOGLE_REDIRECT_URL', 'http://localhost/PHP/authgoogle/');

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('625328699534-3gqkh4eu4gl30pj3hftgiikkpu3j6ja2.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/Project/index.html');

$google_client->addScope('email');
$google_client->addScope('profile');

//start session on web page
session_start();
?>