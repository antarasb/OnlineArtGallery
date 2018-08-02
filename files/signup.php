<?php
if(!session_start())
{session_start();}
?>
<!DOCTYPE html>
    <html>
    <head>
    <font>
    <title>SignUp!</title>
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
    <center>
    <div style="font-size:40px ; color:#4242C5">Sign Up!</div></center>
    <br>
        <br>
<form method="post">
<fieldset style="width:800px; height=500px; margin-left:20%; border-color:#4242C5;">
        <br>
        <br>
        <br>
      <div class="row">
    <form class="col s8" >
      <div class="row">
        <div class="input-field col s6">
          <input   id="first_name" name="name" type="text" class="validate">
          <label for="first_name">*Name</label>
        </div>
      </div>  
      <div class="row">
        <div class="input-field col s6">
          <input  id="email" type="email" name="email" class="validate">
          <label for="email">*Email</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
          <input id="phone" type="tel" name="phone" class="validate">
          <label for="phone">*Phone no</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
          <input id="u_name" type="text" name="username" class="validate">
          <label for="u_name">*User Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password" name="password" class="validate">
          <label for="password">*Password</label>
        </div>
      </div>
       <div class="row">
        <div class="input-field col s6">
          <input id="con_password" type="password" name="cnfpwd" class="validate">
          <label for="con_password"> *Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <textarea id="textarea1" class="materialize-textarea" name="address"></textarea>
          <label for="textarea1">Address</label>
        </div>
      </div>
 <center>
     <button class="btn waves-effect waves-light" style="background-color:#FF9000" type="submit" name="action">Register
         <i class="material-icons right">send</i>
   </button> 
      </center>

      
    </form>
  </div>
</fieldset>

</form>


        <br><br>
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      
<br><br>

</body>
</html>
<?php
include_once("connect.php");
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$confirmpwd=$_POST['cnfpwd'];
$address=$_POST['address'];
$required=array($name,$phone,$email,$username,$password,$confirmpwd);
$error=false;
$valid=$col->findOne(array("uname"=>$username));

foreach ($required as $field)
{
  if(empty($field))
  {
    $error=true;
  }
}

if(isset($_POST['action']))
{
  if(!$error)
  {
   
   if(is_null($valid))
  {
    if($password==$confirmpwd)
      {echo $_SESSION['type'];
        $doc=array("name"=>$name,"phone"=>$phone,"email"=>$email,"address"=>$address,"password"=>$password,"uname"=>$username,"type"=>$_SESSION['type']); 
        $col->insert($doc);
        
                ?>
                <script type="text/javascript">
                window.location="login.php";
                </script>
                <?php
      }

      else
      {
        ?>
        <script type="text/javascript">
        alert("Passwords do not match.Please fill the form again.");
        </script>
      <?php
      }
  }
  else
  {
    ?>
        <script type="text/javascript">
        alert("Invalid username!Please fill the form again..");
        </script>
      <?php
  }
  }
  else
  {?>
    <script type="text/javascript">
        alert("Please fill the required fields");
        </script>
  <?php
  }
}
?>