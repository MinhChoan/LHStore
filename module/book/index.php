<?php
if (!defined("ROOT"))
{
	echo "Err!"; exit;	
}
	$book = new book();
	$ac=getIndex("ac", "home");
	if ($ac=="home")
		{
			include ROOT."/module/book/home.php";
		}
	if ($ac=="list")
		{
			include ROOT."/module/book/list.php";
		}
	if ($ac=="detail")
		{
			include ROOT."/module/book/detail.php";	
		}
	if ($ac=="search")
		{
			include ROOT."/module/book/search.php";	
		}
	if ($ac=="add")
		{
			include ROOT."/module/book/add.php";	
		}
	if ($ac=="detail")
		{
			include ROOT."/module/book/detail.php";	
		}
		

?>