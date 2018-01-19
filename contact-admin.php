<?php
		include_once 'databaseConn.php';
		include_once 'auth.php';
		include_once './lib/pagination.php';
		include_once './class/Config.class.php';
		$DatabaseCo = new DatabaseConn();
		$configObj = new Config();

		$mid = $_SESSION['user_id'];
		
	if(isset($_POST['submit']))
	{	
		$from = $_SESSION['user_id'];	
		$subject="Hello Admin";
		$message=$_POST['message'];
		$to="admin";
		$status='Unread';
		$insert=mysql_query("insert into messages (to_id,from_id,subject,message,sent_date,status) values ('$to','$from','$subject','$message',now(),'$status')") or die(mysql_error());
		$success='Your Message Sent Successfully.';
		
	}

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

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/dropdown-v9.js"></script>
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
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

</head>
<body>		

        <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Contact to Admin</li>
    </ol>
 		<div class="row">
    		
                <div class="col-sm-9 col-xs-12 col-sm-push-3 col-xs-push-0">
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Contact to Admin</h3>
                  </div>
                  <div class="panel-body">
                	 <div class="col-xs-12 padding-left-zero padding-right-zero">
                    <h3 class="panel-title" style="color:#B94A48; margin-bottom:10px; font-weight:bold;">Enter Query </h3>
                    <span>For any kind of help, you can send message to <?php echo $configObj->getConfigFname(); ?> Admin, He will contact you by message or email.</span>	
                    
                    <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
       
             
                           <div class="form-group" style="margin-top:10px;">
                <label for="inputPassword3" class="col-sm-3 control-label">Enter Message &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-6 col-xs-12">
                  <textarea class="form-control col-xs-12" id="message" name="message" data-validation-engine="validate[required]" placeholder="Type Proper Message..." rows="5"></textarea>
                 
                            </div>
                          </div> 
                             
                         
                          
                          <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success col-sm-3 col-xs-12">
                            </div>
                          </div>
                        </form>
                    </div>
                     
                     
                
                      
                  </div>
                </div>
          </div>
          <div class="col-sm-3 col-sm-pull-9 col-xs-12 col-xs-pull-0">      
         		<?php require_once 'advertise/add_single.php';?>	
         	</div>
      </div>	

        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>

</div>
 </body>
</html>
