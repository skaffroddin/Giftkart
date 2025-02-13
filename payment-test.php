<?php
require 'vendor/autoload.php'; // Include Razorpay library
use Razorpay\Api\Api;

session_start();
@include('header.php');
include("connection.php");

if (!isset($_SESSION["user"])) {
    echo "<script>window.open('login.php','_self')</script>";
    die();
}

// Razorpay API credentials
$apiKey = "YOUR_API_KEY";
$apiSecret = "YOUR_SECRET_KEY";

if (isset($_POST['razorpay_payment_id'])) {
    $paymentId = $_POST['razorpay_payment_id'];

    try {
        $api = new Api($apiKey, $apiSecret);
        $payment = $api->payment->fetch($paymentId);

        if ($payment->status === 'captured') {
            // Save payment details in the database
            $orderId = $_SESSION['order_id']; // Ensure `order_id` is stored in the session
            $amount = $payment->amount / 100; // Amount is in paise; convert to INR
            $paymentDate = date("Y-m-d H:i:s");

            $query = "INSERT INTO payments (pay_id, invoice_no, amount, pay_date) 
                      VALUES ('$paymentId', '$orderId', '$amount', '$paymentDate')";
            
            if (mysqli_query($con, $query)) {
                echo "<script>alert('Payment Successful!')</script>";
                echo "<script>window.open('order_summary.php','_self')</script>";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "<script>alert('Payment Failed! Please try again.')</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
