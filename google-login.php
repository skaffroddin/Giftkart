<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

session_start();

// Google OAuth Config
$provider = new Google([
    'clientId'     => 'YOUR_GOOGLE_CLIENT_ID',
    'clientSecret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    'redirectUri'  => 'http://localhost/Projects/Giftkart/google-callback.php',
]);

// Generate Google Authorization URL
if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
}

// If we get here, something went wrong
echo "Unable to generate authorization URL.";

