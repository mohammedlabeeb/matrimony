<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","database-setting.php","Add Database Settings");
	$db_setting_row = getRowCount("select count(REC_ID) from database_setting",$DatabaseCo);
	
	
	$database_server = "";
	$database_name = "";
	$database_username = "";
	$database_password = "";
	
	$ACTION_MODE = "ADD";
	
	if($db_setting_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM database_setting";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			$database_server =  $DatabaseCo->dbRow->DB_SERVER;
			$database_name = $DatabaseCo->dbRow->DB_NAME;
			$database_username = $DatabaseCo->dbRow->DB_USER;
			$database_password = $DatabaseCo->dbRow->DB_PASSWORD;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update Database Settings");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$database_server = isset($_POST['db_server'])?$_POST['db_server']:"localhost";
		$database_name = isset($_POST['db_name'])?$_POST['db_name']:"realestate";
		$database_username = isset($_POST['db_username'])?$_POST['db_username']:"root";
		$database_password = isset($_POST['db_password'])?$_POST['db_password']:"real123";
		
		if($db_setting_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE database_setting  set DB_SERVER='".$database_server."',DB_NAME='".$database_name."',DB_USER='".$database_username."',DB_PASSWORD='".$database_password."'";			
		}
		else
		{
			//Insert Case
$SQL_STATEMENT = "INSERT INTO database_setting (REC_ID,DB_SERVER,DB_NAME,DB_USER,DB_PASSWORD) values ('','".$database_server."','".$database_name."','".$database_username."','".$database_password."')";			
		}
		
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();
	}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | database settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
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
	setPageContext("site-settings","database-setting");
	$(document).ready(function()
	 {
	    var formId = "#db_setting";
	    var rules = {
                db_server: { required: true, minlength: 5, maxlength: 50 },
                db_name: { required: true, minlength: 5, maxlength: 50 },
		db_username: { required: true, minlength: 4, maxlength: 50 },
		db_password: { required: true, minlength: 5, maxlength: 50 }
                
            };
	    var messages = {
		db_server:{required:"Database Server field is required."},
		db_name: { required: "Database Name field is required."},
		db_username: { required: "Database Username field is required." },
		db_password: { required: "Database Password field is required."}
		};
            validateForm(formId,rules,messages);	
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Site Settings </a>/ <a href="#" title="Database Settings">Database Settings</a></div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
        <?php
					if(!empty($STATUS_MESSAGE))
					{	
						if($statusObj->getActionSuccess()){
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="db_setting"  >
          <p class="cf">
            <label>1. Default Country:</label>
            <input type="text" class="input-textbox"  value="<?php echo $database_server;?>" name="db_server" id="Database_Server"/>
          </p>
          <p class="cf">
            <label>2. Default City:</label>
            <input type="text" class="input-textbox" value="<?php echo $database_name;?>" name="db_name" id="Database_Name"/>
          </p>
          <p class="cf">
            <label>3. Database Username:</label>
            <input type="text" class="input-textbox" value="<?php echo $database_username;?>" name="db_username" id="Database_Username"/>
          </p>
          <p class="cf">
            <label>4. Database Password:</label>
            <input type="text" class="input-textbox" value="<?php echo $database_password;?>" name="db_password" id="Database_Password"/>
          </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
        </form>
      </div>
   <div class="widecolumn-inner">
        <h4>Database Backup</h4>
        <form action=""  method="post" class="form-data" id="favicon_setting">

          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="Create Backup" title="Craete Backup"/>
          </p>
          <input  type="hidden" name="action"  value="FAVICON"/>
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
