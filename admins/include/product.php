<?php
require_once(dirname(__DIR__) . '/../config/config.php');
require_once(dirname(__DIR__) . '/../classes/Db.class.php');
require_once(dirname(__DIR__) . '/../classes/Book.class.php');

$book = new Book();
if (isset($_GET['BookID'])) {
  $BookID = $_GET['BookID'];
  // Hiển thị modal xác nhận
  $book->delete($BookID);
  header('location: ./index.php?page=product-list');
}
if (!defined("ROOT")) {
  echo "Err!";
  exit;
}
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Danh sách sản phẩm</h3>
    <a href="index.php?page=product-add" class="btn btn-success float-end">Thêm mới</a>
  </div>
  <div class="card-body">
    <table id="product-list" class="table table-striped" style="width:100%">
      <thead>
        <tr class="text-center">
          <th class="col-1">Mã sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Chương</th>
          <th>Giá tiền</th>
          <th>Số lượng</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db = new Db();
        $sql = "SELECT * FROM books";
        $result = $db->exeQuery($sql);
        foreach ($result as $row) {
          ?>
          <tr class="text-center">
            <td>
              <?php echo $row['BookID']; ?>
            </td>
            <td>
              <?php echo $row['Title']; ?>
            </td>
            <td>
              <?php echo $row['Chapter']; ?>
            </td>
            <td>
              <?php echo number_format($row['Price'], 0, ',', '.'); ?>
            </td>
            <td>
              <?php echo $row['Quantity']; ?>
            </td>
            <td>
            <a class="btn btn-outline-success me-1"
                href="index.php?page=product-update&BookID= <?php echo $row['BookID']; ?>">Sửa</a>

              <a class="btn btn-outline-success me-1"
                href="index.php?page=product-list&BookID= <?php echo $row['BookID']; ?>">Xóa</a>
            </td>
          </tr>
          <?php
        }
        ?>


      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa sản phẩm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Bạn có chắc chắn muốn xóa sản phẩm này?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
        <!-- Thêm ID để xác định nút xác nhận trong JavaScript -->
        <button type="button" class="btn btn-primary" id="confirmDeleteButton">Xác nhận</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
    $('#product-list').DataTable();
  });

</script>