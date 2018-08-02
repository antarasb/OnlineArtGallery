<!DOCTYPE html>
    <html>
    <head>
    <title>LogIn!</title>
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
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:50%;">
              <img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:80%;">
                
              </img>
                </img>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="explore.php">Explore</a></li>
                    <li><a href="home.php">Home</a></li>
                
                </ul>
             
              </div>
            </nav>
            </center>
     
        <br>
        <br>
        <br>
        <center>
 <div style="font-size:40px ; color:#4242C5;font-family:'Comic Sans MS', cursive, sans-serif"  >Log In </div>
    
    <div style="font-size:15px ; color:#4242C5;font-family:'Comic Sans MS', cursive, sans-serif"  ><i> Not a member yet?
      <a href="optionsign.php" style="color:#ff6f00" >SignUp!</a></i>
    </div>
    </center>
        <br>
      <form method="post">
      <fieldset style="width:400px; border-color:#4242C5;margin:auto">      
          <div class="row">
        <form class="col s4">
        <br>
        <br>

          <div class="row">
            <div class="input-field col s6">
              <input id="u_name" type="text" name="username" class="validate">
              <label for="u_name">User Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="password" type="password" name="password" class="validate">
              <label for="password">Password</label>
            </div>
         </div>
        </form>
      </div>
       <center>
     <button class="btn waves-effect waves-light" style="background-color:#FF9000" type="submit" name="action">Log In
         <i class="material-icons right">send</i>
   </button>
   <br><br>
   </center>
   </form>

        </fieldset>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      
<br><br>
<?php
if(!isset($_SESSION))
            {session_start();}

include_once("connect.php");
$username=$_POST['username'];
$password=$_POST['password'];
if(isset($_POST['action']))
{
$cursor = $col->findOne(array('uname'=>$username,'password'=>$password));
  if(is_null($cursor))
  { 
  ?>
  <script>
  alert("Username and passwords do not match!");
  </script>
  <?php
  }
  else
    {
        $type=$cursor['type'];
        echo $type;
        $_SESSION["name"]= $username;
        $_SESSION["loggedin"]="no";
        echo $_SESSION["loggedin"];
        if(isset($cursor))
        {  
           $_SESSION["loggedin"] = "yes";
            echo $_SESSION["loggedin"];
          if($_SESSION["loggedin"]=="yes")
            if($type=="artist")
          {$_SESSION['type']=$type;
            header("Location:dash.php");}

            else
              {$_SESSION['type']=$type;
                header("Location:dashbuy.php");}
        }
    }
}

