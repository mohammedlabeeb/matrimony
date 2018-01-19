<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

    $expectation = "";

    $looking_for = "";

    $part_frm_age = "";

    $part_to_age = "";

    $part_country_living = "";

    $part_height = "";

    $part_height_to = "";

    $part_edu = "";	
	
	$part_complexion = "";
	
	$part_mtongue = "";
	
	$part_religion = "";
	
	$part_caste = "";
	
	$part_income = "";
	
	
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";
		
            if(empty($_POST['part_m_status']))
			{
            	$erroMessage .= "<li>Looking for is required.</li>";
				
            	$errorFlag = true;
            }
            if(empty($_POST['part_to_age']))
			{
            	$erroMessage .= "<li>Partner age from is required.</li>";
            	$errorFlag = true;
            }
            if(empty($_POST['part_from_age']))
			{
            	$erroMessage .= "<li>Partner age to is required.</li>";
            	$errorFlag = true;            	
             }	     
            if(empty($_POST['from_height']))
			{
            	$erroMessage .= "<li>Partner from height is required.</li>";
            	$errorFlag = true;            	
            }            	                  
            if(empty($_POST['to_height']))
			{
            	$erroMessage .= "<li>Partner to height is required.</li>";
            	$errorFlag = true;            	
            }				
            if(empty($_POST['txtPcountry']))
			{
            	$erroMessage .= "<li>Partner Country living in is required.</li>";
            	$errorFlag = true;            	
            }
            if(empty($_POST['txtEducation']))
			 {
            	$erroMessage .= "<li>Partner education is required.</li>";
            	$errorFlag = true;            	
             }
            if(empty($_POST['part_m_tongue']))
			{
            	$erroMessage .= "<li>Partner Mother Tongue is required.</li>";
            	$errorFlag = true;            	
             }
			  if(empty($_POST['txtreligion']))
			{
            	$erroMessage .= "<li>Partner Religion is required.</li>";
            	$errorFlag = true;            	
             }
            
            if(empty($_POST['part_caste_id']))
			{
            	$erroMessage .= "<li>Partner Caste is required.</li>";
            	$errorFlag = true;            	
             }                                 
             
            if(!$errorFlag)
            {

                
				$part_m_status_arr = implode(", ",$_POST['part_m_status']);				
                $part_from_age = $_POST['part_from_age'];
                $part_to_age = $_POST['part_to_age'];
				$from_height = $_POST['from_height'];
                $to_height = $_POST['to_height'];
				
                $part_country = $_POST['txtPcountry'];
				$part_country_arr = implode(",",$part_country);
                
                $education = $_POST['txtEducation'];
				$education_arr = implode(",",$education);
				
                $expectation = $_POST['expectation'];				
				
				$txtComplexion = $_POST['txtComplexion'];
				$txtComplexion_arr = implode(", ",$txtComplexion);
				
                $residence = $_POST['residence'];
				$residence_arr = implode(", ",$residence);
				
				$part_m_tongue = $_POST['part_m_tongue'];
				$part_m_tongue_arr = implode(",",$part_m_tongue);
				
				$txtreligion = $_POST['txtreligion'];
				$txtreligion_arr = implode(",",$txtreligion);
				
				$caste_id = $_POST['part_caste_id'];
				$caste_id_arr = implode(",",$caste_id);
				
				$part_income = $_POST['part_income'];
                
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			 $SQL_STATEMENT = "UPDATE register set part_country_living='".$part_country_arr."',part_edu='".$education_arr."',part_caste='".$caste_id_arr."',part_religion='".$txtreligion_arr."',part_resi_status='".$residence_arr."',looking_for='".$part_m_status_arr."',part_frm_age='".$part_from_age."',part_to_age='".$part_to_age."',part_height='".$to_height."',part_height_to='".$from_height."',part_complexation='".$txtComplexion_arr."',part_expect='".$expectation."',part_mtongue='".$part_m_tongue_arr."',part_income='".$part_income."' where  index_id=".$user_id;			    
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