<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$LOCALITY_ID = isset($_GET['locality_id']) ? $_GET['locality_id'] :"" ;

$locality_name = "";
$locality_visibility_status ="";
$state_id = "";
$country_id = "";
$city_id= "";
$localityRealID = "Real-";
	
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

            if(empty($_POST['city_id'])){
            	$erroMessage .= "<li>City Should be required.</li>";
            	$errorFlag = true;            	
             }            	     
            if(empty($_POST['locality_name'])){
            	$erroMessage .= "<li>Locality Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['locality_name']) < 1){
            		$erroMessage .= "<li>Locality Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
	     
            if(empty($_POST['locality_visibility_status'])){
            	$erroMessage .= "<li>Locality Status should not be empty.</li>";
            	$errorFlag = true;
             }	    
            if(!$errorFlag)
            {

		$locality_name = $_POST['locality_name'];
            	$locality_visibility_status = $_POST['locality_visibility_status'];
		
		$country_id = $_POST['country_id'];
		$state_id = $_POST['state_id'];
		$city_id = $_POST['city_id'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into locality  (LOCALITY_ID,CITY_ID,STATE_ID,COUNTRY_ID,LOCALITY_NAME,STATUS) values ('',".$city_id.",".$state_id.",".$country_id.",'".$locality_name."','".$locality_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $locality_id = $_POST['locality_id'];
                            $SQL_STATEMENT =  "UPDATE locality  set LOCALITY_NAME='".$locality_name."',STATUS='".$locality_visibility_status."',COUNTRY_ID=".$country_id.",STATE_ID=".$state_id.",CITY_ID=".$city_id." WHERE LOCALITY_ID=".$locality_id;	
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