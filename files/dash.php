<?php
if(!session_start())
{
  session_start();
}
?>
 <!DOCTYPE html>
  <html>
    <head>
    <title>Dashboard</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
h5{
  color:#4242C5;
  font-family:"'Comic Sans MS', cursive, sans-serif" 
}
</style>
    </head>

    <body bgcolor="#A4D0F1">
    
    <center>
              <div>
                      <a href="logout.php" style="float:right;color:#6666FF;padding:10px;">Log Out</a>
         </div><br><br>
            
             <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:50%;">
              <img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:80%;">
                
              </img>
                </img>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                 
                   <li class="active"><a href="#">Dashboard</a></li>
                 
                  <li><a href="explore.php">Explore</a></li>
                </ul>
              </div>
            </nav>
</center>
      <br>
         <a class="waves-effect waves-light btn" style="float:left ;background-color:#ff9000" href="edit_profile.php">Edit profile</a>
		    
      <?php
      echo "<center><h3 style='color:#4242C5; margin-left:40%;position:absolute;'>Welcome ".$_SESSION['name']."</h3></center>";
     ?> 
    <br><br>
		  <a class="waves-effect waves-light btn" style="float:left ;background-color:#ff9000" href="myupload.php">My Uploads</a>
		
		<br><br>
		  <a class="waves-effect waves-light btn" style="float:left ;background-color:#ff9000" href="uploadnew.php">Upload new</a>
	<?php
      include_once("connect.php");
$artist=$coll->findOne(array("uname"=>$_SESSION['name']));

$cursor=count($artist['upload']);
//echo "Total number of uploads:".$cursor;
$sold=0;
$nsold=0;


foreach ($artist['upload'] as $value) {
  if($value['status']=="available")
  {
  $nsold++;
  }
}


foreach ($artist['upload'] as $value) 
{
  if($value['status']=="sold")
  {
  $sold++;
  }
}

//echo "<br>Available artworks: ".$nsold;
//echo "<br>Sold artworks: ".$sold;
    
      ?>  
      <br>
      <br>
      <center>
      <div>
<h5>You total number of artworks: <?php echo $cursor;?></h5>
<h5>Artworks sold: <?php echo $sold;?></h5>
<h5>Artworks available: <?php echo $nsold;?></h5>
</div>
</center>
 </body>
 
 </html>

 <?php
 






 ?>

 