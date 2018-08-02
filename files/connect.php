<?php
	$connect=new MongoClient();
	$db=$connect->artistica;
	$col=$db->users;
	$col2 = $db->bill;
?>