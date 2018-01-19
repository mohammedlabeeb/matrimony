<?php
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	include_once './lib/page.class.php';
	$DatabaseCo = new DatabaseConn();
	$pageSetting = new Page("Save","logo-setting.php","Add Site Logo and Favicon");
	$site_setting_row = getRowCount("select count(REC_ID) from site_setting",$DatabaseCo);
	
	
	$logo_image = "";
	$logo_image_type = "";
	$favicon_image = "";
	$favicon_image_type = "";
	$rec_id = "";
	
	$ACTION_MODE = "ADD";
	$statusObj = new Status();
	if($site_setting_row > 0)
	{
		$SQL_STATEMENT2 = "SELECT * FROM site_setting";
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);
							
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			$rec_id = $DatabaseCo->dbRow->REC_ID;
			$logo_image_type = $DatabaseCo->dbRow->LOGO_IMAGE_TYPE;
			$favicon_image_type = $DatabaseCo->dbRow->FAVICON_IMAGE_TYPE;
			break;
						
		}
		$pageSetting->setActionBtnName("Update");
		$pageSetting->setFormTitle("Update Site Logo and Favicon");
		$ACTION_MODE = "UPDATE";	
	}else{
		
		$statusObj->setActionSuccess(false);
		$STATUS_MESSAGE = "Please add site-setting first";	
	}
	
	$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
	if($isPostBack)
	{
		$site_url = isset($_POST['site_url'])?$_POST['site_url']:"realestatescript";
		$site_title = isset($_POST['site_title'])?$_POST['site_title']:"";
		$site_tagline = isset($_POST['site_tagline'])?$_POST['site_tagline']:"";
		
		$ACTION = $_POST["action"];
		
		switch($ACTION)
		{
			case "LOGO":
					$logo_image_type =$_FILES['logo']['type'];
					$logo_image_size =$_FILES['logo']['size'];	
					
					$fileHandle = fopen($_FILES['logo']['tmp_name'], "rb");
					$logo_image = fread($fileHandle, $logo_image_size);
					$logo_image = addslashes($logo_image);
					$ERROR_FLAG =  false;
					if(empty($logo_image)){
						 $STATUS_MESSAGE="Logo File content could not be empty";
						 $statusObj->setActionSuccess(false);
						 $ERROR_FLAG = true;
					}
					else if(strncmp($logo_image_type,"image",4)){
							$STATUS_MESSAGE="Logo File type is not an image file.";
							$statusObj->setActionSuccess(false);
							$ERROR_FLAG = true;
					}
						if($site_setting_row > 0)
						{
							//Update case LOGO
							$SQL_STATEMENT = "UPDATE site_setting  set LOGO='".$logo_image."',LOGO_IMAGE_TYPE='".$logo_image_type."'";			
						}

					break;
			case "FAVICON":
					$favicon_image_type =$_FILES['favicon']['type'];
					$favicon_image_size =$_FILES['favicon']['size'];	
					$fileHandle2 = fopen($_FILES['favicon']['tmp_name'], "rb");
					$favicon_image = fread($fileHandle2, $favicon_image_size);
					$favicon_image = addslashes($favicon_image);
					$ERROR_FLAG =  false;
					if(empty($favicon_image)){
						 $STATUS_MESSAGE=" Favicon File content could not be empty";
						 $statusObj->setActionSuccess(false);
						 $ERROR_FLAG = true;
					}
					else if(strncmp($favicon_image_type,"image",4)){
							$STATUS_MESSAGE="Favicon  File type is not an image file.";
							$statusObj->setActionSuccess(false);
							$ERROR_FLAG = true;
					}
			
					if($site_setting_row > 0){
								//Update case
						$SQL_STATEMENT = "UPDATE site_setting  set FAVICON='".$favicon_image."',FAVICON_IMAGE_TYPE='".$favicon_image_type."'";			
					}

					break;	
		}

		if($site_setting_row > 0){
		$statusObj = handle_post_request($ACTION_MODE,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();			
		}else{
			$statusObj = new Status();
			$statusObj->setActionSuccess(false);
			$STATUS_MESSAGE = "Please add site-setting first";			
			
		}

	}
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | logo-favicon-settings</title>
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
	setPageContext("site-settings","logo-setting");
	$(document).ready(function()
	 {
	    var formId = "#logo_setting";
	    var rules = {
                logo: { required: true }		
            	};
	    var messages = {
				logo: {required:"Logo is required."},
				};
            validateForm(formId,rules,messages);	
		var formId2 = "#favicon_setting";
	    var rules2 = {
                favicon: { required: true }		
            	};
	    var messages2 = {
				favicon: {required:"Favicon is required."},
				};
            validateForm(formId2,rules2,messages2);		
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Site Settings </a>/ <a href="#" title="Site Global Settings">Logo and Favicon Settings</a></div>
      <div class="widecolumn-inner">
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
        <h4>Logo Setting</h4>
        <form action="<?php echo $pageSetting->getFormAction();?>"  enctype="multipart/form-data"  method="post" class="form-data" id="logo_setting">
          <p class="cf">
            <label>1. Logo:</label>
            <input type="file" class="input-textbox" name="logo" id="Logo" />
          </p>
          <p class="cf">
            <label>Existing Logo :</label>
            <?php if(empty($logo_image_type)){?>
            <img src="img/image-not-avail.png" alt="No Image available" />
            <?php } ?>
            <img src="./lib/viewCustomFieldImage.php?recid=<?php echo $rec_id;?>&key_name=REC_ID&table_name=site_setting&image_data_field=LOGO&image_type_field=LOGO_IMAGE_TYPE" align="Site Logo"  /> </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>"/>
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input  type="hidden" name="action"  value="LOGO"/>
        </form>
      </div>
      <div class="widecolumn-inner">
        <h4>Favicon Setting</h4>
        <form action="<?php echo $pageSetting->getFormAction();?>" enctype="multipart/form-data"  method="post" class="form-data" id="favicon_setting">
          <p class="cf">
            <label>1. Favicon:</label>
            <input type="file" class="input-textbox" name="favicon" id="Favicon"/>
          </p>
          <p class="cf">
            <label>Existing Favicon :</label>
						<?php if(empty($favicon_image_type)){?>
            <img src="img/image-not-avail.png" alt="No Image available" />
            <?php } ?>
            <img src="./lib/viewCustomFieldImage.php?recid=<?php echo $rec_id;?>&key_name=REC_ID&table_name=site_setting&image_data_field=FAVICON&image_type_field=FAVICON_IMAGE_TYPE" align="Site Logo"  /> </p>
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>"/>
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
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
