<?php
 		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once '../class/Config.class.php';
		$configObj = new Config();
  
  require_once("../BusinessLogic/class.weddingplanner.php");
	require_once("../BusinessLogic/class.wpcategory.php");

  $planner_status = "";
  if(isset($_GET['planner_status']))
  {
    $planner_status = $_GET['planner_status'];
    $_SESSION['planner_status'] = $_GET['planner_status'];
  }
  else if(isset($_GET['page']))
  {
      $planner_status = $_SESSION['planner_status'];
  }
  else
  {
      $_SESSION['planner_status'] = "all";
      $planner_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['wp_id']))
	{
		$wp_id_arr = $_POST['wp_id'];
		$wp_id_val = "(";
		foreach($wp_id_arr as $wp_id)
		{
			$wp_id_val .=	$wp_id.",";
		}
		$wp_id_val = substr($wp_id_val, 0, -1);
		$wp_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from wedding_planner where wp_id in ".$wp_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update wedding_planner set status='APPROVED' where wp_id in ".$wp_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update wedding_planner set status='UNAPPROVED' where wp_id in ".$wp_id_val;	
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
<title>Admin | Wedding Planners </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="./css/web_dialog.css" />
<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />
<link rel="stylesheet" type="text/css" href="css/tool_tips.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript">
setPageContext("wp","wedding-planners");
 $(document).ready(function ()
   {
      $("#approove" ).button().click(function(){
	window.location = "wedding-planners.php?planner_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "wedding-planners.php?planner_status=unapproved";
      });
	  
    $("#all" ).button().click(function(){
	window.location = "wedding-planners.php?planner_status=all";
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
      <div class="breadcum-wide"><a href="#" title="Membership Plan">Wedding Directory</a> / <a href="#" title="Wedding Planners List">Wedding Planners List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Membership Plan"  onclick="window.location='wedding-planners.php'"><img src="img/bgi/list-icon.png" alt=""/>List All Wedding Planners</a>
          <a href="javascript:;"   class="button"  title="Add New Membership Plan"  onclick="window.location='add-planner.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Wedding Planner</a>
          <div class="approval alignleft">
	   <input type="button" title="APPROVED Wedding Planners List" id="approove" value="Approved (<?php echo getRowCount("select count(wp_id) from wedding_planner where status='APPROVED'",$DatabaseCo);?>)"/>
            
            +     
            <input type="button" title="UNAPPROVED Wedding Planners List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(wp_id) from wedding_planner where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =         
            
            <input type="button" title="All Wedding Planners List" id="all" value="All (<?php echo getRowCount("select count(wp_id) from wedding_planner",$DatabaseCo);?>)"/>
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
      
      <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>      
      
      
      <div class="widecolumn-inner memership-detail">
	<?php
	    
	  $wedding_planner_count = getRowCount("select count(wp_id) from wedd_planner_view".getWhereClauseForstatus($planner_status),$DatabaseCo);
	    if($wedding_planner_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($planner_status); ?> Wedding Planners List</h1>
          </div>  	
        <div class="cf membership-data">
	  
     <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/>
        <span class="alignleft"><b>&nbsp;&nbsp;Check All</b></span>
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="APPROVED" onclick="submitActionForm('APPROVED');">Approve</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="UNAPPROVED" onclick="submitActionForm('UNAPPROVED');">Unapprove</a>
     
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["wedding_planner_page_size"])?$_COOKIE["wedding_planner_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM wedd_planner_view ".getWhereClauseForstatus($planner_status)." ORDER BY wp_id DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	<form method="post" action="wedding-planners.php" id="action_form">
	
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
              <div id="dialog<?php echo $DatabaseCo->dbRow->wp_id; ?>"
								class="cf dialog">
								<div class="profile-img">
								 <?php
			if($DatabaseCo->dbRow->wp_image=='')
			{
				?>
          <img src="../images/nophoto.jpg" alt="User Image" height="150" width="130" border="1" />
          <?php
		  }else
          {?>
           <img src="../wp/<?php echo $DatabaseCo->dbRow->wp_image; ?>" alt="Planner" height="150" width="130" />
           <?php
          }
          ?>
								</div>
								<div class="profile-content">

		<input type="checkbox" class="table-checkbox" name="wp_id[]" value="<?php echo $DatabaseCo->dbRow->wp_id; ?>"  /> <label><span class="title"><?php echo $DatabaseCo->dbRow->wp_name; ?>
        <input type="hidden" name="email[]" value="<?php echo $DatabaseCo->dbRow->wp_email; ?>" />
									</span> </label>

									<div class="profile-section">
										<p class="cf" style="height:12px;">
											
										</p>

										<div class="property-detail cf">
											<div class="first-detail-small">
			<label class="detail-desc2 cf"> <label class="title-label">Email:</label>
													<label class="title-desc2"><?php echo $DatabaseCo->dbRow->wp_email; ?>
												</label> </label> <label class="detail-desc2 cf"> <label
													class="title-label">Category:</label> <label
										class="title-desc2"><?php echo $DatabaseCo->dbRow->wp_cat_name; ?>
												</label> </label> <label class="detail-desc2 cf"> <label
													class="title-label">Mobile:</label> <label
										class="title-desc2">
                                        <?php echo $DatabaseCo->dbRow->wp_mobile;?> </label> </label>
                                            
                                            
                                                 <label
													class="title-label">Description:</label> <label
											class="title-desc2"> <?php echo $DatabaseCo->dbRow->wp_desc; ?>
												</label> </label>
                                                

											</div>

											<div class="second-detail-small">
												
														
												
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">Country:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->country_name; ?>
												</label> </label>
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">State:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->state_name; ?>
												</label> </label> 
                                                
                                                 <label class="detail-desc2 cf"> <label
													class="title-label">City:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->city_name;?>
												</label> </label>
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">Rate:</label> <label
											class="title-desc2"> <?php echo $DatabaseCo->dbRow->wp_rate_from; ?> to 
                                            <?php echo $DatabaseCo->dbRow->wp_rate_to; ?>
												</label> </label>
                                               
											</div>

										</div>


									</div>

								</div>
								<p class="clear"></p>
								<div class="profile-button cf">
									
				<a href="add-planner.php?action=UPDATE&&id=<?php  echo $DatabaseCo->dbRow->wp_id;?>" title="Edit"> <span title="Edit" class="floor-plan">Edit</span>
									</a>
               

								</div>
								<span class="approve_feature"> <span><b>Approval:</b> <?php
								$likeDisLikeCss = "";
								if($DatabaseCo->dbRow->status=='APPROVED')
								$likeDisLikeCss = "approved";
								else
								$likeDisLikeCss = "unapproved";
								?> <span class="<?php echo $likeDisLikeCss; ?>">&nbsp;</span> </span>
							</div>
	      <?php
	$rowCount++;
	      }
	 ?>
	    
      <input  type="hidden" name="action" value="" id="action"/>
      </form>     
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(wp_id) as 'total_rows' from wedd_planner_view".getWhereClauseForstatus($planner_status);		  
	    echo getNewPagination('wedding-planners.php','wedding_planner_page_size','wedd_planner_view','wp_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($planner_status); ?> Wedding Planners. Please add data.</h1>
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
