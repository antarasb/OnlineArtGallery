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
    </head>
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
               
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul class="right ">
                   <li class="active"><a href="#">Dashboard</a></li>
                  <li><a href="explore.php">Explore</a></li>
             

                </ul>
  
              </div>
            </nav>
            </center>

      <br>
		    
      <?php
      echo "<center><h5 style='color:white' >Welcome " .$_SESSION['name']."</h5></center>";
      ?>   
     <br><br>
		<a href="purchases.php"class="waves-effect waves-light btn" style="float:left ;background-color:#ff9000;">My Purchases</a>
		
		
		<br>
		
 </center>
 </body>
 
 </html>
 