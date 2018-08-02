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
            <br><br>
     <h4 style="color:#4242Cf">Upload your artwork!</h4>
      <fieldset style="width:700px; height=1000px; margin-left:3%; border-color:#4242Cf;">
      <form style="width:500px;clear:both;" id="uploadattachments" enctype="multipart/form-data" name="uploadattachments"  method="post">
      <br>
      <br>
      <br>
      <b style="float:left;font-size:20px;color:#4242Cf"> File</b>
      <input type="file" id="attachment_1" name="attachment_1" onchange="document.uploadattachments.submit();"/>
      <br>
      <br>
      <b style="float:left;font-size:20px;color:#4242Cf"> Name of your artwork</b>
      <input id="artname" type="text" name="artname"/>
      <br>
      <br>
      <br>
      

      <b style="float:left;font-size:20px;color:#4242Cf"> Category:</b>
       <select class="browser-default" name="cat">
              <option value="" disabled selected>Choose category of artwork</option>
              <option value="abstract">Abstract</option>
              <option value="scuplture">Sculpture</option>
              <option value="photography">Photography</option>
              <option value="potrait">Potrait</option>
              <option value="graphite">Graphite </option>
              <option value="mosaic">Mosaic</option>
              <option value="miniature">Miniature</option>
              <option value="fine_art">Fine Art</option>
              <option value="painting">Painting</option>
              <option value="handicraft">Handicraft</option>
              <option value="paper_mesh">Paper Mesh</option>
              <option value="calligraphy">Calligraphy</option>
              <option value="12">Other</option>
              </select>
      <br>
      <br>
      <br>
      
      <b style="float:left;font-size:20px;color:#4242Cf"> Inspiration/Description:</b>
      <br>
      <br>
      <textarea rows="8" name="about" style="height:200px";></textarea>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <b style="float:left;font-size:20px;color:#4242Cf"> Price:</b>
      <input type="number" name="price"/>
      <br>
      <br>
      <br>
      <input type="submit" value="Upload" name="submit" />
      </form>
      </fieldset>
</center> 
 </body>
 </html>    
<?php

$user=$_SESSION['name'];

  // Set the upload target directory
  $target_path = "upload/";
  $attachments = 'attachment_1';
  $FileName = $_FILES[$attachments]['name'];

  
       

  // Check if filename is empty
  if($FileName != "")
  {
    $FileType = $_FILES[$attachments]['type'];
    //get extension
    $FileExtension = strtolower(substr($FileName,strrpos($FileName,'.')+1));
    //******************************************************************************
    $i=1;
    $name=$user."_".$i;
    $FileName=$name.".".$FileExtension;

    while(file_exists("upload/".$FileName))
    {
      $name=$user."_".$i;
      $FileName=$name.".".$FileExtension;
      $i++;
    }
    //******************************************************************************

    // Check for supported file formats
          if($FileExtension != "gif" && $FileExtension != "jpg" && $FileExtension != "png" && $FileExtension != "jpeg") 
    {
      echo "Only png, jpg and gif file type are supported";
          }

          else 
    {
      $FileSize = round($_FILES[$attachments]['size']/1024);
      // Check for file size
      if($FileSize > 950)
       {
          $i="File exceeded maximum allowed limit of 150 Kb";
        echo $i;
      }
      else 
      {
          $FileTemp = $_FILES[$attachments]['tmp_name'];
          $FileLocation = $target_path.basename($FileName);
          // Finally Upload
          echo $FileLocation;

          if(move_uploaded_file($FileTemp,$FileLocation)) 
        {
              // On successful upload send a message
               $i="Successfully uploaded";
          echo $i;

          } 
          else 
        {
              $i="There was an error uploading the file, please try again!";
            echo $i;
          }
      }
    }
  }


$username=$_SESSION['name'];
$img="upload/".$FileName;
$submit=$_POST['submit'];
$artname=$_POST['artname'];
$string = preg_replace('/\s+/', '_', $artname);
$art=$string;
echo $art;
$price=(int)$_POST['price'];
$cat=$_POST['cat'];
$about=$_POST['about'];
$required=array('submit','cat','artname','price');
$connect=new MongoClient();
$db=$connect->artistica;
$coll=$db->users;

$real= date("Y-m-d H:i:s");
$today= New Mongodate(strtotime($real));

$error = false;
foreach($required as $field)
 {
  if (empty($_POST[$field])) 
   {
    $error = true;
   }
}

if(isset($submit))
{
 
echo "Inserting in db";
$data=array("artname"=>$art, "price"=>$price, "about"=>$about, "category"=>$cat, "url"=>$img, "status"=>"available","date"=>$today);
$coll->update(array("uname"=>$_SESSION['name']),array('$push'=>array("upload"=>$data)),array('upsert'=>true));
header("Location:dash.php");
}

?>

