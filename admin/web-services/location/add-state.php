<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$STATE_ID = isset($_GET['state_id']) ? $_GET['state_id'] :"" ;

$state_name = "";
$state_visibility_status ="";
$country_id = "";
$stateRealID = "Real-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();

	
	$errorFlag = false;
	$erroMessage = "";
            if(empty($_POST['country_id'])){
            	$erroMessage .= "<li>Country Should be required.</li>";
            	$errorFlag = true;            	
             }            	     
	
            if(empty($_POST['state_name'])){
            	$erroMessage .= "<li>State Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['state_name']) < 1){
            		$erroMessage .= "<li>State Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['state_visibility_status'])){
			$erroMessage .= "<li>State Status should not be empty.</li>";
			$errorFlag = true;
             }
	    
            if(!$errorFlag)
            {
		$state_name = $_POST['state_name'];
            	$state_visibility_status = $_POST['state_visibility_status'];
		$country_id = $_POST['country_id'];										
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into state  (STATE_ID,COUNTRY_ID,STATE_NAME,STATUS)  values ('',".$country_id.",'".$state_name."','".$state_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $state_id = $_POST['state_id'];
                            $SQL_STATEMENT =  "UPDATE state  set STATE_NAME='".$state_name."',STATUS='".$state_visibility_status."',COUNTRY_ID=".$country_id." WHERE STATE_ID=".$state_id;	
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