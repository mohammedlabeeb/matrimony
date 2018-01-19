<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();

$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{	
	$to_id = $_POST['to_id'];
	$from_id = 'admin';
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$status = 'Unread';
	
	
	$errorFlag = false;
	$erroMessage = "";
	
	if(empty($to_id))
	{
		$erroMessage .= "<li>Select person to send message.</li>";
		$errorFlag = true;
	}	
	if(empty($subject))
	{
		$erroMessage .= "<li>Subject is required.</li>";
		$errorFlag = true;
	}
	if(empty($message))
	{
		$erroMessage .= "<li>Message is required.</li>";
		$errorFlag = true;
	}
		
	$response = array();
	
	if(!$errorFlag)
	{
		$SQL_STATEMENT = "insert into messages (sent_date,subject,message,from_id,to_id,status) values
		 (now(),'".$subject."','".$message."','".$from_id."','".$to_id."','".$status."')";
		$statusObj = handle_post_request("ADD",$SQL_STATEMENT,$DatabaseCo);
        $STATUS_MESSAGE = $statusObj->getStatusMessage();
		
		$response['successStatus'] = $statusObj->getActionSuccess();
        $response['responseMessage'] = $STATUS_MESSAGE;
		
        header('Content-type: application/json');
        echo json_encode($response);		
					 
	}
	else
	{
		$response['successStatus'] = false;
	    $response['responseMessage'] = $erroMessage;
	    header('Content-type: application/json');
	    echo json_encode($response);
	}	
	
}
?>