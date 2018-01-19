<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$religion_ID = isset($_GET['mtongue_id']) ? $_GET['mtongue_id'] :"" ;

$mtongue_name = "";
$mtongue_visibility_status ="";

$religionRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['mtongue_name'])){
            	$erroMessage .= "<li>Mothertongue Name should not be empty.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['mtongue_name']) < 1){
            		$erroMessage .= "<li>Mothertongue Name should be atleast 2 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['mtongue_visibility_status'])){
			$erroMessage .= "<li>Mothertongue Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$mtongue_name = $_POST['mtongue_name'];
            	$mtongue_visibility_status = $_POST['mtongue_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into  mothertongue (mtongue_id,mtongue_name,status)  values ('','".$mtongue_name."','".$mtongue_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $mtongue_id = $_POST['mtongue_id'];
                            $SQL_STATEMENT =  "UPDATE  mothertongue  set mtongue_name='".$mtongue_name."',status='".$mtongue_visibility_status."' WHERE mtongue_id=".$mtongue_id;	
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