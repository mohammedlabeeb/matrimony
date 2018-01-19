<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	if(isset($_SESSION['user_id']))
	{
		$smid = $_SESSION['user_id'];
	}
	  	include_once './class/Config.class.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$configObj = new Config();
		$DatabaseCo = new DatabaseConn();
		$matid=isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$PMID = isset($_REQUEST['PMid'])?$_REQUEST['PMid']:$_REQUEST['PMid'];
		
		
		if(isset($PMID))
		{
			
			$whocheck=mysql_query("SELECT * FROM who_viewed_my_profile where my_id='$matid' and viewed_member_id='$PMID'");
			if(mysql_num_rows($whocheck)==0)
			{
			$insert=mysql_query("insert into who_viewed_my_profile(my_id,viewed_member_id,viewed_date) values('$matid','$PMID',now())");
			}
			else
			{
			$update=mysql_query("update who_viewed_my_profile set my_id='$matid',viewed_member_id='$PMID',viewed_date=now() where my_id='$matid' and viewed_member_id='$PMID'");	
			}
			
					$sel=mysql_query("SELECT * FROM payments where pmatri_id='$smid'"); 
					$fet=mysql_fetch_array($sel);
					$tot_profile=$fet['profile'];
					$use_profile=$fet['r_profile'];
					$use_profile=$use_profile+1;
					
					$exp_date=$fet['exp_date'];
					$today= date('Y-m-d');
					
					if($tot_profile>=$use_profile && $exp_date > $today)
					{
		$update="UPDATE payments SET r_profile='$use_profile' WHERE pmatri_id='$smid' ";
						$d=mysql_query($update);
					}
					else
					{
						?>
			<script>alert('Your membership is expired, please upgrade your membership now.');</script>
						<?php
						echo "<script>window.location='payment.php'</script>";	
					}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>  
<?php include "page-part/head.php";?>	
<script type="text/JavaScript">

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}

</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
//  End -->
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
		 <?php
	$SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$PMID'";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	?>
	<?php
		   if(mysql_num_rows($DatabaseCo->dbResult)>0)
		   {?>
		<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						
							<div class="sidebar mini">
								<div class="avathar">
									 <?php
                           if($DatabaseCo->dbRow->photo1!="" && $DatabaseCo->dbRow->photo_pswd=="" && $DatabaseCo->dbRow->photo1_approve!="UNAPPROVED")
                           {
                         ?>
                      <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-sm-12 col-xs-12"/><br />
<a href="#" onClick="newWindow('view_photo_album.php?matri_id=<?php echo $DatabaseCo->dbRow->matri_id;?>','','790','440')" class="text-center col-xs-12">View Photo Album</a>
                         <?php 
                              }
								elseif($DatabaseCo->dbRow->photo_protect=="Yes" && $DatabaseCo->dbRow->photo_pswd!='')
							 {
                        ?>
                                                 
                         <?php  
                               if($DatabaseCo->dbRow->gender=='Male')
                             {
                          ?>                                    
                              <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-sm-12 col-xs-12"/>
                          <?php   
						     }
							 else
							 { 
						  ?>
                              <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-sm-12 col-xs-12"/>
                          <?php 
						   }
						   ?>
                          <br />
<a href="#" onClick="newWindow('send_pass_request.php?id=<?php echo $DatabaseCo->dbRow->matri_id;?>','','790','440')" style="margin-left:7px;">Send Photo Password Request</a>
                          <?php 											  
							}
							else
							{   
                            if($DatabaseCo->dbRow->gender=='Male')
                            {
                          ?>
                         <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-sm-12 col-xs-12" />
                           <?php  
						    }
							else
							{ 
							?>
                          <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-sm-12 col-xs-12" />
                           <?php 
						   }
						   }
						   ?>
								</div>
								<h3>
									<?php echo $DatabaseCo->dbRow->username; ?>
									<span><label>Profile ID</label> : <?php echo $DatabaseCo->dbRow->matri_id; ?></span>
								</h3>
								<div class="placeholder-ad medium">
									<img src="content/placeholder-medium.jpg" />
								</div>
							</div>
							
							
							<div class="main-area middle mini gradient-rev">
								<div class="selected-profile-details">
									<div class="headarea">
										<table cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td>
													<a href="search-result.php" class="back"><i class="ion-android-system-back"></i> Back to search result</a>
												</td>
												<td>
													 <?php
			
															$select=mysql_query("select * from shortlist where to_id='$PMID' and from_id='$matid'");
															if(mysql_num_rows($select)==0)
															{
															?>
														 <a href="#" id="<?php echo $PMID; ?>" onClick="add_shortlist();" class="addToshort-link favorite"><i class="ion-heart"></i>Add to Favorite </a>
														  <?php
															}
															else
															{
															?>
														 <a href="#" id="<?php echo $PMID; ?>" onClick="remove_shortlist();" class="addToblock-link favorite"><i class="ion-heart"></i>Remove Favorite </a>
														 <?php
															} ?>
													
												</td>
											</tr>
										</table>
									</div>
									<div class="details">
										<div class="left">
											<table class="profile-details" width="100%">
												<tr><td><label>Name</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->username; ?></td></tr>
												<tr><td><label>Age</label></td><td width="25" style="text-align:center">:</td><td><?php echo floor((time() - strtotime($DatabaseCo->dbRow->birthdate))/31556926); ?></td></tr>
												<tr><td><label>Height</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->height; ?></td></tr>
												<tr><td><label>Marital Status</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->m_status; ?></td></tr>
												<tr><td><label>Religion , Caste</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->religion_name; ?> , <?php echo $DatabaseCo->dbRow->caste_name; ?></td></tr>
												<tr><td><label>Location</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->city_name; ?>, <?php echo $DatabaseCo->dbRow->state_name; ?></td></tr>
											</table>
										</div>
										<div class="right">
											<a href="#" data-toggle="modal" data-target="#myModal1" onClick="getMessageReply('<?php echo $DatabaseCo->dbRow->matri_id; ?>')" class="mail"><i class="ion-android-mail"></i>Send personalized mail </a>
											
											<hr/>
											<a href="#" class="call" data-toggle="modal" data-target="#myModal2" onClick="getContactDetail('<?php echo $DatabaseCo->dbRow->matri_id; ?>')"><i class="ion-android-call"></i>Call / SMS </a>
											
											<button class="express-btn" data-target="#myModal4" data-toggle="modal" onClick="ExpressInterest('<?php echo $DatabaseCo->dbRow->matri_id; ?>')">Express Interest - FREE <i class="ion-ios7-bell"></i></button>
											<a href="#" class=""></a>
										</div>
									</div>
								</div>
								<div class="profile-info">
									<div class="left">
			
										<div class="bhoechie-tab-menu">
											<div class="list-group">
												<a href="#" class="list-group-item active text-center">
													<h4 class="ion-ios7-information"></h4>
													<span>Basic Information</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-briefcase"></h4>
													<span>Education and Occupation</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-android-share"></h4>
													<span>Social Religious Background</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-pie-graph"></h4>
													<span>Physical Status and Lifestyle</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-card"></h4>
													<span>Profile Description</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-android-friends"></h4>
													<span>Family Details</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-person-stalker"></h4>
													<span>Partner Preference</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-film-marker"></h4>
													<span>Hobies and Interests</span>
												</a>
												<a href="#" class="list-group-item text-center">
													<h4 class="ion-android-display"></h4>
													<span>Horoscope</span>
												</a>
											</div>
										</div>
									</div>
									<div class="right">
									
										<div class="bhoechie-tab">
											<div class="bhoechie-tab-content active">
												<table class="profile-list" width="100%">
													<tr><td><label>Profile ID</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->matri_id; ?></td></tr>
													<tr><td><label>Gender </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->gender; ?></td></tr>
													<tr><td><label>Date of Birth</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->birthdate; ?></td></tr>
													<tr><td><label>Marital Status</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->m_status; ?></td></tr>
													<tr><td><label>Time of Birth</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->birthtime==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->birthtime;} ?></td></tr>
													<tr><td><label>Age</label></td><td width="25" style="text-align:center">:</td><td><?php echo floor((time() - strtotime($DatabaseCo->dbRow->birthdate))/31556926); ?></td></tr>
													<tr><td><label>Place of Birth</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->birthplace==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->birthplace;} ?></td></tr>
													
												</table>
											</div>
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Education</label></td><td width="25" style="text-align:center">:</td><td><?php $c=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '$PMID'  GROUP BY a.edu_detail"));
													echo $c['edu_name']; ?></td></tr>
													
													<tr><td><label>Occupation </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->ocp_name; ?></td></tr>
													<tr><td><label>Employed in </label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->emp_in==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->emp_in;} ?></td></tr>
													<tr><td><label>Annual Income</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->income==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->income;} ?></td></tr>
												</table>
											</div>
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Religion</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->religion_name; ?></td></tr>
													<tr><td><label>Caste/Division</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->caste_name; ?></td></tr>
													<tr><td><label>Manglik/Dosham</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->manglik; ?></td></tr>
													<tr><td><label>Gothram</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->gothra==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->gothra;} ?></td></tr>
													<tr><td><label>Horoscope Match</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->horoscope; ?></td></tr>
													
													<tr><td><label>Sub Caste</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->subcaste==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->subcaste;} ?></td></tr>
													
													<tr><td><label>Star</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->star; ?></td></tr>
													
													<tr><td><label>Moon Sign</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->moonsign; ?></td></tr>
													
													<tr><td><label>Language </label></td><td width="25" style="text-align:center">:</td><td><?php $B=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS mtongue_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.m_tongue) >0 WHERE a.matri_id = '$PMID'  GROUP BY a.m_tongue"));
													echo $B['mtongue_name']; ?></td></tr>
													
												</table>
											</div>
											
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Height</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->height; ?></td></tr>
													<tr><td><label>Weight</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->weight; ?> kg</td></tr>
													<tr><td><label>Blood Group</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->b_group; ?></td></tr>
													<tr><td><label>Body Type</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->bodytype; ?></td></tr>
													<tr><td><label>Complexion</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->complexion; ?></td></tr>
													<tr><td><label>Diet</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->diet==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->diet;} ?></td></tr>
													<tr><td><label>Smoke</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->smoke; ?></td></tr>
													<tr><td><label>Drink</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->drink; ?></td></tr>
												</table>
											</div>
											
											<div class="bhoechie-tab-content">
												<p><?php echo $DatabaseCo->dbRow->profile_text; ?> </p>
											</div>
											
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Family Details</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->family_details==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_details;} ?></td></tr>
													
													
													<tr><td><label>Family Type</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->family_type==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_type;} ?></td></tr>
													<tr><td><label>Family Status</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->family_status==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_status;} ?></td></tr>
													<tr><td><label>Family Origin </label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->family_origin==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->family_origin;} ?></td></tr>
													
													<tr><td><label>Father Name</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->father_name==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->father_name;} ?></td></tr>
													<tr><td><label>Father Occupation</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->father_occupation==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->father_occupation;} ?></td></tr>
													
													<tr><td><label>Mother Name</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->mother_name==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->mother_name;} ?></td></tr>
													
													<tr><td><label>Mother Occupation</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->mother_occupation==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->mother_occupation;} ?></td></tr>
													
													<tr><td><label>No Of Bro Married</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->no_marri_brother==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->no_marri_brother;} ?></td></tr><?php if($DatabaseCo->dbRow->no_marri_sister==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->no_marri_sister;} ?></td></tr>
													<tr><td><label>No Of Brothers</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->no_of_brothers; ?></td></tr>
													<tr><td><label>No Of Sisters </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->no_of_sisters; ?></td></tr>
												</table>
											</div>
											
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Age</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->part_frm_age; ?> to <?php echo $DatabaseCo->dbRow->part_to_age; ?></td></tr>
													<tr><td><label>Looking For</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->looking_for; ?></td></tr>
													<tr><td><label>Complexion</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->part_complexation; ?></td></tr>
													<tr><td><label>Height</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->part_height; ?> / <?php echo $DatabaseCo->dbRow->part_height_to; ?></td></tr>
													<tr><td><label>Partner Preference</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->part_expect==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_expect;} ?></td></tr>
													<tr><td><label>Religion</label></td><td width="25" style="text-align:center">:</td><td><?php $f=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.matri_id = '$PMID'  GROUP BY a.part_religion"));echo $f['part_religion'];?></td></tr>
													
													<tr><td><label>Caste</label></td><td width="25" style="text-align:center">:</td><td><?php $g=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_sect  FROM   register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0 where a.matri_id = '$PMID'  GROUP BY a.part_caste"));echo $g['part_sect'];?></td></tr>
													
													<tr><td><label>Education</label></td><td width="25" style="text-align:center">:</td><td><?php $e=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.matri_id = '$PMID'  GROUP BY a.edu_detail"));
													echo $e['edu_name']; ?></td></tr>
													<tr><td><label>Country Living in</label></td><td width="25" style="text-align:center">:</td><td><?php $d=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.matri_id = '$PMID'  GROUP BY a.part_country_living"));
													echo $d['part_country'];?></td></tr>
													<tr><td><label>Resident Status</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->part_resi_status==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_resi_status;} ?></td></tr>
													<tr><td><label>Mother Tongue</label></td><td width="25" style="text-align:center">:</td><td><?php $h=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS part_mtongue  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where a.matri_id = '$PMID'  GROUP BY a.part_mtongue"));echo $h['part_mtongue'];?></td></tr>
													
													<tr><td><label>Income</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->part_income==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_income;} ?></td></tr>
												</table>
											</div>
											
											<div class="bhoechie-tab-content">
												<table class="profile-list" width="100%">
													<tr><td><label>Hobbies & Interest</label></td><td width="25" style="text-align:center">:</td><td><?php if($DatabaseCo->dbRow->hobby==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->hobby;} ?> </td></tr>
													
												</table>
											</div>
											
											<div class="bhoechie-tab-content">
												<?php		
													   if($DatabaseCo->dbRow->hor_photo!="" && $DatabaseCo->dbRow->hor_photo=='APPROVED')
														{	
														?>	
														<div style="width:620px; height:330px;">
											   <a href="horoscope-list/<?php echo $rowh['hor_photo']?>" class="horoscope"><img src="horoscope-list/<?php echo $rowh['hor_photo']?>"  width="100%" ></a>
														</div>
														<?php
														}
														elseif($DatabaseCo->dbRow->hor_photo!="" && $DatabaseCo->dbRow->hor_photo!=='APPROVED')
														{
														 ?>	
														<div style="width:630px; height:330px;">
											   <h4>Your horoscope is in waiting for Admin Approval. It will be online after approval...</h4>
														</div>
														<?php		
														}
														else
														{
														?>
													<h4>No horoscope Image available</h4>
													<?php	
														}
												
												?>
												
											</div>
											
											
										</div>
										
										
									</div>
								</div>
								
								<div class="footer-profile">
									<table width="100%" cellpadding="0" cellspacing="0">
										<tr>
											<td> <?php
			
													$select=mysql_query("select * from shortlist where to_id='$PMID' and from_id='$matid'");
													if(mysql_num_rows($select)==0)
													{
													?>
												 <a href="#" id="<?php echo $PMID; ?>" onClick="add_shortlist();" class="addToshort-link shortlist"><i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp; Add to Shortlist </a>
												  <?php
													}
													else
													{
													?>
													 <a href="#" id="<?php echo $PMID; ?>" onClick="remove_shortlist();" class="addToblock-link shortlist"><i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp; Remove from Shortlist  </a>
													 <?php
														} ?>
											</td>
											<td width="20"></td>
											<td><a href="#" class="forward"><i class="ion-forward"></i>Forward to a friend</a></td>
											<td>
												<div class="social-btns"> 
													<span class='st_sharethis_large' displayText='ShareThis'></span>
													<span class='st_facebook_large' displayText='Facebook'></span>
													<span class='st_twitter_large' displayText='Tweet'></span>
													<span class='st_linkedin_large' displayText='LinkedIn'></span>
													<span class='st_pinterest_large' displayText='Pinterest'></span>
													<span class='st_email_large' displayText='Email'></span>
													<script type="text/javascript">var switchTo5x=true;</script>
													<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
													<script type="text/javascript">stLight.options({publisher: "09af7ddb-25c9-4185-8037-721edec5d218", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
												</div>
											</td>
										</tr>
									</table>
								</div>
								
							</div>
							<div class="right-side">
								<div class="placeholder-ad large">
									<img src="content/ad-large.jpg" />
								</div>
								<div class="placeholder-ad small">
									<img src="content/placeholder-small.jpg" />
								</div>
							</div>
						</div>
					</div>
		</article>
<?php } ?>
 
  <script src="js/bootstrap.min.js"></script>
  <script src="js/function.js" type="text/javascript"></script>
   <div class="modal fade" id="myModal1"></div>
   <div class="modal fade" id="myModal2"></div>
   <div class="modal fade" id="myModal3"></div>
   <div class="modal fade" id="myModal4"></div>
 </body>
</html>