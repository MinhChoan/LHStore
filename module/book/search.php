<?php
if (!defined("ROOT")) {
    echo "Err!";
    exit;
}
$key = getIndex("key", "");
$sql = "select * from Books where Title like :key ";
$arr = array(":key" => "%" . $key . "%");
$page = Utils::getIndex("page", 1);
$list = $book->search($page);


?>

<div class="card">
	<div class="card-header">
		<h5 class="">Trang <?php echo "$page/ " . $book->getPageCount(); ?></h5>
	</div>
	<div class="card-body  row row-cols-1 row-cols-md-3 g-4">
    <?php
    foreach ($list as $r) {
        ?>
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/<?php echo $r["Image"]; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" ><?php echo $r["Title"]; ?></h5>
                            <p class="card-text">
                                Chương <?php echo $r["Chapter"]; ?>
                            </p>
                            <p class="card-text">
                                Giá: <?php echo number_format($r['Price'], 0, ',', '.'); ?> VND
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Tác giả: <?php echo $r["Author"]; ?></small>
                            </p>
                            <div class="btn-group form-control border border-0" role="group">
                            <a href="index.php?mod=cart&ac=add&id=<?php echo $r["BookID"]; ?>" class="btn btn-dark btn-md">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php
    }
    ?>
</div>

</div>
<?php



?>
<div>
    <?php
    for ($i = 1; $i <= $book->getPageCount(); $i++) {
        echo "<a href='index.php?mod=sanpham&ac=search&key=$key&page=$i'>$i</a>&nbsp;";
    }
    ?>
</div>