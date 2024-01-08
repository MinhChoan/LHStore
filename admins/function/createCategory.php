<?php
require_once(dirname(__DIR__) . '/../classes/Db.class.php');
require_once(dirname(__DIR__) . '/../classes/Book.class.php');
require_once(dirname(__DIR__) . '/../classes/Category.class.php');


$mess = "";
if (isset($_POST["themtheloai"])) {
    $category = new categories();

    $CategoryName = $_POST["tentheloai"];

    $result = $category->addCategory($CategoryName);

    if ($result) {
        $_SESSION['add'] = "Thêm thể loại thành công!";
        unset($_POST["themtheloai"]);
        header ("location: ./index.php?page=category-list");
    } else {
        $mess = "Thêm thể loại thất bại!";
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
        <form action="index.php?page=category-add" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tentheloai" class="form-label">Tên thể loại</label>
                <input type="text" class="form-control" id="tentheloai" name="tentheloai" placeholder="Nhập tên thể loại">
            </div>
            <button type="submit" class="btn btn-primary" name="themtheloai">Thêm</button>
        </div>
    </form>
</div>
