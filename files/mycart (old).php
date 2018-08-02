<html>
<body>
<?php

if(!session_start())
{session_start();}
?>
<a href="explore.php">Explore</a><br>
<?php
$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;
$col2 = $db->bill;

$cursor=$col->findOne(array('uname'=>$_SESSION['name']));
$name=$cursor["name"];
$cnt=count($cursor['cart']);
foreach ($cursor['cart'] as $value)
{
$source=$value['url'];

echo "Art: ".$value['artname']."<br>";
echo "Price: ".$value['price']."<br>";
?>
	<br>
	<img src="<?php echo $source; ?>" height="200px" width="200px"></img><br>
<?php	
}
  
$map = new MongoCode("function() {
                       for (var i = 0; i < this.cart.length; i++) {
                           var key = this.name;
                           
                           var value = {
                                         price: this.cart[i].price
                                       };
                           emit(key, value);
                       }
                    };");

$reduce = new MongoCode("function(keys, values) {
                     bill = { price: 0 };

                     for (var i = 0; i < values.length; i++) {
                        var x = new NumberInt(values[i].price);
                        var y = new NumberInt(bill.price);
                         bill.price = y + x;

                     }
                   
                     return bill;
                  };
");


$sales = $db->command(array(
    "mapreduce" => "users", 
    "map" => $map,
    "reduce" => $reduce,
    "query" => array("uname" => $name),
    "out" => array("merge" => "bill")));
  
    $users = $col2->findOne(array("_id" => $name));
    foreach($users['value'] as $i) 
    {
      echo "<br><b>Your bill is:$i</b>"; 
    }

?>
<form method="post">
<input type="submit" value="Buy" name="buy">
</form>


<?php
$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;
$col2=$col->find();
$sess=$_SESSION['name'];

$cursor=$col->findOne(array("uname"=>$sess));


if(isset($_POST['buy']))
{
  ?>
  <script type="text/javascript">
  confirm("Sure you want to buy?");
  </script>
              <?php
  foreach ($cursor['cart'] as $value) 
  {
    $artname=$value['artname'];
    foreach ($col2 as $key) 
    {
      if($key['cart'])
      {
        foreach ($key['cart'] as $id) 
        {
          if($artname==$id['artname'])
          {
             $col->update(array("upload.artname"=>$artname),array('$set'=>array('upload.$.status'=>'sold')));       
              break;
          }
        }
      }
    }
  }
  $col->update(array("uname"=>$sess),array('$rename'=>array("cart"=>"bought")));
  
}


?>
</body>
</html>