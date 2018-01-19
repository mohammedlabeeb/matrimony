<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$bg_id = isset($_GET['bg_id']) ? $_GET['bg_id'] :"" ;
$bg_name = "";
$blood_group_visibility_status ="";

$blood_groupRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['bg_name'])){
            	$erroMessage .= "<li>Blood Group should not be empty.</li>";
            	$errorFlag = true;
            }
			
            if(empty($_POST['blood_group_visibility_status'])){
			$erroMessage .= "<li>Blood Group Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$bg_name = $_POST['bg_name'];
            	$blood_group_visibility_status = $_POST['blood_group_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into blood_group (bg_id,bg_name,status) 
							 values ('','".$bg_name."','".$blood_group_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $bg_id = $_POST['bg_id'];
                            $SQL_STATEMENT =  "UPDATE blood_group set bg_name='".$bg_name."',status='".$blood_group_visibility_status."' WHERE bg_id=".$bg_id;	
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