<?php
if (!isset($_SESSION)) session_start();

$mess = "";
if (isset($_POST["register"])) {
  $auth = new Auth();
  $email = $_POST["email"];
  $password = $_POST["password"];
  $repassword = $_POST["repassword"];
  $fullname = $_POST["fullname"];
  $username = $_POST["username"];
  if ($email == "" || $password == "" || $repassword == "" || $fullname == "" || $username == "") {
    $mess = "Không để trống thông tin!";
  } else {
    if ($password != $repassword) {
      $mess = "Mật khẩu không trùng khớp!";
    } else {
      $result = $auth->register($username, $email, $fullname, $password);

      if ($result) {
        $mess = "Đăng ký thành công!";
        unset($_POST["register"]);
      } else {
        $mess = "Đăng ký thất bại. Vui lòng thử lại.";
      }
    }
  }
}
?>

<!-- Your HTML code -->
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <!-- Your existing code for the image -->
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="post" action="index.php?mod=auth&ac=register">

                  <!-- Login form fields -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Địa chỉ Email</label>
                  </div>

                  <!-- Registration form fields -->
                  <div class="form-outline mb-4">
                    <input type="text" name="username" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">Tên đăng nhập</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Mật khẩu</label>
                  </div>
                  
                  <div class="form-outline mb-4">
                  <input type="password" name="repassword" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Nhập lại mật khẩu</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" name="fullname" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">Họ và tên</label>
                  </div>

                  <!-- Common submit button for both forms -->
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit" name="register">Đăng ký</button>
                  </div>

                  <!-- Display error messages -->
                  <div class="alert alert-sucess" role="alert"><?php echo $mess ?></div>

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