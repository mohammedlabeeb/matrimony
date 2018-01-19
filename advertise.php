<?php
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		require_once("BusinessLogic/class.cms.php");	
		require_once("BusinessLogic/class.advertise.php");
		
		if(isset($_POST['submit']))
{
		$adv_name=mysql_real_escape_string($_POST['advertisement']);
		$adv_link=$_POST['advertiselink'];
		$adv_img=$_FILES['file']['name'];
		$status='0';
		$contact=$_POST['contact_name'];
		$phone=$_POST['phone'];
		
		$ob=new advertisement();
		$ob->add_adv2($adv_name,$adv_by,$adv_link,$adv_type,$adv_google,$adv_img,$adv_counter,$adv_level,$display,$contact,$phone,$status);
		move_uploaded_file($_FILES['file']['tmp_name'],"advertise/".$_FILES['file']['name']);		
		echo "<script>window.location='thanks.php'</script>";
}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
	<script>
		jQuery(document).ready(function()
		{
			jQuery("#adformSearch").validationEngine();
		});
	</script>

</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
 
         <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Advertisement</li>
        </ol>
 	<div class="row">
          <div class="col-xs-12 col-sm-9 col-sm-push-3 col-xs-push-0">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Advertise With Us</h3>
            </div>
            <div class="panel-body">
            
            <p class="clearfix"></p>
              	<form name="adformSearch" id="adformSearch" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-3 control-label">Advertise Name&nbsp;<font class="text-danger">*</font></label>
    			<div class="col-sm-4">
      			<input type="text"  name="advertisement" id="advertisement" class="form-control" data-validation-engine="validate[required]"><font id="nameId"></font>
           
    			</div>
  				</div>
                
  				
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-3 control-label">Advertise Link&nbsp;<font class="text-danger">*</font></label>
    			<div class="col-sm-4">
      			<input type="text" class="form-control" name="advertiselink" id="advertiselink" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="linkId"></font>
           
    			</div>
  				</div>
                
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-3 control-label">Contact Person&nbsp;<font class="text-danger">*</font></label>
    			<div class="col-sm-4">
      			<input type="text" class="form-control" name="contact_name" id="contact_name" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="contactId"></font> 
           
    			</div>
  				</div>
                
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-3 control-label">Phone&nbsp;<font class="text-danger">*</font></label>
    			<div class="col-sm-4">
      			<input type="text" class="form-control" name="phone" id="phone" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="phoneId"></font>
           
    			</div>
  				</div>
                
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-3 control-label">Advertise Image&nbsp;<font class="text-danger">*</font></label>
    			<div class="col-sm-4">
      			<input type="file" class="form" name="file" id="file" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="imageId"></font>  
           
    			</div>
  				</div>       
                           
  				
  				<div class="form-group">
    			<div class="col-sm-offset-3 col-sm-10">
      			<button type="submit" name="submit" class="btn btn-success col-sm-3 col-xs-12"> Submit </button>
    			</div>
  				</div>
				</form>
            </div>
          </div>
          </div>
          <div class="col-xs-12 col-xs-pull-0 col-sm-pull-9 col-sm-3">
        		 <?php include 'advertise/add_single.php'; ?>
          </div>
            
      	
	</div>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
 </body>
</html>

