<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$country_id = isset($_GET['country_id']) ? $_GET['country_id'] :"" ;

$country_name = "";
$country_visibility_status ="";

$countryRealID = "Real-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['country_name'])){
            	$erroMessage .= "<li>Country Name should not be empty.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['country_name']) < 1){
            		$erroMessage .= "<li>Country Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['country_visibility_status'])){
			$erroMessage .= "<li>Country Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$country_name = $_POST['country_name'];
            	$country_visibility_status = $_POST['country_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into country (country_id,country_name,status)  values ('','".$country_name."','".$country_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $country_id = $_POST['country_id'];
                            $SQL_STATEMENT =  "UPDATE country  set country_name='".$country_name."',status='".$country_visibility_status."' WHERE country_id=".$country_id;	
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