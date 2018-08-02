<?php
  session_start();
?>
<html>
    <head>
    <title>SIGNING</title>
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
              
         </div><br><br>

            <br>            
            <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img src="artistica.png" style="width:200px;height:50px;margin-right:850px;"></img>
               
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="explore.php">Explore</a></li>
                    <li><a href="home.php">Home</a></li>
                
                </ul>
             
                
              <img src="paint.png" style="width:70px;height:70px;position:absolute"></img>
               
              </div>
            </nav>
            </center>

<br><br>
<center>
    <div style="font-size:40px ;color:#4242C5;font-family:'Comic Sans MS', cursive, sans-serif">Sign Up!</div>
 <div style="font-size:25px ; color:4242C5"  ><i> as :</i></div>
   </center>
     <br><br>
     <!--
      <a class="waves-effect waves-light btn" style="float:left ; margin-right:50px ; margin-left:530px" href="signup.php">Artist</a>
    

      <a class="waves-effect waves-light btn" style="float:left ;" href="signup.php">Buyer</a>
    -->
  <center>
<form method="post">
  <button class="btn waves-effect waves-light" style="background-color:#FF9000" type="submit" name="artist">Artist
    <i class="material-icons right"></i>
  </button>
        

  <button class="btn waves-effect waves-light" style="background-color:#FF9000" type="submit" name="buyer">Buyer
    <i class="material-icons right"></i>
  </button>
        
</form>
    <div style="font-size:15px ;color:#4242C5;font-family:'Comic Sans MS', cursive, sans-serif"><i>Already a member?<a href="login.php" style="color:#ff6f00" > Log In!</a></i></div>

</center>
    <br></body>
    </html>
    <?php

if(isset($_POST['artist']))
{
$_SESSION['type']="artist";
  header("Location:signup.php");
}
if(isset($_POST['buyer']))
{
$_SESSION['type']="buyer";
header("Location:signup.php");
}

    ?>