<?php
if(!isset($_SESSION))
{session_start();}
	$_SESSION["logout"]="yes";
	echo $_SESSION["logout"];

	if($_SESSION["logout"]=="yes"){header("Location:home.php");}
unset($_SESSION["logout"]);
session_destroy();
?>