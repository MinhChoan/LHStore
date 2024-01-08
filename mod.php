<?php
$mod = getIndex("mod","book");
$ac = getIndex("ac","index");
			
if ($mod=="book")
	include "module/book/index.php";
if ($mod=="news")
	include "module/news/index.php";
if ($mod=="cart")
	include "module/cart/index.php";
if ($mod=="checkout")
	include "module/cart/thanhtoan.php";
if ($mod=="auth")
	include "module/auth/index.php";
if ($mod=="admin")
	include "/admins/index.php";
?>