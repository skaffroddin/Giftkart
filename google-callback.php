<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

$googleProvider = new Google([
    'clientId'     => 'YOUR_GOOGLE_CLIENT_ID',
    'clientSecret' => 'YOUR_GOOGLE_CLIENT_SECRET',
    'redirectUri'  => 'http://localhost/Projects/Giftkart/google-callback.php',
]);

if (!empty($_GET['error'])) {
    header('Location: login.php?error=' . htmlspecialchars($_GET['error']));
    exit;
}

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    echo 'Invalid state';
    exit;
}

try {
    $token = $googleProvider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);

    $googleUser = $googleProvider->getResourceOwner($token);
    $googleUserData = $googleUser->toArray();

    if (!isset($googleUserData['name'], $googleUserData['email'])) {
        throw new Exception('Missing required user details');
    }

    include "connection.php";
    $email = $googleUserData['email'];
    $stmt = $con->prepare("SELECT * FROM buyers WHERE buyer_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["user"] = $user;
    } else {
        $name = $googleUserData['name'];
        $image = $googleUserData['picture'];
        $stmt = $con->prepare("INSERT INTO buyers (buyer_name, buyer_email, buyer_image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $image);
        $stmt->execute();

        $_SESSION["user"] = [
            'buyer_name'  => $name,
            'buyer_email' => $email,
            'buyer_image' => $image,
        ];
    }

    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log('OAuth Error: ' . $e->getMessage());
    header('Location: login.php?error=auth_failed');
    exit;
}
?>

