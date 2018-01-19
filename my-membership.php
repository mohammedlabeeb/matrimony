<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/JavaScript">

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}

</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
//  End -->
</script>
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
						
        <?php
	$SQL_STATEMENT =  "select r.*,p.* from register_view r,payments p where r.matri_id='".$mid."' && r.status='Paid' && r.matri_id=p.pmatri_id";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	
	?>
						<div class="main-area gradient-rev">
 	
           <div class="gradient-rev block-level" style="margin-top:20px">
              <h3 class="">My-Orders</h3>  
             
            
            <?php  while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
					   { ?>
            <div class="">
               <div class="thumbnail col-xs-12">
                 <div class="col-sm-2  col-xs-4  padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       Membership
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12  padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->p_plan; ?>
                    </span>
                 </div>
                 <div class="col-sm-1 col-xs-4 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       Amount
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12  padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->p_amount; ?>
                    </span>
                 </div>
                 <div class="col-sm-2 col-xs-4 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       Expiry Date
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12 padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->exp_date; ?>
                    </span>
                 </div>
                 
                 <div class="clearfix visible-xs"></div>
                 <hr class="visible-xs">
                 
                 <div class="col-sm-2 col-xs-4 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                      Plan Duration
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12 padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->plan_duration; ?> Days
                    </span>
                 </div>
                 <div class="col-sm-1 col-xs-4 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       Contacts
                    </span>
                    <div class="clearfix "></div>
                    <span class="col-sm-12 padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->p_no_contacts;?>
                    </span>
                 </div>
                 <div class="col-sm-2  col-xs-4 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       View Profile
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12 padding-left-zero padding-right-zero margin-top-10px">
                    	<?php echo $DatabaseCo->dbRow->profile; ?>
                    </span>
                 </div>
                  <div class="clearfix visible-xs"></div>
                  <hr class="visible-xs">
                 <div class="col-sm-2 col-xs-12 padding-left-zero padding-right-zero text-center">
                 	<span class="col-sm-12 padding-left-zero padding-right-zero  margin-bottom-zero bg-red">
                       Messages
                    </span>
                    <div class="clearfix"></div>
                    <span class="col-sm-12 padding-left-zero padding-right-zero">
                    	<?php echo $DatabaseCo->dbRow->p_msg; ?>
                    </span>
                 </div>
                 <div class="clearfix"></div>
               </div>
               <a href="#" class="btn btn-success col-sm-2 col-xs-12 col-sm-offset-5 col-xs-offset-0" onClick="newWindow('invoice.php?id=<?php echo $DatabaseCo->dbRow->payid;?>','','790','540')"> View Invoice</a>
                 
            </div>      
            			<?php
					    }
                        ?>
            
            
                    
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


