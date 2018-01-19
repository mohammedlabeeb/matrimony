<?php
	error_reporting(0);
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	include("BusinessLogic/class.register.php");

	
		$firstname=$_SESSION['fname'];	 
		$lastname=$_SESSION['lname'];
		$gender=$_SESSION['gender_reg'];	 
		$email=$_SESSION['email'];	 
		$password=$_SESSION['password'];	 		
		$birthdate=$_SESSION['birthdate'];	 
		$m_tongue=$_SESSION['mother_tongue'];	
		$m_status=$_SESSION['m_status'];	 
		$religion=$_SESSION['religion_id'];	 
		$caste=$_SESSION['caste_id'];	 
		$m_status=$_SESSION['m_status']; 
		$edu_detail=$_SESSION['edu_detail'];	 
		$income=$_SESSION['txtIncome'];		 
		$occupation=$_SESSION['occupation'];	 
		$emp_in=$_SESSION['emp_in'];		 
		$weight=$_SESSION['weight'];		 
		$height=$_SESSION['height'];		 
		$country=$_SESSION['country_id'];		 
		$state=$_SESSION['state_id'];		 
		$city=$_SESSION['city_id'];	
		$mobile=$_SESSION['mobile'];
        $drink = $_SESSION['drink'];
	 	$smoke =$_SESSION['smoke'];
	 	$bodytype=$_SESSION['bodytype'];
	 	$looking_status=$_SESSION['looking_status'];
		
		$profileby=$_SESSION['profileby'];
		$reference=$_SESSION['reference'];
		$gothra=$_SESSION['gothra'];
		$star=$_SESSION['star'];
		$moonsign=$_SESSION['moonsign'];
		$horoscope=$_SESSION['horoscope'];
		$manglik=$_SESSION['manglik'];
		$birthplace=$_SESSION['birthplace'];
		$b_group=$_SESSION['b_group'];
		$diet=$_SESSION['diet'];
		$profile_text = $_SESSION['txtmsg'];
		$looking_status= $_SESSION['looking_status'];
		$part_frm_age = $_SESSION['txtEAge'];
		$part_to_age = $_SESSION['txtEPAge'];
		$part_expect = $_SESSION['txtExpectation'];
		$part_country_living=$_SESSION['txtPCountry'];
        $part_mtongue=$_SESSION['pmtongue'];
		$part_religion=$_SESSION['part_religion'];
		$part_caste=$_SESSION['part_caste'];
		$part_edu=$_SESSION['part_edu'];
		$part_height = $_SESSION['txtPFHeight'];
		$part_height_to = $_SESSION['txtPTHeight'];
        $address=$_SESSION['address'];
        $complexion=$_SESSION['complexion'];
        $part_complexation=$_SESSION['part_complexation'];
		$part_income=$_SESSION['part_annu_income'];

$status='Inactive';
$ip=$_SERVER['REMOTE_ADDR'];                
//$ref=$_SERVER['HTTP_REFERER'];
$agent=$_SERVER['HTTP_USER_AGENT'];  


$tm=mktime(date('h')+5,date('i')+30,date('s'));
$reg_date=date('Y-m-d h:i:s',$tm);

$order_status = "No";
$photo_protect = "No";


$s="select * from register";
$rr=mysql_query($s);
$dd=mysql_fetch_array($rr);

$prefix=$dd['prefix'];


$adminrole_id='1';
$adminrole_view_status='Yes';

// insert the data
$ob=new register();
$result=$ob->register_user($index_id,$matri_id,$prefix,$terms,$email,$password,$m_status,$profileby,$reference,$username,$firstname,$lastname,$gender,$birthdate,$birthtime,$birthplace,$tot_children,$status_children,$edu_detail,$income,$occupation,$emp_in,$religion,$caste,$subcaste,$gothra,$star,$moonsign,$horoscope,$manglik,$m_tongue,$height,$weight,$b_group,$complexion,$bodytype,$diet,$smoke,$drink,$address,$country,$state,$city,$phone,$mobile,$residence,$father_name,$mother_name,$father_living_status,$mother_living_status,$father_occupation,$mother_occupation,$profile_text,$looking_status,$family_details,$family_value,$family_type,$family_status,$family_origin,$no_of_brothers,$no_of_sisters,$no_marri_brother,$no_marri_sister,$part_frm_age,$part_to_age,$part_income,$part_expect,$part_height,$part_height_to,$part_complexation,$part_mtongue,$part_religion,$part_caste,$part_edu,$part_country_living,$part_resi_status,$hobby,$interest,$photo_protect,$reg_date,$ip,$agent,$status,$adminrole_id,$adminrole_view_status);
$email = $_SESSION['email'];  
print "<script>";
print " self.location='register_confirm_pswd.php?email=$email';"; 
print "</script>";

?>