<?php
	include_once 'databaseConn.php';
	if(isset($_SESSION['user_name'])) {
            header("location: myhome.php");
            exit();
    }
	include_once 'lib/requestHandler.php';
	include_once './class/Config.class.php';
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	
?>
<?php
if(isset($_REQUEST['member_login']))
{

            $username = isset($_POST['username'])?$_POST['username']:"";
            $password = md5(isset($_POST['password'])?$_POST['password']:"");
            
			$STATUS_MESSAGE="";
            $SQL_STATEMENT = "select * from register where (matri_id='".$username."' OR email='".$username."') and password='".$password."' AND status!='Suspended'";
           
            $statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
        if($statusObj->getActionSuccess())
         {
		    if($DatabaseCo->dbRow->status!='Inactive')
		    {
                            session_regenerate_id();
                                $_SESSION['user_name'] = $DatabaseCo->dbRow->email;
                                $_SESSION['user_id'] = $DatabaseCo->dbRow->matri_id;
				$_SESSION['uname'] = $DatabaseCo->dbRow->username;
				$_SESSION['gender'] = $DatabaseCo->dbRow->gender;
				$_SESSION['uid'] = $DatabaseCo->dbRow->index_id;
				$_SESSION['email'] = $DatabaseCo->dbRow->email;
				$email = $_SESSION['email'];
				$browser = $_SERVER['HTTP_USER_AGENT'];
				$url = $_SERVER['HTTP_HOST'];
				$ip = $_SERVER['SERVER_ADDR'];
				$tm=mktime(date('h')+5,date('i')+30,date('s'));
				$login_dt=date('Y-m-d h:i:s',$tm);
				$date2 = date("d F ,Y", (strtotime($login_dt)));
				$sql="UPDATE register set last_login='$login_dt' WHERE (matri_id='".$username."' OR email='".$username."')";		
				
                                mysql_query($sql);

				session_write_close();
                                header("location:myhome.php");
                                exit();
                                }
                                else
                                {
                                ?>
                                <script>alert('Your account is under review. It will be activated within 24hrs');</script>
                                <?php
                                }
                                }
                                else
                                {
                                    ?>
                                <script>alert('Your username or password is wrong. Please try again...');</script>
                                <?php
                                }
 }		
       ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
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
						
						<?php include('page-part/left_colum.php'); ?>
						<div class="main-area gradient-rev"> 
          <div class="panel panel-error">
            <div class="panel-heading">
              <h3 class="panel-title">Login Here</h3>
            </div>
            <div class="panel-body">
            
              	<form name="adformSearch" id="adformSearch" class="col-xs-12" method="post" enctype="multipart/form-data">
                  <div class="col-xs-12 padding-left-zero padding-right-zero" style="margin-bottom:20px;">
                    <div class="form-group" style="">
    			       <label for="inputEmail3" class="col-sm-4 col-xs-12 text-center control-label">Email-ID or Matri ID</label>
    			       <div class="col-sm-4 col-xs-12">
      			          <input type="text"  name="username" id="username" class="form-control" data-validation-engine="validate[required]" >
           
    			        </div>
  				   </div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="col-xs-12 padding-left-zero padding-right-zero" style="margin-bottom:20px;">
                   <div class="form-group">
    			      <label for="inputEmail3" class="col-sm-4 control-label col-xs-12 text-center">Password</label>
    			      <div class="col-sm-4 col-xs-12">
      			          <input type="password"  name="password" id="password" class="form-control" data-validation-engine="validate[required]" >
           
    			      </div>
  				   </div>
                   </div>
                <div class="clearfix"></div>
  				<div class="col-xs-12">
  				  <div class="form-group">
    			    <div class="col-sm-offset-4 col-sm-10 col-xs-12 col-xs-offset-0">
      			      <button type="submit" name="member_login" class="btn btn-success col-sm-3 col-xs-12"> Submit </button>
    			    </div>
  				  </div>
                </div>
                
				</form>
                
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

