<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$religion_ID = isset($_GET['religion_id']) ? $_GET['religion_id'] :"" ;

$religion_name = "";
$religion_visibility_status ="";

$religionRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['religion_name'])){
            	$erroMessage .= "<li>Religion Name should not be empty.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['religion_name']) < 1){
            		$erroMessage .= "<li>Religion Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['religion_visibility_status'])){
			$erroMessage .= "<li>Religion Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
		$religion_name = $_POST['religion_name'];
            	$religion_visibility_status = $_POST['religion_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into religion (religion_id,religion_name,status)  values ('','".$religion_name."','".$religion_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $religion_id = $_POST['religion_id'];
                            $SQL_STATEMENT =  "UPDATE religion  set religion_name='".$religion_name."',status='".$religion_visibility_status."' WHERE religion_id=".$religion_id;	
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