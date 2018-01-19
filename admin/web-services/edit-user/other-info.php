<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;

    $profile_text = "";
    $hobby = "";		
	$txtFamilyDetails = "";
	$txtFamilyStatus = "";
	$txtFamilyType = "";
	$family_origin = "";
	$txtFathername = "";
	$txtFathersoccupation = "";
	$txtMothername = "";
	$txtMothersoccupation = "";
	$txtNoBrothers = "";
	$nbm = "";
	$txtnoofsisters = "";
	$nsm = "";

	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{

	    $statusObj = new Status();
	    
	    $errorFlag = false;
	    $erroMessage = "";

            if(empty($_POST['about_me']))
			{
            	$erroMessage .= "<li>Profile text is required.</li>";
            	$errorFlag = true;
            }
			
 		
			
             
            if(!$errorFlag)
            {
                	$about_me = $_POST['about_me'];
               		$hobby = $_POST['hobby'];				
					$fam_details = $_POST['fam_details'];
					$txtFamilyType =$_POST['txtFamilyType'];
					$txtFamilyStatus = $_POST['txtFamilyStatus'];
					$family_origin = $_POST['family_origin'];
					$father_name =$_POST['father_name']; 
					$father_ocp =$_POST['father_ocp']; 
					$mother_name =$_POST['mother_name'];
					$mother_ocp = $_POST['mother_ocp']; 
					$txtNoBrothers = $_POST['txtNoBrothers'];
					$nbm =$_POST['nbm'];
					$txtnoofsisters = $_POST['txtnoofsisters'];
					$nsm = $_POST['nsm']; 					
				 
    
            	$STATUS_MESSAGE="";
            	$SQL_STATEMENT = "";
                switch($ACTION)
                {
		    case 'UPDATE':
			    $SQL_STATEMENT = "UPDATE register set profile_text=\"".htmlspecialchars($about_me, ENT_QUOTES)."\",hobby=\"".htmlspecialchars($hobby, ENT_QUOTES)."\",family_details=\"".htmlspecialchars($fam_details, ENT_QUOTES)."\",family_origin=\"".htmlspecialchars($family_origin, ENT_QUOTES)."\",father_name=\"".htmlspecialchars($father_name, ENT_QUOTES)."\",mother_name=\"".htmlspecialchars($mother_name, ENT_QUOTES)."\", 	father_occupation=\"".htmlspecialchars($father_ocp, ENT_QUOTES)."\",mother_occupation=\"".htmlspecialchars($mother_ocp, ENT_QUOTES)."\",family_type='".$txtFamilyType."',family_status='".$txtFamilyStatus."',family_type='".$txtFamilyType."',no_of_brothers='".$txtNoBrothers."',no_of_sisters='".$txtnoofsisters."',no_marri_brother='".$nbm."' ,no_marri_sister='".$nsm."' where index_id=".$user_id;			    			 
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