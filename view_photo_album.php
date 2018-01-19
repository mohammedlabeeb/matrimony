<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	
	$matri_id = $_GET['matri_id'];
	
	$sel = mysql_query("select * from register where matri_id='$matri_id'") or die(mysql_error());
	
	
  $res1=mysql_fetch_array($sel);
  ?>
					
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>  
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script language="JavaScript">
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}
</script>
<script type="text/javascript">

jQuery(document).ready(function($){

	$('#image1').addimagezoom({
		zoomrange: [2, 4],
		magnifiersize: [300,200],
		magnifierpos: 'right',
		largeimage: 'photos/<?php echo $res['photo1'];?>'//<-- No comma after last option!
	})

})
</script><!--end fof zoom-->

<script type="text/javascript" src="js/jquery.js"></script>



<script type="text/javascript">
$(document).ready(function(){

	$("h2").append('<em></em>')

	$(".thumb a").click(function(){
	
		var largePath = $(this).attr("href");
		var largeAlt = $(this).attr("title");
		
		$("#largeImg1").attr({ src: largePath, alt: largeAlt, value:largeAlt  });
		
		$("h2 em").html(" (" + largeAlt + ")"); return false;
	});
	
});
</script>
</head>
<style type="text/css">
body
{
	margin-top:5px !important;
}

#largeImg {
	border: solid 1px #ccc;
	width: 100px;
	height: 100px;
	padding: 4px;
}
.thumbs img {
	border: solid 1px #ccc;
	width: 42px;
	height: 42px;
	padding: 2px;
}
.thumbs img:hover {
	border-color: #FF9900;
	border:0;
}	

#largeImg1 {
	border: solid 0px #7e70e0;
	width: 300px;
	height: 340px;
	padding: 0px;
}
.thumb img {

    border: 2px solid #7e70e0; 
    width: 85px;
	height: 85px;
	padding: 2px;
}
.thumb img:hover {
	/*border-color: #FF9900;*/
	border:0;
}

</style>
<body bgcolor="#D8D6D6">

  
<table width="100%" align="left" border="0" class="verdana_12">


<tr class="verdana_12">



<td valign="top" align="center">
<img src="photos_big/<?php echo $res1['photo1'];?>" width="500px" height="400px"  id="largeImg1" alt="Large image" title="<?php echo $res1['photo1']; ?>"/>
<br />
<br />

<div class="thumb">
<?php  if($res1['photo1_approve'] == "APPROVED")
{
?>

<a href="photos/<?php echo $res1['photo1'] ?>" title="Image 1"><img src="photos/<?php echo $res1['photo1'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>

<?php
}
?>
&nbsp;&nbsp;&nbsp;
<?php  if($res1['photo2_approve'] == "APPROVED")
{
?>

<a href="photos/<?php echo $res1['photo2'] ?>" title="Image 2"><img src="photos/<?php echo $res1['photo2'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>

<?php
}
?>
&nbsp;&nbsp;&nbsp;
<?php  if($res1['photo3_approve'] == "APPROVED")
{
?>
<a href="photos/<?php echo $res1['photo3'] ?>" title="Image 3"><img src="photos/<?php echo $res1['photo3'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>

<?php
}
?>
&nbsp;&nbsp;&nbsp;
<?php  if($res1['photo4_approve'] == "APPROVED")
{
?>
<a href="photos/<?php echo $res1['photo4'] ?>" title="Image 4"><img src="photos/<?php echo $res1['photo4'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>
<?php
}
?>
&nbsp;&nbsp;&nbsp;
<?php  if($res1['photo5_approve'] == "APPROVED")
{
?>
<a href="photos/<?php echo $res1['photo5'] ?>" title="Image 4"><img src="photos/<?php echo $res1['photo5'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>
<?php
}
?>
&nbsp;&nbsp;&nbsp;
<?php  if($res1['photo6_approve'] == "APPROVED")
{
?>
<a href="photos/<?php echo $res1['photo6'] ?>" title="Image 4"><img src="photos/<?php echo $res1['photo6'];?>" border="0" height="100" width="80" class="rounded_STYLE"/></a>
<?php
}
?>
</div>
</td>

</tr>
</table>
 



</body>
</html>
