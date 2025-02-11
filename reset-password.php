<?php
session_start();
require 'connection.php'; // Your database connection file

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token
    $stmt = $con->prepare("SELECT * FROM buyers WHERE reset_token = ? AND reset_token_expire > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("Invalid or expired token.");
    }
} elseif (isset($_POST['submit'])) {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Update password
    $stmt = $con->prepare("UPDATE buyers SET buyer_password = ?, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $newPassword, $token);

    if ($stmt->execute()) {
        echo "Password reset successful!";
        echo "<a href='login.php'>Login here</a>";
    } else {
        echo "Failed to reset password.";
    }
    exit;
} else {
    die("Unauthorized access.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <form method="post" action="">
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <button type="submit" name="submit">Reset Password</button>
    </form>
</body>
</html>

