<?php
require_once(dirname(__DIR__) . '/config/config.php');


class Db
{
	private $_numRow;
	protected $dbh = null;

	public function __construct()
	{
		$driver = "mysql:host=" . HOST . "; dbname=" . DB_NAME;
		try {
			$this->dbh = new PDO($driver, DB_USER, DB_PASS);
			$this->dbh->query("set names 'utf8' ");

		} catch (PDOException $e) {
			echo "Err:" . $e->getMessage();
			exit();
		}
	}

	public function prepare($sql) {
        return $this->dbh->prepare($sql);
    }

	public function __destruct()
	{
		$this->dbh = null;
	}

	public function getRowCount()
	{
		return $this->_numRow;
	}

	private function query($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		$stm = $this->dbh->prepare($sql);
		if (!$stm->execute($arr)) {
			echo "Sql lỗi."; //exit;	
		}
		$this->_numRow = $stm->rowCount();
		return $stm->fetchAll($mode);

	}
	/*
		  Sử dụng cho các sql select
		  */
	public function exeQuery($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		return $this->query($sql, $arr, $mode);
	}
	/*
		  Sử dụng cho các sql cập nhật dữ liệu. Kết quả trả về số dòng bị tác động
		  */
	public function exeNoneQuery($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		$this->query($sql, $arr, $mode);
		return $this->getRowCount();
	}

	/* su dung de dem so phan tu cua table ...*/
	public function countItems($sql, $arr = array())
	{
		$data = $this->exeQuery($sql, $arr);

		if (is_array($data) && isset($data[0]) && is_array($data[0]) && isset($data[0][0])) {
			return $data[0][0];
		}

		return 0;
	}


	public function getOneRow($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		$data = $this->exeQuery($sql, $arr, $mode);
		if (count($data) == 0)
			return null;
		return $data[0];
	}

	public function getFetchArray($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		$data = $this->exeQuery($sql, $arr, $mode);
		if (count($data) == 0)
			return null;
		return $data;
	}

	public function select_to_array($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		return $this->exeQuery($sql, $arr, $mode);
	}

	public function getPageResult($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
	{
		$page = getIndex("page", 1);
		$limit = getIndex("limit", 10);
		$offset = ($page - 1) * $limit;
		$sql .= " limit $offset, $limit";
		return $this->exeQuery($sql, $arr, $mode);
	}

	public function getLastID()
	{
		return $this->dbh->lastInsertId();
	}

	public function generateOrderID()
	{
		// You can customize this method based on your requirements for generating an OrderID
		// For example, you can use a combination of current timestamp and a random number
		$orderId = date('YmdHis') . mt_rand(1000, 9999);

		return $orderId;
	}

	




}
?>