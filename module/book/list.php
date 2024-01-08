<?php
if (!defined("ROOT")) {
	echo "Err!";
	exit;
}
$CategoryID = getIndex("CategoryID", "all");
$sql = "select * from books where 1 ";
$arr = array();
if ($CategoryID != "all") {
	$sql .= " and CategoryID =:CategoryID ";
	$arr[":CategoryID"] = $CategoryID;
}

$list = $book->exeQuery($sql, $arr);

?>
<div class="card">
	<div class="card-header">
		<h5 class="">Có
			<?php echo $book->getRowCount() ?> kết quả
		</h5>
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