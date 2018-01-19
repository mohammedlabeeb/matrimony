<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$USER_ID = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

    $business_id = "";
    $business_title = "";
    $address = "";
    $city_id = "";
    $contact_no = "";
    $email= "";
    $website = "";
	$business_detail = "";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";

            if(empty($_POST['business_title'])){
            	$erroMessage .= "<li>Business Title is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['business_title']) < 5){
            		$erroMessage .= "<li>Business Title should be atleast 5 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['address'])){
            	$erroMessage .= "<li>Address is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['address']) < 5){
            		$erroMessage .= "<li>Address should be atleast 5 characters.</li>";
            		$errorFlag = true;
            	}
            }
            

            if(empty($_POST['country_id'])){
            	$erroMessage .= "<li>Country Should be required.</li>";
            	$errorFlag = true;            	
             }            	                              
            if(empty($_POST['state_id'])){
            	$erroMessage .= "<li>State Should be required.</li>";
            	$errorFlag = true;            	
             }            	                  
            if(empty($_POST['city_id'])){
            	$erroMessage .= "<li>City Should be required.</li>";
            	$errorFlag = true;            	
             }
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            		$erroMessage .= "<li>Email should be valid email.</li>";
            		$errorFlag = true;                    
            }
            if(!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
            		$erroMessage .= "<li>Website should be valid URL start with http://.</li>";
            		$errorFlag = true;                    
            }            
			if(empty($_POST['business_detail'])){
				$erroMessage .= "<li>Business detail should be required.</li>";
				$errorFlag = true;            	
			}            	                  
            if(!$errorFlag)
            {

		$business_title = $_POST['business_title'];
		$address = $_POST['address'];
		$city_id = $_POST['city_id'];
		$contact_no = $_POST['contact_no'];
		$email= $_POST['email'];
		$website = $_POST['website'];
		$business_detail = $_POST['business_detail'];
                
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'ADD':
			    $SQL_STATEMENT = "INSERT INTO user_business  (BUSINESS_ID,BUSINESS_TITLE,BUSINESS_ADDRESS,CITY_ID,CONTACT_NO,EMAIL,WEBSITE,BUSINESS_DETAIL,B_USER_ID) VALUES ('','".$business_title."','".$address."',".$city_id.",'".$contact_no."','".$email."','".$website."',\"".htmlspecialchars($business_detail, ENT_QUOTES)."\",".$USER_ID.")";
    
    
			    break;
		    case 'UPDATE':
			    $SQL_STATEMENT = "UPDATE user_business  set  BUSINESS_TITLE='".$business_title."',BUSINESS_ADDRESS='".$address."',CITY_ID=".$city_id.",CONTACT_NO='".$contact_no."',EMAIL='".$email."',WEBSITE='".$website."',BUSINESS_DETAIL=\"".htmlspecialchars($business_detail, ENT_QUOTES)."\"  where B_USER_ID=".$USER_ID;			    
			    break;
                                    
                 }
                
		$statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
		$STATUS_MESSAGE = $statusObj->getStatusMessage();
		
		$response = array();
		$response['successStatus'] = $statusObj->getActionSuccess();
		$response['responseMessage'] = $STATUS_MESSAGE;
		$response['maxId'] = $USER_ID;

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