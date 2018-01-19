<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
	
	if(isset($_POST['delete-profile']))
	{	
		$from = $_SESSION['user_id'];	
		$subject="A request to delete my profile";
		$message=$_POST['reason'];
		$to="admin";
		$status='Unread';
		$insert=mysql_query("insert into messages (to_id,from_id,subject,message,sent_date,status) values ('$to','$from','$subject','$message',now(),'$status')");
		echo "<script language='javascript'>window.location='logout.php?action=logout'</script>";
	}

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

	<script>
		jQuery(document).ready(function()
		{
			//alert("hi");
			jQuery("#MatriForm").validationEngine();
		});
	</script>

<?php
	$SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	?>  
<?php include "page-part/head.php";?>	
</head>
<body>		
<div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev">   
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">
			    <span class="col-sm-6 col-xs-12"><?php echo $DatabaseCo->dbRow->username; ?> (<?php echo $DatabaseCo->dbRow->matri_id; ?>)</span>
                <span class="pull-right col-sm-6 col-xs-12 text-right"> Last Online : <?php $date1=$DatabaseCo->dbRow->last_login;
				echo $date2 = date("l, d M Y", (strtotime($date1)));   ?></span></h3>
                <div class="clearfix"></div>
            </div>
            
            <div class="panel-body">                   	
                	 <div class="col-sm-12">
                    <p class="page-heading text-danger">Delete profile </p>   
                    <p>You are about to delete your <?php echo $configObj->getConfigFname(); ?> profile. This means: All details of your interaction with other members will be lost and If you wish to use <?php echo $configObj->getConfigFname(); ?> services later, you will need to create a new profile.</p>	
                    
                    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
       
             
                           <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 col-xs-12 text-center control-label">Enter Reason &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-6 col-xs-12">
                  <textarea class="form-control" id="reason" name="reason" rows="4" data-validation-engine="validate[required]" placeholder="Type Proper Reason for leaving..."></textarea>
                 
                            </div>
                          </div> 
                     <span>Your request will go through <?php echo $configObj->getConfigFname(); ?> Admin and he will delete your profile. It will take atleast two days...</span>                  
                         
                          
                          <div class="form-group" style="margin-top:20px;">
                            <div class="col-sm-offset-3 col-sm-10">
                    <input type="submit" name="delete-profile" value="Delete My profile" class="btn btn-danger col-sm-3 col-xs-12">
                            </div>
                          </div>
                        </form>
                    </div>                        
            </div>              
          </div>  
            
          </div>
          
           
	</div>
	</div>
	</div>
</article>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>

</div>
    
</body>
</html>


