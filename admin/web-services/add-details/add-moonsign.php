<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$moonsign_id = isset($_GET['moonsign_id']) ? $_GET['moonsign_id'] :"" ;
$moonsign_name = "";
$moonsign_visibility_status ="";

$moonsignRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['moonsign_name'])){
            	$erroMessage .= "<li>Moonsign Name should not be empty.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['moonsign_visibility_status'])){
			$erroMessage .= "<li>Moonsign Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$moonsign_name = $_POST['moonsign_name'];
            	$moonsign_visibility_status = $_POST['moonsign_visibility_status'];
    			$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into moonsign (moonsign_id,moonsign_name,status) 
							 values ('','".$moonsign_name."','".$moonsign_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $moonsign_id = $_POST['moonsign_id'];
                            $SQL_STATEMENT =  "UPDATE moonsign set moonsign_name='".$moonsign_name."',status='".$moonsign_visibility_status."' WHERE moonsign_id=".$moonsign_id;	
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