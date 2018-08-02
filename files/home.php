<?php
include_once("connect.php");

    
?>
<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
   <link type="text/css" rel="stylesheet" href="css/grid.css"  media="screen,projection"/>
  <style type="text/css">
  p{
    
    font-size: 20px;
    font-family: Helvetica;
    color:white;
    margin:20px;
    }
#section {
    width:950px;
    float:left;
    padding:10px;
}


    </style>

      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

  <body bgcolor="#A4D0F1">
    
    <center>
                  <div >
              <a href="optionsign.php" style="float:right;color:#6666FF;padding:10px;">Sign Up</a>
              <a href="login.php" style="float:right;color:#6666FF;padding:10px;">Log In</a>
              
         </div><br><br>

            <br>            
             <nav style="background-color:#ff6f00">
              <div class="nav-wrapper">
              <img class="brand-logo" src="artistica.png" style="width:200px;height:50px;margin-right:50%;">
              <img src="paint.png" style="width:70px;height:70px;position:relative;margin-left:80%;">
                
              </img>
                </img>
               
              <!--<a href="#" class="brand-logo center" style="margin-left:1%;">ArTisTicA</a>-->
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li><a href="explore.php">Explore</a></li>
                </ul>   
              </div>
            </nav>
            </center>

<div id="section">
<br>
<h3 style="color:#4242C5;font-family:'Comic Sans MS', cursive, sans-serif">Welcome to Artistica!</h3>
<p style="color:#327FBB;font-family:'Comic Sans MS', cursive, sans-serif">
Keeping with the latest trends of the art market, Artistica has come up with best solutions for a wider audience of fine arts from traditional paintings, sculptures, printmaking, and graphics to new media like conceptual art, video art, installations and experimental art and started an online art shop where a buyer can opt to select and buy a piece of modern and contemporary art of his or her choice from a variety of collections.<br>
Artistica Art Gallery since its inception has been instrumental in promoting the upcoming artists and newer generation art works.
</p>
<p style="color:#327FBB;font-family:'Comic Sans MS', cursive, sans-serif">
<?php 
  $connect=new MongoClient();
  $db=$connect->artistica;
  $col=$db->users;
//  $col2=$col->count();
$col2=$col->find(array("type"=>"artist"));
$cnt=$col->count(array("type"=>"artist"));
$cnt3=$col->count(array("type"=>"buyer"));
$ops=array(array('$unwind'=>'$upload'),array('$match'=>array('upload.status'=>'sold')));
      $cur=$col->aggregate($ops);
     
      $curs=$cur['result'];
     
      $val=$curs[0];

      $cnt2=count($val);
//$cnt3=0;
//var_dump($col2);


?>
ArTisTicA currently encourages and provides a platform  for <?php echo $cnt; ?> artists and has sold around <?php echo $cnt2; ?> artworks of varying categories and has around <?php echo $cnt3;?> registered buyers.
</p>

<p style="color:#4242CF;font-family:'Comic Sans MS', cursive, sans-serif">
Highest Priced artworks:
<?php
$ops=array(array('$unwind'=>'$upload'),array('$sort'=>array('upload.price'=>-1)),array('$limit'=>4));
$cur=$col->aggregate($ops);
$curs=$cur['result'];
      //var_dump($curs);
        echo "<ul class='grid'>";
      
      foreach($curs as $id) 
      { 
        $name=$id['name'];
      $i=$id['upload'];      
      rep($i,$name);
     }
     echo "</ul>";
    
?>
</p>
</div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>



</body>
</html>
<?php

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