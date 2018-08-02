<?php
if(!session_start())
{
  session_start();
}

$connect=new MongoClient();
$db=$connect->artistica;
$col=$db->users;
$user=$col->findOne(array("uname" => $_SESSION['name']));
?>

 <!DOCTYPE html>
  <html>
    <head>
    <title>Edit Profile</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body bgcolor="#A4D0F1">
    
    <center>
              <div>
                      <a href="logout.php" style="float:right;color:#6666FF;padding:10px;">Log Out</a>
         </div><br><br>
            
                        
            <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img src="artistica.png" style="width:200px;height:50px;margin-right:850px;"></img>
               
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                 
                   <li ><a href="dash.php">Dashboard</a></li>
                 
                  <li><a href="explore.php">Explore</a></li>
                   </ul>
              
              <img src="paint.png" style="width:70px;height:70px;position:absolute"></img>
               
              </div>
            </nav>



            <br>
            <br>
            <center>
         <h4 style="color:#4242C5;">Edit your profile</h4>
             </center>
             <br>             
      <form method="post">
<fieldset style="width:800px; height=500px;  border-color:#4242C5;">
    <div class="row">
    <form class="col s8">
                        <br>
                        <br>
                        <div class="row">
                        <div class="input-field col s6">
                          <input id="first_name" type="text" name="name" class="validate" value="<?php echo $user['name'];?>">
                          <label class="active" for="first_name">Name</label>
                        </div>
                      </div>
                      <div class="row">
                      <div class="input-field col s6">
                      <label >Change Password:</label>
                      </div>
                      </div>
                      <br>
                     <div class="row">
                    <div class="input-field col s6">
                      <input id="con_password" type="password" name="newpd" class="validate" >
                      <label for="con_password"> New Password</label>
                    </div>
                  </div>   
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="password" type="password" name="password" class="validate">
                        <label for="password">Password</label>
                      </div>
                    </div>
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="email" type="email" name="email" class="validate" value="<?php echo $user['email'];?>">
                      <label class="active" for="email">Email</label>
                    </div>
                  </div>
                 <div class="row">
                  <div class="input-field col s6">
                    <input id="phone" type="tel" class="validate" name="phone" value="<?php echo $user['phone'];?>">
                    <label class="active" for="phone">Phone no</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <input id="date" type="date" class="datepicker" name="date">
                    <label  for="date">Birth Date</label>
                  </div>
                </div>
          
              <div class="row">
                 <div class="input-field col s6">
                  <textarea id="textarea2" class="materialize-textarea" name="address" value="<?php echo $user['address'];?>"></textarea>
                <label class="active" for="textarea2">Address</label>
              </div>
            </div>
                <div class="row">
                    <div class="input-field col s6">
                      <textarea id="textarea1" class="materialize-textarea" name="describe" value="<?php echo $user['describe'];?>">
                      </textarea>
                      <label class="active" for="textarea1">About Yourself</label>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                      <label for="phone">Gender</label><br>
                      <form >
                        <p>
                          <input name="gender" type="radio" id="test1" value="male" />
                          <label for="test1">Male</label>
                        </p>
                        <p>
                          <input name="gender" type="radio" id="test2" value="female"/>
                          <label for="test2">Female</label>
                        </p>
                    <br>
                    <br>      
           <button class="btn waves-effect waves-light" style="background-color:#ff9000"type="submit" name="action">Update
            <i class="material-icons right">send</i>
            </button            
                      </form>
                  </div>  
                </div>
            </form>
          </div>
       </fieldset>
   </form>
   <br><br>
            >
        
      
        <br><br>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      </center>
      </body>
      </html>

      <?php

      $connect=new MongoClient();
      $db=$connect->artistica;
      $col=$db->users;
      
      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $password=$_POST['password'];
      $newpd=$_POST['newpd'];
      $bdate=$_POST['date'];
      $desc=$_POST['describe'];
      $gender=$_POST['gender'];
      
      if(isset($_POST['action']))
      {   

        if(isset($newpd))
        {
          if($password==$user['password'])
          {
          $newdata=array('$set' => array("name" => $name,"email" => $email,"phone"=>$phone ,"password" => $newpd, "birthdate" => $bdate, "describe" => $desc, "gender" => $gender ));
          $col->update(array("uname" => $_SESSION['name']),$newdata);
           //         echo "<b ><style='color:blue;'> Update successful!</style></b>"; 
          }
        }
        else{
          $newdata=array('$set' => array("name" => $name,"email" => $email,"phone"=>$phone , "birthdate" => $bdate, "describe" => $desc, "gender" => $gender ));
          $col->update(array("uname" => $_SESSION['name']),$newdata);
         // echo "<b ><style='color:blue;'> Update successful!</style></b>";
                 }
           ?>
          <script type="text/javascript">
          window.location.assign('dash.php');
          </script>
          <?php
         
      }


      ?>