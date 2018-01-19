<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
	include_once './lib/requestHandler.php';
	include_once './class/Config.class.php';
	$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
		
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<?php include "page-part/head.php";?>
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
						<?php include('page-part/accountsidebar.php'); ?>
						<?php
			$SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
			$DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
				?>
						<div class="main-area gradient-rev">
								<div class="myaccount profile" style="margin-top:0px;">
									<div class="left">
										<div class="avathar">
											 <?php
                  if($DatabaseCo->dbRow->photo1!="")
                     {
               ?>
               <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" />
               <?php 
					}												 
				 else
					{   
                 if($DatabaseCo->dbRow->gender=='Male')
                    {
                ?>
                <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" />
                <?php 
				    }
			    else
				    { 
			    ?>
                <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" />
                 <?php
				    } 
					}
				 ?>  
										</div>
										<div class="contact-details">
											<button class="mail"><i class="ion-android-mail"></i><?php echo $DatabaseCo->dbRow->email; ?></button>
											<button class="call"><i class="ion-android-call"></i><?php echo $DatabaseCo->dbRow->phone; ?></button>
											<button class="address"><i class="ion-android-location"></i><?php echo $DatabaseCo->dbRow->city_name; ?>, <?php echo $DatabaseCo->dbRow->state_name; ?></button>
										</div>
									</div>
									<div class="right">
										<div class="top">
											<table class="profile-details">
												<tbody>
													<tr><td><label>Profile ID</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->matri_id; ?></td></tr>
													<tr><td><label>Name</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->username; ?></td></tr>
													<tr><td><label>Membership</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->status; ?>(<?php $exe=$DatabaseCo->dbRow->matri_id;
        $select=mysql_query("select * from payment_view where pmatri_id='$exe'") or die(mysql_error());
                     $fet=mysql_fetch_array($select); echo $fet['p_plan']; ?>)</td></tr>
													<tr><td><label>Looking</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->looking_for; ?></td></tr>
													<tr><td><label>Posted by</label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->profileby; ?></td></tr>
													<tr><td><label>Created</label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->reg_date)); ?></td></tr>
													<tr><td><label>Last Login</label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->last_login)); ?></td></tr>
												</tbody>
											</table>
										</div>
										<div class="bottom">
										<p><?php echo $DatabaseCo->dbRow->profile_text; ?></p>
										</div>
									</div>
								</div>
							</div><!-- Main Area -->
							
							<div class="main-area gradient-rev block-level" style="margin-top:20px">
								<h3>Basic Information</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td><label>Profile</label><?php echo $DatabaseCo->dbRow->matri_id; ?></td><td><label>Name</label><?php echo $DatabaseCo->dbRow->username; ?></td></tr>	
										<tr><td><label>Gender</label><?php echo $DatabaseCo->dbRow->gender; ?></td><td><label>Age</label><?php echo floor((time() - strtotime($DatabaseCo->dbRow->birthdate))/31556926); ?> Years</td></tr>	
										<tr><td><label>Date of Birth</label><?php echo $DatabaseCo->dbRow->birthdate; ?></td><td><label>Place of Birth</label><?php echo $DatabaseCo->dbRow->birthplace; ?></td></tr>	
										<tr><td><label>Marital Status</label><?php echo $DatabaseCo->dbRow->m_status; ?></td><td><label>Children Status</label><?php echo $DatabaseCo->dbRow->status_children; ?></td></tr>	
										<tr><td><label>Time of Birth</label><?php echo $DatabaseCo->dbRow->birthtime; ?></td><td><label>Created By</label><?php echo $DatabaseCo->dbRow->profileby; ?></td></tr>	
									</table>
								</div>
								<h3>Contact Details</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td colspan="2"><label>Address </label><?php echo $DatabaseCo->dbRow->address; ?></td></tr>
										<tr><td><label>Country</label><?php echo $DatabaseCo->dbRow->country_name; ?></td><td><label>State </label><?php echo $DatabaseCo->dbRow->state_name; ?></td></tr>										
										<tr><td><label>City</label><?php echo $DatabaseCo->dbRow->city_name; ?></td><td><label>Email ID </label><?php echo $DatabaseCo->dbRow->email; ?></td></tr>										
										<tr><td><label>Phone</label><?php echo $DatabaseCo->dbRow->phone; ?></td><td><label>Mobile</label><?php echo $DatabaseCo->dbRow->mobile; ?></td></tr>										
										<tr><td colspan="2"><label>Residence in</label><?php echo $DatabaseCo->dbRow->redidence; ?></td></tr>										
									</table>
								</div>
								<h3>Education and Occupation</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td><label>Education </label><?php $c=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.matri_id = '$mid'  GROUP BY a.edu_detail"));
				echo $c['edu_name']; ?></td><td><label>Occupation </label><?php echo $DatabaseCo->dbRow->ocp_name; ?></td></tr>								
										<tr><td><label>Employed in</label><?php echo $DatabaseCo->dbRow->emp_in; ?></td><td><label>Annual Income  </label> <?php echo $DatabaseCo->dbRow->income; ?></td></tr>								
																		
									</table>
								</div>
								<h3>Social Religious Background</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td><label>Religion</label><?php echo $DatabaseCo->dbRow->religion_name; ?></td><td><label>Caste/Sub Caste </label><?php echo $DatabaseCo->dbRow->caste_name; ?>/<?php echo $DatabaseCo->dbRow->subcaste; ?></td></tr>								
										<tr><td><label>Manglik/Dosham</label><?php echo $DatabaseCo->dbRow->manglik; ?></td><td><label>Gothram</label><?php echo $DatabaseCo->dbRow->gothra; ?></td></tr>								
										<tr><td><label>Language</label><?php echo $DatabaseCo->dbRow->m_tongue; ?></td><td><label>Star</label><?php echo $DatabaseCo->dbRow->star; ?></td></tr>								
										<tr><td><label>Moonsign </label><?php echo $DatabaseCo->dbRow->moonsign; ?></td><td><label>Horoscope </label><?php echo $DatabaseCo->dbRow->horoscope; ?></td></tr>								
									</table>
								</div>
								<h3>Physical Status and Lifestyle</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td><label>Height</label><?php echo $DatabaseCo->dbRow->height; ?></td><td><label>Weight</label><?php echo $DatabaseCo->dbRow->weight; ?> kg</td></tr>																
										<tr><td><label>Blood Group</label><?php echo $DatabaseCo->dbRow->b_group; ?></td><td><label>Body Type</label><?php echo $DatabaseCo->dbRow->bodytype; ?></td></tr>																
										<tr><td><label>Complexion</label><?php echo $DatabaseCo->dbRow->complexion; ?></td><td><label>Diet</label><?php echo $DatabaseCo->dbRow->diet; ?></td></tr>																
										<tr><td><label>Smoke</label><?php echo $DatabaseCo->dbRow->smoke; ?></td><td><label>Drink</label><?php echo $DatabaseCo->dbRow->drink; ?></td></tr>																
									</table>
								</div>
								<h3>Profile Description</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr>
										<td>
											<p><?php echo $DatabaseCo->dbRow->profile_text; ?></p>
										</td>
										</tr>																
									</table>
								</div>
								<h3>Family Details</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td colspan="2"><label>Family Details</label><?php echo $DatabaseCo->dbRow->family_details; ?></td></tr>																															
										<tr><td><label>Family Values</label><?php echo $DatabaseCo->dbRow->family_value; ?></td><td><label>Family Type</label><?php echo $DatabaseCo->dbRow->family_type; ?></td></tr>																															
										<tr><td><label>Family Status</label><?php echo $DatabaseCo->dbRow->family_status; ?></td><td><label>Father Occupation</label><?php echo $DatabaseCo->dbRow->father_occupation; ?></td></tr>																															
										<tr><td><label>Mother Occupation</label><?php echo $DatabaseCo->dbRow->mother_occupation; ?></td><td><label>Family Origin </label><?php echo $DatabaseCo->dbRow->family_origin; ?></td></tr>																															
										<tr><td><label>No Of Brothers</label><?php echo $DatabaseCo->dbRow->no_of_brothers; ?></td><td><label>No Of Sisters</label><?php echo $DatabaseCo->dbRow->no_of_sisters; ?></td></tr>																															
										<tr><td><label>No Of Bro Married</label><?php echo $DatabaseCo->dbRow->no_marri_brother; ?></td><td><label>No Of Sis Married</label><?php echo $DatabaseCo->dbRow->no_marri_sister; ?></td></tr>																															
									</table>
								</div>
								<h3>Partner Preference</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td colspan="2"><label>Age</label><?php echo $DatabaseCo->dbRow->part_frm_age; ?> Between <?php echo $DatabaseCo->dbRow->part_to_age; ?></td></tr>																															
										<tr><td><label>Looking For</label><?php echo $DatabaseCo->dbRow->looking_for; ?></td><td><label>Complexion</label><?php echo $DatabaseCo->dbRow->part_complexation; ?></td></tr>																															
										<tr><td><label>Height</label><?php echo $DatabaseCo->dbRow->part_height; ?> to <?php echo $DatabaseCo->dbRow->part_height; ?></td><td><label>Partner Preference</label><?php echo $DatabaseCo->dbRow->part_expect; ?></td></tr>																															
										<tr><td><label>Religion</label><?php $f=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.matri_id = '$mid'  GROUP BY a.part_religion"));
				echo $f['part_religion'];?></td><td><label>Education</label><?php $e=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.matri_id = '$mid'  GROUP BY a.edu_detail"));
				echo $e['edu_name']; ?></td></tr>																															
										<tr><td><label>Country Living in</label><?php $d=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.matri_id = '$mid'  GROUP BY a.part_country_living"));
				echo $d['part_country'];?></td><td><label>Resident Status</label><?php if($DatabaseCo->dbRow->part_resi_status==''){ echo "Not Available"; } else { echo $DatabaseCo->dbRow->part_resi_status;} ?></td></tr>


									<tr><td><label>Caste</label><?php $g=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_sect  FROM   register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0 where a.matri_id = '$mid'  GROUP BY a.part_caste"));
				echo $g['part_sect'];?></td><td><label>Mother Tongue</label><?php $h=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS part_mtongue  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where a.matri_id = '$mid'  GROUP BY a.part_mtongue"));
				echo $h['part_mtongue'];?></td></tr>
				
				<tr><td colspan="2"><label>Income</label><?php echo $DatabaseCo->dbRow->part_income; ?></td></tr>
									</table>
								</div>
								<h3>Hobies and Interests</h3>
								<div class="block-level-table">
									<table class="simple-table">
										<tr><td ><label>Hobies and Interests</label><?php echo $DatabaseCo->dbRow->hobby; ?></td></tr>																																																													
																																																																							
									</table>
								</div>
								<h3>Horoscope</h3>
								<div class="block-level-table">
									<?php if($DatabaseCo->dbRow->hor_photo!="") { ?>
									<img src="horoscope-list/<?php echo $DatabaseCo->dbRow->hor_photo; ?>" alt=""  width="100%" >
									<?php } else { ?>
										No photo uploaded
									<?php } ?>
								</div>
								
							</div>
					</div>
			</div>
	</article>
			

<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>

</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>    
 </body>
</html>