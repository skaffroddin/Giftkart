<?php
// session_start();
include "connection.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token
    $query = "SELECT * FROM buyers WHERE reset_token = '$token' AND reset_token_expire > NOW()";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        if (isset($_POST['reset_password'])) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password === $confirmPassword) {
                // Hash the new password
                $hashedPassword = $password;

                // Update password in the database
                $updateQuery = "UPDATE buyers SET buyer_password = '$hashedPassword', reset_token = NULL, reset_token_expire = NULL WHERE reset_token = '$token'";
                if (mysqli_query($con, $updateQuery)) {
                    $successMessage = "Password has been reset successfully!";
                } else {
                    $errorMessage = "Failed to reset password. Please try again.";
                }
            } else {
                $errorMessage = "Passwords do not match.";
            }
        }
    } else {
        $errorMessage = "Invalid or expired token.";
    }
} else {
    $errorMessage = "No token provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .reset-password-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .reset-password-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-password-container">
            <h2 class="text-center">Reset Password</h2>
            <?php if (isset($successMessage)): ?>
                <div class="alert alert-success">
                    <?= $successMessage ?>
                </div>
            <?php elseif (isset($errorMessage)): ?>
                <div class="alert alert-danger">
                    <?= $errorMessage ?>
                </div>
            <?php endif; ?>
            <?php if (!isset($successMessage)): ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password" required>
                </div>
                <button type="submit" name="reset_password" class="btn btn-primary btn-block">Reset Password</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
