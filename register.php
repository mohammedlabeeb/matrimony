<?php
	ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(E_ALL);
	include_once 'databaseConn.php';
	include("BusinessLogic/class.register.php");
	if(isset($_SESSION['user_name']) || (trim($_SESSION['user_id']) != '')) {
            header("location: myhome.php");
            exit();
    }
	include_once 'lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	include_once './class/Config.class.php';
	$configObj = new Config();
	
if(isset($_POST['submit']))
    {
	$fname=trim(ucwords($_POST['fname']));
	$lname=trim(ucwords($_POST['lname']));
	$email=trim($_POST['email']);
	$password=md5($_POST['txtPassword']);
	$gender=$_POST['gender'];
	
	$dob=$_POST['datepicker'];
	$mtongue=implode(',',$_POST['mtongue']);
	$religion_id=$_POST['religion_id'];
	$caste_id=$_POST['caste_id'];
	$m_status=$_POST['m_status'];	
	
	$country_id=$_POST['txtCountry'];
	$state_id=$_POST['cbo1State'];
	$city_id=$_POST['cbo1City'];
	$mobile=$_POST['txtMobile'];	
	$edu_detail=implode(',',$_POST['txtEdudetail']);
	
	$txtIncome=$_POST['txtIncome'];
	$occupation=$_POST['txtOccupation'];
	$weight=$_POST['txtWeight'];
	$height=$_POST['txtHeight'];
	$address= htmlspecialchars($_POST['address']);
	
    $txtmsg= htmlspecialchars($_POST['txtProfiledescription']);		
	
	$txtEAge=$_POST['txtEAge'];
	$txtEPAge=$_POST['txtEPAge'];	
	
	$txtExpectation= htmlspecialchars($_POST['txtExpectation']);	
	 
	$txtPCountry=implode(',',$_POST['part_country']);
	$part_religion=implode(',',$_POST['part_religion_id']);
	$looking_status=implode(', ',$_POST['looking_for']);
	$part_caste=implode(',',$_POST['part_caste_id']);
	
	$part_edu=implode(',',$_POST['txtPEducation']);
	
	$txtPFHeight=$_POST['txtSheight'];
	$txtPTHeight=$_POST['txtEheight'];
	$part_complexation=implode(', ',$_POST['part_complexation']);
	$part_mtongue=implode(',',$_POST['pmtongue']);
	$part_income=$_POST['part_income'];
	
	
		
	$_SESSION['part_complexation']=$part_complexation;	
	$_SESSION['txtmsg']=$txtmsg;
	
	$_SESSION['txtEAge']=$txtEAge;
	$_SESSION['txtEPAge']=$txtEPAge;
	
	$_SESSION['txtExpectation']=$txtExpectation;
	$_SESSION['txtPCountry']=$txtPCountry;
	$_SESSION['part_religion']=$part_religion;
	
	$_SESSION['part_caste']=$part_caste;	
	$_SESSION['part_edu']=$part_edu;
	$_SESSION['txtPFHeight']=$txtPFHeight;
	$_SESSION['txtPTHeight']=$txtPTHeight;
	$_SESSION['pmtongue']=$part_mtongue;
	$_SESSION['looking_status']=$looking_status;
	$_SESSION['part_annu_income']=$part_income;
	
	$_SESSION['fname']=$fname;
	$_SESSION['lname']=$lname;
	$_SESSION['gender_reg']=$gender;
	$_SESSION['email']=$email;	
	$_SESSION['password']=$password;
	
	$_SESSION['birthdate']=$dob;	
	$_SESSION['mother_tongue']=$mtongue;
	$_SESSION['religion_id']=$religion_id;
	$_SESSION['caste_id']=$caste_id;
	$_SESSION['m_status']=$m_status;
	
	$_SESSION['edu_detail']=$edu_detail;
	$_SESSION['country_id']=$country_id;	
	$_SESSION['state_id']=$state_id;	
	$_SESSION['city_id']=$city_id;	
	
	$_SESSION['txtIncome']=$txtIncome;	
	$_SESSION['occupation']=$occupation;	
	$_SESSION['weight']=$weight;	
	$_SESSION['height']=$height;	
	$_SESSION['mobile'] = $mobile;
	$_SESSION['address']=$address; 	
	
	
	$check = "select email from register where email='$email'";
	$qry = mysql_query($check) or die ("Could not match data because ".mysql_error());
	$num_rows = mysql_num_rows($qry); 
	if ($num_rows != 0) 
	{ 
		?><script>alert('This Email ID is already exist, Please Login now');</script><?php
		echo "<script language='javascript'>window.location='login.php'</script>";
		
	} 

	 echo "<script language='javascript'>window.location='register_submit.php?email=$email'</script>";
}

if(isset($_REQUEST['register']))
{
	$firstname=trim($_REQUEST['f_name']);
	$lastname=trim($_REQUEST['l_name']);
	$email=trim($_REQUEST['email']);
	$password=md5($_REQUEST['password']);
	$cpassword=($_REQUEST['password']);
	$gender=$_REQUEST['gender'];
	$profileby=$_REQUEST['profile_for'];
	$dob= $_REQUEST['y_dob']."-".$_REQUEST['m_dob']."-".$_REQUEST['d_dob'];
	$birthdate=date("Y-m-d",strtotime("$dob"));
	
	$mobile=$_REQUEST['phone_c'].$_REQUEST['phone_n'];	
		
	$check = "select email from register where email='$email'";
	$qry = mysql_query($check) or die ("Could not match data because ".mysql_error());
	$num_rows = mysql_num_rows($qry); 
	if ($num_rows != 0) 
	{ 
		?><script>alert('This Email ID is already exist, Please Login now');</script><?php
		echo "<script language='javascript'>window.location='login.php'</script>";
		
	}
	$s="SELECT `index_id`,`prefix` FROM `register` ORDER BY `index_id` DESC LIMIT 0,1";
$rr=mysql_query($s);
$dd=mysql_fetch_array($rr);

$prefix=$dd['prefix'];
$id =  intval($dd['index_id'])+1;
$matri_id = $dd['prefix'].$id;

$ob=new register();

$result=$ob->temp_register($matri_id,$prefix,$email,$password,$cpassword,$profileby,$firstname,$lastname,$gender,$birthdate,$mobile);

echo "<script language='javascript'>window.location='register_confirm_pswd.php?email=$email'</script>";	
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/validate.css">
<link rel="stylesheet" href="css/chosen.css">
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
function getXMLHTTP()
{ //fuction to return the xml http object
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
}



function GetCaste(strURL) 
{
		var req4 = getXMLHTTP();		
		if (req4) 
		{
			$("#status3").html('<img src="images/loader/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
			req4.onreadystatechange = function() 
			{
					if (req4.readyState == 4) 
					{
						
						
						
						if(req4.status == 200) 
						{	
						$("#status3").html('');					
						document.getElementById('CasteDiv').innerHTML=req4.responseText;						
						} 
						else 
						{
						$("#status3").html('');
						alert("There was a problem while using XMLHTTP:\n" + req4.statusText);
						}
					}				
			}			
			req4.open("GET", strURL, true);
			req4.send(null);
		}				
}
</script>
<script type="text/javascript">

var numDays = {
                '01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
                '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
              }; 

function setDays(oMonthSel, oDaysSel, oYearSel)
{ 
	var nDays, oDaysSelLgth, opt, i = 1; 
	nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
	if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
		++nDays; 
	oDaysSelLgth = oDaysSel.length; 
	if (nDays != oDaysSelLgth)
	{ 
		if (nDays < oDaysSelLgth) 
			oDaysSel.length = nDays; 
		else for (i; i < nDays - oDaysSelLgth + 1; i++)
		{ 
			opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  	oDaysSel.options[oDaysSel.length] = opt;
		} 
	}
	var oForm = oMonthSel.form;
	var month = oMonthSel.options[oMonthSel.selectedIndex].value;
	var day = oDaysSel.options[oDaysSel.selectedIndex].value;
	var year = oYearSel.options[oYearSel.selectedIndex].value;	
	oForm.datepicker.value = year + '-' + month + '-' + day;
} 

</script>


<script type="text/javascript">
$(document).ready(function()
{
	
$("#country").change(function()
{
	$("#status1").html('<img src="images/loader/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
	$("#sub_button").hide();
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "ajax_country_state.php",
data: dataString,
cache: false,
success: function(html)
{
$("#state").html(html);
$("#status1").html('');
$("#sub_button").show();
} 
});

});


$("#state").change(function()
{
	$("#status2").html('<img src="images/loader/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
	$("#sub_button").hide();
var id=$(this).val();
var cnt_id=$("#country").val();
var dataString = 'state_id='+ id+'&country_id='+ cnt_id;

$.ajax
({
type: "POST",
url: "ajax_country_state.php",
data: dataString,
cache: false,
success: function(html)
{
$("#city").html(html);
$("#status2").html('');
$("#sub_button").show();
} 
});

});


});
	
</script>

	
</head>
<body>		
  <div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title col-xs-12">Feel Free to Join Us</h3>
                                 
                </div>
    
    
                   <div class="panel-body register">             	
                    <div class="col-sm-12">						
                    <div class="registration-step reg-step1 col-xs-9"></div>
                    <font class="small text-danger col-lg-12 text-right col-xs-10">All * Fields are compalsary </font>
                    <div class="clearfix visible-xs"></div>   
                    
                    
                    
                    <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
                     <div class="col-sm-6 border_right col-xs-12 padding-left-right-zero-small">        
                       <h3 class="text-primary text-center ">Account Information</h3>
                                             
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">First name&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <input type="text" name="fname" class="form-control" id="fname" placeholder="Type First Name" data-validetta="required" value="<?php echo $fname;?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Last name&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <input type="text" name="lname" class="form-control" id="lname" placeholder="Type Last Name" data-validetta="required" >
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Email-Id&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <input type="text" name="email" class="form-control" id="email" placeholder="Type Email" value="<?php echo $email;?>" data-validetta="required,email">
                             
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Password&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <input type="password" name="txtPassword" class="form-control" id="txtPassword" placeholder="Password" data-validetta="required" value="<?php echo $password;?>">
                            </div>
                          </div>
                          <h3 class="text-primary">Contact Information</h3>                          
                         
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Address&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                    <textarea  class="form-control" id="address" name="address" placeholder="Address" data-validetta="required"></textarea>
                            </div>
                          </div>
                         
                         <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Country&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">                            
                                <select name="txtCountry" class="form-control" id="country"  data-validetta="required">
                             
                                    <option value="">--Please select country--</option>
                                    
                                    <?php
                                    $SQL_STATEMENT =  "SELECT * FROM country WHERE status='APPROVED' order by country_name ";
                                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                            {
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                    <?php } ?>
                                </select> 
                            </div>
                            
                            &nbsp; <span id="status1"></span>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">State&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                                <select name="cbo1State" id="state" class="form-control"   data-validetta="required">
                                   
                                    <option value="">--Select country first--</option>
                                </select> 
                            </div>
                            
                            &nbsp; <span id="status2"></span>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">City&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="cbo1City" class="form-control" id="city" data-validetta="required" >
                                <option value="">All City</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Mobile number&nbsp;<font class="text-danger">*</font></label>
                                                       
                            <div class="col-sm-5">
                              <input type="tel" maxlength="10" class="form-control" name="txtMobile" id="txtMobile" placeholder="Type 10 Digit Mobile Number" data-validetta="required,number,minLength[10],maxLength[13]" value="<?php echo $mobile;?>">
                              
                            </div>
                          </div>
                          
                          <h3 class="text-primary">Personal Information</h3>

                         
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Gender <font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="gender" id="gender"  class="form-control" data-validetta="required">
                               <option value="">Gender</option>
                              <option value="Male" <?php if($gender=='Male'){?> selected="selected"<?php }?>>Male</option>
                 <option value="Female" <?php if($gender=='Female'){?> selected="selected"<?php }?>>Female</option>
                              </select>
                            </div>
                            
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Date of Birth <font class="text-danger">*</font></label>
                            
                            <div class="col-sm-2">
                            <select name="day" id="day"  class="form-control" data-validetta="required" onchange="setDays(month,this,year)">
                             
                             <option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
                               
                             </select>
                            </div>
                            
                          <div class="col-sm-2"> 
         				  <select name="month" id="month"  class="form-control" onchange="setDays(this,day,year)" data-validetta="required">
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
                               
                             </select>
                             </div>
                           
                             
				<div class="col-sm-2">
					 <select name="year" id="year"  class="form-control" data-validetta="required" onchange="setDays(month,day,this)">
                     
<option value="1924">1924</option>
<option value="1925">1925</option>
<option value="1926">1926</option>
<option value="1927">1927</option>
<option value="1928">1928</option>
<option value="1929">1929</option>
<option value="1930">1930</option>
<option value="1931">1931</option>
<option value="1932">1932</option>
<option value="1933">1933</option>
<option value="1934">1934</option>
<option value="1935">1935</option>
<option value="1936">1936</option>
<option value="1937">1937</option>
<option value="1938">1938</option>
<option value="1939">1939</option>
<option value="1940">1940</option>
<option value="1941">1941</option>
<option value="1942">1942</option>
<option value="1943">1943</option>
<option value="1944">1944</option>
<option value="1945">1945</option>
<option value="1946">1946</option>
<option value="1947">1947</option>
<option value="1948">1948</option>
<option value="1949">1949</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
                               
                             </select>
                             </div>                             
                            <input type="hidden" class="form-control" name="datepicker" value="1924-01-01" /> 
                            
                       </div>
                       
                       
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Height & Weight&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-3">
                              <select name="txtHeight" class="form-control" id="txtHeight" data-validetta="required">
                                            <option value="">Height</option>
                                            <option value="Below 4ft 6in">Below 4ft 6in - 137cm</option>
                                            <option value="4ft 6in">4ft 6in - 137cm</option>
                                            <option value="4ft 7in">4ft 7in - 139cm</option>
                                            <option value="4ft 8in">4ft 8in - 142cm</option>
                                            <option value="4ft 9in">4ft 9in - 144cm</option>
                                            <option value="4ft 10in">4ft 10in - 147cm</option>
                                            <option value="4ft 11in">4ft 11in - 149cm</option>
                                            <option value="5ft">5ft - 152cm</option>
                                            <option value="5ft 1in">5ft 1in - 154cm</option>
                                            <option value="5ft 2in">5ft 2in - 157cm</option>
                                            <option value="5ft 3in">5ft 3in - 160cm</option>
                                            <option value="5ft 4in">5ft 4in - 162cm</option>
                                            <option value="5ft 5in">5ft 5in - 165cm</option>
                                            <option value="5ft 6in">5ft 6in - 167cm</option>
                                            <option value="5ft 7in">5ft 7in - 170cm</option>
                                            <option value="5ft 8in">5ft 8in - 172cm</option>
                                            <option value="5ft 9in">5ft 9in - 175cm</option>
                                            <option value="5ft 10in">5ft 10in - 177cm</option>
                                            <option value="5ft 11in">5ft 11in - 180cm</option>
                                            <option value="6ft">6ft - 182cm</option>
                                            <option value="6ft 1in">6ft 1in - 185cm</option>
                                            <option value="6ft 2in">6ft 2in - 187cm</option>
                                            <option value="6ft 3in">6ft 3in - 190cm</option>
                                            <option value="6ft 4in">6ft 4in - 193cm</option>
                                            <option value="6ft 5in">6ft 5in - 195cm</option>
                                            <option value="6ft 6in">6ft 6in - 198cm</option>
                                            <option value="6ft 7in">6ft 7in - 200cm</option>
                                            <option value="6ft 8in">6ft 8in - 203cm</option>
                                            <option value="6ft 9in">6ft 9in - 205cm</option>
                                            <option value="6ft 10in">6ft 10in - 208cm</option>
                                            <option value="6ft 11in">6ft 11in - 210cm</option>
                                            <option value="7ft">7ft - 213cm</option>
                                            <option value="Above 7ft">Above 7ft - 213cm</option>
                               </select>
                            </div>
                            
                            <div class="col-sm-3">
                              <select name="txtWeight" data-validetta="required" class="form-control" id="txtWeight">
                              <option value="">Weight</option>
                      						 <option value="40">40 Kg</option>
                                            <option value="41">41 Kg</option>
                                            <option value="42">42 Kg</option>
                                            <option value="43">43 Kg</option>
                                            <option value="44">44 Kg</option>
                                            <option value="45">45 Kg</option>
                                            <option value="46">46 Kg</option>
                                            <option value="47">47 Kg</option>
                                            <option value="48">48 Kg</option>
                                            <option value="49">49 Kg</option>
                                            <option value="50">50 Kg</option>
                                            <option value="51">51 Kg</option>
                                            <option value="52">52 Kg</option>
                                            <option value="53">53 Kg</option>
                                            <option value="54">54 Kg</option>
                                            <option value="55">55 Kg</option>
                                            <option value="56">56 Kg</option>
                                            <option value="57">57 Kg</option>
                                            <option value="58">58 Kg</option>
                                            <option value="59">59 Kg</option>
                                            <option value="60">60 Kg</option>
                                            <option value="61">61 Kg</option>
                                            <option value="62">62 Kg</option>
                                            <option value="63">63 Kg</option>
                                            <option value="64">64 Kg</option>
                                            <option value="65">65 Kg</option>
                                            <option value="66">66 Kg</option>
                                            <option value="67">67 Kg</option>
                                            <option value="68">68 Kg</option>
                                            <option value="69">69 Kg</option>
                                            <option value="70">70 Kg</option>
                                            <option value="71">71 Kg</option>
                                            <option value="72">72 Kg</option>
                                            <option value="73">73 Kg</option>
                                            <option value="74">74 Kg</option>
                                            <option value="75">75 Kg</option>
                                            <option value="76">76 Kg</option>
                                            <option value="77">77 Kg</option>
                                            <option value="78">78 Kg</option>
                                            <option value="79">79 Kg</option>
                                            <option value="80">80 Kg</option>
                                            <option value="81">81 Kg</option>
                                            <option value="82">82 Kg</option>
                                            <option value="83">83 Kg</option>
                                            <option value="84">84 Kg</option>
                                            <option value="85">85 Kg</option>
                                            <option value="86">86 Kg</option>
                                            <option value="87">87 Kg</option>
                                            <option value="88">88 Kg</option>
                                            <option value="89">89 Kg</option>
                                            <option value="90">90 Kg</option>
                                            <option value="91">91 Kg</option>
                                            <option value="92">92 Kg</option>
                                            <option value="93">93 Kg</option>
                                            <option value="94">94 Kg</option>
                                            <option value="95">95 Kg</option>
                                            <option value="96">96 Kg</option>
                                            <option value="97">97 Kg</option>
                                            <option value="98">98 Kg</option>
                                            <option value="99">99 Kg</option>
                                            <option value="100">100 Kg</option>
                                            <option value="101">101 Kg</option>
                                            <option value="102">102 Kg</option>
                                            <option value="103">103 Kg</option>
                                            <option value="104">104 Kg</option>
                                            <option value="105">105 Kg</option>
                                            <option value="106">106 Kg</option>
                                            <option value="107">107 Kg</option>
                                            <option value="108">108 Kg</option>
                                            <option value="109">109 Kg</option>
                                            <option value="110">110 Kg</option>
                                            <option value="111">111 Kg</option>
                                            <option value="112">112 Kg</option>
                                            <option value="113">113 Kg</option>
                                            <option value="114">114 Kg</option>
                                            <option value="115">115 Kg</option>
                                            <option value="116">116 Kg</option>
                                            <option value="117">117 Kg</option>
                                            <option value="118">118 Kg</option>
                                            <option value="119">119 Kg</option>
                                            <option value="120">120 Kg</option>
                                            <option value="121">121 Kg</option>
                                            <option value="122">122 Kg</option>
                                            <option value="123">123 Kg</option>
                                            <option value="124">124 Kg</option>
                                            <option value="125">125 Kg</option>
                                            <option value="126">126 Kg</option>
                                            <option value="127">127 Kg</option>
                                            <option value="128">128 Kg</option>
                                            <option value="129">129 Kg</option>
                                            <option value="130">130 Kg</option>
                                            <option value="131">131 Kg</option>
                                            <option value="132">132 Kg</option>
                                            <option value="133">133 Kg</option>
                                            <option value="134">134 Kg</option>
                                            <option value="135">135 Kg</option>
                                            <option value="136">136 Kg</option>
                                            <option value="137">137 Kg</option>
                                            <option value="138">138 Kg</option>
                                            <option value="139">139 Kg</option>
                                            <option value="140">140 Kg</option>
                              </select>
                            </div>
                          </div>   
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Marital Status<font class="text-danger">*</font></label>
                            <div class="col-sm-7">
                               <input name="m_status" checked="checked" class="radio-inline" type="radio" value="Unmarried"  onClick="return HaveChildnp(this)"/>
                                Unmarried
                                <input name="m_status" class="radio-inline" type="radio" value="Widow/Widower" onClick="return HaveChildnp(this)">
                                Widow/Widower<br>
                                <input name="m_status" class="radio-inline" type="radio" value="Divorcee" onClick="return HaveChildnp(this)">

                                Divorcee  &nbsp;
                                &nbsp;&nbsp;<input name="m_status" class="radio-inline" type="radio" value="Separated" onClick="return HaveChildnp(this)">
                                Separated
                            </div>
                            </div>
                           
                              
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Religion&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="religion_id" class="form-control" id="religion_id" onchange="GetCaste('ajax_search2.php?religionId='+this.value)" data-validetta="required">
                              <option value="<?php echo $religion_id;?>"><?php
			$select =mysql_query("SELECT * FROM religion WHERE religion_id='$religion_id' order by religion_name");
			$con=mysql_fetch_array($select);
			echo $con['religion_name'];?>
			</option>
                              <option value="">--Please select Religion--</option>
                                <?php
                                $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
                                $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                <?php                                 
                                } 
                                ?>
                              </select> 
                            </div>
                            
                            &nbsp; <span id="status3"></span>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Caste&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5" id="CasteDiv">
                                <select  name="caste_id" id="caste_id"   data-validetta="required" class="form-control" > 
                                <option value="<?php echo $caste_id;?>"><?php
                    $select1 =mysql_query("SELECT * FROM caste WHERE caste_id='$caste_id'");
                    $sta=mysql_fetch_array($select1);
                    echo $sta['caste_name'];?>
                    </option>                             <option value="">--Select Religion first--</option>
                              </select>
                            </div>
                          </div>
                          
                          
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mothertongue&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select  name="mtongue[]" id="mtongue" data-validetta="required" data-placeholder="Select multiple mothertongue"  class="form-control chosen-select" multiple >
                            
                                <?php
                               $SQL_STATEMENT =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
                               $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                               while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                               {
                               ?>
                               <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
                               <?php } ?>
                              </select>
                            </div>
                          </div>
                    </div>
                    <div class="clearfix visible-xs"></div>
                        <div class="col-sm-6">  
                            <h3 class="text-primary">Education Information</h3>
                          
                            
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Education&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="txtEdudetail[]" id="txtEdudetail" data-validetta="required" data-placeholder="Select multiple education"  class="form-control chosen-select" multiple>
                            
                                <?php
                               $SQL_STATEMENT =  "SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC";
                               $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                               while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                               {
                               ?>
                               <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
                               <?php } ?>
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Occupation&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="txtOccupation" id="txtOccupation"  data-validetta="required" class="form-control" >
                              <option value="">Select Occupation</option>
                                <?php
                              $SQL_STATEMENT =  "SELECT * FROM occupation WHERE status='APPROVED' ORDER BY ocp_name ASC";
                              $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                              while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                              {
                              ?>
                              <option value="<?php echo $DatabaseCo->dbRow->ocp_id; ?>"><?php echo $DatabaseCo->dbRow->ocp_name; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Annual Income</label>
                            <div class="col-sm-5">
                              <select  name="txtIncome" id="txtIncome" class="form-control">
                              <option value="">Select Annual Income</option>
		     		<option value="Rs.10,000 - 50,000">Rs.10,000 - 50,000</option>
					<option value="Rs.50,000 - 1,00,000">Rs.50,000 - 1,00,000</option>
					<option value="Rs.1,00,000 - 2,00,000">Rs.1,00,000 - 2,00,000</option>
					<option value="Rs.2,00,000 - 5,00,000">Rs.2,00,000 - 5,00,000</option>
					<option value="Rs.5,00,000 - 10,00,000">Rs.5,00,000 - 10,00,000</option>
					<option value="Rs.10,00,000 - 50,00,000">Rs.10,00,000 - 50,00,000</option>
					<option value="Rs.50,00,000 - 1,00,00,000">Rs.50,00,000 - 1,00,00,000</option>
					<option value="Above Rs.1,00,00,000">Above Rs.1,00,00,000</option>
                              </select>
                            </div>
                          </div>
                           <h3 class="text-primary">More Personal Information</h3>
                          	
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Profile Text&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                         <textarea  class="form-control" placeholder="Profile Text" id="txtProfiledescription" name="txtProfiledescription" data-validetta="required"></textarea>
                         	</div>                            
                          </div>
                            <h3 class="text-primary">Partner Preference</h3>
                                                
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Looking for<font class="text-danger">*</font></label>
                            <div class="col-sm-610">
                               <input name="looking_for[]" checked="checked" class="radio-inline" type="checkbox" value="Unmarried"  onClick="return HaveChildnp(this)" />
                                Unmarried &nbsp;
                                <input name="looking_for[]" class="radio-inline" type="checkbox" value="Widow/Widower" onClick="return HaveChildnp(this)">
                                Widow/Widower<br>
                                <input name="looking_for[]" class="radio-inline" type="checkbox" value="Divorcee" onClick="return HaveChildnp(this)">
                                Divorcee  &nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;<input name="looking_for[]" class="radio-inline" type="checkbox" value="Separated" onClick="return HaveChildnp(this)">
                                Separated
                            </div>
                            </div>     
                            
                            <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Partner From age</label>
                      <div class="col-sm-3">
                              <select name="txtEAge" class="form-control">
                           
                                <option value="18">18 Years</option>
                                <option value="19">19 Years</option>
                                <option value="20" selected="selected">20 Years</option>
                                <option value="21">21 Years</option>
                                <option value="22">22 Years</option>
                                <option value="23">23 Years</option>
                                <option value="24">24 Years</option>
                                <option value="25">25 Years</option>
                                <option value="26">26 Years</option>
                                <option value="27">27 Years</option>
                                <option value="28">28 Years</option>
                                <option value="29">29 Years</option>
                                <option value="30">30 Years</option>
                                <option value="31">31 Years</option>
                                <option value="32">32 Years</option>
                                <option value="33">33 Years</option>
                                <option value="34">34 Years</option>
                                <option value="35">35 Years</option>
                                <option value="36">36 Years</option>
                                <option value="37">37 Years</option>
                                <option value="38">38 Years</option>
                                <option value="39">39 Years</option>
                                <option value="40">40 Years</option>
                                <option value="41">41 Years</option>
                                <option value="42">42 Years</option>
                                <option value="43">43 Years</option>
                                <option value="44">44 Years</option>
                                <option value="45">45 Years</option>
                                <option value="46">46 Years</option>
                                <option value="47">47 Years</option>
                                <option value="48">48 Years</option>
                                <option value="49">49 Years</option>
                                <option value="50">50 Years</option>
                                <option value="51">51 Years</option>
                                <option value="52">52 Years</option>
                                <option value="53">53 Years</option>
                                <option value="54">54 Years</option>
                                <option value="55">55 Years</option>
                                <option value="56">56 Years</option>
                                <option value="57">57 Years</option>
                                <option value="58">58 Years</option>
                                <option value="59">59 Years</option>
                                <option value="60">60 Years</option>
                              </select>
                            </div>
                            <div class="col-sm-1">To</div>
                          	<div class="col-sm-3">
                              <select name="txtEPAge" class="form-control">
                           
                                <option value="18">18 Years</option>
                                <option value="19">19 Years</option>
                                <option value="20">20 Years</option>
                                <option value="21">21 Years</option>
                                <option value="22">22 Years</option>
                                <option value="23">23 Years</option>
                                <option value="24">24 Years</option>
                                <option value="25">25 Years</option>
                                <option value="26">26 Years</option>
                                <option value="27">27 Years</option>
                                <option value="28">28 Years</option>
                                <option value="29">29 Years</option>
                                <option value="30" selected="selected">30 Years</option>
                                <option value="31">31 Years</option>
                                <option value="32">32 Years</option>
                                <option value="33">33 Years</option>
                                <option value="34">34 Years</option>
                                <option value="35">35 Years</option>
                                <option value="36">36 Years</option>
                                <option value="37">37 Years</option>
                                <option value="38">38 Years</option>
                                <option value="39">39 Years</option>
                                <option value="40">40 Years</option>
                                <option value="41">41 Years</option>
                                <option value="42">42 Years</option>
                                <option value="43">43 Years</option>
                                <option value="44">44 Years</option>
                                <option value="45">45 Years</option>
                                <option value="46">46 Years</option>
                                <option value="47">47 Years</option>
                                <option value="48">48 Years</option>
                                <option value="49">49 Years</option>
                                <option value="50">50 Years</option>
                                <option value="51">51 Years</option>
                                <option value="52">52 Years</option>
                                <option value="53">53 Years</option>
                                <option value="54">54 Years</option>
                                <option value="55">55 Years</option>
                                <option value="56">56 Years</option>
                                <option value="57">57 Years</option>
                                <option value="58">58 Years</option>
                                <option value="59">59 Years</option>
                                <option value="60">60 Years</option>
                              </select>
                            </div>
                          </div>
                          
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Partner Expectation</label>
                            <div class="col-sm-5">
                              <textarea class="form-control" id="txtExpectation" name="txtExpectation" placeholder="Partner Expectation "></textarea>
                            </div>
                          </div>             
                           <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Partner Country Living&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="part_country[]" id="part_country"  data-validetta="required" data-placeholder="Select multiple country"  class="form-control chosen-select" multiple>
                             
                                    <?php
                                   $SQL_STATEMENT =  "SELECT * FROM country WHERE status='APPROVED' order by country_name";
                                   $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                   while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                           {
                                   ?>
                                   <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                                   <?php } ?>
                              </select>
                            </div>                            
                          </div>                        
                             
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Religion&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="part_religion_id[]" id="part_religion_id"  data-validetta="required" data-placeholder="Select multiple religion"  class="form-control chosen-select" multiple>
                             
                                <?php
                               $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
                               $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                               while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                               {
                               ?>
                               <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                               <?php } ?>
                              </select>
                            </div>
                            
                             &nbsp; <span id="CasteDivloader"></span>                            
                          </div>       
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Caste&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5" id="CasteDiv1">
                             <select name="part_caste_id" id="part_caste_id"    class="form-control">
                              <option value="">--Select Religion first--</option>
                              </select>
                            </div>                            
                          </div>      
                          
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-4 control-label">Partner Height</label>
                      <div class="col-sm-3">
                      <select name="txtSheight" class="form-control">
                     <option value="Below 4ft 6in">Below 4ft 6in - 137cm</option>
                                            <option value="4ft 6in">4ft 6in - 137cm</option>
                                            <option value="4ft 7in">4ft 7in - 139cm</option>
                                            <option value="4ft 8in">4ft 8in - 142cm</option>
                                            <option value="4ft 9in">4ft 9in - 144cm</option>
                                            <option value="4ft 10in">4ft 10in - 147cm</option>
                                            <option value="4ft 11in">4ft 11in - 149cm</option>
                                            <option value="5ft">5ft - 152cm</option>
                                            <option value="5ft 1in">5ft 1in - 154cm</option>
                                            <option value="5ft 2in">5ft 2in - 157cm</option>
                                            <option value="5ft 3in">5ft 3in - 160cm</option>
                                            <option value="5ft 4in">5ft 4in - 162cm</option>
                                            <option value="5ft 5in">5ft 5in - 165cm</option>
                                            <option value="5ft 6in">5ft 6in - 167cm</option>
                                            <option value="5ft 7in">5ft 7in - 170cm</option>
                                            <option value="5ft 8in">5ft 8in - 172cm</option>
                                            <option value="5ft 9in">5ft 9in - 175cm</option>
                                            <option value="5ft 10in">5ft 10in - 177cm</option>
                                            <option value="5ft 11in">5ft 11in - 180cm</option>
                                            <option value="6ft">6ft - 182cm</option>
                                            <option value="6ft 1in">6ft 1in - 185cm</option>
                                            <option value="6ft 2in">6ft 2in - 187cm</option>
                                            <option value="6ft 3in">6ft 3in - 190cm</option>
                                            <option value="6ft 4in">6ft 4in - 193cm</option>
                                            <option value="6ft 5in">6ft 5in - 195cm</option>
                                            <option value="6ft 6in">6ft 6in - 198cm</option>
                                            <option value="6ft 7in">6ft 7in - 200cm</option>
                                            <option value="6ft 8in">6ft 8in - 203cm</option>
                                            <option value="6ft 9in">6ft 9in - 205cm</option>
                                            <option value="6ft 10in">6ft 10in - 208cm</option>
                                            <option value="6ft 11in">6ft 11in - 210cm</option>
                                            <option value="7ft">7ft - 213cm</option>
                                            <option value="Above 7ft">Above 7ft - 213cm</option>
                      </select>
                      </div>
                            <div class="col-sm-1">
                <label>To</label>
                </div>
                            <div class="col-sm-3">
                              <select name="txtEheight" class="form-control">
                            <option value="Below 4ft 6in">Below 4ft 6in - 137cm</option>
                                            <option value="4ft 6in">4ft 6in - 137cm</option>
                                            <option value="4ft 7in">4ft 7in - 139cm</option>
                                            <option value="4ft 8in">4ft 8in - 142cm</option>
                                            <option value="4ft 9in">4ft 9in - 144cm</option>
                                            <option value="4ft 10in">4ft 10in - 147cm</option>
                                            <option value="4ft 11in">4ft 11in - 149cm</option>
                                            <option value="5ft">5ft - 152cm</option>
                                            <option value="5ft 1in">5ft 1in - 154cm</option>
                                            <option value="5ft 2in">5ft 2in - 157cm</option>
                                            <option value="5ft 3in">5ft 3in - 160cm</option>
                                            <option value="5ft 4in">5ft 4in - 162cm</option>
                                            <option value="5ft 5in">5ft 5in - 165cm</option>
                                            <option value="5ft 6in">5ft 6in - 167cm</option>
                                            <option value="5ft 7in">5ft 7in - 170cm</option>
                                            <option value="5ft 8in">5ft 8in - 172cm</option>
                                            <option value="5ft 9in">5ft 9in - 175cm</option>
                                            <option value="5ft 10in" selected>5ft 10in - 177cm</option>
                                            <option value="5ft 11in">5ft 11in - 180cm</option>
                                            <option value="6ft">6ft - 182cm</option>
                                            <option value="6ft 1in">6ft 1in - 185cm</option>
                                            <option value="6ft 2in">6ft 2in - 187cm</option>
                                            <option value="6ft 3in">6ft 3in - 190cm</option>
                                            <option value="6ft 4in">6ft 4in - 193cm</option>
                                            <option value="6ft 5in">6ft 5in - 195cm</option>
                                            <option value="6ft 6in">6ft 6in - 198cm</option>
                                            <option value="6ft 7in">6ft 7in - 200cm</option>
                                            <option value="6ft 8in">6ft 8in - 203cm</option>
                                            <option value="6ft 9in">6ft 9in - 205cm</option>
                                            <option value="6ft 10in">6ft 10in - 208cm</option>
                                            <option value="6ft 11in">6ft 11in - 210cm</option>
                                            <option value="7ft">7ft - 213cm</option>
                                            <option value="Above 7ft">Above 7ft - 213cm</option>
                              </select>
                            </div>
                          </div>     
                         <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Partner Education&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="txtPEducation[]" id="txtPEducation" data-validetta="required" data-placeholder="Select multiple education"  class="form-control chosen-select" multiple>
                              
                     <?php
		    $SQL_STATEMENT =  "SELECT * FROM education_detail WHERE status='APPROVED' ORDER BY edu_name ASC";
		    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		    {
		    ?>
		    <option value="<?php echo $DatabaseCo->dbRow->edu_id; ?>"><?php echo $DatabaseCo->dbRow->edu_name; ?></option>
		    <?php } ?>
                              </select>
                            </div>                            
                          </div> 
                            <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Complexion&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="part_complexation[]" id="part_complexation" data-validetta="required" data-placeholder="Select multiple complexion"  class="form-control chosen-select" multiple>
                              
                                <option value="Very Fair">Very Fair</option>
                                <option value="Fair">Fair</option>
                                <option value="Wheatish">Wheatish</option>
                                <option value="Wheatish Medium">Wheatish Medium</option>
                                <option value="Wheatish Brown">Wheatish Brown</option>
                                <option value="Dark">Dark</option>
                              </select>
                            </div>                            
                          </div>  
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Partner Mothertongue&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-5">
                              <select name="pmtongue[]" id="pmtongue" data-validetta="required" data-placeholder="Select multiple mothertongue"  class="form-control chosen-select" multiple>
                             
                     <?php
		    $SQL_STATEMENT =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
		    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		    {
		    ?>
		    <option value="<?php echo $DatabaseCo->dbRow->mtongue_id; ?>"><?php echo $DatabaseCo->dbRow->mtongue_name; ?></option>
		    <?php } ?>
                              </select>
                            </div>                            
                          </div>    
                         
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Partner Annual Income</label>
                            <div class="col-sm-5">
                              <select  name="part_income" id="part_income" class="form-control">
                              <option value="">Select Annual Income</option>
		     		<option value="Rs.10,000 - 50,000">Rs.10,000 - 50,000</option>
					<option value="Rs.50,000 - 1,00,000">Rs.50,000 - 1,00,000</option>
					<option value="Rs.1,00,000 - 2,00,000">Rs.1,00,000 - 2,00,000</option>
					<option value="Rs.2,00,000 - 5,00,000">Rs.2,00,000 - 5,00,000</option>
					<option value="Rs.5,00,000 - 10,00,000">Rs.5,00,000 - 10,00,000</option>
					<option value="Rs.10,00,000 - 50,00,000">Rs.10,00,000 - 50,00,000</option>
					<option value="Rs.50,00,000 - 1,00,00,000">Rs.50,00,000 - 1,00,00,000</option>
					<option value="Above Rs.1,00,00,000">Above Rs.1,00,00,000</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                          <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-7">
                              <button type="submit" name="submit" class="btn btn-success btn-lg">Register</button>
                            </div>
                          </div>
                    </form>
                        </div>    
                    </div>
              </div> 
         </div>
           
	</div>
	</div>
	</article>
     
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
</div>
	
    <script src="js/bootstrap.min.js"></script>
 	<script src="js/validetta.js" type="text/javascript"></script>
    <script src="js/chosen.jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
		

		var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }	
   	
	
   </script>
   
    <script type="text/javascript">
    $(function(){
    	$('#reg_form').validetta({
    		errorClose : false,
			custom : {
    			regname : {
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Custom Reg Error Message !'
    			},
                // you can add more
    			example : { 
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Lan mal !'
    			}
    		},
            realTime : true
    	});	 
	
		
    });
    </script>
    
    <script type="text/javascript">  
		   $("#part_religion_id").on('change', function()
		   {
			   
			$("#CasteDivloader").html('<img src="images/loader/9.gif" align="absmiddle">&nbsp;Loading...');			
		    var selectedReligion = $("#part_religion_id").val() 
			var dataString = 'religion='+ selectedReligion;
			
						
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "part_rel_caste.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
					
				$("#part_caste_id").remove();	
								
				$('#CasteDiv1').find('option').remove().end().append(response);

				
				$("#part_caste_id_chosen").remove();
				$("#CasteDivloader").html('');		
				 
				 var config = {
      					'.chosen-select'           : {},
      					'.chosen-select-deselect'  : {allow_single_deselect:true},
      					'.chosen-select-no-single' : {disable_search_threshold:10},
      					'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      						'.chosen-select-width'     : {width:"95%"}
										}
										for (var selector in config)
										 {
										  $(selector).chosen(config[selector]);
										}	
			},			
			});		
		});	
    </script>
 </body>
</html>