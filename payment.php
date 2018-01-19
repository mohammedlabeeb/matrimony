    <?php
 		error_reporting(0);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
    function getMembershipTheme(){
		static $theme_no = 1;
		$theme_name = "";
		switch($theme_no)
		{
			case 1:
					$theme_name = "theme1";
					break;
			case 2:
					$theme_name = "theme2";
					break;
			case 3:
					$theme_name = "theme3";
					break;
			case 4:
					$theme_name = "theme4";
					break;
		}
		$theme_no++;
		if($theme_no==5)
		$theme_no=1;
		return $theme_name;
	}
      ?>		
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script> 
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
 	<div class="row">    
        <div class="col-xs-12 col-sm-12">
        <div class="text-right"><sup>All rates of % of service tax</sup></div> 
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Choose a package and payment mode that suits you best from the various options.</h3>
            </div>             
              <div class="panel-body">
                        <?php
                            $SQL_STATEMENT =  "SELECT * FROM membership_plan WHERE status='APPROVED'";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
                        ?>
                  <ul class="theme col-sm-3 col-xs-12">          
                      <li class="<?php echo getMembershipTheme();?> col-xs-12 padding-left-right-zero-small">
                            <h3><?php echo $DatabaseCo->dbRow->plan_name;?></h3>
                            <ul class="features">
                                <li><h5>Amount</h5><strong class="muted" style="color:#D74E50;"><?php echo $DatabaseCo->dbRow->plan_amount_type.' '.$DatabaseCo->dbRow->plan_amount;?> </strong></li>
                                <li><h5>Duration</h5><strong class="muted"><?php echo $DatabaseCo->dbRow->plan_duration;?> Day</strong></li>
                                <li><h5>Contacts views</h5><strong class="muted"><?php echo $DatabaseCo->dbRow->plan_contacts;?></strong></li>
                                <li>
                                <?php if($DatabaseCo->dbRow->video=='Yes'){ ?>
                                <img alt="Membership Plans" src="images/icons/yes.png">
                                <?php	}else { ?>
                                 <img alt="Membership Plans" src="images/icons/no.png">
                                 <?php } ?>
                                <br /><strong class="muted">Video Uploading</strong></li>                               
                                <li>
                                <?php if($DatabaseCo->dbRow->chat=='Yes'){ ?>
                                <img alt="Membership Plans" src="images/icons/yes.png">
                                 <?php	}else {?>
                                 <img alt="Membership Plans" src="images/icons/no.png">
                                 <?php } ?>                                
                                <br /><strong class="muted">live Chat</strong></li>
                                <li><h5>Profile Views</h5><strong class="muted"><?php echo $DatabaseCo->dbRow->profile;?></strong></li>
                                <li><h5>Personal Messages</h5><strong class="muted"><?php echo $DatabaseCo->dbRow->plan_msg;?></strong></li>
                                <li><h5>Special Offers</h5><strong class="muted"><?php echo $DatabaseCo->dbRow->plan_offers;?></strong></li>                                
                            </ul>
                            <div class="footer">
                                <?php 
                                if(isset($_SESSION['user_id']))
                                {
				if($DatabaseCo->dbRow->plan_amount=='0') {                                
                                ?>
                                <a class="btn btn-warning btn-large" target="_blank" title="PHP Classified Script" href="contact-admin.php"><i class="glyphicon glyphicon-shopping-cart"></i>Contact To Admin</a><?php
                                }else{
                                ?>
                                <a class="btn btn-warning btn-large" target="_blank" title="PHP Classified Script" href="make_payment.php"><i class="glyphicon glyphicon-shopping-cart"></i> BUY NOW</a><?php
                                 } }else { ?>
                                <a class="btn btn-warning btn-large" target="_blank" title="PHP Classified Script" href="login.php"><i class="glyphicon glyphicon-shopping-cart"></i> BUY NOW</a>
                                <?php } ?>
                            </div>
                   </li>                           
                  </ul>
                  <div class="clearfix visible-xs"></div>
                   <?php } ?>
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