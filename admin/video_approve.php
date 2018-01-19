<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $video_status = "";
  if(isset($_GET['video_status']))
  {
    $video_status = $_GET['video_status'];
    $_SESSION['video_status'] = $_GET['video_status'];
  }
  else if(isset($_GET['page']))
  {
	$video_status = $_SESSION['video_status'];
      
  }
  else
  {
      $_SESSION['video_status'] = "all";
      $video_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['index_id']))
	{
		$index_id_arr = $_POST['index_id'];
		$index_val = "(";
		foreach($index_id_arr as $index_id)
		{
			$index_val .=	$index_id.",";
		}
		$index_val = substr($index_val, 0, -1);
		$index_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "update  register set video='',video_url='' where index_id in ".$index_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  register set video_approval='APPROVED' where index_id in ".$index_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  register set video_approval='UNAPPROVED' where index_id in ".$index_val;	
			      break;
	    }
	      $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
         	  $STATUS_MESSAGE = $statusObj->getStatusMessage();
  	}
	else
	{
	  $statusObj = new Status();
	  $statusObj->setActionSuccess(false);
	  $STATUS_MESSAGE = "Please select value to complete action.";	  
	}
 }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Video Approval</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script src="../js/swfobject.js" type="text/javascript"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<style type="text/css">
iframe
{
width:300px !important;
height:180px !important;
}
</style>
<script type="text/javascript">
	setPageContext("approve","video-appprove");
	$(document).ready(function ()
	   {
		$("#approove" ).button().click(function(){
		   window.location = "video_approve.php?video_status=approved";
		 });
		$("#unapproove" ).button().click(function(){
		   window.location = "video_approve.php?video_status=unapproved";
		 });
	       $("#all" ).button().click(function(){
		   window.location = "video_approve.php?video_status=all";
		      });
	   });
</script>
</head>
<body>
<div id="wrapper">
  <?php
		require_once('./page-part/header.php');
	?>
  <!-- start content -->
  <div id="container" class="cf">
    <?php
		require_once('./page-part/left-menu.php');
	?>
    <div class="widecolumn alignleft">
      <div class="breadcum-wide"><a href="#" title="User">Approval</a> / <a href="#" title="Role"> Video Approval List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button"  title="List All Video Approval" onclick="window.location='video_approve.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Video Approval</a>
          
          <div class="approval alignleft">
	    <input type="button"  title="Approove Video"   id="approove"  value="Approved (<?php echo getRowCount("select count(index_id) from register_view where video_approval='APPROVED' AND (video!='' OR video_url!='')",$DatabaseCo);?>)"/>+
	    <input type="button"  title="Unapproove Video"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(index_id) from register_view where video_approval='UNAPPROVED' AND (video!='' OR video_url!='')",$DatabaseCo);?>)"/>=
	     <input type="button" title="All Video"  id="all" value="All (<?php echo getRowCount("select count(index_id) from register_view WHERE (video!='' OR video_url!='')",$DatabaseCo);?>)"/>	    
          </div>
        </div>
      </div>
      <?php
	if(!empty($STATUS_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$STATUS_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
		}
	}
	 ?>
     
     <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>       
      <div class="widecolumn-inner memership-detail">
	<?php
	    
	    $video_approval_count = getRowCount("select count(index_id) from register".getWhereClauseForVideo($video_status),$DatabaseCo);
	    if($video_approval_count>0){  
	?>
	  <div class="nodata-avail ">
            <h1><?php echo strtoupper($video_status); ?> Video</h1>
          </div> 	
        <div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["video_approval_page_size"])?$_COOKIE["video_approval_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM register ".getWhereClauseForVideo($video_status)." ORDER By index_id DESC LIMIT ".$lim_str;
	  ?>


        </div>
        <div class="table-desc cf" style="margin-bottom:20px;">
          <table width="100%" cellpadding="3" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="15%">Matri ID</th>
              <th width="20%">User name</th>
              <th width="15%">Email</th>
              <th width="30%">Video</th>
            </tr>
	<form method="post" action="video_approve.php" id="action_form">
              <?php						
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		$rowCount=0;
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			if($rowCount%2!=0)
					$cssClass="odd";
			else
					$cssClass="even";
			$rec_not_found = false;			
		?>		    
	<tr class="<?php echo $cssClass;?>">
		    <td><input type="checkbox"  class="table-checkbox"  name="index_id[]" value="<?php  echo $DatabaseCo->dbRow->index_id;?>"/></td>
		    <td><a class="edit-btn margin-none" href="add-video.php?action=UPDATE&index_id=<?php echo $DatabaseCo->dbRow->index_id;?>" title="Edit">Edit</a></td>
		    <td>
		    <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->video_approval=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
			<a href="#" class="<?php echo $likeDisLikeCss;?>"></a>
		    </td>
		    <td><?php echo $DatabaseCo->dbRow->matri_id;?></td>
		    <td><?php echo $DatabaseCo->dbRow->username;?></td>
		    <td><?php echo $DatabaseCo->dbRow->email;?></td>
            <td style="vertical-align:middle;">
			<?php 
			if($DatabaseCo->dbRow->video!='')
			{
			?>
           <div id="flvplayer"></div>    
			<script language="javascript">
            var so = new SWFObject("../mpw_player.swf", "swfplayer", "300", "180", "5", "#000000"); 
            so.addVariable("flv", "video-list/<?php echo $DatabaseCo->dbRow->video;?>","swfplayer", "300", "180", "5", "#000000"); // File Name
         	so.addVariable("autoplay","false"); // Autoplay, make true to autoplay
            so.addParam("allowFullScreen","true"); // Allow fullscreen, disable with false
            so.addVariable("backcolor","000000"); // Background color of controls in html color code
            so.addVariable("frontcolor","ffffff"); // Foreground color of controls in html color code
            so.write("flvplayer"); // This needs to be the name of the div id
			</script>
            
            <?php
			}
			else
			{
				echo $DatabaseCo->dbRow->video_url;
			}
			?>
		  </td>
            </tr>
		 <?php
		 $rowCount++;
	      }
	      ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>	    
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(index_id) as 'total_rows' from  register".getWhereClauseForVideo($video_status);		  
	echo getNewPagination('video_approve.php','video_approval_page_size','register','index_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
           <h1>There are no data for <?php echo strtoupper($video_status); ?> Video.</h1>
	   <br/>
	   <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
          </div>
        </div>
        <?php
	    }
	   ?>	    
	
      </div>
      <?php
		require_once('./page-part/footer.php');
	?>
    </div>
  </div>
  <!-- end content --> 
</div>
</body>
</html>
