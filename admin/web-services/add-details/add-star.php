<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$star_id = isset($_GET['star_id']) ? $_GET['star_id'] :"" ;
$star_name = "";
$star_visibility_status ="";

$starRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['star_name'])){
            	$erroMessage .= "<li>Star Name should not be empty.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['star_visibility_status'])){
			$erroMessage .= "<li>Star Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$star_name = $_POST['star_name'];
            	$star_visibility_status = $_POST['star_visibility_status'];
    			$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into star (star_id,star_name,status) 
							 values ('','".$star_name."','".$star_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $star_id = $_POST['star_id'];
                            $SQL_STATEMENT =  "UPDATE star set star_name='".$star_name."',status='".$star_visibility_status."' WHERE star_id=".$star_id;	
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