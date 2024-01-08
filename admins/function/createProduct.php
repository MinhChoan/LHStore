<?php
require_once(dirname(__DIR__) . '/../classes/Db.class.php');
require_once(dirname(__DIR__) . '/../classes/Book.class.php');
require_once(dirname(__DIR__) . '/../classes/Category.class.php');

$theloai = new categories();
$gettheloai = $theloai->getAll();

$mess = "";
if (isset($_POST["themsach"])) {
    $book = new Book();

    $Title = $_POST["tensach"];
    $Description = $_POST["mota"];
    $Author = $_POST["tacgia"];
    $Quantity = $_POST["soluong"];
    $Price = $_POST["gia"];
    $Image = "";
    $CategoryID = $_POST["maloai"];
    $Chapter = $_POST["chuong"];


    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../image/book';
        $uploadFile = $uploadDir . basename($_FILES['anh']['name']);

        if (move_uploaded_file($_FILES['anh']['tmp_name'], $uploadFile)) {
            $Image = '../image/book' . $_FILES['anh']['name'];
        }
    }
    if ($Title == "" || $Description == "" || $Author == "" || $Quantity == "" || $Price == "" || $Image == "" || $CategoryID == ""|| $Chapter == "") {
        $mess = "Không để trống thông tin!";
    } else {

        $result = $book->addBook($Title, $Description, $Author, $Quantity, $Price, $Image, $CategoryID, $Chapter);
        if ($result) {
            if ($result)
            $mess = "Thêm sách thành công!";
            unset($_POST["themsach"]);
        } else {
            $mess = "Thêm sách thất bại!";
        }
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
        <form action="index.php?page=product-add" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tensach" class="form-label">Tên sách</label>
                <input type="text" class="form-control" id="tensach" name="tensach" placeholder="Nhập tên sách">
            </div>
            <div class="mb-3">
                <label for="chuong" class="form-label">Chương</label>
                <input type="text" class="form-control" id="chuong" name="chuong" placeholder="Nhập chương">
            </div>
            <div class="mb-3">
                <label for="mota" class="form-label">Mô tả</label>
                <input type="text" class="form-control" id="mota" name="mota" placeholder="Nhập mô tả">
            </div>
            <div class="mb-3">
                <label for="tacgia" class="form-label">Tác giả</label>
                <input type="text" class="form-control" id="tacgia" name="tacgia" placeholder="Nhập tác giả">
            </div>
            <div class="mb-3">
                <label for="soluong" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="soluong" name="soluong" placeholder="Nhập số lượng">
            </div>
            <div class="mb-3">
                <label for="gia" class="form-label">Giá</label>
                <input type="number" class="form-control" id="gia" name="gia" placeholder="Nhập giá">
            </div>
            <div class="mb-3">
                <label for="anh" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="anh" name="anh">
            </div>
            <div class="mb-3">
                <label for="maloai" class="form-label">Thể loại</label>
                <select class="form-select" aria-label="Chọn thể loại" name="maloai">
                    <?php
                    foreach ($gettheloai as $row) {
                        ?>
                        <option value="<?php echo $row['CategoryID']; ?>">
                            <?php echo $row['CategoryName']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="themsach">Thêm</button>
        </div>
    </form>
</div>
