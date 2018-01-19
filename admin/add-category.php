<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
include("../BusinessLogic/class.weddingplanner.php");
include("../BusinessLogic/class.wpcategory.php");
$pageSetting = new Page("Save","add-category.php?action=ADD","Add New Category");
$exp=new wpcategory(); 
$result=$exp->get_wpcat();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$wp_cat_id  = isset($_GET['id']) ? $_GET['id'] :"" ;

$wp_cat_name = "";
$status ="";

$roleRealID = "Real-";
$ACTION_MODE = "ADD";

if($ACTION == "UPDATE")
{
	$SQL_STATEMENT2 = "SELECT * FROM wp_category where wp_cat_id =".$wp_cat_id ;
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
					
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
		
		$wp_cat_name = $DatabaseCo->dbRow->wp_cat_name;
		$status =$DatabaseCo->dbRow->status;

	}
	$pageSetting->setActionBtnName("Update");
	$pageSetting->setFormTitle("Update Wedding Planner ".$wp_cat_id);
	$pageSetting->setFormAction("add-category.php?id=".$wp_cat_id."&action=UPDATE");			
	$ACTION_MODE = "UPDATE";
}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$statusObj = new status();
		$wp_cat_name = $_POST['wp_cat_name'];
		$status = $_POST['status'];

	
		$status_MESSAGE="";
		$ACTION_MODE = $_POST['action'];
		$SQL_STATEMENT = "";
		switch($ACTION_MODE)
		{
			case 'ADD':
	$SQL_STATEMENT = "INSERT into wp_category (wp_cat_name,status) values ('".$wp_cat_name."','".$status."')";

	
				break;
			case 'UPDATE':
				$wp_id = $_POST['id'];
				$SQL_STATEMENT =  "UPDATE wp_category set wp_cat_name='".$wp_cat_name."',status='".$status."' WHERE wp_cat_id=".$wp_cat_id;
				break;
				
		}
	
		 $statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		 
		 $status_MESSAGE = $statusObj->getstatusMessage();
		
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Wedding Planners</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
	setPageContext("wp","wedding-planners-category");
	$(document).ready(function()
	 {
	    var formId = "#add_category";
	    var rules = {
                wp_cat_name: { required: true },
				status:{ required: true },
			
				
            };
	    var messages = {
				wp_cat_name: {required:"Category name is required."},
				status:{required:"Status is required."},
				
		};
            validateForm(formId,rules,messages);	
	 });
	
</script>
<link rel="stylesheet" href="../css/jquery.ui.theme.css">
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.datepicker.js"></script>
 <script>
$(function() {
$( "#datepicker" ).datepicker({
changeMonth: true,
changeYear: true
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
      <div class="breadcum-wide"><a href="#" title="Add New Deatail">Wedding Directory</a> / <a href="#" title="Event">Wedding Planners</a></div>
      <div class="listing-section">
        <div class="member-list cf">
	    <a href="javascript:;" title="List All Wedding Planners Category" onclick="window.location='wedding-planners-category.php'" class="button"><img src="img/bgi/list-icon.png" alt=""/>List All Wedding Planners Category</a>
	  <a href="javascript:;" title="Add New Wedding Planner Category" onclick="window.location='add-category.php'" class="button"><img src="img/bgi/add-icon.png" alt=""/>Add New Wedding Planner Category</a>			
        </div>
      </div>
      
      <div class="widecolumn-inner">
	
	<h4>Manage Wedding Planner Category</h4>
		<span class="field_marked">All Fields are required.</span>
        <?php
					if(!empty($status_MESSAGE))
					{	
						if($statusObj->getActionSuccess()){
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$status_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$status_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>
	<form action="<?php echo $pageSetting->getFormAction();?>" enctype="multipart/form-data" method="post" class="form-data" id="add_category">
		
		
	    <p class="cf">
	      <label><font id="star">*</font>&nbsp;Category Name:</label>
	      <input type="text" class="input" size="32"  name="wp_cat_name" value="<?php echo $wp_cat_name;?>" id="wp_cat_name"/>
	    </p>
        
	
     <p class="cf"> <label><font id="star">*</font>&nbsp;Status:</label>
            <input type="radio"  value="APPROVED" name="status" id="status"<?php if($status=='APPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="status" id="status" <?php if($status=='UNAPPROVED'){?> checked="checked" <?php } ?>  />
            <span class="radio-btn-text">Inactive</span>
	  </p>
	
	
	    <p class="submit-btn cf">
        <?php
		if(!empty($wp_cat_id))
		{
		?>
         <input type="submit"  class="save-btn" value="Update" name="update_planner" title="Update"/>
         <input type="hidden" name="update_planner" value="submit" />
         <?php
		}
		else
		{
		?>
	      <input type="submit"  class="save-btn" value="Add" name="add_planner" title="Add"/>
          <input type="hidden" name="add_planner" value="submit" />
        <?php
		}
		?>
	      <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="id" value="<?php echo $wp_cat_id;?>" />	
	    </p>
	
	</form>
	
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
