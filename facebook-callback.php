<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Facebook;

include "connection.php";

// Facebook OAuth Configuration
$facebookProvider = new Facebook([
    'clientId'     => 'YOUR_FACEBOOK_APP_ID',
    'clientSecret' => 'YOUR_FACEBOOK_APP_SECRET',
    'redirectUri'  => 'http://localhost/Projects/Giftkart/facebook-callback.php',
]);

// Check for errors or invalid state
if (!empty($_GET['error'])) {
    // Handle error response
    echo 'Authentication error: ' . htmlspecialchars($_GET['error']);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state_facebook'])) {
    unset($_SESSION['oauth2state_facebook']);
    echo 'Invalid state';
    exit;
} else {
    try {
        // Get the access token
        $token = $facebookProvider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);

        // Fetch user details from Facebook
        $facebookUser = $facebookProvider->getResourceOwner($token);
        $facebookUserData = $facebookUser->toArray();

        // Extract user data
        $name = $facebookUserData['name'];
        $email = $facebookUserData['email'];
        $picture = $facebookUserData['picture']['data']['url']; // URL for the user's profile picture

        // Check if the user exists in the database
        $query = "SELECT * FROM buyers WHERE buyer_email = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, log them in
            $user = $result->fetch_assoc();
            $_SESSION["user"] = $user;
        } else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO buyers (buyer_name, buyer_email, buyer_image) VALUES (?, ?, ?)";
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("sss", $name, $email, $picture);
            $stmt->execute();

            // Set session data for the new user
            $_SESSION["user"] = [
                'buyer_name'  => $name,
                'buyer_email' => $email,
                'buyer_image' => $picture,
            ];
        }

        // Redirect to the homepage
        echo "<script>window.open('index.php','_self')</script>";
    } catch (Exception $e) {
        // Handle errors
        echo 'Failed to get user details: ' . $e->getMessage();
        exit;
    }
}
?>

