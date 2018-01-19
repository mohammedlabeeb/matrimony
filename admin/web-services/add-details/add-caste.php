<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$caste_id = isset($_GET['caste_id']) ? $_GET['caste_id'] :"" ;

$caste_name = "";
$caste_visibility_status ="";
$religion_id = "";
$casteRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();

	
	$errorFlag = false;
	$erroMessage = "";
            if(empty($_POST['religion_id'])){
            	$erroMessage .= "<li>Religion Should be required.</li>";
            	$errorFlag = true;            	
             }            	     
	
            if(empty($_POST['caste_name'])){
            	$erroMessage .= "<li>Caste Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['caste_name']) < 1){
            		$erroMessage .= "<li>Caste Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['caste_visibility_status'])){
			$erroMessage .= "<li>Caste Status should not be empty.</li>";
			$errorFlag = true;
             }
	    
            if(!$errorFlag)
            {
		$caste_name = $_POST['caste_name'];
            	$caste_visibility_status = $_POST['caste_visibility_status'];
		$religion_id = $_POST['religion_id'];										
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into caste  (caste_id,religion_id,caste_name,status)  values ('',".$religion_id.",'".$caste_name."','".$caste_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $caste_id = $_POST['caste_id'];
                            $SQL_STATEMENT =  "UPDATE caste  set caste_name='".$caste_name."',status='".$caste_visibility_status."',religion_id=".$religion_id." WHERE caste_id=".$caste_id;	
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