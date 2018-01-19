<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$inc_id = isset($_GET['inc_id']) ? $_GET['inc_id'] :"" ;

$income_rate = "";
$currency="";
$income_visibility_status ="";

$incomeRealID = "Matri-";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{
		
	$statusObj = new Status();
	$errorFlag = false;
            $erroMessage = "";
            if(empty($_POST['income_rate'])){
            	$erroMessage .= "<li>Income Amonut should not be empty.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['currency'])){
            	$erroMessage .= "<li>Currency should not be empty.</li>";
            	$errorFlag = true;
            }
			else{
            	if(strlen($_POST['income_rate']) < 4){
            		$erroMessage .= "<li>Income Amonut should be atleast 4 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['income_visibility_status'])){
			$erroMessage .= "<li>Income Status should not be empty.</li>";
			$errorFlag = true;
          	}	
            if(!$errorFlag)
            {
				$income_rate = $_POST['income_rate'];
				$currency = $_POST['currency'];
            	$income_visibility_status = $_POST['income_visibility_status'];
    
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
            	switch($ACTION)
            	{
                    case 'ADD':
                            $SQL_STATEMENT = "INSERT into income (inc_id,currency,income_rate,status) 
							 values ('','".$currency."','".$income_rate."','".$income_visibility_status."')";

    
                            break;
                    case 'UPDATE':
                            $inc_id = $_POST['inc_id'];
                            $SQL_STATEMENT =  "UPDATE income  set currency='".$currency."',income_rate='".$income_rate."',status='".$income_visibility_status."' WHERE inc_id=".$inc_id;	
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