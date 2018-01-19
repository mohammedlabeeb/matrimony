<?php
error_reporting(0);
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $membership_plan_status = "";
  if(isset($_GET['membership_plan_status']))
  {
    $membership_plan_status = $_GET['membership_plan_status'];
    $_SESSION['membership_plan_status'] = $_GET['membership_plan_status'];
  }
  else if(isset($_GET['page']))
  {
      $membership_plan_status = $_SESSION['membership_plan_status'];
  }
  else
  {
      $_SESSION['membership_plan_status'] = "all";
      $membership_plan_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['plan_id']))
	{
		$plan_id_arr = $_POST['plan_id'];
		$plan_id_val = "(";
		foreach($plan_id_arr as $plan_id)
		{
			$plan_id_val .=	$plan_id.",";
		}
		$plan_id_val = substr($plan_id_val, 0, -1);
		$plan_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  membership_plan where plan_id in ".$plan_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  membership_plan set status='APPROVED' where plan_id in ".$plan_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  membership_plan set status='UNAPPROVED' where plan_id in ".$plan_id_val;	
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $status_MESSAGE = $statusObj->getstatusMessage();
	}
	else
	{
	  $statusObj = new status();
	  $statusObj->setActionSuccess(false);
	  $status_MESSAGE = "Please select value to complete action.";	  
	}
 }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Membership Plan</title>
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
setPageContext("membership","membership-plan");
 $(document).ready(function ()
   {
     $("#approove" ).button().click(function(){
	window.location = "membership-plan.php?membership_plan_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "membership-plan.php?membership_plan_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "membership-plan.php?membership_plan_status=all";
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
      <div class="breadcum-wide"><a href="#" title="Membership Plan">Membership Plan</a> / <a href="#" title="Membership Plan">Membership Plan List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Membership Plan"  onclick="window.location='membership-plan.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Membership Plan</a>
          <a href="javascript:;"   class="button"  title="Add New Membership Plan"  onclick="window.location='add-membership-plan.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Membership Plan</a>
          <div class="approval alignleft">
	    <input type="button" title="Approved Membership Plan"  id="approove" value="Approved (<?php echo getRowCount("select count(plan_id) from membership_plan where status='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Membership Plan"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(plan_id) from membership_plan where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Membership Plan"  id="all" value="All (<?php echo getRowCount("select count(plan_id) from membership_plan",$DatabaseCo);?>)"/>
          </div>
        </div>
      </div>
      <?php
	if(!empty($status_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$status_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$status_MESSAGE."</li></ul></div>";	
		}
	}
      ?>      
      <div class="widecolumn-inner memership-detail">
	<?php
	    
	    $membership_plan_count = getRowCount("select count(plan_id) from membership_plan".getWhereClauseForstatus($membership_plan_status),$DatabaseCo);
	    if($membership_plan_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($membership_plan_status); ?> Membership Plan List</h1>
          </div>  	
        <div class="cf membership-data">
	  <div style="position: relative;top:8px;left:-3px;">
        <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/><span class="alignleft"><b>Check All</b></span>
	</div>
	  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["membership_plan_page_size"])?$_COOKIE["membership_plan_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM membership_plan ".getWhereClauseForstatus($membership_plan_status)." ORDER BY plan_id DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	
	
	
	<form method="post" action="membership-plan.php" id="action_form">
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
	<!-- MEMBERSHIP PLAN-1 START -->
        <div class="plan-desc">
          <div class="plan-table-title">
	    <span class="plan-title">
            <input type="checkbox"  class="table-checkbox"  name="plan_id[]" value="<?php  echo $DatabaseCo->dbRow->plan_id;?>"/>
            <?php echo $DatabaseCo->dbRow->plan_name;?>
            <a class="edit-btn margin-none" href="add-membership-plan.php?action=UPDATE&plan_id=<?php echo $DatabaseCo->dbRow->plan_id;?>" title="Edit">Edit</a>
            </span>
            <label class="plan-status">Plan status: </label>
            <span class="plan-active">
		    <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='APPROVED')
			  $likeDisLikeCss = "./img/bgi/like-icon.png";
			else
			  $likeDisLikeCss = "./img/bgi/dislike-icon.png";
		      ?>
		      <img src="<?php echo $likeDisLikeCss;?>" alt="ActiveInactive" />
	    </span>
	    <?php if($DatabaseCo->dbRow->plan_type=="PAID"){?>
	        <img src="img/paid-img.png"  alt="paid-img" class="paid-img"/>
	    <?php }else if($DatabaseCo->dbRow->plan_type=="FREE"){?>
		<img src="img/free-plan.png"  alt="paid-img" class="paid-img"/>
	    <?php } ?>
	    </div>
          <div class="table-desc">
            <table width="100%"  cellpadding="0" cellspacing="0" border="1" class="table-data">
              <tr>
                <th class="second-title">Duration Type</th>
				<th class="third-title">Allow Contacts</th>
                <th class="third-title">Allow Profile</th>
				<th class="third-title">Allow Messages</th>
                <th class="four-title">Video Upload</th>
                <th class="four-title">Online Chat</th>
                <th class="four-title">Plan Offer</th>
              </tr>
              <tr class="odd">
                <td><?php echo $DatabaseCo->dbRow->plan_duration;?> Days</td>
                <td><?php echo $DatabaseCo->dbRow->plan_contacts;?></td>
                <td><?php echo $DatabaseCo->dbRow->profile;?></td>
                <td><?php echo $DatabaseCo->dbRow->plan_msg;?></td>
                <td><?php echo $DatabaseCo->dbRow->video;?> </td>
                <td><?php echo $DatabaseCo->dbRow->chat;?></td>
                <td><?php echo substr($DatabaseCo->dbRow->plan_offers,0,80);?></td>
              </tr>
	      
	      <?php if($DatabaseCo->dbRow->plan_type=="PAID"){?>
              <span class="star-icon">
		<?php echo $DatabaseCo->dbRow->plan_amount_type;?><?php echo $DatabaseCo->dbRow->plan_amount;?>
	      </span>
	      <?php } ?>
            </table>
          </div>
        </div>
	<!-- MEMBERSHIP PLAN-1 END -->
	<?php
	$rowCount++;
	      }
	 ?>
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(plan_id) as 'total_rows' from membership_plan".getWhereClauseForstatus($membership_plan_status);		  
	    echo getNewPagination('membership-plan.php','membership_plan_page_size','membership_plan','plan_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($membership_plan_status); ?> Membership Plan. Please add data.</h1>
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
