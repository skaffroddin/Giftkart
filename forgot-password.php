<?php
// session_start();
include "connection.php";
include "header.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists
    $query = "SELECT * FROM buyers WHERE buyer_email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate token
        $token = bin2hex(random_bytes(50));

        // Store token in the database
        $updateQuery = "UPDATE buyers SET reset_token = '$token', reset_token_expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE buyer_email = '$email'";
        mysqli_query($con, $updateQuery);

        // Send reset email
        $resetLink = "http://localhost/Projects/Giftkart/reset-password.php?token=" . $token;

        // Use PHPMailer to send the email
        require 'vendor/autoload.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Replace with your Gmail
        $mail->Password = 'your-email-password'; // Replace with your Gmail password or App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Giftkart');
        $mail->addAddress($email);

        $mail->Subject = "Password Reset Request";
        $mail->Body = "Click this link to reset your password: $resetLink";

        if ($mail->send()) {
            $successMessage = "Password reset email sent! Please check your inbox.";
        } else {
            $errorMessage = "Failed to send email. Error: " . $mail->ErrorInfo;
        }
    } else {
        $errorMessage = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .forgot-password-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .forgot-password-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot-password-container">
            <h2 class="text-center">Forgot Password</h2>
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success">
                    <?= $successMessage ?>
                </div>
            <?php elseif (isset($errorMessage)): ?>
                <div class="alert alert-danger">
                    <?= $errorMessage ?>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="email">Enter your email address:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>
