<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Facebook;

// Google OAuth Configuration
$googleProvider = new Google([
    'clientId'     => 'YOUR_GOOGLE_CLIENT_ID',
    'clientSecret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    'redirectUri'  => 'http://localhost/Projects/Giftkart/google-callback.php',
]);

// Facebook OAuth Configuration
$facebookProvider = new Facebook([
    'clientId'        => 'YOUR_FACEBOOK_APP_ID',
    'clientSecret'    => 'YOUR_FACEBOOK_APP_SECRET',
    'redirectUri'     => 'http://localhost/Projects/Giftkart/facebook-callback.php',
    'graphApiVersion' => 'v15.0', // Use the latest version of the Graph API
]);

if (isset($_SESSION["user"])) {
    echo "<script>window.open('index.php','_self')</script>";
    die();
}

include "connection.php";

if (isset($_POST['loginsubmit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate credentials
    $stmt = $con->prepare("SELECT * FROM buyers WHERE buyer_email = ? AND buyer_password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["user"] = $user;
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}

// Generate Google login URL
$googleAuthUrl = $googleProvider->getAuthorizationUrl();
$_SESSION['oauth2state_google'] = $googleProvider->getState();

// Generate Facebook login URL
$facebookAuthUrl = $facebookProvider->getAuthorizationUrl();
$_SESSION['oauth2state_facebook'] = $facebookProvider->getState();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h1>Login</h1>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email address" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" name="loginsubmit" class="btn btn-success btn-block">Login</button>
                </form>
                <hr>
                <a href="<?= htmlspecialchars($googleAuthUrl) ?>" class="btn btn-primary btn-block">
                    Login with Google
                </a>
                <a href="<?= htmlspecialchars($facebookAuthUrl) ?>" class="btn btn-info btn-block">
                    Login with Facebook
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

