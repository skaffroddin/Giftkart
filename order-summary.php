<?php
session_start();
include("connection.php");

$userId = $_SESSION['user_id'];
$orderQuery = "SELECT * FROM orders WHERE user_id = '$userId'";
$orderResult = mysqli_query($con, $orderQuery);
?>

<div class="container">
    <h1>Order Summary</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = mysqli_fetch_assoc($orderResult)): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['product_name']; ?></td>
                <td><?php echo $order['quantity']; ?></td>
                <td><?php echo $order['total']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
