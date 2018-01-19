<?php
error_reporting(0);
	session_start();
	require_once('dbConf.php');
	class DatabaseConn
	{
		var $dbLink;
		var $sqlQuery;
		var $dbResult;
		var $dbRow;
		
		
		function __construct()
		{
			$this->dbLink = '';
			$this->sqlQuery = '';
			$this->dbResult = '';
			$this->dbRow = '';
			
			/**************
			* End databse parameter
			*****************/
			
			
			$this->dbLink = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			mysql_select_db(DB_DATABASE, $this->dbLink);
			mysql_query("set names 'utf8'",$this->dbLink);
		}
		function convertToLocalHtml($localHtmlEquivalent)
		{
			$localHtmlEquivalent = mb_convert_encoding($localHtmlEquivalent,"HTML-ENTITIES","UTF-8");
			return $localHtmlEquivalent;
		}

		function getSelectQueryResult($selectQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $selectQuery;
			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			return $this->dbResult;
		}
		function updateData($updateQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $updateQuery;

			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			
			if($this->dbResult)
				return true;
			else
				return false;
		}
	}
        include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
        
        $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
        $STATUS_MESSAGE = "";
	if($isPostBack)
        {
            $username = isset($_POST['username'])?$_POST['username']:"";
            $password = md5(isset($_POST['password'])?$_POST['password']:"");
            
             $SQL_STATEMENT = "select * from admin_users where uname='".$username."' and pswd='".$password."' and role_id='1'";
             $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                $statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
                
                if($statusObj->getActionSuccess())
                {
                 
                       
                        $_SESSION['admin_user_name'] = $DatabaseCo->dbRow->uname;
                        $_SESSION['admin_user_id'] = $DatabaseCo->dbRow->id;
                        
						 echo "<script>window.location='dashboard.php'</script>";
                       
                       
                }else{
                    $STATUS_MESSAGE = "Email or password was incorrect";
                }
                
        
        }
        if(isset($_GET['option']))
        {
        	if($_GET['option']=="logout")
        	{
        
        		unset($_SESSION['admin_user_name']);
        		unset($_SESSION['admin_user_id']);
        		$STATUS_MESSAGE = "You are successfully loggged out.";
        			
        	}
        }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Login Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
 <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.horizontal.scroll.css" />
		<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
		<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />	
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
</head>
<body id="login-body">
 	<div id="logo-wrapper">
    	<h2 class="logo">Admin Panel</h2>
    
    	<div class="login-box cf">
    		<h3 class="title">Log In</h3>
            <form action="" method="post">
             
            	<p class="error-msg-text">
            	
            	 <?php
					if(!empty($STATUS_MESSAGE))
					{	
					
							echo  $STATUS_MESSAGE;
					}
			?>
            	</p>
                <p><label  class="email-label">Email</label></p>
                <p><input type="text" class="email-desc" name="username"/></p>
                <p><label  class="email-label">Password</label></p>
                <p><input type="password" class="email-desc" name="password" /></p>
                <p><input type="submit" value="Log In" class="login-btn"/>
                <a href="forgot.php" title="Forgot Your Password?" class="forgot-pwd">Forgot Your Password?</a>
                </p>
            </form>
    	</div>
    </div>
</body>
</html>
