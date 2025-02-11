<?php
session_start();
require 'connection.php'; // Your database connection file

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists
    $stmt = $con->prepare("SELECT * FROM buyers WHERE buyer_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate token
        $token = bin2hex(random_bytes(50));

        // Store token in the database
        $stmt = $con->prepare("UPDATE buyers SET reset_token = ?, reset_token_expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE buyer_email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Send reset email
        $resetLink = "http://localhost/Projects/Giftkart/reset-password.php?token=" . $token;

        // Use PHPMailer to send the email
        require 'vendor/autoload.php'; // Composer autoload

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
            echo "Password reset email sent!";
        } else {
            echo "Failed to send email. Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit" name="submit">Reset Password</button>
    </form>
</body>
</html>

