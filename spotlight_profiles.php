<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
        $mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	include_once './lib/requestHandler.php';        
	include_once './class/Location.class.php';
	include_once './class/Config.class.php';	
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
        $DatabaseCo1 = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
        ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
</head>
<body>		

	<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

 	<ol class="breadcrumb">
  		<li><a href="#">Home</a></li>
  		<li class="active">My Account</li>
	</ol>     
       
        <div class="row">
   	       
     <div class="col-sm-9 col-xs-12 col-sm-push-3 col-xs-push-0">           
            
            <?php
               $SQL_STATEMENT1 =  "SELECT * FROM register_view WHERE fstatus='Featured'";
               $DatabaseCo->dbResult1=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1);
               $recently_joined = getRowCount("select count(index_id) FROM register_view", $DatabaseCoCount);
          ?>
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Spotlight Profiles (<?php echo $recently_joined; ?>)</h3>
            </div>
            <div class="panel-body"> 
                <?php 
                while($DatabaseCo->dbRow1 = mysql_fetch_object($DatabaseCo->dbResult1))
                    {
                    ?>
                <div class="profile">                   
                    <?php if($DatabaseCo->dbRow1->photo1=='')
							  {?>
                              <img src="photos/nophoto.jpg" />
                              <?php
							  }
							  else
							  {?>
                    <img src="photos/<?php echo $DatabaseCo->dbRow1->photo1; ?>" />
                    		<?php
							  }
							  ?>                  
                    <p>
                         <b><a href="#"><?php echo $DatabaseCo->dbRow1->username; ?>,</a></b><br />
                        24 years , <?php echo $DatabaseCo->dbRow1->height; ?> Inch, <?php echo $DatabaseCo->dbRow1->religion_name; ?> ,<?php echo $DatabaseCo->dbRow1->caste_name; ?> ,<br />
                        <?php echo $DatabaseCo->dbRow1->ocp_name; ?> , <?php echo $DatabaseCo->dbRow1->city_name; ?> ,<?php echo $DatabaseCo->dbRow1->country_name; ?><br />
                        <a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow1->matri_id; ?>">View Full Profile</a>
                    </p>
                </div>
                 <?php } ?>
               
            </div>
          </div>
      </div>
       <div class="col-sm-3 col-xs-12 col-sm-pull-9 col-xs-pull-0">      
        <?php 
        require_once 'page-part/left_colum.php';        
        ?>
     </div>              
	</div>
        
      <?php   require_once 'chat.php';    ?>	
     
<!-----------------------top part end-------------------------->

<?php include "page-part/footer.php";?>

</div>
     <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
 </body>
</html>