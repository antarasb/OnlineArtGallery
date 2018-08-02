  
<?php
$search=$_POST['search'];
$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;
//$coll=$col->find();
echo "search is:";
$col2=$col->findOne(array("uname"=>null));
var_dump($col2);

$col3=$col2->sort(array("upload.date"=>1));
var_dump($col3);
?>