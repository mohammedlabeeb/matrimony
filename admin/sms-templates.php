<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  
  $template_status = "";
  if(isset($_GET['template_status']))
  {
    $template_status = $_GET['template_status'];
    $_SESSION['template_status'] = $_GET['template_status'];
  }
  else if(isset($_GET['page']))
  {
      $template_status = $_SESSION['template_status'];
  }
  else
  {
      $_SESSION['template_status'] = "all";
      $template_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['template_id']))
	{
		$template_id_arr = $_POST['template_id'];
		$template_val = "(";
		foreach($template_id_arr as $template_id)
		{
			$template_val .=	$template_id.",";
		}
		$template_val = substr($template_val, 0, -1);
		$template_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  sms_templates where SMS_TEMPLATE_ID in ".$template_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  sms_templates set STATUS='APPROVED' where  SMS_TEMPLATE_ID in ".$template_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  sms_templates set STATUS='UNAPPROVED' where  SMS_TEMPLATE_ID in ".$template_val;	
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
<title>Admin | Sms templates</title>
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
	setPageContext("sms","sms-template");
	$(document).ready(function ()
	   {
		$("#approove" ).button().click(function(){
		   window.location = "sms-templates.php?template_status=approved";
		 });
		$("#unapproove" ).button().click(function(){
		   window.location = "sms-templates.php?template_status=unapproved";
		 });
	       $("#all" ).button().click(function(){
		   window.location = "sms-templates.php?template_status=all";
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
<div class="breadcum-wide"><a href="#" title="User">Sms Templates</a> / <a href="#" title="Role"> Sms Templates List</a></div>	
	<div class="listing-section">
	  <div class="member-list cf">
	   <a href="javascript:;" class="button"  title="List All Sms Templates" onclick="window.location='sms-templates.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Sms templates</a>
<a href="javascript:;" class="button"  title="Add New Sms Template" onclick="window.location='add-sms-template.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Sms Template</a>			
	   <div class="approval alignleft">
	    <input type="button" title="Enabled Sms Templates"  id="approove"  value="Approved (<?php echo getRowCount("select count(SMS_TEMPLATE_ID) from sms_templates where STATUS='APPROVED'",$DatabaseCo);?>)"/>+
	    <input type="button" title="Disabled Sms Templates"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(SMS_TEMPLATE_ID) from sms_templates where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>=
	     <input type="button" title="All Sms Templates"  id="all" value="All (<?php echo getRowCount("select count(SMS_TEMPLATE_ID) from sms_templates",$DatabaseCo);?>)"/>
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
	<div class="widecolumn-inner memership-detail">
        <?php
	    
	    $sms_template_count = getRowCount("select count(SMS_TEMPLATE_ID) from sms_templates".getWhereClauseForStatus($template_status),$DatabaseCo);
	    if($sms_template_count>0){  
	   ?>
	  <div class="nodata-avail ">
            <h1><?php echo strtoupper($template_status); ?> SMS-Template List</h1>
          </div> 		
	<div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["sms_template_page_size"])?$_COOKIE["sms_template_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM sms_templates ".getWhereClauseForStatus($template_status)." ORDER BY SMS_TEMPLATE_ID DESC  LIMIT ".$lim_str;
	  ?>
        
	    </div>
	    <div class="table-desc cf">
	       <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
		    <tr>
		    <th  width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
		    <th width="7%">Edit</th>
		    <th width="10%">Status</th>
		    <th width="10%">Template ID</th>
                    <th width="20%">Template name</th>
		    <th width="15%">Pre Action</th>
		    <th width="25%">Sms Subject</th>
		</tr>
	<form method="post" action="sms-templates.php" id="action_form">
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
		    <td><input type="checkbox"  class="table-checkbox"  name="template_id[]" value="<?php  echo $DatabaseCo->dbRow->SMS_TEMPLATE_ID;?>"/></td>
		    <td><a class="edit-btn margin-none" href="add-sms-template.php?action=UPDATE&sms_template_id=<?php echo $DatabaseCo->dbRow->SMS_TEMPLATE_ID;?>" title="Edit">Edit</a></td>
		    <td>
		    <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->STATUS=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
			<a href="#" class="<?php echo $likeDisLikeCss;?>"></a>
		    </td>
		    <td><?php echo $DatabaseCo->dbRow->SMS_TEMPLATE_ID;?></td>
		    <td><?php echo $DatabaseCo->dbRow->SMS_TEMPLATE_NAME;?></td>
		    <td><?php echo $DatabaseCo->dbRow->PRE_CONDITION;?></td>
		    <td><?php echo $DatabaseCo->dbRow->SMS_SUBJECT;?></td>
		    
		</tr>
		 <?php
		 $rowCount++;
	      }
	      ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
	       </table>
	<?php 	
		$SQL_STATEMENT_PAGINATION = "select count(SMS_TEMPLATE_ID) as 'total_rows' from  sms_templates".getWhereClauseForStatus($template_status);		  
		echo getNewPagination('sms-templates.php','sms_template_page_size','sms_templates','SMS_TEMPLATE_ID',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
		?>		   
	       </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($template_status); ?> SMS-Templates. Please add data.</h1>
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
