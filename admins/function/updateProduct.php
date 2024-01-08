<?php
ob_start();
require_once(dirname(__DIR__) . '/../classes/Db.class.php');
require_once(dirname(__DIR__) . '/../classes/Book.class.php');
require_once(dirname(__DIR__) . '/../classes/Category.class.php');
include_once(dirname(__DIR__) . '/../config/config.php');
$theloai = new categories();
$gettheloai = $theloai->getAll();
$book = new Book();
$mess = "";
if (isset($_GET["BookID"])) {
    $BookID = $_GET["BookID"];
    echo $BookID;
    $list = $book->getDetail($BookID);
}
if (isset($_POST["suasach"])) {
    $Title = $_POST["tensach"];
    $Description = $_POST["mota"];
    $Author = $_POST["tacgia"];
    $Quantity = $_POST["soluong"];
    $Price = $_POST["gia"];
    $CategoryID = $_POST["maloai"];
    $Chapter = $_POST["chuong"];
        $result = $book->updateBook(93, $Title, $Description, $Author, $Quantity, $Price, $CategoryID, $Chapter);
        if ($result) {
            $_SESSION['update'] = "Sửa sản phẩm thành công!";
            unset($_POST["suasach"]);
            header ("location: ./index.php?page=product-list");
        } else {
            $mess = "Sửa sách thất bại!";
        }
    }
?>

<div class="card">
    <div class="card-header bg-dark">
        <div>
            <p class="text-success">
                <?php echo $mess ?>
            </p>
        </div>
    </div>
    <div class="card-body">
        <form action="index.php?page=product-update" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tensach" class="form-label">Tên sách</label>
                <input type="text" class="form-control" id="tensach" name="tensach" value="<?php echo $list['Title']; ?>">
            </div>
            <div class="mb-3">
                <label for="chuong" class="form-label">Chương</label>
                <input type="text" class="form-control" id="chuong" name="chuong" value="<?php echo $list['Chapter']; ?>">
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mô tả</label>
                <input type="text" class="form-control" id="mota" name="mota" value="<?php echo $list['Description']; ?>">
            </div>
            <div class="mb-3">
                <label for="tacgia" class="form-label">Tác giả</label>
                <input type="text" class="form-control" id="tacgia" name="tacgia" value="<?php echo $list['Author']; ?>">
            </div>
            <div class="mb-3">
                <label for="soluong" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="soluong" name="soluong" value="<?php echo $list['Quantity']; ?>">
            </div>
            <div class="mb-3">
                <label for="gia" class="form-label">Giá</label>
                <input type="number" class="form-control" id="gia" name="gia" value="<?php echo $list['Price']; ?>">
            </div>
            <div class="mb-3">
                <label for="maloai" class="form-label">Thể loại</label>
                <select class="form-select" aria-label="Chọn thể loại" name="maloai">
                    <?php
                    foreach ($gettheloai as $row) {
                        ?>
                        <option selected value="<?php echo $row['CategoryID']; ?>">
                            <?php echo $row['CategoryName']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="suasach">Cập nhật</button>
        </div>
    </form>
</div>
<?php 
ob_end_flush(); 
?>
