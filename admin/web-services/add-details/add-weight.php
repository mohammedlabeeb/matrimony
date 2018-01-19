<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$weight_id = isset($_GET['weight_id']) ? $_GET['weight_id'] :"" ;
$weight_value = "";
$unit="";
$weight_visibility_status ="";

$weightRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['weight_value'])){
            	$erroMessage .= "<li>Weight Value should not be empty.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['unit'])){
            	$erroMessage .= "<li>Unit should not be empty.</li>";
            	$errorFlag = true;
            }
			else{
            	if(strlen($_POST['weight_value']) < 2){
            		$erroMessage .= "<li>Weight Value should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['weight_visibility_status'])){
			$erroMessage .= "<li>Weight Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$weight_value = $_POST['weight_value'];
				$unit = $_POST['unit'];
            	$weight_visibility_status = $_POST['weight_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into weight (weight_id,unit,value,status) 
							 values ('','".$unit."','".$weight_value."','".$weight_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $weight_id = $_POST['weight_id'];
                            $SQL_STATEMENT =  "UPDATE weight  set unit='".$unit."',value='".$weight_value."',status='".$weight_visibility_status."' WHERE weight_id=".$weight_id;	
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