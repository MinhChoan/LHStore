<?php
// Assuming you include necessary classes and configurations

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = isset($_POST['order_id']) ? $_POST['order_id'] : null;
    $paymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;

    if (!$orderID || !$paymentMethod) {
        // Handle invalid request (e.g., redirect back to the order page with an error message)
        header("Location: order_page.php?error=InvalidRequest");
        exit;
    }

    if ($paymentMethod === 'cod') {
        // Thanh toán khi nhận hàng
        displayCODConfirmationForm($orderID);
    } elseif ($paymentMethod === 'vnpay') {
        // Thanh toán qua VNPay
        handleVNPayPayment($orderID);
    } else {
        // Invalid payment method selected
        header("Location: order_page.php?error=InvalidPaymentMethod&OrderID={$orderID}");
        exit;
    }
} else {
    // Handle invalid request method (e.g., redirect back to the order page with an error message)
    header("Location: order_page.php?error=InvalidRequestMethod");
    exit;
}

// Function to display the COD confirmation form
function displayCODConfirmationForm($orderID) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận thanh toán khi nhận hàng</title>
        <!-- Add Bootstrap CSS link -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-5">
        <h2 class="mb-4">Xác nhận thanh toán khi nhận hàng</h2>

        <form action="confirm_cod_payment.php" method="post">
            <!-- Include any necessary order details -->
            <input type="hidden" name="order_id" value="<?php echo $orderID; ?>">
            <!-- Add other order details if needed -->

            <!-- User information form fields -->
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ nhận hàng:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Xác nhận thanh toán COD</button>
        </form>

        <!-- Add Bootstrap JS script if needed -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}

// Function to handle VNPay payment
function handleVNPayPayment($orderID) {
    // Perform VNPay integration here

    // Redirect to VNPay's payment gateway or handle as per VNPay integration documentation
    // For illustration purposes, assuming a successful VNPay transaction
    $vnpayTransactionStatus = true;

    if ($vnpayTransactionStatus) {
        // Update the order status in the database

        // Redirect back to the order page with a success message
        header("Location: order_page.php?success=VNPayPaymentSuccessful&OrderID={$orderID}");
        exit;
    } else {
        // Handle VNPay transaction failure
        header("Location: order_page.php?error=VNPayPaymentFailed&OrderID={$orderID}");
        exit;
    }
}
?>
