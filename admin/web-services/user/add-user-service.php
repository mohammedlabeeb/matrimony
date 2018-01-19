<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';
include_once '../../class/SiteSetting.class.php';


$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$USER_ID = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

$sitesettingObj = new SiteSetting();

$userRealID = $sitesettingObj->getDbRecPrefix()."-User-";

    $user_name = "";
    $password = "";
    $user_role = "";
    $first_name = "";
    $last_name = "";
    $address = "";
    $country_id = "";
    $state_id = "";
    $city_id = "";
	$locality_id = "";
    $zip = "";
    $user_imae = "";
    $user_image_type = "";
    $membership_plan = "";
    $status = "";
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{


$statusObj = new Status();

$errorFlag = false;
$erroMessage = "";

            if(empty($_POST['user_name'])){
            	$erroMessage .= "<li>User Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['user_name']) < 5){
            		$erroMessage .= "<li>User Name should be atleast 5 characters.</li>";
            		$errorFlag = true;
            	}
                if(!filter_var($_POST['user_name'], FILTER_VALIDATE_EMAIL)) {
            		$erroMessage .= "<li>User Name should be valid email.</li>";
            		$errorFlag = true;                    
                }
            }
            if(empty($_POST['password'])){
            	$erroMessage .= "<li>Password is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['password']) < 5){
            		$erroMessage .= "<li>Password should be atleast 5 characters.</li>";
            		$errorFlag = true;
            	}
            }            
            if(empty($_POST['user_role'])){
            	$erroMessage .= "<li>User Role should not be empty.</li>";
            	$errorFlag = true;            	
             }
            if(empty($_POST['first_name'])){
            	$erroMessage .= "<li>First Name is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['first_name']) < 3){
            		$erroMessage .= "<li>First Name should be atleast 3 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['last_name'])){
            	$erroMessage .= "<li>Last Namr is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['last_name']) < 3){
            		$erroMessage .= "<li>Last Name should be atleast  characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['address'])){
            	$erroMessage .= "<li>Address is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['address']) < 10){
            		$erroMessage .= "<li>Address should be atleast  10characters.</li>";
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
			if(empty($_POST['locality_id'])){
				$erroMessage .= "<li>Locality Should be required.</li>";
				$errorFlag = true;            	
			}			 
            if(empty($_POST['zip'])){
            	$erroMessage .= "<li>ZIP is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['zip']) < 5){
            		$erroMessage .= "<li>ZIP should be atleast  5 characters.</li>";
            		$errorFlag = true;
            	}
            }
            if(empty($_POST['mobile_no'])){
            	$erroMessage .= "<li>Mobile No is required.</li>";
            	$errorFlag = true;
            }else{
            	if(strlen($_POST['mobile_no']) < 10){
            		$erroMessage .= "<li>Mobile Np should be atleast  10 characters.</li>";
            		$errorFlag = true;
            	}
            }
	    
            if(empty($_POST['membership_plan'])){
            	$erroMessage .= "<li>Membership Plan is required.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['user_status'])){
			$erroMessage .= "<li>User Status should not be empty.</li>";
			$errorFlag = true;

            }            
             
	    
            if(!$errorFlag)
            {

                $user_name = $_POST['user_name'];
                $password = $_POST['password'];
                $user_role = $_POST['user_role'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $address = $_POST['address'];
                $country_id = $_POST['country_id'];
                $state_id = $_POST['state_id'];
                $city_id = $_POST['city_id'];
				$locality_id = $_POST['locality_id'];
				
                $zip = $_POST['zip'];
            
                $mobile_no = $_POST['mobile_no'];
                $contact_no = $_POST['contact_no'];
                $membership_plan = $_POST['membership_plan'];
                $status = $_POST['user_status'];		
                $is_featured = $_POST['featured'];
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
		$ERROR_FLAG = false;
	    if($ACTION=="ADD")
	    {
		if(empty($_FILES['image_file']))
		    $ERROR_FLAG = true;
	    }	
            if(!isset($_POST['image_flag'])  && $ERROR_FLAG!=true)
            {
                   if(isset($_FILES['image_file'])){
		    $image_blob_type = $_FILES['image_file']['type'];
                    $image_blob_size =$_FILES['image_file']['size'];
		    
                    $fileHandle = fopen($_FILES['image_file']['tmp_name'], "rb");
                    $fileContent = fread($fileHandle, $image_blob_size);
                    $fileContent = addslashes($fileContent);
                    $ERROR_FLAG =  false;
                    if(empty($fileContent)){
                             $STATUS_MESSAGE="File content could not be empty";
                             $statusObj->setActionSuccess(false);
                             $ERROR_FLAG = true;
                    }
                    else if(strncmp($image_blob_type,"image",4)){
                                    $STATUS_MESSAGE="File type is not an image file.";
                                    $statusObj->setActionSuccess(false);
                                    $ERROR_FLAG = true;
                    }
		   }else{
		     $STATUS_MESSAGE="File content could not be empty";
                             $statusObj->setActionSuccess(false);
                             $ERROR_FLAG = true;
		   }
            }

            if($ERROR_FLAG != true)
            {
                      $today = date("F j, Y");
                        switch($ACTION)
                        {
                            case 'ADD':
                                   
                                    $SQL_STATEMENT = "call addUser('".$userRealID."','".$user_name."','".$password."','".$first_name."','".$last_name."','".$address."',".$locality_id.",'".$zip."','".$mobile_no."','".$contact_no."',".$membership_plan.",".$user_role.",'".$fileContent."','".$image_blob_type."','".$status."',0,'".$today."')";
        
            
                                    break;
                            case 'UPDATE':
                                    $user_id = $_POST['user_id'];
				    if(isset($_POST['image_flag']) && $_POST['image_flag']=="true"){
                                    $SQL_STATEMENT = "call updateUser(".$user_id.",'".$user_name."','".$password."','".$first_name."','".$last_name."','".$address."',".$locality_id.",'".$zip."','".$mobile_no."','".$contact_no."',".$membership_plan.",".$user_role.",'".$status."',".$is_featured.",'".$today."')";	
								
							}else{
                                    $SQL_STATEMENT = "call updateUserWithImage(".$user_id.",'".$user_name."','".$password."','".$first_name."','".$last_name."','".$address."',".$locality_id.",'".$zip."','".$mobile_no."','".$contact_no."',".$membership_plan.",".$user_role.",'".$fileContent."','".$image_blob_type."','".$status."',".$is_featured.",'".$today."')";
				}
                                    break;
                                    
                        }
                    
                     $statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
                     $STATUS_MESSAGE = $statusObj->getStatusMessage();
                     $MAX_USER_ID = 0; 
		     if($statusObj->getActionSuccess() && $ACTION=="ADD")
		     {
			$MAX_ID_QUERY = "SELECT max(USER_ID) as 'MAX_USER_ID' FROM users";
			$MAX_USER_ID = getRowCount($MAX_ID_QUERY,$DatabaseCo);
			$ADD_BUSINESS_SQL = "INSERT INTO user_business (BUSINESS_ID,B_USER_ID) values ('',".$MAX_USER_ID.")";
                     $statusObj = handle_post_request($ACTION,$ADD_BUSINESS_SQL,$DatabaseCo);
                     $STATUS_MESSAGE = $statusObj->getStatusMessage();			
			
		     }
		     else
		     {
			$MAX_USER_ID = $USER_ID;
		     }
                     $response = array();
                     $response['successStatus'] = $statusObj->getActionSuccess();
                     $response['responseMessage'] = $STATUS_MESSAGE;
					$response['maxId'] = $MAX_USER_ID;
                     //header('Content-type: application/json');
                     echo json_encode($response);
                    }
                    else
                    {
                        $response = array();
                        $response['successStatus'] = false;
                        $response['responseMessage'] = "<li>Please Select Proper User Image</li>";
                       // header('Content-type: application/json');
                        echo json_encode($response);	   		                        
                    }
	   	}
	   	else
	   	{
	     $response = array();
	     $response['successStatus'] = false;
	     $response['responseMessage'] = $erroMessage;
	     //header('Content-type: application/json');
	     echo json_encode($response);	   		
	   	}
	   	
}

?>