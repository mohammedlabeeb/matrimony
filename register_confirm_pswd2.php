<?php
$email=$_GET['email'];
include_once 'databaseConn.php';
	include_once 'lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />

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
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Registration Confirmation</h3>
            </div>
            <div class="panel-body">
            
            <p class="clearfix">
            We have sent you a Confirmation Email.Please Check your mail for Verification.<a href="index.php">Go to Login Page</a>
            </p>
              
                
            </div>
          </div>
          </div>
      </div>
      </article>

<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
 </body>
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</html>

