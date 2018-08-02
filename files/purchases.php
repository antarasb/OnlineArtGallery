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

      <!--Let browser know website is optimized for mobile-->
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
img{
  width: 245px;
  height: 285px; 
}

        </style>
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
              <img src="artistica.png" style="width:200px;height:50px;margin-right:850px;"></img>
               
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   <li ><a href="dashbuy.php">Dashboard</a></li>
                  <li><a href="explore.php">Explore</a></li>
             

                </ul>
             

              <img src="paint.png" style="width:70px;height:70px;position:absolute"></img>
               
              </div>
            </nav>
            </center>
<?php
$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;

$cursor=$col->findOne(array('uname'=>$_SESSION['name']));
$cnt=count($cursor['bought']);
if($cnt!=0)
{
echo "<ul class='grid'>";
foreach ($cursor['bought'] as $i)
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
echo "</ul>";
}
  

else
{
  echo "You haven't purchased anything yet.";
}
?>
</body>
</html>