<?php
class book extends Db{
	private $_page_size =5;//Một trang hiển hị 5 cuốn sách
	private $_page_count;
	public function getBook($n)
	{
		$sql="select BookID, Title, Author, Price, Image, Chapter from books limit 0, $n ";
		return $this->exeQuery($sql);	
	}
	public function getBookRand($n)
	{
		$sql="select BookID, Title, Author, Price, Image, Chapter from books order by rand() limit 0, $n ";
		return $this->exeQuery($sql);		
	}

	public function getBookAdmin()
	{
		$sql = "select * from Books";
		return $this->exeQuery($sql);	
	}
	
	public function delete($BookID)
	{
		$sql="delete from books where BookID=:BookID ";
		$arr =  array(":BookID"=>$BookID);
		return $this->exeQuery($sql, $arr);	
	}
	
	public function getDetail($BookID)
	{
		$sql="select books.*, CategoryName 
			from books, categories
			where books.CategoryID = Categories.CategoryID
				and BookID=:BookID ";
		$arr = array(":BookID"=>$BookID);
		$data = $this->exeQuery($sql, $arr);
		if (Count($data)>0) return $data[0];
		else return array();
	}
	
	public function getAll($currPage=1)
	{
		$offset = ($currPage -1) * $this->_page_size;
		$sql="SELECT
				Count(*)
				FROM
				categories
				INNER JOIN books ON books.CategoryID = categories.CategoryID";
				$n  = $this->count($sql);
				$this->_page_count = ceil($n/$this->_page_size);
		$sql="SELECT
				books.BookID,
				books.Title,
				books.Description,
				books.Price,
				books.Image,
				books.CategoryID,
				categories.CategoryName,
				FROM
				categories
				INNER JOIN books ON books.CategoryID = categories.CategoryID
				limit $offset, " . $this->_page_size;
		
		return $this->exeQuery($sql);
	}
	
	public function search($currPage=1)
	{
		$key = getIndex("key", "");
		$offset = ($currPage -1) * $this->_page_size;
		$sql ="select * from Books where Title like :key ";
		$arr = array(":key"=> "%".$key."%");
		$n  = $this->count($sql, $arr);
		$this->_page_count = ceil($n/$this->_page_size);
		$sql ="select * from Books where Title like :key limit $offset, " . $this->_page_size;
		return $this->exeQuery($sql, $arr);
		
	}
	
	public function count($sql, $arr=array())
	{
		return $this->countItems($sql, $arr);
	}
	
	public function getPageCount()
	{
		return $this->_page_count;	
	}

	public function addBook($Title, $Description, $Author, $Quantity, $Price, $Image, $CategoryID, $Chapter)
	{
		$sql = "INSERT INTO books 
		(Title, Description, Author, Quantity, Price, Image, CategoryID, Chapter) 
		values (:Title, :Description, :Author, :Quantity, :Price, :Image, :CategoryID, :Chapter)";
		$arr = array
		(":Title"=>$Title, ":Description"=>$Description, ":Author"=>$Author, ":Quantity"=>$Quantity, ":Price"=>$Price, ":Image"=>$Image, ":CategoryID"=>$CategoryID, ":Chapter"=>$Chapter,);
		return $this->exeNoneQuery($sql, $arr);
	}

	public function updateBook($BookID, $Title, $Description, $Author, $Quantity, $Price, $CategoryID, $Chapter)
{
    $sql = "UPDATE books SET Title=:Title, Description=:Description, Author=:Author, Quantity=:Quantity, Price=:Price, CategoryID=:CategoryID, Chapter=:Chapter WHERE BookID=:BookID";
    $arr = array
    (
        ":BookID"=>$BookID, 
        ":Title"=>$Title, 
        ":Description"=>$Description, 
        ":Author"=>$Author, 
        ":Quantity"=>$Quantity, 
        ":Price"=>$Price, 
        ":CategoryID"=>$CategoryID, 
        ":Chapter"=>$Chapter
    );
    return $this->exeQuery($sql, $arr);
}
}
?>