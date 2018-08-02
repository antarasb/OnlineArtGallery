<?php
if(!session_start())
{
  session_start();
}
?>
 <!DOCTYPE html>
  <html>
    <head>
    <title>Explore</title>

       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
           <style type="text/css">

.avl
{
  color:green;
  font-weight: bolder;
  text-align: center;
}
.cap 
{
  font-weight: bold;
  z-index: 50;
  margin-left: 5px;
}
.grid {
  
  padding: 8px;
  list-style: none;
  position: relative;
  width: 100%;
  margin-left: 6%;
}

.grid li {
  float: left;
  overflow: hidden;
  width: 20%; /* Fallback */
  width: calc(100% / 5);
  margin-right: 2%;
  margin-bottom: 2%;
  border-style: solid;
  border-color: #FF4500;
  border-width: 4px;
  border-radius: 8px;
  background-color: white;
}

.grid li a
 {
  display: block;
  width: 100%;
  cursor: pointer;

}

#detail-left .cart-button {
    background : url("cart-button3.png");
    border : none;
    height: 50px;
    width: 50px;
    padding: 10px;
    line-height: 48px;
    background-color: #00C169;
    border-radius: 8px;
    position: absolute;
    margin-top: 1.5%;
    margin-left: 15.3%;
    z-index: 0;
}

img{
  width: 245px;
  height: 285px; 
}
</style>

    </head>

    <body bgcolor="#272525">
    
    <center>
            
            <nav style="background-color:#FF4500">
              <div class="nav-wrapper">
              <a href="#" class="brand-logo" style="margin-left:1%;">ArTisTicA</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
           
            <?php if($_SESSION['loggedin']=="yes")
            {?>
              

               
                   <li ><a href="logout.php">LogOut</a></li>
                   
                   <?php
                }
              ?>           



          <?php if($_SESSION['loggedin']!="yes")
            {?>       
                  <li ><a href="home.html">Home</a></li>
                  <li class="active"><a href="#">Explore</a></li>
                <?php }?>
                </ul>
              </div>
            </nav>
            <br>
            <br>
    </center>
        <form method="post">
         <label for="search"></label>
        <i class="medium material-icons">search</i><big><b>Search</b></big><input type="text" name="search" style="color:white;font-size:30px;">
        
  <button class="btn waves-effect waves-light" type="submit" name="artist">Submit
    <i class="material-icons right">send</i>
  </button>
 
      <!--    <input type="submit" name="category" value="Category">
        <input type="submit" name="pricelow" value="Price-low to high">
        <input type="submit" name="pricehigh" value="Price-high to low">
       --> </form>



<?php

    $search=$_POST['search'];
    $connect=new MongoClient();
    $db=$connect->artistica;
    $col=$db->users;
    $cursor = $col->find();
    unset($_SESSION['artist']);

    if(isset($_POST['artist']))
    {
        $where=array('name'=>array('$regex'=>new MongoRegex("/.*$search.*/i")));
        $cursor = $col->find($where); 
    }
  
  echo "<ul class='grid'>";
  //CHANGE THIS #########

  foreach($cursor as $id) 
  { 
    $name = $id["name"];
    if($id["upload"])
    { 
  
      foreach ($id["upload"] as $i )
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
<?php if($_SESSION['type']=="buyer")
{?>
      <div id="detail-left">
      <form method='post'>
      <input class='cart-button' type='submit' value="" name='<?php echo $temp; ?>'/>

     </div>
 <?php
 }?>    


          <div class="cap"><div><?php echo $in." by ".$name;?><br>Price:<?php echo $p;?></div>
          </div>
          <?php
          if($s=="available")
          {
          ?>
          <div class="avl"><?php echo $s;?></div>
          <?php }
           else
           {
            ?>
           <div class="avl" style="color:red;"><?php echo $s;?></div>
           <?php
           }?> 

      </li>
      
    </div>
    <?php
        
      }
    }
  }
  echo "</ul>";

   /*if(isset($temp)))
            {
              $_SESSION["artwork"] = &$in;
              $_SESSION["artist"] = &$name;
              echo $_SESSION["artist"];
              //header("Location:details.php");
            }
             unset($temp,$in);*/
?>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
  <!-- 

   <form method='post'>
      <input type='submit' name='<?php echo $temp; ?>' value='more'></form>
      </div>
      </li>-->
  <?php  

foreach($cursor as $artist)
{
  $name=$artist['uname'];
  if($artist['upload'])
  {
  
  foreach ($artist['upload'] as $value)
  {
  
  $temp=$value['artname'];
  if(isset($_POST[$temp]))
  {
   
  $_SESSION['artist']=$name;
  $_SESSION['artwork']=$temp;  
  ?>
  <script>
  window.open("details.php");
  </script>
<?php
  
  }
  }
}
}

?>
