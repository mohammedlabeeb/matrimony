<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

    $height = "";
	$weight = "";
	$complexion = "";
	$b_group = "";
    $body_type = "";
	$diet = "";
	$smoke = "";
	$drink = "";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";

            if(empty($_POST['height']))
			{
            	$erroMessage .= "<li>Height is required.</li>";
            	$errorFlag = true;
            }
			 if(empty($_POST['weight']))
			{
            	$erroMessage .= "<li>Weight is required.</li>";
            	$errorFlag = true;
            }
			 
            if(!$errorFlag)
            {

                $height = $_POST['height'];
				$weight = $_POST['weight'];
				$complexion = $_POST['complexion'];
				$blood_group = $_POST['blood_group'];
                $body_type = $_POST['body_type'];
				$diet = $_POST['diet'];
				$smoke = $_POST['smoke'];
				$drink = $_POST['drink'];
				
    
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			    $SQL_STATEMENT = "UPDATE register set  height='".$height."',weight='".$weight."',b_group='".$blood_group."',complexion='".$complexion."',bodytype='".$body_type."',diet='".$diet."',smoke='".$smoke."',drink='".$drink."' where index_id=".$user_id;			    
			    break;
                                    
                 }
                
		$statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();
		
		$MAX_INDEX_ID = $user_id;
		
		$response = array();
		$response['successStatus'] = $statusObj->getActionSuccess();
		$response['responseMessage'] = $STATUS_MESSAGE;
		$response['maxId'] = $MAX_INDEX_ID;

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