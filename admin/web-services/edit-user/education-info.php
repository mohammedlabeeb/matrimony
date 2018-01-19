<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

   $income = "";

    $edu_detail = "";

    $occupation = "";
	
	$emp_in = "";

    
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";

		
            if(empty($_POST['education']))
			{
            	$erroMessage .= "<li>Education is required.</li>";
            	$errorFlag = true;
            }
			
            if(empty($_POST['occupation']))
			{
            	$erroMessage .= "<li>Occupation is required.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['annual_income']))
			{
            	$erroMessage .= "<li>Annual Income required.</li>";
            	$errorFlag = true;
            }
			if(empty($_POST['emp_in']))
			{
            	$erroMessage .= "<li>Employed In is required.</li>";
            	$errorFlag = true;
            }
			
            
            
                                            
             
            if(!$errorFlag)
            {

                $education = implode(",",$_POST['education']);
                $annual_income = $_POST['annual_income'];
                $occupation = $_POST['occupation'];
				$emp_in = $_POST['emp_in'];
                
                
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			   $SQL_STATEMENT = "UPDATE register set edu_detail='".$education."', 	income='".$annual_income."',occupation='".$occupation."',emp_in='".$emp_in."'  where  index_id=".$user_id;			    
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