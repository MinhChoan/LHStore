<?php
if (!defined("ROOT"))
{
	echo "Err!"; exit;	
}
	$ac=getIndex("ac", "home");
	if ($ac=="home")
		{
			include ROOT."/module/book/home.php";
		}
	if ($ac=="login")
        {
            include ROOT."/module/auth/login.php";
        }
    if ($ac=="register")
        {
            include ROOT."/module/auth/register.php";
        }
        
?>