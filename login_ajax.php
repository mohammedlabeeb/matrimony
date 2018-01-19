<?php 
include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();		     
	   $username = isset($_REQUEST['username'])?$_REQUEST['username']:"";
            $password = md5(isset($_REQUEST['password'])?$_REQUEST['password']:"");
            
			$STATUS_MESSAGE="";
            $SQL_STATEMENT = "select * from register where (matri_id='".$username."' OR email='".$username."') and password='".$password."' AND status!='Suspended'";
           
            $statusObj = handle_post_request("LOGIN",$SQL_STATEMENT,$DatabaseCo);
        if($statusObj->getActionSuccess())
         {
		    if($DatabaseCo->dbRow->status!='Inactive')
		    {
                          
                                $_SESSION['user_name'] = $DatabaseCo->dbRow->email;
                                $_SESSION['user_id'] = $DatabaseCo->dbRow->matri_id;
				$_SESSION['uname'] = $DatabaseCo->dbRow->username;
				$_SESSION['gender123'] = $DatabaseCo->dbRow->gender;
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

				 echo "1";
                              
                                }
                                else
                                {
                                echo 'Your account is under review. It will be activated within 24hrs';
                                }
                                }
                                else
                                {
                                   echo 'Your username or password is wrong. Please try again...';
                                }
  		
 ?>