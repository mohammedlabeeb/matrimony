<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  require_once("../BusinessLogic/class.weddingplanner.php");
	require_once("../BusinessLogic/class.wpcategory.php");

  $category_status = "";
  if(isset($_GET['category_status']))
  {
    $category_status = $_GET['category_status'];
    $_SESSION['category_status'] = $_GET['category_status'];
  }
  else if(isset($_GET['page']))
  {
      $category_status = $_SESSION['category_status'];
  }
  else
  {
      $_SESSION['category_status'] = "all";
      $category_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['wp_cat_id']))
	{
		$wp_cat_id_arr = $_POST['wp_cat_id'];
		$wp_cat_id_val = "(";
		foreach($wp_cat_id_arr as $wp_cat_id)
		{
			$wp_cat_id_val .=	$wp_cat_id.",";
		}
		$wp_cat_id_val = substr($wp_cat_id_val, 0, -1);
		$wp_cat_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from wp_category where wp_cat_id in ".$wp_cat_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update wp_category set status='APPROVED' where wp_cat_id in ".$wp_cat_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update wp_category set status='UNAPPROVED' where wp_cat_id in ".$wp_cat_id_val;	
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
setPageContext("wp","wedding-planners-category");
 $(document).ready(function ()
   {
      $("#approove" ).button().click(function(){
	window.location = "wedding-planners-category.php?category_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "wedding-planners-category.php?category_status=unapproved";
      });
	  
    $("#all" ).button().click(function(){
	window.location = "wedding-planners-category.php?category_status=all";
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
      <div class="breadcum-wide"><a href="#" title="Membership Plan">Wedding Directory</a> / <a href="#" title="Wedding Planners List">Wedding Planners Category List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Wedding Category"  onclick="window.location='wedding-planners-category.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Wedding Category</a>
          <a href="javascript:;"   class="button"  title="Add New Wedding Category"  onclick="window.location='add-category.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Wedding Category</a>
          <div class="approval alignleft">
	   <input type="button" title="APPROVED Wedding Category List" id="approove" value="Approved (<?php echo getRowCount("select count(wp_cat_id) from wp_category where status='APPROVED'",$DatabaseCo);?>)"/>
            
            +     
            <input type="button" title="UNAPPROVED Wedding Planners List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(wp_cat_id) from wp_category where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =         
            
            <input type="button" title="All Wedding Planners List" id="all" value="All (<?php echo getRowCount("select count(wp_cat_id) from wp_category",$DatabaseCo);?>)"/>
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
	    
	  $wp_category_count = getRowCount("select count(wp_cat_id) from wp_category".getWhereClauseForstatus($category_status),$DatabaseCo);
	    if($wp_category_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($category_status); ?> Wedding Category List</h1>
          </div>  	
        <div class="cf membership-data">
	  
    
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="APPROVED" onclick="submitActionForm('APPROVED');">Approve</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="UNAPPROVED" onclick="submitActionForm('UNAPPROVED');">Unapprove</a>
     
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["wp_category_page_size"])?$_COOKIE["wp_category_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM wp_category ".getWhereClauseForstatus($category_status)." ORDER BY wp_cat_id DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	
	 
	
	<form method="post" action="wedding-planners-category.php" id="action_form">
	
	<!-- MEMBERSHIP PLAN-1 START -->
        <div class="plan-desc">
          
          <div class="table-desc">
            <table width="100%"  cellpadding="0" cellspacing="0" border="1" class="table-data">
              <tr>
                <th  width="3%">
             <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="10%">Edit</th>
              <th width="10%">status</th>
              <th width="65%">Category Name</th>
             
              </tr>
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
                <td><input type="checkbox"  class="table-checkbox" name="wp_cat_id[]" value="<?php  echo $DatabaseCo->dbRow->wp_cat_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="add-category.php?action=UPDATE&&id=<?php  echo $DatabaseCo->dbRow->wp_cat_id;?>" title="Edit" id="edit_wp_category">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->wp_cat_name;?></td>
                </tr>
	      <?php
	$rowCount++;
	      }
	 ?>
	    
            </table>
          </div>
        </div>
	<!-- MEMBERSHIP PLAN-1 END -->
	
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(wp_cat_id) as 'total_rows' from wp_category".getWhereClauseForstatus($category_status);		  
	    echo getNewPagination('wedding-planners-category.php','wp_category_page_size','wp_category','wp_cat_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($category_status); ?> Wedding Category. Please add data.</h1>
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
