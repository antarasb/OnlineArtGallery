<?php
if(!session_start())
{
  session_start();
}
include_once("connect.php");
$name= $_SESSION['artist'];

$artist=$col->findOne(array("uname"=>$name));

?>
<!DOCTYPE html>
    <html>
    <head>
    <title>IMAGE DETAILS</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body bgcolor="#A4D0F1">
    
    <center>
                  <div >
              <a href="logout.php" style="float:right;color:#6666FF;padding:10px">Log-out</a>
               <a href="mycart.php" style="float:right;color:#6666FF;padding:10px">My Cart</a>
         </div><br><br>

            <br>            
             <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:50%;">
              <img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:80%;">
                
              </img>
                </img>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   <li ><a href="dashbuy.php">Dashboard</a></li>
                  <li><a href="explore.php">Explore</a></li>
             

                </ul>
             
              </div>
            </nav>
            </center>
    <!--<img class="materialboxed" width="300" src="upload/boo_1.png" style="border:solid pink">-->


<?php


foreach ($artist['upload'] as $value)
  { 
    $name=$artist['name'];
    if($value['artname']===$_SESSION['artwork'])
    {
      $price=$value['price'];
      $source=$value['url'];
      $category=$value['category'];
      ?>
      <br>
      <!--<img src="<?php echo $source; ?>" height="200px" width="200px"></img><br>-->
      <center>
       <img class="materialboxed" data-caption="<?php echo "$_SESSION[artwork]"; ?> " height="300" width="400"  src="<?php echo $source; ?>" style="border:solid pink">
      <?php
      echo "<h4 style='color:#4242C5'>".$_SESSION['artwork']."<br>by ".$name."</h4>";
      echo "<h6 style='color:#4242C5'>Price: ".$value['price']."</h6>";
      echo "<h6 style='color:#4242C5'>Category: ".$value['category']."</h6>";
      if($value['about'])
      {
      echo "<h6 style='color:#4242C5'>Description: ".$value['about']."</h6>";
      }?>
      
      <form method="post">
      <input type="submit" value="Add to cart" name="<?php echo $_SESSION['artwork'];?>">
      </form>
      <center>
      <?php
      break;
    }
  }

if($_SESSION['loggedin']=="yes")
{
$artwork=$_SESSION['artwork'];
if(isset($_POST[$artwork]))
{
?>
<script>
alert("Added successfully!");
</script>
<?php

//Add in the buyer's cart
$buyer=$_SESSION['name'];
$artname=$_SESSION['artwork'];

$data=array("artname"=>$artname, "price"=>$price,"url" =>$source,"artist"=>$name);
$col->update(array("uname"=>$buyer),array('$push'=>array("cart"=>$data)),array('upsert'=>true));
}
}
else
{
 ?>
 <script type="text/javascript">
  alert("Please login to continue. If not a member please, sign up.");
  window.location.assign('home.php');
 </script>
 <?php
}

?>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
</center><br><br>

</center>
</body></html>