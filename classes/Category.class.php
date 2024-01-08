<?php
class categories extends Db{
	
	
	public function delete($CategoryID)
	{
		$sql="delete from categories where CategoryID=:CategoryID ";
		$arr =  array(":CategoryID"=>$CategoryID);
		return $this->exeQuery($sql, $arr);	
	}
	
	public function getById($CategoryID)
	{
		$sql="select categories.* 
			from categories
			where  categories.CategoryID=:CategoryID ";
		$arr = array(":CategoryID"=>$CategoryID);
		$data = $this->exeQuery($sql, $arr);
		if (Count($data)>0) return $data[0];
		else return array();
	}
	
	public function getAll()
	{
		return $this->exeQuery("select * from categories");
	}
	
	public function saveEdit()
	{
		$id =Utils::postIndex("CategoryID");
		$name =Utils::postIndex("CategoryName");
		if ($id =="" || $name=="") return 0;//Error
		$sql="update categories set CategoryName=:name where CategoryID=:id ";
		$arr = array(":name"=>$name, ":id"=>$id);
		return $this->exeNoneQuery($sql, $arr);
		
	}
	public function saveAddNew()
	{
		$id =Utils::postIndex("CategoryID");
		$name =Utils::postIndex("CategoryName");
		if ($id =="" || $name=="") return 0;//Error
		$sql="insert into categories(CategoryID, CategoryName) values(:CategoryID, :CategoryName) ";
		$arr = array(":CategoryID"=>$id, ":CategoryName"=>$name);
		return $this->exeNoneQuery($sql, $arr);
		
	}

	public function addCategory($CategoryName)
	{
		$sql = "INSERT INTO categories(CategoryName) VALUES (:CategoryName)";
		$arr = array(":CategoryName"=>$CategoryName);
		return $this->exeNoneQuery($sql, $arr);
	}

}
?>