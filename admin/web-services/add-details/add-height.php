<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$height_id = isset($_GET['height_id']) ? $_GET['height_id'] :"" ;
$height_value = "";
$unit="";
$height_visibility_status ="";

$heightRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['height_value'])){
            	$erroMessage .= "<li>Height Value should not be empty.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['unit'])){
            	$erroMessage .= "<li>Unit should not be empty.</li>";
            	$errorFlag = true;
            }
			else{
            	if(strlen($_POST['height_value']) < 2){
            		$erroMessage .= "<li>Height Value should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['height_visibility_status'])){
			$erroMessage .= "<li>Height Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$height_value = $_POST['height_value'];
				$unit = $_POST['unit'];
            	$height_visibility_status = $_POST['height_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into height (height_id,unit,value,status) 
							 values ('','".$unit."','".$height_value."','".$height_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $height_id = $_POST['height_id'];
                            $SQL_STATEMENT =  "UPDATE height  set unit='".$unit."',value='".$height_value."',status='".$height_visibility_status."' WHERE height_id=".$height_id;	
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