<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

   $address = "";

    $country_id = "";

    $state_id = "";

    $city = "";

    $residence = "";
	
	$mobile = "";
	
	$phone = "";
	
	$time_to_call = "";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";
		
			if(empty($_POST['address']))
			{
            	$erroMessage .= "<li>Address is required.</li>";
            	$errorFlag = true;
            }

            if(empty($_POST['txtCountry']))
			{
            	$erroMessage .= "<li>Country is required.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['state']))
			{
            	$erroMessage .= "<li>State is required.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['city']))
			{
            	$erroMessage .= "<li>City is required.</li>";
            	$errorFlag = true;
            }
           	     
            if(empty($_POST['residence']))
			{
            	$erroMessage .= "<li>Residence status is required.</li>";
            	$errorFlag = true;            	
             }
			 if(empty($_POST['mobile']))
			{
            	$erroMessage .= "<li>Mobile status is required.</li>";
            	$errorFlag = true;            	
             }            	                  
                                      
             
            if(!$errorFlag)
            {

				$address = $_POST['address'];
                $country_id = $_POST['txtCountry'];
                $state_id = $_POST['state'];
				$city = $_POST['city'];
                $residence = $_POST['residence'];
				$mobile = $_POST['mobile'];
				$phone = $_POST['phone'];
				$time_to_call = $_POST['time_to_call'];
              
                
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			    $SQL_STATEMENT = "UPDATE register set address='".$address."',country_id='".$country_id."',state_id='".$state_id."',city='".$city."',residence='".$residence."',mobile='".$mobile."',phone='".$phone."',time_to_call='".$time_to_call."'  where  index_id=".$user_id;			    
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