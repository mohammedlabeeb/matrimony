<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;
 
    $email = "";
    $password = "";
   
    
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";

            if(empty($_POST['email']))
			{
            	$erroMessage .= "<li>Email is required.</li>";
            	$errorFlag = true;
            }
           
                 	                  
            if(empty($_POST['conf_email']))
			{
            	$erroMessage .= "<li>Confirm Email be required.</li>";
            	$errorFlag = true;            	
            }
			 if($_POST['email']!=$_POST['conf_email'])
			{
            	$erroMessage .= "<li> Email is not matched.</li>";
            	$errorFlag = true;            	
            }
			
			            
            if(!$errorFlag)
            {

               
                $email = $_POST['email'];
				$password =$_POST['password'];
				
				               
                
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			
			if($password!='')
				{
					$SQL_STATEMENT = "UPDATE  register set email='".$email."',password='".md5($password)."' where index_id=".$user_id;
				}
			   else
			    {
   					$SQL_STATEMENT = "UPDATE  register set email='".$email."' where index_id=".$user_id;		   
				}	    
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