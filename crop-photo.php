<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './class/Config.class.php';
	include_once 'lib/requestHandler.php';
	include_once './lib/pagination.php';
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$index_id = isset($_SESSION['uid'])?$_SESSION['uid']:0;
	$final_img_id=isset($_GET['id'])?$_GET['id']:'';
		
	
//only assign a new timestamp if the session variable is empty
if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); //assign the timestamp to the session variable
	$_SESSION['user_file_ext']= "";
}
#########################################################################################################
# CONSTANTS																								#
# You can alter the options below																		#
#########################################################################################################
$upload_dir_big = "photos_big";
$upload_dir = "photos"; 				// The directory for the images to be saved in
$upload_path = $upload_dir."/";
$upload_path_big = $upload_dir_big."/";				// The path to where the image will be saved
$large_image_prefix = ""; 			// The prefix name to large image
$thumb_image_prefix = "";			// The prefix name to the thumb image
$large_image_name = $large_image_prefix.$_SESSION['random_key'];     // New name of the large image (append the timestamp to the filename)
$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];     // New name of the thumbnail image (append the timestamp to the filename)
$max_file = "1"; 							// Maximum file size in MB
if($_POST['img_wd1']=='1' )
{
$max_width = "240";

}
else{
$max_width = "700";							// Max width allowed for the large image

}							// Max width allowed for the large image
$thumb_width = "180";						// Width of thumbnail image
$thumb_height = "240";					// Height of thumbnail image
// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
$allowed_image_ext = array_unique($allowed_image_types); // do not change this
$image_ext = "";	// initialise variable, do not change this.
foreach ($allowed_image_ext as $mime_type => $ext) {
    $image_ext.= strtoupper($ext)." ";
}


##########################################################################################################
# IMAGE FUNCTIONS																						 #
# You do not need to alter these functions																 #
##########################################################################################################
function resizeImage($image,$width,$height,$scale,$max_width) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	
	if($max_width =='240'){
		
	$newImageHeight =320;	
		}
	else{
	$newImageHeight = ceil($height * $scale);
	}
	
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}
//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale,$max_width){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = '180';
	$newImageHeight ='240';	
	
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
//You do not need to alter these functions
function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
//You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

//Image Locations
$large_image_location = $upload_path_big.$large_image_name.$_SESSION['user_file_ext'];
$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];

//Create the upload directory with the right permissions if it doesn't exist
if(!is_dir($upload_dir)){
	mkdir($upload_dir, 0777);
	chmod($upload_dir, 0777);
}

//Check to see if any images with the same name already exist
if (file_exists($large_image_location)){
	if(file_exists($thumb_image_location)){
		$thumb_photo_exists = "<img src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
	}else{
		$thumb_photo_exists = "";
	}
   	$large_photo_exists = "<img src=\"".$upload_path_big.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
} else {
   	$large_photo_exists = "";
	$thumb_photo_exists = "";
}

if (isset($_POST["upload"]))
 { 
	//Get the file information
	$fimg_id=$_POST['img_id'];
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	
	//Only process if the file is a JPG, PNG or GIF and below the allowed limit
	if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		
		foreach ($allowed_image_types as $mime_type => $ext) {
			//loop through the specified image types and if they match the extension then break out
			//everything is ok so go and check file size
			if($file_ext==$ext && $userfile_type==$mime_type){
				$error = "";
				break;
			}else{
				$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
			}
		}
		//check if the file size is above the allowed limit
		if ($userfile_size > ($max_file*1048576)) {
			$error.= "Images must be under ".$max_file."MB in size";
		}
		
	}else{
		$error= "Select an image for upload";
	}
	//Everything is ok, so we can upload the image.
	if (strlen($error)==0){
		
		if (isset($_FILES['image']['name'])){
			//this file could now has an unknown file extension (we hope it's one of the ones set above!)
			$large_image_location = $large_image_location.".".$file_ext;
			$thumb_image_location = $thumb_image_location.".".$file_ext;
			
			//put the file ext in the session so we know what file to look for once its uploaded
			$_SESSION['user_file_ext']=".".$file_ext;
			
			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			
			$width = getWidth($large_image_location);
			$height = getHeight($large_image_location);
			//Scale the image if it is greater than the width set above
			if ($width > $max_width){
				$scale = $max_width/$width;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale,$max_width);
			}else{
				$scale = 1;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}
			//Delete the thumbnail file so the user can create a new one
			if (file_exists($thumb_image_location)) {
				unlink($thumb_image_location);
			}
		}
		//Refresh the page to show the new uploaded image
		 $_SESSION['final_img_id']=$fimg_id;
		 echo "<script>window.location='crop-photo.php?id=".$_SESSION['final_img_id']."'</script>";
		
	}
}

if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
	//Get the new coordinates to crop the image.
	$x1 = $_POST["x"];
	$y1 = $_POST["y"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	//Scale the image to the thumb_width set above
	$scale = $thumb_width/$w;
	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale*1.5,$max_width);
	//Reload the page again to view the thumbnail
	
	$_SESSION['final_img_id'];
	
 $ins="update register set photo".$_GET['id']."='$thumb_image_name".$_SESSION['user_file_ext']."',photo".$_GET['id']."_approve='PENDING' where index_id='$index_id'"; 
	$exe=mysql_query($ins) or die(mysql_error());
	
	
	 echo "<script>window.location='modify-photo.php'</script>";
}


if ($_GET['a']=="delete" && strlen($_GET['t'])>0){
//get the file locations 
	$large_image_location = $upload_path_big.$large_image_prefix.$_GET['t'];
	$thumb_image_location = $upload_path.$thumb_image_prefix.$_GET['t'];
	if (file_exists($large_image_location)) {
		unlink($large_image_location);
	}
	if (file_exists($thumb_image_location)) {
		unlink($thumb_image_location);
	}
	 echo "<script>window.location='crop-photo.php?id=".$_SESSION['final_img_id']."'</script>";
}
?>

<!DOCTYPE html>

<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $configObj->getConfigFname(); ?></title>

<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />

<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  

<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />

<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<script src="js/crop/jquery.min.js"></script>
<script src="js/crop/jquery.Jcrop.js"></script>

</head>
 <?php

                    $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$matid'";

                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);

                    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);

                    ?>
<body>		

     <div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev">

                    

                   

                       

                    

                       <div class="gradient-rev block-level" style="margin-top:20px">
                  <h3>Upload and Crop Photo</h3>   

                          

                        <div class="">                   	

                          <div class="row well well-sm">                                

                                

<?php

//Only display the javacript if an image has been uploaded

if(strlen($large_photo_exists)>0){

$current_large_image_width = getWidth($large_image_location);
	$current_large_image_height = getHeight($large_image_location);?>
<script type="text/javascript">


  $(function(){




    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });



  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>
<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }
</style>

<?php }?>

<?php

//Display error message if there are any

if(strlen($error)>0)

{

	echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";

}

if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){

	echo $large_photo_exists."&nbsp;".$thumb_photo_exists;

	echo "<p><a href=\"".$_SERVER["PHP_SELF"]."?a=delete&t=".$_SESSION['random_key'].$_SESSION['user_file_ext']."\">Delete images</a></p>";

	echo "<p><a href=\"".$_SERVER["PHP_SELF"]."\">Upload another</a></p>";

	//Clear the time stamp session and user file extension

	$_SESSION['random_key']= "";

	$_SESSION['user_file_ext']= "";

}	

else

{

		if(strlen($large_photo_exists)>0)

		

		{?>

		<h4 style="color:red;">Create Thumbnail</h4><h5>Select thumbnail Area</h5>

		<div align="center">
			<img src="<?php echo $upload_path_big.$large_image_name.$_SESSION['user_file_ext'];?>" style="float: left; margin-right: 10px;" id="cropbox" alt="Create Thumbnail" class="img-responsive" />
			
			<br style="clear:both;"/>
			<form action="" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
            
            
				<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="btn btn-primary btn-large btn-inverse" />
                <input type="hidden" name="fimg_id" value="<?php echo $_SESSION['final_img_id'];?>">
               
			</form>
		</div>

        <?php /*?><div align="center">

			<img src="<?php echo $upload_path_big.$large_image_name.$_SESSION['user_file_ext'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />

			<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">

				<img src="<?php echo $upload_path_big.$large_image_name.$_SESSION['user_file_ext'];?>" style="position: relative;" alt="Thumbnail Preview" />

			</div>

			<br style="clear:both;"/>

			

            <form name="thumbnail" action="" method="post" class="form-horizontal">

				<input type="hidden" name="x1" value="" id="x1" />

				<input type="hidden" name="y1" value="" id="y1" />

				<input type="hidden" name="x2" value="" id="x2" />

				<input type="hidden" name="y2" value="" id="y2" />

				<input type="hidden" name="w" value="" id="w" />

				<input type="hidden" name="h" value="" id="h" />

				<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="btn btn-primary" />

                <input type="hidden" name="fimg_id" value="<?php echo $_GET['image_id'];?>">

               

			</form>

		</div><?php */?>

		<hr />

	<?php } ?>

	

	<form name="photo" class="form-horizontal" enctype="multipart/form-data" action="" method="post">

      <div class="modal-body">   

	 <div class="form-group">

       <label for="inputEmail3" class="col-sm-4 control-label">Select Photo : </label>


 <div class="col-sm-8"><input type="file" name="image" size="30" /><br>
   	
    
    <input type="submit" name="upload" value="Upload" class="btn btn-primary" />
    <input type="hidden" name="img_wd1" id="img_wd1" value="">
     <input type="hidden" name="img_id" value="<?php echo $final_img_id;?>"></div>

       <?php /*?> <div class="col-sm-8"><input type="file" name="image" size="30" /><br>

   	

    

    <input type="submit" name="upload" value="Upload" class="btn btn-primary" />

     <input type="hidden" name="img_id" value="<?php echo $final_img_id;?>"></div><?php */?>

     </div>

     </div>

     </form>

     <?php

 } ?>  

                               

                                

                            </div>

                           

                            

                            

                        </div>

                      </div>        

                    </div>

                   

                    </div>
                    </div>
                    </article>

                <!-----------------------top part end-------------------------->

                <?php include "page-part/footer.php";?>

                <?php 	require_once 'chat.php';	?>

            

        </div>

  

    

  	<script type="text/javascript">
 $(document).ready(function() { 
		
//alert($('#img_wd').css('width'));          	
if($('#img_wd').css('width')!='815px')
{

$('#img_wd1').val('1');

}

 });
</script>

    <script src="js/bootstrap.min.js"></script>

   

 </body>

</html>

<link rel="stylesheet" href="css/crop/demos.css" type="text/css" />
<link rel="stylesheet" href="css/crop/jquery.Jcrop.css" type="text/css" />