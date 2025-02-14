<?php
require_once 'vendor/autoload.php'; // Load Composer's autoload file

session_start();

// Create a new Google Client
$client = new Google_Client();
$client->setClientId('null'); // Replace with your Google Client ID
$client->setClientSecret('null'); // Replace with your Google Client Secret
$client->setRedirectUri('http://giftkart.infy.uk/google-callback.php'); // Replace with your callback URL
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();

// Redirect the user to Google's login page
header("Location: $login_url");
exit();
