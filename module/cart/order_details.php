<?php
// Include necessary classes and configuration files

// Check if the 'users' key is set in the session
if (isset($_SESSION['users'])) {
    // Retrieve order details from the database based on the order ID
    $orderID = getIndex("OrderID"); // Assuming 'OrderID' is the correct key
    $db = new Db();

    // Fetch order information
    $sql = "SELECT * FROM orders WHERE OrderID = :OrderID";
    $params = array(':OrderID' => $orderID);
    $order = $db->getOneRow($sql, $params);

    if ($order) {
        $totalAmount = $order['TotalAmount'];
        $orderDate = $order['OrderDate'];

        // Fetch order items
        $sql = "SELECT od.*, b.Title, b.Price FROM orderdetails od
                INNER JOIN books b ON od.BookID = b.BookID
                WHERE od.OrderID = :OrderID";
        $params = array(':OrderID' => $orderID);
        $orderItems = $db->select_to_array($sql, $params);

        // Display order details using Bootstrap styling
        ?>
        <div class="container mt-5">
            <h2>Thông tin đơn hàng</h2>
            <p class="lead">Số đơn hàng: <?php echo $orderID; ?></p>
            <p class="lead">Ngày đặt hàng: <?php echo $orderDate; ?></p>

            <h3 class="mt-4">Sách đã mua:</h3>
            <ul class="list-group">
                <?php foreach ($orderItems as $item) { ?>
                    <li class="list-group-item">
                        <?php echo "{$item['Title']} - Số lượng: {$item['Quantity']}"; ?>
                    </li>
                <?php } ?>
            </ul>

            <!-- Display payment method selection form -->
            <form action="/module/cart/process_payment.php" method="post">
                <h3 class="mt-4">Chọn phương thức thanh toán:</h3>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                    <label class="form-check-label" for="cod">
                        Thanh toán khi nhận hàng
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay">
                    <label class="form-check-label" for="vnpay">
                        Thanh toán qua VNPay
                    </label>
                </div>
                <input type="hidden" name="order_id" value="<?php echo $orderID; ?>">
                <button type="submit" class="btn btn-primary mt-3">Xác nhận thanh toán</button>
            </form>

            <!-- Display total amount -->
            <h3 class="mt-4">Tổng tiền phải trả: <?php echo number_format($totalAmount, 0, ',', '.'); ?> VND</h3>
        </div>
        <?php
    } else {
        echo "<p>Không có thông tin đơn hàng.</p>";
    }
} else {
    echo "<p>Vui lòng đăng nhập trước.</p>";
}
?>
