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
       <link type="text/css" rel="stylesheet" href="css/grid.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
           <style type="text/css">


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

</style>

    </head>

<body bgcolor="#A4D0F1">
    
    <center>
              <div>
                     
         </div><br><br>
            
                        
            <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:80%;"><img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:80%;"></img>
                </img>
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul class="right">
           
            <?php if($_SESSION['loggedin']=="yes")
            {
              if($_SESSION['type']=="artist")
              {              
                ?>
                    <li><a href="dash.php">Dashboard</a></li>
                    <li><a href="logout.php">Log Out</a></li>                   
                     <?php
                }
              
              if($_SESSION['type']!="artist")
              {
                ?>
                <li><a href="dashbuy.php">Dashboard</a></li>         
                <li><a href="logout.php">Log Out</a></li>                   
                     
                <?php
              }
            }
              ?>
              <?php if($_SESSION['loggedin']!="yes")
            {?>       
                  <li ><a href="home.php">Home</a></li>
                  <li class="active"><a href="#">Explore</a></li>
                <?php }?>    
              </ul>
              
               
              </div>
            </nav>
           



            <br>
            <br>
    </center>

    <fieldset style="width:900px; height:200px; margin-left:180px;border-color:#4242CF">
        <form method="post" style="margin-left:20px;">
        <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix"  style="color:white;">search</i>
          <input id="icon_prefix" type="text" style="width:600px;height:35px;" class="validate" name="search">
          <label for="icon_prefix">Search</label>
          
            <p style="margin-left:10px;">
              <input class="with-gap" name="group1" type="radio" id="test1" value="artist"/>
              <label for="test1">Artist</label>
              <input class="with-gap" name="group1" type="radio" id="test2"  value="category"/>
              <label for="test2">Category</label>
              <input class="with-gap" name="group1" type="radio" id="test3"  value="avail"/>
              <label for="test3">Availability</label>
              <input class="with-gap" name="group1" type="radio" id="test4" value="pricelow" />
              <label for="test4">Price low to high</label>
              <input class="with-gap" name="group1" type="radio" id="test5" value="pricehigh" />
              <label for="test5">Price high to low</label>

              </p>
            <button class="btn waves-effect waves-light" type="submit" name="submit" style="margin-top:35px;margin-left:285px;">Search
            </button>
              
             </div>
          </div>   
          </form>
  </fieldset>
    <!--<select class="browser-default">
      <option value="" disabled selected>Choose your option</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
    </select>

        <!--<i class="medium material-icons">search</i><big><b>Search</b></big><input type="text" name="search" style="color:white;font-size:30px;">-->
        
      
     <!-- <form method="post">
        <input type="submit" name="category" value="Category">
        <input type="submit" name="pricelow" value="Price-low to high">
        <input type="submit" name="pricehigh" value="Price-high to low">
        <input type="submit" name="available" value="Available">
       </form>
-->


<?php


    $search=$_POST['search'];
    
    $connect=new MongoClient();
    $db=$connect->artistica;
    $col=$db->users;
    $cursor = $col->find();
    unset($_SESSION['artist']);


    if(isset($_POST['submit']))
{

      if(isset($_POST['group1']))
        {
   if(($_POST['group1']=="artist")||($_POST['group1']=="category"))
   { 
   if(!empty($_POST['search']))         
    {
         if($_POST['group1']=="artist")
         {
         $where=array('name'=>array('$regex'=>new MongoRegex("/.*$search.*/i")));
          $cursor = $col->find($where); 
                    
          echo "<ul class='grid'>";
          foreach($cursor as $id) 
          { 
            //var_dump($id);
         $name=$id['name'];
        //echo $name;
          $i=$id['upload'];
        
          //rep($i,$name);
          foreach($id['upload'] as $i)
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
<?php if($_SESSION['type']=="buyer" && $s=="available")
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
         echo "</ul>";




        }  

        if($_POST['group1']=="category")
        {
           $ops=array(array('$unwind'=>'$upload'),array('$match'=>array('upload.category'=>array('$regex'=>new MongoRegex("/.*$search.*/i")))));
          $cur=$col->aggregate($ops);
          $curs=$cur['result'];
          echo "<ul class='grid'>";
          
          foreach($curs as $id) 
          { 
          $name=$id['name'];
          $i=$id['upload'];      
          rep($i,$name);
         }
         echo "</ul>";
        
        }
      }
  else
  {?>
    <script type="text/javascript">
    alert("Please enter a keyword in the search field.");
    </script>
    <?php   
  }
  }
    if($_POST['group1']=="avail")
    {
 
  /*    $where=array('upload.status'=>"sold");
      $cursor=$col->find($where);
 */
      $ops=array(array('$unwind'=>'$upload'),array('$match'=>array('upload.status'=>'available')));
      $cur=$col->aggregate($ops);
      $curs=$cur['result'];
      echo "<ul class='grid'>";
      
      foreach($curs as $id) 
      { 
        $name=$id['name'];
      $i=$id['upload'];      
      rep($i,$name);
     }
     echo "</ul>";
    

    }

  
    if($_POST['group1']=="pricelow")
    {
  
      $ops=array(array('$unwind'=>'$upload'),array('$sort'=>array('upload.price'=>1)));
      $cur=$col->aggregate($ops);
      $curs=$cur['result'];
      echo "<ul class='grid'>";
      foreach($curs as $id) 
      { 
        $name=$id['name'];
      $i=$id['upload'];      
      rep($i,$name);
     }
     echo "</ul>";
    }
    
    
    if($_POST['group1']=="pricehigh")
    {

      
      $ops=array(array('$unwind'=>'$upload'),array('$sort'=>array('upload.price'=>-1)));
      $cur=$col->aggregate($ops);
      $curs=$cur['result'];
      echo "<ul class='grid'>";
      foreach($curs as $id) 
      {
      $name=$id['name']; 
      $i=$id['upload'];      
      rep($i,$name);
     }
     echo "</ul>";
    }
  }
}
else
    
//if((!isset($_POST['avail'])) && (!isset($_POST['artist'])) && (!isset($_POST['category'])) && (!isset($_POST['pricehigh'])) && (!isset($_POST['pricelow'])))
{
 echo "<ul class='grid'>";

foreach($cursor as $id) 
  { 
    $name = $id["name"];
    if($id["upload"])
    { 
  
      foreach ($id["upload"] as $i )
      {
        rep($i,$name);
      
      }
    }
  }
  echo "</ul>";
}
?>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
  
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
  location.assign("details.php");
  </script>
<?php
  
  }
  }
}
}


function rep($i,$name)
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
<?php if($_SESSION['type']=="buyer" && $s=="available")
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

?>
