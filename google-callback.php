<?php
require_once 'vendor/autoload.php';
require_once 'connection.php'; // Include your database connection file

session_start();

$client = new Google_Client();
$client->setClientId('null');
$client->setClientSecret('null');
$client->setRedirectUri('http://giftkart.infy.uk/google-callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Fetch user profile info from Google
    $google_service = new Google_Service_Oauth2($client);
    $user_info = $google_service->userinfo->get();

    $google_id = $user_info->id;
    $name = $user_info->name;
    $email = $user_info->email;
    $profile_pic = $user_info->picture;

    // Check if user exists in the database
    $check_user = "SELECT * FROM buyers WHERE google_id = '$google_id' OR buyer_email = '$email'";
    $result = mysqli_query($con, $check_user);

    if (mysqli_num_rows($result) > 0) {
        // User exists, log them in
        $user = mysqli_fetch_assoc($result);
        $_SESSION['buyer_id'] = $user['buyer_id'];
        $_SESSION['buyer_email'] = $user['buyer_email'];
        $_SESSION['buyer_name'] = $user['buyer_name'];
        $_SESSION['buyer_image'] = $user['buyer_image'];
    } else {
        // New user, register them in the database
        $add_user = "INSERT INTO buyers (
            buyer_name, buyer_email, buyer_password, buyer_country, buyer_city, buyer_address, buyer_phone, 
            buyer_image, social_id, social_provider, google_id
        ) VALUES (
            '$name', '$email', '', '', '', '', '', 
            '$profile_pic', '$google_id', 'Google', '$google_id'
        )";

        if (mysqli_query($con, $add_user)) {
            $_SESSION['buyer_id'] = mysqli_insert_id($con);
            $_SESSION['buyer_email'] = $email;
        } else {
            echo "<script>alert('Error: Unable to register user.');</script>";
            echo "<script>window.open('register.php', '_self');</script>";
            exit();
        }
    }

    // Redirect to the homepage or dashboard
    echo "<script>window.open('index.php', '_self');</script>";
    exit();
} else {
    echo 'Authentication failed!';
}
?>
