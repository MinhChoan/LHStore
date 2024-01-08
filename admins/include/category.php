<?php
require_once(dirname(__DIR__) . '/../config/config.php');
require_once(dirname(__DIR__) . '/../classes/Db.class.php');
require_once(dirname(__DIR__) . '/../classes/Book.class.php');
require_once(dirname(__DIR__) . '/../classes/Category.class.php');

$category = new categories();
if (isset($_GET['CategoryID'])) {
  $CategoryID = $_GET['CategoryID'];
  // Hiển thị modal xác nhận
  $category->delete($CategoryID);
  header('location: ./index.php?page=category-list');
}
if (!defined("ROOT")) {
  echo "Err!";
  exit;
}
?>

<div class="card">
  <div class="card-header">
    <a href="index.php?page=category-add" class="btn btn-success float-end">Thêm mới</a>
  </div>
  <div class="card-body">
    <table id="category-list" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th class="col-1">Mã thể loại</th>
          <th>Tên thể loại</th>
          <th class="col-1">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db = new Db();
        $sql = "SELECT * FROM categories";
        $result = $db->exeQuery($sql);
        foreach ($result as $row) {
          ?>
          <tr>
            <td>
              <?php echo $row['CategoryID']; ?>
            </td>
            <td>
              <?php echo $row['CategoryName']; ?>
            </td>
            <td>
              <a class="btn btn-outline-success me-1"
                href="index.php?page=category-list&CategoryID= <?php echo $row['CategoryID']; ?>">Xóa</a>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


<script>
  new DataTable('#category-list');
</script>
