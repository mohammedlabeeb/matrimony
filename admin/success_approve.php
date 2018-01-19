<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $success_approval = "";
  if(isset($_GET['success_approval']))
  {
    $success_approval = $_GET['success_approval'];
    $_SESSION['success_approval'] = $_GET['success_approval'];
  }
  else if(isset($_GET['page']))
  {
	$success_approval = $_SESSION['success_approval'];
      
  }
  else
  {
      $_SESSION['success_approval'] = "all";
      $success_approval = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['story_id']))
	{
		$story_id_arr = $_POST['story_id'];
		$story_val = "(";
		foreach($story_id_arr as $story_id)
		{
			$story_val .=	$story_id.",";
		}
		$story_val = substr($story_val, 0, -1);
		$story_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  success_story where story_id in ".$story_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  success_story set status='APPROVED' where story_id in ".$story_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  success_story set status='UNAPPROVED' where story_id in ".$story_val;	
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
<title>Admin | Success Story</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
	setPageContext("approve","success-appprove");
	$(document).ready(function ()
	   {
		$("#approove" ).button().click(function(){
		   window.location = "success_approve.php?success_approval=approved";
		 });
		$("#unapproove" ).button().click(function(){
		   window.location = "success_approve.php?success_approval=unapproved";
		 });
	       $("#all" ).button().click(function(){
		   window.location = "success_approve.php?success_approval=all";
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
      <div class="breadcum-wide"><a href="#" title="Success Story">Success Story</a> / <a href="#" title="Role"> Success Story List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button"  title="List All Success Story" onclick="window.location='success_approve.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Success Story</a>
          <a href="javascript:;" class="button" title="Add New Success Story" onclick="window.location='add-success-story.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Success Story"/>Add New Success Story</a>
          <div class="approval alignleft">
	    <input type="button"  title="Approove Success Story"   id="approove"  value="Approved (<?php echo getRowCount("select count(story_id) from success_story where status='APPROVED'",$DatabaseCo);?>)"/>+
	    <input type="button"  title="Unaproove Success Story"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(story_id) from success_story where status='UNAPPROVED'",$DatabaseCo);?>)"/>=
	     <input type="button" title="All Success Story"  id="all" value="All (<?php echo getRowCount("select count(story_id) from success_story",$DatabaseCo);?>)"/>	    
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
	    
	    $success_story_count = getRowCount("select count(story_id) from success_story".getWhereClauseForStatus($success_approval),$DatabaseCo);
	    if($success_story_count>0){  
	?>
	  <div class="nodata-avail ">
            <h1><?php echo strtoupper($success_approval); ?> Success Story</h1>
          </div> 	
        <div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["success_story_page_size"])?$_COOKIE["success_story_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM success_story ".getWhereClauseForStatus($success_approval)." ORDER By story_id DESC LIMIT ".$lim_str;
	  ?>


        </div>
        <div class="table-desc cf" style="margin-bottom:20px;">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="7%">Status</th>
              <th width="15%">Bride name</th>
              <th width="15%">Groom Name</th>
              <th width="15%">Wedding Date</th>
              <th width="22%">Description</th>
              <th width="35%">Success Image</th>
            </tr>
	<form method="post" action="success_approve.php" id="action_form">
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
		    <td><input type="checkbox"  class="table-checkbox"  name="story_id[]" value="<?php  echo $DatabaseCo->dbRow->story_id;?>"/></td>
		    <td><a class="edit-btn margin-none" href="add-success-story.php?action=UPDATE&story_id=<?php echo $DatabaseCo->dbRow->story_id;?>" title="Edit">Edit</a></td>
		    <td>
		    <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
			<a href="#" class="<?php echo $likeDisLikeCss;?>"></a>
		    </td>
		   
		    <td><?php echo $DatabaseCo->dbRow->bridename;?></td>
		    <td><?php echo $DatabaseCo->dbRow->groomname;?></td>
            <td><?php $a=$DatabaseCo->dbRow->marriagedate;
				 echo date('F j, Y', (strtotime($a)));?></td>
            <td><?php echo substr($DatabaseCo->dbRow->successmessage,0,25);?></td>
		    <td title="<?php echo $DatabaseCo->dbRow->story_id;?>"><img src="../SuccessStory/<?php echo $DatabaseCo->dbRow->weddingphoto;?>" width="180" height="130" style="vertical-align: middle"/></td>
            </tr>
		 <?php
		 $rowCount++;
	      }
	      ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>	    
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(story_id) as 'total_rows' from  success_story".getWhereClauseForStatus($success_approval);		  
	echo getNewPagination('success_approve.php','email_template_page_size','success_story','story_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
           <h1>There are no data for <?php echo strtoupper($success_approval); ?> Success Story. Please add data.</h1>
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
