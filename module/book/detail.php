<?php
if (!defined('DETAIL_PAGE_DISPLAYED')) {
    define('DETAIL_PAGE_DISPLAYED', true);

    $book = new book(); // Tạo đối tượng từ class book

    // Kiểm tra xem có tham số id được truyền từ URL hay không
    if (isset($_GET['ac']) && $_GET['ac'] == 'detail' && isset($_GET['id']) && !empty($_GET['id'])) {
        $bookID = $_GET['id'];
        $productDetail = $book->getDetail($bookID);

        if (!empty($productDetail)) {
?>
        <div class="card">
            <div class="row g-0 ">
                <div class="col-md-4">
                    <img src="images/<?php echo $productDetail['Image']; ?>" class="img-fluid rounded-start"
                        alt="Product Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $productDetail['Title']; ?>
                        </h4>
                        <p class="card-text">Tác giả:
                            <?php echo $productDetail['Author']; ?>
                        </p>
                        <p class="card-text">Chương:
                            <?php echo $productDetail['Chapter']; ?>
                        </p>
                        <p class="card-text">Giá:
                            <?php echo number_format($productDetail['Price'], 0, ',', '.'); ?> VND
                        </p>
                        <p class="card-text">Mô tả:
                            <?php echo $productDetail['Description']; ?>
                        </p>
                        <div class="">
                            <a href="index.php?mod=cart&ac=add&id=<?php echo $productDetail['BookID']; ?>"
                                class="btn btn-dark btn-md">Thêm vào giỏ hàng</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                Sách khác
            </div>
        <div class="card-body">
                <div class="row">
                    <?php
                    $randomBooks = $book->getBookRand(5);
                    foreach ($randomBooks as $randomBook) {
                    ?>
                        <div class="col-md-2">
                            <div class="card">
                                <img src="images/<?php echo $randomBook['Image']; ?>" class="card-img-top" alt="Book Image">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $randomBook['Title']; ?></h6>
                                    <p class="card-text"><?php echo $randomBook['Author']; ?></p>
                                    <a href="index.php?ac=detail&id=<?php echo $randomBook['BookID']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        } else {
            echo "Không tìm thấy thông tin sản phẩm!";
        }
    } else {
        echo "Thiếu thông tin sản phẩm!";
    }
}
?>