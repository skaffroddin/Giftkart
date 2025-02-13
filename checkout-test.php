<?php
include('header.php');
include("connection.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    echo "<script>window.open('login_register.php','_self')</script>";
    die();
}

if (!isset($_SESSION['Order'])) {
    echo "<script>alert('No items in your order!')</script>";
    echo "<script>window.open('cart.php','_self')</script>";
    die();
}

$Order = $_SESSION['Order'];
$totalAmount = 0;

foreach ($Order as $orderlineitem) {
    $totalAmount += $orderlineitem->price * $orderlineitem->quantity;
}
?>

<div class="wrapper">
    <div class="container">
        <h1>CHECKOUT</h1>
    </div>
    <div class="container pannel">
        <div class="col-md-12 tod">
            <h3>Your Order</h3>
            <table class="table table-bordered">
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($Order as $orderlineitem) { ?>
                <tr>
                    <td><?php echo $orderlineitem->name; ?></td>
                    <td><?php echo $orderlineitem->quantity; ?></td>
                    <td><?php echo $orderlineitem->price; ?></td>
                    <td><?php echo $orderlineitem->price * $orderlineitem->quantity; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"><b>Total</b></td>
                    <td colspan="2"><b><?php echo $totalAmount; ?></b></td>
                </tr>
            </table>

            <div>
                <h3>Payment</h3>
                <form id="razorpay-form" method="POST" action="payment.php">
                    <input type="hidden" name="amount" value="<?php echo $totalAmount * 100; ?>">
                    <button id="rzp-button" type="button">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    const options = {
        "key": "YOUR_RAZORPAY_KEY", // Replace with your Razorpay key
        "amount": "<?php echo $totalAmount * 100; ?>", // Amount in paise
        "currency": "INR",
        "name": "Giftkart",
        "description": "Order Payment",
        "image": "your-logo-url", // Optional: Add your logo URL
        "handler": function (response) {
            // Send payment ID to the server
            const form = document.getElementById('razorpay-form');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'razorpay_payment_id';
            input.value = response.razorpay_payment_id;
            form.appendChild(input);
            form.submit();
        },
        "prefill": {
            "name": "<?php echo $_SESSION['user']['name']; ?>", 
            "email": "<?php echo $_SESSION['user']['email']; ?>" 
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    const rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function (e) {
        rzp.open();
        e.preventDefault();
    };
</script>

<?php include('footer.php'); ?>
