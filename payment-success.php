<?php
session_start();
include("connection.php");
@include('header.php');

if (isset($_GET['payment_id'])) {
    $paymentId = $_GET['payment_id'];
    $userId = $_SESSION['user_id'];
    $order = $_SESSION['Order'];
    $totalAmount = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $order));

    // Save payment to database
    $insertPayment = "INSERT INTO payments (user_id, payment_id, amount, pay_date) VALUES ('$userId', '$paymentId', '$totalAmount', NOW())";
    if (mysqli_query($con, $insertPayment)) {
        echo "<h1>Payment Successful</h1>";
        echo "<p>Payment ID: $paymentId</p>";
        echo "<p>Total Amount: $totalAmount</p>";
        echo "<a href='order-summary.php'>View Order Summary</a>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
