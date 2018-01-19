<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$sid = isset($_GET['sid']) ? $_GET['sid'] :"" ;

$icon_name = "";
$icon_visibility_status ="";

$countryRealID = "Real-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['icon_name']))
			{
            	$erroMessage .= "<li>Icon Name should not be empty.</li>";
            	$errorFlag = true;
            }
			else
			{
            	if(strlen($_POST['icon_name']) < 1)
				{
            		$erroMessage .= "<li>Icon Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['icon_visibility_status'])){
			$erroMessage .= "<li>Icon Status should not be empty.</li>";
			$errorFlag = true;
          	}
				
            if($errorFlag!=true)
            {
				$icon_name = $_POST['icon_name'];
            	$icon_visibility_status = $_POST['icon_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                           $SQL_STATEMENT = "INSERT into social_networking_icon (sid,sname,simg,slink,status)  values ('','".$icon_name."','".$icon_image."',,'".$icon_link."',,'".$icon_visibility_status."')";
    
                            break;
                    case 'UPDATE':
                            $sid = $_POST['sid'];
                            $SQL_STATEMENT =  "UPDATE social_networking_icon  set sname='".$country_name."',simg='".$icon_image."',slink='".$icon_link."',status='".$icon_visibility_status."' WHERE sid=".$sid;
                            break;
                            
            }
    
             $statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
             $STATUS_MESSAGE = $statusObj->getStatusMessage();
	     
	     
	     $response = array();
	     $response['successStatus'] = $statusObj->getActionSuccess();
	     $response['responseMessage'] = $STATUS_MESSAGE;
	     header('Content-type: application/json');
	     echo json_encode($response);
	   	}
	   	else
	   	{
	   	 	
	     $response = array();
	     $response['successStatus'] = false;
	     $response['responseMessage'] = $erroMessage;
	     header('Content-type: application/json');
	     echo json_encode($response);	   		
	   	}
	   	
}

?>