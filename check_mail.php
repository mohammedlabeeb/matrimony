<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		
		$email_id =$_GET['emailID'];       
	     $sql_check = mysql_query("select * from register where email='".$email_id."'") or die(mysql_error());
		 
    $check2 = mysql_num_rows($sql_check);
	if($check2 != 0)
	{
		echo "1";
	}
    //if the name exists it gives an error
    
?>