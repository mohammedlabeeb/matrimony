<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';


$DatabaseCo = new DatabaseConn();
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$USER_ID = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;


    $photo1 = "";

    $photo2 = "";

    $photo3 = "";

    $photo4 = "";

    $photo5 = "";
	
	$photo6 = ""; 
	
	$que1='';
	$que2='';
	$que3='';
	$que4='';
	$que5='';
	$que6='';
       
	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{


$statusObj = new Status();

$errorFlag = false;
$erroMessage = "";
                   
	    
            if(!$errorFlag)
            {

            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
				
		       $ERROR_FLAG = false;
	    
           
                if(@is_uploaded_file($_FILES["image_file1"]["tmp_name"]))
				{
					$image_type1 = $_FILES['image_file1']['name'];
					$upload_status=copy($_FILES["image_file1"]["tmp_name"], "../../../photos/" .$image_type1);
					$upload_big=copy($_FILES['image_file1']['tmp_name'],"../../../photos_big/".$image_type1);
					$que1=",photo1_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type1=$_POST['photo1'];					
				}
				
				
				if(@is_uploaded_file($_FILES["image_file2"]["tmp_name"]))
				{
					$image_type2 = $_FILES['image_file2']['name'];
					$upload_status=copy($_FILES["image_file2"]["tmp_name"], "../../../photos/" .$image_type2);
					$upload_big=copy($_FILES['image_file2']['tmp_name'],"../../../photos_big/".$image_type2);
					$que2=",photo2_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type2=$_POST['photo2'];					
				}
				
				
				if(@is_uploaded_file($_FILES["image_file3"]["tmp_name"]))
				{
					$image_type3 = $_FILES['image_file3']['name'];
					$upload_status=copy($_FILES["image_file3"]["tmp_name"], "../../../photos/" .$image_type3);
					$upload_big=copy($_FILES['image_file3']['tmp_name'],"../../../photos_big/".$image_type3);
					$que3=",photo3_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type3=$_POST['photo3'];					
				}
				
				
				if(@is_uploaded_file($_FILES["image_file4"]["tmp_name"]))
				{
					$image_type4 = $_FILES['image_file4']['name'];
					$upload_status=copy($_FILES["image_file4"]["tmp_name"], "../../../photos/" .$image_type4);
					$upload_big=copy($_FILES['image_file4']['tmp_name'],"../../../photos_big/".$image_type4);
					$que4=",photo4_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type4=$_POST['photo4'];					
				} 
				
				if(@is_uploaded_file($_FILES["image_file5"]["tmp_name"]))
				{
					$image_type5 = $_FILES['image_file5']['name'];
					$upload_status=copy($_FILES["image_file5"]["tmp_name"], "../../../photos/" .$image_type5);
					$upload_big=copy($_FILES['image_file5']['tmp_name'],"../../../photos_big/".$image_type5);
					$que5=",photo5_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type5=$_POST['photo5'];					
				}
				
				if(@is_uploaded_file($_FILES["image_file6"]["tmp_name"]))
				{
					$image_type6 = $_FILES['image_file6']['name'];
					$upload_status=copy($_FILES["image_file6"]["tmp_name"], "../../../photos/" .$image_type6);
					$upload_big=copy($_FILES['image_file6']['tmp_name'],"../../../photos_big/".$image_type6);
					$que6=",photo6_approve='APPROVED'";
								
				}
				else
				{					
					 $image_type6=$_POST['photo6'];					
				} 
           
           

            if($ERROR_FLAG != true)
            {
                     
                        switch($ACTION)
                        {
                            
                            case 'UPDATE':
                                    $user_id = $_POST['user_id'];
				   
$SQL_STATEMENT = "UPDATE register set photo1='".$image_type1."',photo2='".$image_type2."',photo3='".$image_type3."',photo4='".$image_type4."',photo5='".$image_type5."',photo6='".$image_type6."' $que1 $que2 $que3 $que4 $que5 $que6 where  index_id=".$user_id;	
									
				
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