<?php
require_once 'Db.class.php';
class Auth extends Db
{
    
    function register(string $Email, string $FullName, string $Password)
    {
        $sql = 'INSERT INTO users(Email, FullName, Password)
            VALUES(:Email, :FullName, :Password)';

        $statement = $this->dbh->prepare($sql);
        $statement->bindValue(':Email', $Email, PDO::PARAM_STR);
        $statement->bindValue(':FullName', $FullName, PDO::PARAM_STR);
        $statement->bindValue(':Password', $Password, PDO::PARAM_STR);

        if (!$statement->execute()) {
            die(print_r($statement->errorInfo(), true));
        }

        return true;
    }
    function login(string $Email, string $Password)
{
    // Kiểm tra session cho cột AdminID
    if (isset($_SESSION['AdminID'])) {
        // Nếu đã đăng nhập với quyền Admin, trả về thông tin Admin từ session
        return $_SESSION['AdminID'];
    }

    // Kiểm tra trong bảng users
    $sql = 'SELECT * FROM users WHERE Email = :Email AND Password = :Password';
    $statement = $this->dbh->prepare($sql);
    $statement->bindValue(':Email', $Email, PDO::PARAM_STR);
    $statement->bindValue(':Password', $Password, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Lưu thông tin user vào session
        $_SESSION['users'] = $user;
        return $user;
    }

    // Kiểm tra trong bảng admins
    $sqlAdmin = 'SELECT * FROM admins WHERE Email = :Email AND Password = :Password';
    $statementAdmin = $this->dbh->prepare($sqlAdmin);
    $statementAdmin->bindValue(':Email', $Email, PDO::PARAM_STR);
    $statementAdmin->bindValue(':Password', $Password, PDO::PARAM_STR);
    $statementAdmin->execute();
    $admin = $statementAdmin->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Lưu thông tin Admin vào session
        $_SESSION['AdminID'] = $admin;
        return $admin;
    }

    // Nếu không tìm thấy trong cả hai bảng
    return false;
}


    function logout()
    {
        session_destroy();
        header("location: index.php");
    }

    function checkAdmin()
    {
        if (!isset($_SESSION["admins"])) {
            header("location: index.php");
        }
    }

    function checkUser()
    {
        if (!isset($_SESSION["users"])) {
            header("location: index.php");
        }
    }

}