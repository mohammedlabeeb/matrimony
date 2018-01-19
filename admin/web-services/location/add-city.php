<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$CITY_ID = isset($_GET['city_id']) ? $_GET['city_id'] :"" ;

$city_name = "";
$city_visibility_status ="";
$state_id = "";
$country_id = "";

$cityRealID = "Real-";
	
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

            if(empty($_POST['state_id'])){
            	$erroMessage .= "<li>State Should be required.</li>";
            	$errorFlag = true;            	
             }            	                  

            if(empty($_POST['city_name'])){
            	$erroMessage .= "<li>City Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['city_name']) < 1){
            		$erroMessage .= "<li>City Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['city_visibility_status'])){
			$erroMessage .= "<li>City Status should not be empty.</li>";
			$errorFlag = true;
             }
	    
            if(!$errorFlag)
            {

							$city_name = $_POST['city_name'];
            	$city_visibility_status = $_POST['city_visibility_status'];
    					$state_id = $_POST['state_id'];
    					$country_id = $_POST['country_id'];
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into city (CITY_ID,STATE_ID,COUNTRY_ID,CITY_NAME,STATUS) values ('',".$state_id.",".$country_id.",'".$city_name."','".$city_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $city_id = $_POST['city_id'];
                            $SQL_STATEMENT =  "UPDATE city  set CITY_NAME='".$city_name."',STATUS='".$city_visibility_status."',COUNTRY_ID=".$country_id.",STATE_ID=".$state_id." WHERE CITY_ID=".$city_id;	
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