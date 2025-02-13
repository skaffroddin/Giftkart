<?php
require_once 'vendor/autoload.php'; // Load Composer's autoload file

session_start();

// Create a new Google Client
$client = new Google_Client();
$client->setClientId('447405879086-3c54rtubopq6enrq6pphdm7rignffkqm.apps.googleusercontent.com'); // Replace with your Google Client ID
$client->setClientSecret('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'); // Replace with your Google Client Secret
$client->setRedirectUri('http://giftkart.infy.uk/google-callback.php'); // Replace with your callback URL
$client->addScope('email');
$client->addScope('profile');

$login_url = $client->createAuthUrl();

// Redirect the user to Google's login page
header("Location: $login_url");
exit();
