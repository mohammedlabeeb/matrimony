<?php
session_start();
	include_once 'databaseConn.php';
	include_once 'lib/requestHandler.php';
	include_once './class/Config.class.php';
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
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
          <li class="active">Login</li>
        </ol>
 	<div class="row">
   		 
    		<div class="col-xs-6 col-sm-3">
        		 <?php include 'advertise/add_single.php'; ?>
        	</div>
            
           <div class="clearfix visible-xs"></div>
          <div class="col-xs-12 col-sm-9">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Login Here</h3>
            </div>
            <div class="panel-body">
            
            <p class="clearfix"></p>
              	<form name="adformSearch" id="adformSearch" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-4 control-label">Email-ID or Matri ID</label>
    			<div class="col-sm-4">
      			<input type="text"  name="username" id="username" class="form-control" data-validation-engine="validate[required]" >
           
    			</div>
  				</div>
                
                <div class="form-group">
    			<label for="inputEmail3" class="col-sm-4 control-label">Password</label>
    			<div class="col-sm-4">
      			<input type="password"  name="password" id="password" class="form-control" data-validation-engine="validate[required]" >
           
    			</div>
  				</div>
                
  				
  				<div class="form-group">
    			<div class="col-sm-offset-4 col-sm-10">
      			<button type="submit" name="member_login" class="btn btn-success"> Submit </button>
    			</div>
  				</div>
				</form>
            </div>
          </div>
          </div>
      	
	</div>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>  
 </body>
</html>

