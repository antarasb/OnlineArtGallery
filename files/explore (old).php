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
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
             <style type="text/css">
      .grid
      {
        
        list-style: none;
        position: relative;
        width: 50%;
      }
      .grid li {
        margin-left: 10%;
        margin-bottom: 2%;
      position: relative;
     float: left;
      overflow: hidden;
      width: 35%; 
      height: 40%;
      display: block;
      border: 0.5px solid black;
      padding: 3px;
      }
    
      .myimg
      {
        border-style: solid;
        border-color: black;
        border-radius: 5px;
        border-width: 0.5px;
        
        }

#detail-left .cart-button {
    background : url("cart-button1.png");
    border : none;
    height: 98px;
    width: 98px;
    padding: 10px;
    line-height: 48px;
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
         <label for="search"><i class="material-icons">search</i></label>
        <input type="text" name="search">
        <input type="submit" name="artist" value="Artist">
      <!--    <input type="submit" name="category" value="Category">
        <input type="submit" name="pricelow" value="Price-low to high">
        <input type="submit" name="pricehigh" value="Price-high to low">
       --> </form>
  

  </body>
  </html>
  
<?php
$search=$_POST['search'];
$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;
$coll=$col->find();

if(isset($_POST['artist']))
{

echo "Search Results:";

 $where=array('name'=>array('$regex'=>new MongoRegex("/.*$search.*/i")));
    $col2 = $col->findOne($where); 
  
if($col2['upload'])
{ 
  $name=$col2['name'];
  foreach ( $col2['upload'] as $id)
    {
      $source=$id["url"];
 
      ?>
    <li class="col s3">
     <br>
      <div class="myimg">
      <img src="<?php echo $source;?>">
      <div class="divider"></div>
         <?php
  echo $value['artname']." by ".$name."<br>";
  echo "Price:".$value['price']."<br>";
?>   

   <form method='post'>
      <input type='submit' name='<?php echo $temp; ?>' value='more'>
      </form>
       


      </div>
      </li>
    <?php
        
    }
}
}

else{
$coll=$col->find();
foreach($coll as $artist)
{
  $name=$artist['uname'];
  if($artist['upload'])
  {
  
  foreach ($artist['upload'] as $value)
  {
  $source=$value['url'];
  $temp=$value['artname'];
  ?>
  <li class="col s3">
      <br>     
      <div class="myimg">
      <img src="<?php echo $source;?>">
      <div class="divider"></div>
        <?php
  echo $value['artname']." by ".$name."<br>";
  echo "Price:".$value['price']."<br>";
?>   
  <div id="detail-left">
      <form method='post'>
      <input class='cart-button' type='submit' value='Add' name='<?php echo $temp; ?>'/>
      <!--<input type='submit' name='<?php echo $temp; ?>' value='more'>--></form>
     </div>
    </div>
      </li>
  <?php  
  
  }
  }
}
}


foreach($coll as $artist)
{
  $name=$artist['uname'];
  if($artist['upload'])
  {
  
  foreach ($artist['upload'] as $value)
  {

  
  $temp=$value['artname'];
  if(isset($_POST[$temp]))
  {

    echo "boom";
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