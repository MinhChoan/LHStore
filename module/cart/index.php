<?php
$ac = getIndex("ac");

if ($ac == "order_details") {
    include ROOT . "/module/cart/order_details.php";
}

if ($ac == "add") {
    $BookID = getIndex("id");
    $cart->add($BookID);
    header("location: ?mod=cart");
    exit;
}

if ($ac == "remove") {
    $BookID = getIndex("id");
    $cart = new Cart();
    $cart->remove($BookID);
    header("location: ?mod=cart");
    exit;
}

if ($ac == "clear") {
    $cart = new Cart();
    $cart->clear();
    header("location: ?mod=cart");
    exit;
}

if ($ac == "checkout") {

    // Check if the 'users' key is set in the session
    if (isset($_SESSION['users'])) {
        $db = new Db();
        $sql = "INSERT INTO orders (OrderDate, UserID, TotalAmount) VALUES (NOW(), :UserID, :TotalAmount)";
        $params = array(
            ':UserID' => $_SESSION['users']['UserID'], // Assuming 'UserID' is the correct key
            ':TotalAmount' => $cart->getTotal()
        );
        $db->exequery($sql, $params);
        $OrderID = $db->getLastID();

        foreach ($cart->show() as $item) {
          $BookID = $item['BookID'];
          $Quantity = $cart->getQuantity($BookID);
      
          // Debug output
          echo "BookID: $BookID, Quantity: $Quantity<br>";
      
          $Subtotal = $item['Price'] * $Quantity;
      
          $sql = "INSERT INTO orderdetails (OrderID, BookID, Quantity, Subtotal) VALUES (:OrderID, :BookID, :Quantity, :Subtotal)";
          $params = array(
              ':OrderID' => $OrderID,
              ':BookID' => $BookID,
              ':Quantity' => $Quantity,
              ':Subtotal' => $Subtotal
          );
          $db->exequery($sql, $params);
      }

        $cart->clear();
        header("location: ?mod=cart&ac=order_details&OrderID={$OrderID}");
        exit;
    } else {
        // Redirect to the login page or take appropriate action
        echo "Please login first";
        exit;
    }
}

?>

<section class="vh-100" style="background-color: #fff;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <p><span class="h2">Giỏ hàng </span><span class="h4">(
            <?php echo $cart->getNumItem(); ?>


            sản phẩm trong giỏ hàng)
          </span></p>

        <div class="card mb-4">
          <div class="card-body p-4">
            <div class="row align-items-center">
              <div class="col-md-1 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Hình ảnh
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Tên sách
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Chương
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Số lượng
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Giá tiền
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Thành tiền
                  </p>
                </div>
              </div>
              <div class="col-md-1 d-flex justify-content-center">
                <div>
                  <p class="lead fw-normal mb-0">
                    Xóa
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-body p-4">
            <?php
            $cart = new Cart();
            $list = $cart->show();
            if (count($list) == 0) {
              ?>
              <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      Giỏ hàng trống
                    </p>
                  </div>
                </div>
              </div>
              <?php
            }
            foreach ($list as $r) {
              ?>
              <div class="row align-items-center">
                <div class="col-md-1">
                  <img src="<?php echo $r['Image']; ?>" alt="" class="img-fluid"
                    style="max-width: 100%; max-height: 150px;">
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <?php echo $r['Title']; ?>
                    </p>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <?php echo $r['Chapter']; ?>
                    </p>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <?php echo $cart->getQuantity($r['BookID']); ?>
                    </p>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <?php echo number_format($r['Price'], 0, ',', '.'); ?> VND
                    </p>
                  </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <?php echo number_format($r['Price'] * $cart->getQuantity($r['BookID']), 0, ',', '.'); ?> VND
                    </p>
                  </div>
                </div>
                <div class="col-md-1 d-flex justify-content-center">
                  <div>
                    <p class="lead fw-normal mb-0">
                      <a href="?mod=cart&ac=remove&id=<?php echo $r['BookID']; ?>" class="btn btn-danger">Xóa</a>
                    </p>
                  </div>
                </div>
              </div>
              <hr>
              <?php
            }
            ?>
          </div>

        </div>

        <div class="card mb-5">
          <div class="card-body p-4">
            <div class="float-start">
              <a href="?mod=cart&ac=clear" class="btn btn-danger">Xóa giỏ hàng</a>
            </div>


            <div class="float-end">
              <p class="mb-0 me-5 d-flex align-items-center">
                <span class="small text-muted me-2">Tổng tiền phải trả:</span> <span class="lead fw-normal">
                  <?php echo number_format($cart->getTotal(), 0, ',', '.'); ?> VND
                </span>
              </p>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <a href="/" class="btn btn-light">Tiếp tục mua hàng</a>
          <a href="?mod=cart&ac=checkout" class="btn btn-primary ms-3">Thanh toán</a>
        </div>

      </div>
    </div>
  </div>
</section>