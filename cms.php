<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './lib/pagination.php';
include_once './class/Location.class.php';
include_once './class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();
require_once("BusinessLogic/class.cms.php");
$cm=new cms();
$cms_id=$_REQUEST['cms_id'];
$res2=$cm->get_cms_by_id($cms_id);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
 
         <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">CMS Page</li>
        </ol>
 	<div class="row">
   		 <div class="col-xs-12 col-xs-push-0 col-sm-9 col-sm-push-3">
          <div class="panel panel-success">
            <div class="panel-heading">
              <?php					   
                               while($row2 = mysql_fetch_array($res2)) 
                               {
                              ?> 
              <h3 class="panel-title"><?php echo $row2['cms_title']; ?></h3>
            </div>
            <div class="panel-body">
              <p style="text-align:justify;"><?php echo htmlspecialchars_decode($row2['cms_content']);?></p>
              <?php
                                }
                                ?>
            </div>
            <div class="panel-body">
            
            <p class="clearfix"></p>
              	
          
         
            </div>
          </div>
          </div>
          <div class="col-xs-12 col-xs-pull-0 col-sm-pull-9 col-sm-3">
        		 <?php include 'advertise/add_three.php'; ?>
          </div>
         
            
      	
	</div>
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
 </body>
</html>

