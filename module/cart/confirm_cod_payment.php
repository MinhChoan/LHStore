<?php
// confirm_cod_payment.php

// Retrieve order details from the request
$orderID = isset($_POST['order_id']) ? $_POST['order_id'] : null;

if (!$orderID) {
    // Handle invalid request (e.g., redirect back to the order page with an error message)
    header("Location: order_page.php?error=InvalidOrderID");
    exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the submitted form for COD payment confirmation
    processCODPaymentConfirmation($orderID);
} else {
    // Display the confirmation form for COD payment
    displayConfirmationForm($orderID);
}

// Function to process the submitted form for COD payment confirmation
function processCODPaymentConfirmation($orderID) {
    // Validate and process the user information as needed
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // Perform any additional processing or validation if required

    // Display the success message
    displaySuccessMessage($orderID, $fullname, $address);
}

// Function to display the success message
function displaySuccessMessage($orderID, $fullname, $address) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận thanh toán COD</title>
        <!-- Add Bootstrap CSS link -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-5">
        <h2>Xác nhận thanh toán khi nhận hàng</h2>
        <div class="alert alert-success" role="alert">
            <p>Thanh toán COD thành công!</p>
            <p>Mã đơn hàng của bạn: <?php echo $orderID; ?></p>
            <p>Họ và tên: <?php echo $fullname; ?></p>
            <p>Địa chỉ nhận hàng: <?php echo $address; ?></p>
            <!-- Add any additional information or links as needed -->
        </div>
        <button type="button" class="btn btn-primary" onclick="window.location.href='/'">Quay lại trang chủ</button>
        <!-- Add Bootstrap JS script if needed -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}

// Function to display the confirmation form
function displayConfirmationForm($orderID) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Xác nhận thanh toán COD</title>
        <!-- Add Bootstrap CSS link -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-5">
        <h2>Xác nhận thanh toán khi nhận hàng</h2>
        <form action="/module/cart/confirm_cod_payment.php" method="post">
            <!-- Include any necessary order details -->
            <input type="hidden" name="order_id" value="<?php echo $orderID; ?>">
            <!-- Add other order details if needed -->

            <!-- User information form fields (customize as needed) -->
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
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
}
?>
