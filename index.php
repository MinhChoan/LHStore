<?php
include "config/config.php";
include ROOT . "/include/function.php";
if (!isset($_SESSION))
  session_start();
spl_autoload_register("loadClass");
$db = new Db();
$cart = new Cart();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>LHStore</title>
</head>

<body>
  <div class="mb-4">
    <?php
    include "include/navbar.php";
    ?>
  </div>

  <main class="boder">
  <div class="container">
    <?php
    include "mod.php";
    ?>
  </div>
  </main>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>