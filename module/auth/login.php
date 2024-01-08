<?php
$mess = "";
if (isset($_POST["login"])) {
    $auth = new Auth();
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["email"] = $email;
    if ($email == "" || $password == "") {
        $mess = "Sai thông tin đăng nhập!";
    } else {
        $result = $auth->login($email, $password);
        if ($result && isset($result['AdminID'])) {
            // Nếu là quản trị viên
            $_SESSION["admins"] = $result;
            header("Location: /index.php");
            exit;
        } else if ($result) {
            // Nếu là người dùng
            $_SESSION["users"] = $result;
            header("Location: /index.php");
            exit;
        } else {
            $mess = 'Đăng nhập thất bại';
        }
    }
}
?>

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

              <form method="post" action="">
                  <div class="d-flex align-items-center mb-3 pb-1 text-center">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">
                      <img src="/image/favicon.ico" alt="">
                      <span class="text-dark">LH</span>Store
                    </span>
                  </div>
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Địa chỉ Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example27" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Mật khẩu</label>
                  </div>

                  <div class="col text-center">
                    <p class="text-danger"> <?php echo $mess ?></p>
                  </div>

                  <div class="pt-1 mb-4">
                    <button name="login" type="submit" class="btn btn-primary btn-block form-control">Đăng nhập</button>
                  </div>

                  <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a href="?ac=register.php"
                      style="color: #393f81;">Đăng ký ngay!</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                  
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>