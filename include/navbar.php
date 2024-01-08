<?php
require_once 'classes/Auth.class.php';

// Kiểm tra xem có yêu cầu logout không
if (isset($_GET['logout'])) {
    $auth = new Auth(); // Tạo một đối tượng Auth

    // Gọi phương thức logout từ đối tượng Auth
    $auth->logout();
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="/image/favicon.ico" alt="" style="width: 40px;">LHStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Thể loại
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $cats = $db->exeQuery("select * from categories");
                        foreach ($cats as $r) {
                            ?>
                            <li>
                                <a class="dropdown-item"
                                    href="index.php?mod=book&ac=list&CategoryID=<?php echo $r["CategoryID"];?>">
                                    <?php echo $r["CategoryName"];?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex mx-auto" role="search" action="index.php">
                <div class="input-group">
                    <input type="hidden" name="mod" value="book" />
                    <input type="hidden" name="ac" value="search" />
                    <input type="text" class="form-control" name="key" placeholder="Tìm truyện..."
                        value="<?php echo Utils::getIndex("key", ""); ?>" />
                    <input type="submit" class="btn btn-outline-light" value="Tìm" />
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <?php
                    if (isset($_SESSION["users"])) {
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $_SESSION["users"]["FullName"]; ?>
                        </a>
                        <ul class="dropdown-menu text-center dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="?logout=1">Đăng xuất</a>
                            </li>
                        </ul>
                        <?php
                    } else 
                    if (isset($_SESSION["admins"])) {
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $_SESSION["admins"]["FullName"]; ?>
                        </a>
                        <ul class="dropdown-menu text-center dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/admins/index.php">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="?logout=1">Đăng xuất</a>
                            </li>
                        </ul>
                        
                        <?php
                    } else {
                        ?>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Tài khoản
                        </a>
                        <ul class="dropdown-menu text-center dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php?mod=auth&ac=login">Đăng nhập</a></li>
                            <li><a class="dropdown-item" href="index.php?mod=auth&ac=register">Đăng ký</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
            </ul>

            <div class="itemmenu">
                <a href="index.php?mod=cart">
                    <button type="button" class="btn btn-outline-light">
                        <i class="bi bi-basket-fill"></i>
                        <span id="cart_sumary">
                            <?php
                            if (isset($_SESSION["cart"])) {
                                $cart = new Cart();
                                echo $cart->getNumItem();
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</nav>