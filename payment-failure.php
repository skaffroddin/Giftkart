<?php
session_start();
@include('header.php');
echo "<h1>Payment Failed</h1>";
echo "<p>Unfortunately, your payment could not be processed.</p>";
echo "<a href='checkout.php' class='btn btn-primary'>Try Again</a>";
?>
