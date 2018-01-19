<?php
	  	include_once 'databaseConn.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />


</head>
<body>		

        <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Advertise</li>
    </ol>
 		<div class="row">
    		
            
                <div class="col-sm-9 col-xs-12 col-sm-push-3 col-xs-push-0">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Advertise With Us</h3>
                  </div>
                  <div class="panel-body">
                      <div class="col-sm-12">
                      <h4 class="clearfix">
            Your data has been submited successfully. We will Contact you As soon as Possible. 
            </h4>
                      </div>
                      
                  </div>
                </div>
          </div>
          <div class="col-sm-3 col-sm-pull-9 col-xs-12 co-xs-pull-0">      
         	<div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Advanced Search </h3>
            </div>
            <div class="panel-body">
             <?php include "page-part/my_search.php";?>
            </div>
          </div>
         	</div>
      </div>	

        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>

</div>
 </body>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>  
</html>
 