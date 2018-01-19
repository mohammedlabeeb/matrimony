<?php
error_reporting(0);
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();

require_once("BusinessLogic/class.events.php");
require_once 'BusinessLogic/class.country.php';
$id=$_SESSION['id'];
$ob=new event();
$events=$ob->get_event_by_id($id);
$event=mysql_fetch_array($events);


if(isset($_REQUEST['submit']))
{
	$website = $configObj->getConfigName();
	$wfname = $configObj->getConfigFname();
	
	$logo = $configObj->getConfigLogo();
	$from = $configObj->getConfigContact();
	$event_name=$event['name'];
	$venue=$event['venue'];
	$date=$event['event_date'];
	$time=$event['event_time'];
	$one=$_REQUEST['one1'];
	$three=$_REQUEST['three1'];
	
	 $a= $one * $event['ticket'];
	 $b= $three * $event['ticket'];
	 
	 $c=$a+$b;
     $_SESSION['amount']=$c;

	 
	 $fullname1=$_REQUEST['fullname1'];
	 $fullname2=$_REQUEST['fullname2'];
	 $fullname3=$_REQUEST['fullname3'];
	 $fullname4=$_REQUEST['fullname4'];
	 $fullname5=$_REQUEST['fullname5'];
	 $fullname6=$_REQUEST['fullname6'];
	 $fullname7=$_REQUEST['fullname7'];
	 $fullname8=$_REQUEST['fullname8'];
	
	 $email1=$_REQUEST['email1'];
	 $email2=$_REQUEST['email2'];
	 $email3=$_REQUEST['email3'];
	 $email4=$_REQUEST['email4'];
	 $email5=$_REQUEST['email5'];
	 $email6=$_REQUEST['email6'];
	 $email7=$_REQUEST['email7'];
	 $email8=$_REQUEST['email8'];
	
	 $age1=$_REQUEST['age1'];
	 $age2=$_REQUEST['age2'];
	 $age3=$_REQUEST['age3'];
	 $age4=$_REQUEST['age4'];
	 $age5=$_REQUEST['age5'];
	 $age6=$_REQUEST['age6'];
	 $age7=$_REQUEST['age7'];
	 $age8=$_REQUEST['age8'];
		
	 $status1=$_REQUEST['status1'];
	 $status2=$_REQUEST['status2'];
	 $status3=$_REQUEST['status3'];
	 $status4=$_REQUEST['status4'];
	 $status5=$_REQUEST['status5'];
	 $status6=$_REQUEST['status6'];
	 $status7=$_REQUEST['status7'];
	 $status8=$_REQUEST['status8'];
	
	 $location1=$_REQUEST['location1'];
	 $location2=$_REQUEST['location2'];
	 $location3=$_REQUEST['location3'];
	 $location4=$_REQUEST['location4'];
	 $location5=$_REQUEST['location5'];
	 $location6=$_REQUEST['location6'];
	 $location7=$_REQUEST['location7'];
	 $location8=$_REQUEST['location8'];
	
	 $grew_up_in1=$_REQUEST['grew_up_in1'];
	 $grew_up_in2=$_REQUEST['grew_up_in2'];
	 $grew_up_in3=$_REQUEST['grew_up_in3'];
	 $grew_up_in4=$_REQUEST['grew_up_in4'];
	 $grew_up_in5=$_REQUEST['grew_up_in5'];
	 $grew_up_in6=$_REQUEST['grew_up_in6'];
	 $grew_up_in7=$_REQUEST['grew_up_in7'];
	 $grew_up_in8=$_REQUEST['grew_up_in8'];
	
	
	 $about_you1=$_REQUEST['about_you1'];
	 $about_you2=$_REQUEST['about_you2'];
	 $about_you3=$_REQUEST['about_you3'];
	 $about_you4=$_REQUEST['about_you4'];
	 $about_you5=$_REQUEST['about_you5'];
	 $about_you6=$_REQUEST['about_you6'];
	 $about_you7=$_REQUEST['about_you7'];
	 $about_you8=$_REQUEST['about_you8'];
	
	 $your_match1=$_REQUEST['your_match1'];
	 $your_match2=$_REQUEST['your_match2'];
	 $your_match3=$_REQUEST['your_match3'];
	 $your_match4=$_REQUEST['your_match4'];
	 $your_match5=$_REQUEST['your_match5'];
	 $your_match6=$_REQUEST['your_match6'];
	 $your_match7=$_REQUEST['your_match7'];
	 $your_match8=$_REQUEST['your_match8'];
	
	 $user_email=$_REQUEST['user_email'];
	 $user_phone=$_REQUEST['user_phone'];
	 $user_how_hear=$_REQUEST['user_how_hear'];
	 
	 if($fullname1!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname1','$email1','$age1','$status1','$event_name','$date','$location1','$grew_up_in1','$about_you1',' $your_match1','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname2!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname2','$email2','$age2','$status2','$event_name','$date','$location2','$grew_up_in2','$about_you2',' $your_match2','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname3!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname3','$email3','$age3','$status3','$event_name','$date','$location3','$grew_up_in3','$about_you3',' $your_match3','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname4!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname4','$email4','$age4','$status4','$event_name','$date','$location4','$grew_up_in4','$about_you4',' $your_match4','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname5!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname5','$email5','$age5','$status5','$event_name','$date','$location5','$grew_up_in5','$about_you5',' $your_match5','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname6!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname6','$email6','$age6','$status6','$event_name','$date','$location6','$grew_up_in6','$about_you6',' $your_match6','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname7!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname7','$email7','$age7','$status7','$event_name','$date','$location7','$grew_up_in7','$about_you7',' $your_match7','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 if($fullname8!='')
	 {
		$insert="insert into event_registered_people(fullname,email,age,status,event_name,event_date,location,gender,about_you,your_match,confirm_email,confirm_phone,user_how_hear) values('$fullname8','$email8','$age8','$status8','$event_name','$date','$location8','$grew_up_in8','$about_you8',' $your_match8','$user_email','$user_phone','$user_how_hear')";
		$exe=mysql_query($insert) or die (mysql_error());
		 
	 }
	 
	 $subject = "Your Confirmation For $event_name ";	
	
 	 $message = "
	    <html>
		<style type='text/css'>
		.green_text
		{
			font-family:Lucida Sans, Arial;
			font-size:14px;
			font-weight:900;
			color:#FF3300;
		}
		
		.red_text
		{
			font-family:Lucida Sans, Arial;
			font-size:14px;
			font-weight:900;
			color:#7e0000;
		}
		</style>
	    <body>		
		<table width='98%' style='border:double 5px #FF3300; margin:10px;' cellspacing='20px'>
	    <tr>
        <td>
            <table width='100%' height='auto' border='0' style='margin-left:auto; margin-right:auto;'>
               
                <tr>
                	<td  class='green_text' style='font-size:20px; text-decoration:underline; color:#FF3300;font-family:Lucida Sans, Arial;' colspan='2'>
                    	Confirmation Mail for $event_name
                    </td>
                </tr>
				
			     <tr>
                	<td style='padding-top:10px; line-height:25px; font-family:Lucida Sans, Arial;font-size:14px;font-weight:900;color:#7e0000;' colspan='2'>
             
			              <table border='0' width='90%'>
						  <tr>
						  <td>Dear, $user_email</td>
						  </tr>
						  <tr>
						  <td>Hi, Your Registration has been confirm at $sitename for $event_name</td>
						  </tr>
						  <tr>
						  <td>Event Date : $date</td>
						  </tr>
						  <tr>
						  <td>Event Time : $time</td>
						  </tr>
						   <tr>
						  <td>Venue : $venue</td>
						  </tr>
						   <tr>
						  <td>List of Participants : <br/>
						$fullname1 &nbsp;&nbsp;  $age1 &nbsp;&nbsp;   $email1 <br/>
	 					$fullname2 &nbsp;&nbsp;  $age2 &nbsp;&nbsp;   $email2 <br/>
					    $fullname3 &nbsp;&nbsp;  $age3 &nbsp;&nbsp;   $email3 <br/>
						$fullname4 &nbsp;&nbsp;  $age4 &nbsp;&nbsp;   $email4 <br/>
						$fullname5 &nbsp;&nbsp;  $age5 &nbsp;&nbsp;   $email5 <br/>
						$fullname6 &nbsp;&nbsp;  $age6 &nbsp;&nbsp;   $email6 <br/>
						$fullname7 &nbsp;&nbsp;  $age7 &nbsp;&nbsp;   $email7 <br/>
						$fullname8 &nbsp;&nbsp;  $age8 &nbsp;&nbsp;   $email8 <br/>
	 </td>
						  </tr>
						  
						  </table> 
                </td>
                </tr>
                
                                
            </table>
        </td>
    </tr>
</table>	
		</body>
		</html> 
		"; 
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$from."\r\n";
		
		mail($user_email,$subject, $message, $headers); 
		
		
	 echo "<script language='javascript'>window.location='go.php';</script>";
}
	?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />

<link href="css/ticket.css" type="text/css" rel="stylesheet" />
<link href="css/gallary.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

(function($,W,D)
{
    var JQUERY4U ={};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#tandcform").validate({
                rules: {
                    fullname1: "required",fullname2: "required",fullname3: "required",fullname4: "required",fullname5: "required",fullname6: "required",fullname7: "required",fullname8: "required",
					age1: "required",age2: "required",age3: "required",age4: "required",age5: "required",age6: "required",age7: "required",age8: "required",
                    email1: {
                        required: true,
                        email: true
                    },email2: {
                        required: true,
                        email: true
                    },email3: {
                        required: true,
                        email: true
                    },email4: {
                        required: true,
                        email: true
                    },email5: {
                        required: true,
                        email: true
                    },email6: {
                        required: true,
                        email: true
                    },email7: {
                        required: true,
                        email: true
                    },email8: {
                        required: true,
                        email: true
                    },
                   	status:"required",
					location:"required",
					grew_up_in:"required",
				},
               
					
                   submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>

</head>
<body>		

        <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end-------------------------> 
     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Events</li>
    </ol>
 		
        <div class="panel panel-success">
          <div class="panel-heading">
          		<div class="panel-title">
                	Check Out
                </div>
          </div>
          <div class="panel-body">
    	     <div class="col-sm-12">
               <div class="row">
               <h2 class="col-xs-12">Order Details</h2>
                  <div class="col-sm-12 thumbnail">
                  	    <div class="col-sm-4 col-xs-12 padding-left-zero padding-right-zero">
                    	   <div class="col-sm-12 thumbnail margin-bottom-zero text-center bg-green">
                             Event
                           </div>
                           <div class="clearfix"></div>
                           <div class="col-sm-12 text-center">
                           		<?php echo $event['name']; ?> - <?php echo $event['event_date']; ?>
                           </div>
                         </div>
                         <div class="col-sm-2 col-xs-6 padding-left-zero padding-right-zero">
                    	   <div class="col-sm-12 thumbnail margin-bottom-zero text-center bg-green">
                             Male
                           </div>
                           <div class="clearfix"></div>
                           <div class="col-sm-12 text-center">
                           	<?php echo $_POST['ValOne'];?>
                           </div>
                         </div>
                         <div class="col-sm-2 col-xs-6 padding-left-zero padding-right-zero">
                    	   <div class="col-sm-12 thumbnail margin-bottom-zero text-center bg-green text-center">
                             Female
                           </div>
                           <div class="clearfix"></div>
                           <div class="col-sm-12 text-center">
                           	 <?php echo $_POST['Valthree'];?>
                           </div>
                         </div>
                         <div class="clearfix visible-xs"></div>
                         <div class="col-sm-2 col-xs-12 padding-left-zero padding-right-zero">
                    	   <div class="col-sm-12 thumbnail margin-bottom-zero text-center bg-green">
                             Unit Price
                           </div>
                           <div class="clearfix"></div>
                           <div class="col-sm-12 text-center">
                           	&#8377; <?php echo $event['ticket'];?>
                           </div>
                         </div>
                         <div class="col-sm-2 col-xs-12 padding-left-zero padding-right-zero">
                    	   <div class="col-sm-12 thumbnail margin-bottom-zero text-center bg-green ">
                             Total
                           </div>
                           <div class="clearfix"></div>
                           <div class="col-sm-12 text-center">
                           	 &#8377; <?php
                     $a= $_POST['ValOne'] * $event['ticket'];
	 $b= $_POST['Valthree'] * $event['ticket'];
	 
	 $c=$a+$b;
	 echo  $c;?>
                           </div>
                         </div>
                         <div class="clearfix"></div>
                     </div>
                     <a href="event.php" class="btn btn-danger col-sm-2 col-sm-offset-5 col-xs-12 col-xs-offset-0">Back</a>
                </div>
             </div>
             <div class="col-sm-12">
             	<div class="row">
                	<h4>The participant information is confidential and will be stored on our secure database.We will not give out any details without your permisson.Information will be for Event Use.</h4>
                </div>
             </div>
             <form name="tandcform" method="post" id="tandcform" class="col-lg-12 col-xs-12 thumbnail">
             <?php
		
			for($i=1;$i<= $_POST['ValOne']+$_POST['Valthree'];$i++)
			{
			?>
             	<div class="col-xs-12 checkout-border margin-bottom">
                	<div class="row">
                    	<div class="col-xs-12 text-center">
                        	<h4>Participant <?php echo $i;?></h4>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                        	<div class="row">
 <input type="hidden" name="one<?php echo $i;?>" value="<?php echo $_POST['ValOne'];?>">
               
 <input type="hidden" name="three<?php echo $i;?>" value="<?php echo $_POST['Valthree'];?>">
                        		<div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Full Name:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<input type="text" class="form-control" name="fullname<?php echo $i;?>" id="fullname<?php echo $i;?>">
                            			</div>
                                    </div>
                       			</div>
                                <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Age:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<input type="text" class="form-control" name="age<?php echo $i;?>" id="age<?php echo $i;?>">
                            			 </div>
                                      </div>
                       			  </div>
                                  <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Current Location:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<select  class="form-control" name="location<?php echo $i;?>" id="location<?php echo $i;?>">
                                        		 <option value="">Please select...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="Brunei">Brunei</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Dominica">Dominica</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Libya">Libya</option>
<option value="Macau">Macau</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mauritius">Mauritius</option>
<option value="Mexico">Mexico</option>
<option value="Morocco">Morocco</option>
<option value="Myanmar">Myanmar</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
                                        	</select>
                            			 </div>
                                      </div>
                       			  </div>
                                  <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>About You:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<textarea  class="form-control" rows="4" name="about_you<?php echo $i;?>" id="about_you<?php echo $i;?>">
                                        		
                                        	</textarea>
                            			 </div>
                                      </div>
                       			  </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        	<div class="row">
                            
                        		<div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Email ID:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<input type="text" class="form-control" name="email<?php echo $i;?>" id="email<?php echo $i;?>">
                            			</div>
                                    </div>
                       			</div>
                                <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Status:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<select  class="form-control" name="status<?php echo $i;?>" id="status<?php echo $i;?>">
                                        		<option value="">Please select...</option>
	                 <option value="never_married" >Never Married</option>
	                 <option value="divorced" >Divorced</option>
	                 <option value="divorced_with_children" >Divorced with children</option>
	                 <option value="widow_widower" >Widow/Widower</option>
	                 <option value="widow_widower_with_children" >Widow/Widower with children</option>
                                        	</select>
                            			 </div>
                                      </div>
                       			  </div>
                                  <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Gender:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<select  class="form-control" name="grew_up_in<?php echo $i;?>" id="grew_up_in<?php echo $i;?>">
                                        		<option value="">Please select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                                        	</select>
                            			 </div>
                                      </div>
                       			  </div>
                                  <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Your Match:</label>
                            			</div>
                            			<div class="col-lg-7" >
                            				<textarea  class="form-control" rows="4" name="your_match<?php echo $i;?>" id="your_match<?php echo $i;?>">
                                        		
                                        	</textarea>
                            			 </div>
                                      </div>
                       			  </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
              <?php
			}
		
			?>   
                
                
                <div class="col-xs-12 checkout-border margin-top-10px">
                	<div class="row">
                    	<div class="col-xs-12 text-center">
                        	<h4>Confirmation Details</h4>
                            <hr>
                        </div>
                        <div class="col-lg-6">
                        	<div class="row">
                            
                        		<div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Email Address:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<input type="text" class="required form-control" name="user_email">
                            			</div>
                                    </div>
                       			</div>
                                <div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>How did you hear about us?:</label>
                            			</div>
                            			<div class="col-lg-7">
                  <select  class="required form-control" name="user_how_hear">
                                        		<option value="">Please select...</option>
                        <option value="google" >Google</option>
                        <option value="flyer" >Flyer</option>
                        <option value="word of mouth" >Word of Mouth</option>
                        <option value="search engine" >Search Engine</option>
                        <option value="other" >Other</option>
                                        	</select>
                            			 </div>
                                      </div>
                       			  </div>
                                  
                                  
                            </div>
                        </div>
                        <div class="col-lg-6">
                        	<div class="row">
                            
                        		<div class="form-group col-xs-12">
                                	<div class="row">
                        				<div class="col-lg-4">
                            				<label>Contact Number:</label>
                            			</div>
                            			<div class="col-lg-7">
                            				<input type="text" class="required form-control" name="user_phone">
                            			</div>
                                    </div>
                       			</div>
                                
                                  
                                  
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            
             
             <div class="col-xs-12 margin-top-10px">
              
              <input type="submit" name="submit" value="Continue" class="btn btn-success col-sm-2 col-sm-offset-5 col-xs-12 col-offset-0">
              
             </form>
          </div>
      </div>	

        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>

</div>
 </body>
</html>
 