<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","google-settings.php","Add Google Settings");
	$google_setting_row = getRowCount("select count(REC_ID) from google_settings",$DatabaseCo);
	
	
	$google_map_api_code = "";
	$google_analytic_code = "";
	$google_verification_code = "";
	$google_adsense_status = "";
	$google_adsense_code = "";
	
	$ACTION_MODE = "ADD";
	
	if($google_setting_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM google_settings";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			$google_map_api_code = $DatabaseCo->dbRow->GOOGLE_MAP_API_CODE;
			$google_analytic_code = $DatabaseCo->dbRow->GOOGLE_ANALYTIC_CODE;
			$google_verification_code = $DatabaseCo->dbRow->GOOGLE_VERIFICATION_CODE;
			$google_adsense_status = $DatabaseCo->dbRow->GOOGLE_ADSENSE_STATUS;
			$google_adsense_code = $DatabaseCo->dbRow->GOOGLE_ADSENSE_CODE;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update Google Settings");
		$ACTION_MODE = "UPDATE";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		
		$google_map_api_code = $_POST['google_map_api_code'];
		$google_analytic_code = $_POST['google_analytic_code'];
		$google_verification_code = $_POST['google_verification_code'];
		$google_adsense_status = $_POST['google_adsense_status'];
		$google_adsense_code = $_POST['google_adsense_code'];
		
		if($google_setting_row > 0)
		{
			//Update case
			$SQL_STATEMENT = "UPDATE google_settings  set  GOOGLE_MAP_API_CODE='".$google_map_api_code."',GOOGLE_ANALYTIC_CODE='".$google_analytic_code."',GOOGLE_VERIFICATION_CODE='".$google_verification_code."',GOOGLE_ADSENSE_STATUS='".$google_adsense_status."',GOOGLE_ADSENSE_CODE='".$google_adsense_code."'";			
		}
		else
		{
			//Insert Case
$SQL_STATEMENT = "INSERT INTO google_settings  (REC_ID,GOOGLE_MAP_API_CODE,GOOGLE_ANALYTIC_CODE,GOOGLE_VERIFICATION_CODE,GOOGLE_ADSENSE_STATUS,GOOGLE_ADSENSE_CODE) values ('','".$google_map_api_code."','".$google_analytic_code."','".$google_verification_code."','".$google_adsense_status."','".$google_adsense_code."')";			
		}
		
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();
	}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | google  settings</title>
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
	setPageContext("google","google-setting");
	$(document).ready(function()
	 {
	    var formId = "#google_setting";
	    var rules = {
                google_map_api_code: { required: true},
                google_analytic_code: { required: true},
		google_verification_code: { required: true }

            };
	    var messages = {
                google_map_api_code: { required: "Google Map API Code is required."},
                google_analytic_code: { required: "Google Analytic Code is required."},
		google_verification_code: { required: "Google Verification Code is required." }

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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Google API Settings </a>/ <a href="#" title="Database Settings">Google Settings</a></div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
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
        <form action="<?php echo $pageSetting->getFormAction();?>" method="post" class="form-data" id="google_setting"  >
          <p class="cf">
            <label>1. Google Map API Code:</label>
            <input type="text" class="input-textbox" name="google_map_api_code" id="Googel_MAP_API_Code" value="<?php echo $google_map_api_code;?>"/>
          </p>
          <p class="cf">
            <label>2. Google Analytic Code:</label>
            <input type="text" class="input-textbox"  name="google_analytic_code" id="Google_Analytic_Code" value="<?php echo $google_analytic_code;?>"/>
          </p>
          <p class="cf">
            <label>3. Google Verifiacation Code:</label>
            <input type="text" class="input-textbox" name="google_verification_code" id="Google_Verification_Code" value="<?php echo $google_verification_code;?>"/>
          </p>
          <p class="cf">
            <label>4. Google Adsense Status:</label>
            <input type="radio"  value="APPROVED" name="google_adsense_status" id="Google_Adsense_Status"  <?php if($google_adsense_status=='APPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="google_adsense_status" id="Google_Adsense_Status"  <?php if($google_adsense_status=='UNAPPROVED') echo "checked";?>/>
            <span class="radio-btn-text">Inactive</span>
          <p class="cf">
            <label>5. Google Adsense Code:</label>
            <textarea rows="15" cols="70" name="google_adsense_code" id="Google_Adsense_Code"><?php echo $google_adsense_code;?></textarea>
          </p>
          <p class="submit-btn cf">
             <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="button" class="save-btn" value="Cancel" title="Cancel"/>
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
