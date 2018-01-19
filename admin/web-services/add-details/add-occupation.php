<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$ocp_id = isset($_GET['ocp_id']) ? $_GET['ocp_id'] :"" ;

$occupation_name = "";
$occupation_visibility_status ="";

$occupationRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['occupation_name'])){
            	$erroMessage .= "<li>Occupation should not be empty.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['occupation_name']) < 1){
            		$erroMessage .= "<li>Occupation should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['occupation_visibility_status'])){
			$erroMessage .= "<li>Occupation Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$occupation_name = $_POST['occupation_name'];
            	$occupation_visibility_status = $_POST['occupation_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into occupation (ocp_id,ocp_name,status)  values ('','".$occupation_name."','".$occupation_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $ocp_id = $_POST['ocp_id'];
                            $SQL_STATEMENT =  "UPDATE occupation  set ocp_name='".$occupation_name."',status='".$occupation_visibility_status."' WHERE ocp_id=".$ocp_id;	
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