<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
include_once '../../../class/Config.class.php';
$configObj = new Config();

$s="select prefix from register";
$rr=mysql_query($s);
$dd=mysql_fetch_array($rr);

$prefix=$dd['prefix'];
  
 
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] :"" ;


if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
$ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
$ip = $_SERVER["REMOTE_ADDR"];
}

$agent=$_SERVER['HTTP_USER_AGENT'];
$tm=mktime(date('h')+5,date('i')+30,date('s'));
$reg_date=date('Y-m-d h:i:s',$tm);
$status='Active';
   
 
    $firstname = '';

    $lastname = '';

    $gender = '';

    $m_status = '';

    $m_tongue = '';

    $birthplace = '';

    $reference = '';

    $profileby = '';

    $birthtime = '';

    $religion = '';

    $caste = '';
	
	$caste_name = '';
					
	$subcaste = '';

    $horoscope = '';

    $manglik = '';
					
	$gothra = '';
					 
	$star = '';  
	
	$moonsign = '';  

	
$isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
if($isPostBack)
{


$statusObj = new Status();

$errorFlag = false;
$erroMessage = "";

            if(empty($_POST['firstname']))
			{
            	$erroMessage .= "<li>First name is required.</li>";
            	$errorFlag = true;
            }
			 if(empty($_POST['lastname']))
			{
            	$erroMessage .= "<li>Last name is required.</li>";
            	$errorFlag = true;
            }
			
			
           if(empty($_POST['gender']))
		   {
            	$erroMessage .= "<li>Gender is required.</li>";
            	$errorFlag = true;
            }
			
			if(empty($_POST['m_status']))
		   {
            	$erroMessage .= "<li>Marital Status is required.</li>";
            	$errorFlag = true;
            }
			
			if(empty($_POST['mtongue']))
		   {
            	$erroMessage .= "<li>Mother Tongue is required.</li>";
            	$errorFlag = true;
            }
			
            if(empty($_POST['datepicker']))
			{
            	$erroMessage .= "<li>Birth date is required.</li>";
            	$errorFlag = true;            	
             }            	                              
                     	                  
                                
            if(empty($_POST['religion_id']))
			{
            	$erroMessage .= "<li>Religion is required.</li>";
            	$errorFlag = true;
            }
			
			if(empty($_POST['caste_id']))
			{
            	$erroMessage .= "<li>Caste is required.</li>";
            	$errorFlag = true;
            }
                                 
	    
            if(!$errorFlag)
            {
				
										
                	$firstname = htmlspecialchars($_POST['firstname'],ENT_QUOTES);

                    $lastname = htmlspecialchars($_POST['lastname'],ENT_QUOTES);

                    $gender = $_POST['gender'];
					
					$birthdate = $_POST['datepicker'];

                    $m_status = $_POST['m_status'];

                    $mtongue = implode(",",$_POST['mtongue']);

                    $birthplace = htmlspecialchars($_POST['birthplace'],ENT_QUOTES);
					
					$birthtime = htmlspecialchars($_POST['birthtime'],ENT_QUOTES);

                    $reference = $_POST['reference'];

                    $profileby = $_POST['profileby'];                    

                    $religion = $_POST['religion_id'];

                    $caste = $_POST['caste_id'];				
									
					$subcaste = htmlspecialchars($_POST['subcaste'],ENT_QUOTES);

                    $horoscope = $_POST['horoscope'];

                    $manglik = $_POST['manglik'];
					
					$gothra = htmlspecialchars($_POST['gothra'],ENT_QUOTES);
					 
					$star = htmlspecialchars($_POST['mem_star'],ENT_QUOTES);    
					
					$moonsign = htmlspecialchars($_POST['moonsign'],ENT_QUOTES);        
					
            	$STATUS_MESSAGE="";
            
            	$SQL_STATEMENT = "";
				$ERROR_FLAG = false;
	    

            if($ERROR_FLAG != true)
            {
                    
                        switch($ACTION)
                        {
                            case 'ADD':
                                   
                                $SQL_STATEMENT = "INSERT into register (index_id,terms,cpass_status,m_status,profileby,reference,username,firstname,lastname,gender,birthdate,m_tongue,birthtime,birthplace,religion,caste,subcaste,horoscope,manglik,gothra,star,moonsign,reg_date,ip,agent,status)  values ('','Yes','yes','".$m_status."','".$profileby."','".$reference."','".$firstname." ".$lastname."','".$firstname."','".$lastname."','".$gender."','".$birthdate."','".$mtongue."','".$birthtime."','".$birthplace."','".$religion."','".$caste."','".$subcaste."','".$horoscope."','".$manglik."','".$gothra."','".$star."','".$moonsign."','".$reg_date."','".$ip."','".$agent."','".$status."')";			
        
            
                                    break;
                            case 'UPDATE':
                                    $user_id = $_POST['user_id'];
									
				   
     $SQL_STATEMENT = "UPDATE register set username='".$firstname." ".$lastname."',firstname='".$firstname."',lastname='".$lastname."',gender='".$gender."',birthdate='".$birthdate."',m_status='".$m_status."',m_tongue='".$mtongue."',birthplace='".$birthplace."',birthtime='".$birthtime."',religion='".$religion."',caste='".$caste."',subcaste='".$subcaste."',profileby='".$profileby."',reference='".$reference."',horoscope='".$horoscope."',manglik='".$manglik."',gothra='".$gothra."',star='".$star."',moonsign='".$moonsign."' where index_id='".$user_id."'";
				
                                    break;
                                    
          				 }
                   
                     $statusObj = handle_post_request($ACTION,$SQL_STATEMENT,$DatabaseCo);
                     $STATUS_MESSAGE = $statusObj->getStatusMessage();
                     $MAX_INDEX_ID = 0; 
					 
					 if($statusObj->getActionSuccess() && $ACTION=="ADD")
					 {
					$MAX_ID_QUERY = "SELECT max(index_id) as 'MAX_INDEX_ID' FROM  register";
					$MAX_INDEX_ID = getRowCount($MAX_ID_QUERY,$DatabaseCo);	
					
					
					$upd=mysql_query("update register set matri_id='".$prefix.$MAX_INDEX_ID."',prefix='".$prefix."' where index_id='$MAX_INDEX_ID'");
					
									
	
					 }
					 else
					 {
					$MAX_INDEX_ID = $user_id;
					 }
							 $response = array();
							 $response['successStatus'] = $statusObj->getActionSuccess();
							 $response['responseMessage'] = $STATUS_MESSAGE;
							 $response['maxId'] = $MAX_INDEX_ID;
							 header('Content-type: application/json');
							 echo json_encode($response);
			  }
			
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