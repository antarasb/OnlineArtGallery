<?php
if(!session_start())
{session_start();}
?>
<html>

    <head>
    <title>Dashboard</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/grid.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body bgcolor="#A4D0F1">
    
    <center>
              <div>
              <a href="logout.php" style="float:right ; background-color:red ;color:white">Log-out</a>
         </div><br><br><br>
            <!--navbar starts here-->
            <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:50%;">
              <img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:72%;">
                
              </img>
                </img>
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul class="right">
           
           <?php if($_SESSION['loggedin']=="yes")
            {
              if($_SESSION['type']=="artist")
              {              
                ?>
                    <li><a href="dash.php">Dashboard</a></li>
                    <li><a href="logout.php">Log Out</a></li>  
                                   
                     <?php
                }
              
              if($_SESSION['type']!="artist")
              {
                ?>
                <li><a href="dashbuy.php">Dashboard</a></li>  
                   <li><a href="explore.php">Explore</a></li>        
                <li><a href="logout.php">Log Out</a></li>   
                             
                     
                <?php
              }
            }
              ?>
              <?php if($_SESSION['loggedin']!="yes")
            {
              ?>       
                  
                  <li ><a href="home.php">Home</a></li>
                  <li><a href="explore.php">Explore</a></li> 

                <?php 
                }
                ?>    
              </ul>
               
              </div>
            </nav>
               <!--navbar ends here-->
            </center>


<?php
include_once("connect.php");

$cursor=$col->findOne(array('uname'=>$_SESSION['name']));

$name=$cursor["uname"];
$cnt=count($cursor['cart']);
    if($cnt!=0)
    {
        echo "<ul class='grid'>";
              foreach ($cursor['cart'] as $i)
              {      

                  $im=$i["url"];
                  $in = $i["artname"];
                  $p = $i["price"];
                  $s = $i["status"];
                  $temp=$i['artname'];
                  ?>

                  <div>
                    <li>

                      <a href="#"><img src="<?php echo $im;?>"/>
                        <div class="divider"></div></a>

                        <div class="cap"><div><?php echo $in?><br>Price:<?php echo $p;?></div>
                        </div>
                        <!--PRINT STATUS-->
                        <?php
                        if($s=="available")
                        {
                            ?>
                            <div class="avl"><?php echo $s;?></div>
                            <?php 
                        }
                         else
                         {
                            ?>
                           <div class="avl" style="color:red;"><?php echo $s;?></div>
                           <?php
                         }

                         ?> 
                         <!--END PRINT STATUS-->


                         <form method="POST"><input type="submit" name="<?php echo $temp?>" value="remove" style="background-color:#00C169"></form>
                    </li>
                  </div>
                  <?php
                  }
        echo "</ul>";

       $boo=0;
        foreach ($cursor["cart"] as $x) 
        {
            if(isset($_POST[$x["artname"]]))
              {
                $boo=1;
                  echo $x["artname"];
                  echo $name;

                  
                  $res = $col->update(
                    array("uname"=>$name),
                    array('$pull'=>array("cart"=>array("artname"=>$x["artname"]))),array('multi'=>false));
                  $cnt=count($cursor['cart']);
                  echo $cnt;
                  if($cnt === 0)
                    break;

              }
        }

        $map = new MongoCode("function() {
                       for (var i = 0; i < this.cart.length; i++) {
                           var key = this.uname;
                           
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
      echo "<br><h6 style='color:white';>Your bill is:".$i."</h6>"; 
      $bill = $i;

    }
    $_SESSION["bill"] = &$bill;

?>


        

<form method="post">
<input type="submit" value="Buy" name="buy">
</form>


<?php
    }
  

    else
    {
      echo "<h5 style='color:orange';>You have no items on your cart!</h5>";
    }

  

//change status to bought
$colf=$col->find();
$sess=$_SESSION['name'];

$cur=$col->findOne(array("uname"=>$sess));


if(isset($_POST['buy']))
{
  ?>
  <script>  
  confirm("Sure you want to buy?");
  </script>
  <?php


  $x=$cur;
  $num = count($cur['cart']);
  echo $num;
  $_SESSION["count"] = count($cur['cart']);
  foreach ($cur['cart'] as $pass) 
  {   
     $artname=$pass['artname'];
     $_SESSION['artname'][$num] = $artname;
     echo $_SESSION['artname'][$num];

     $_SESSION['price'][$num] = $pass['price'];
     $num--;
  }

  foreach ($cur['cart'] as $value) 
  {
    $artname=$value['artname'];
    $price = $value['price'];
    $source = $value['url'];
    $artist = $value['artist'];
    foreach ($colf as $key) 
    {
      if($key['cart'])
      {
        foreach ($key['cart'] as $id) 
        {
          if($artname==$id['artname'])
          {
             $col->update(array("upload.artname"=>$artname),array('$set'=>array('upload.$.status'=>'sold')));   

                  if(count($cur['bought'])!=0)
                  {
                    $data=array("artname"=>$artname, "price"=>$price,"url" =>$source,"artist"=>$artist);
                    $col->update(array("uname"=>$sess),
                      array('$push'=>array("bought"=>$data)),array('upsert'=>true));

                    $col->update(
                    array("uname"=>$name),
                    array('$pull'=>array("cart"=>array("artname"=>$artname))),array('multi'=>false));
                  
                  }
                  else
                  {
                    $col->update(array("uname"=>$sess),array('$rename'=>array("cart"=>"bought")));
                  }
          }
        }
      }
    }
  }
 
}
if($boo==1)
        { 
          header("Location:mycart.php");
        }

//End of change status to bought


        //Invoice
        if(isset($_SESSION['count']))
        {
          header("Location:receipt.php");
        }
?>
</body>
</html>