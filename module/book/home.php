<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php
        $list = $book->getBook(10);
        foreach ($list as $r) {
            ?>
            <div class="col">
                <div class="card mb-3 " style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="images/<?php echo $r["Image"]; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">
                                    <?php echo $r["Title"]; ?>
                                </h5>
                                <p class="card-text">
                                    Chương
                                    <?php echo $r["Chapter"]; ?>
                                </p>
                                <p class="card-text">
                                    Giá:
                                    <?php echo number_format($r['Price'], 0, ',', '.'); ?>
                                    VND
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Tác giả:
                                        <?php echo $r["Author"]; ?>
                                    </small>
                                </p>
                                <div class="">
                                <a href="?ac=detail&id=<?php echo $r["BookID"]; ?>"
                                        class="btn btn-dark btn-md form-control mb-1">Xem chi tiết</a>
                                    <a href="index.php?mod=cart&ac=add&id=<?php echo $r["BookID"]; ?>"
                                        class="btn btn-dark btn-md form-control">Thêm vào giỏ hàng</a>
                                    
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