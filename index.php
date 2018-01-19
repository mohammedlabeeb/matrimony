<?php	
		ini_set('display_errors',0);
		ini_set('display_startup_errors',0);
		error_reporting(-1);
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();		
		include("BusinessLogic/class.socialicon.php");
		$scon=new socialicon();
		require_once("BusinessLogic/class.cms.php");
		$cm=new cms();
		$cms_id=17;
		$res2=$cm->get_cms_by_id($cms_id);
?>		
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<?php include "page-part/head.php";?>	


</head>
<body>

    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
	
	if(isset($_REQUEST['confirm_id']))
	{
		$confid=$_REQUEST['confirm_id'];
		$confemail=$_REQUEST['email'];
		
		$select=mysql_query("select matri_id from register where email='$confemail' and cpassword='$confid'");
		$exe=mysql_num_rows($select);
		
		if($exe>0)
		{
			$update=mysql_query("update register set cpass_status='yes',status='Active' where email='$confemail'");
			?>
		    <script>alert('Your account has been Activated...');</script>
		    <?php
			echo "<script>window.location='index.php'</script>";
			
		}
		else
		{
			?>
		    <script>alert('Error in activation...');</script>
		    <?php	
		}
		
	}
	?>

<div class="wrapper gradient">
	<header>
		<?php
		
		
		include "page-part/top-black.php";
		
		include "page-part/header.php";?>
					
	</header>
	
	<article>
		<?php while($row2 = mysql_fetch_array($res2))  { ?> 
			<div class="intro">
				<h2 class="headline"><?php echo $row2['cms_title']; ?></h2>
				<p><?php echo htmlspecialchars_decode($row2['cms_content']);?></p>
			</div>
		<?php } ?>
		<div class="inner">
			<div class="content">
				<div class="highlighted-profiles">
					<h3>Hightlighted Profiles</h3>
					<span class="control prev"><i class="ion-chevron-left"></i></span>
					<div class="frame" id="centered">
						<ul class="clearfix">
							 <?php 
								if($_SESSION['gender123'])
								{
										if($_SESSION['gender123']=='Male')
										{
										 $gender="and gender='Female'";
										}
										else
										{
										 $gender="and gender='Male'";	
										}		
								}
								else
								{
									$gender='';
								}
								$SQL_STATEMENT =  "SELECT * FROM register_view WHERE fstatus='Featured' $gender";
								$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
															
								if($DatabaseCo->dbRow = mysql_num_rows($DatabaseCo->dbResult)>0)
									{
									while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
										{
					
								?>
							<li>
								<a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow->matri_id; ?>">
									<div class="avathar">
									<?php	
									if($DatabaseCo->dbRow->photo1!='' && $DatabaseCo->dbRow->photo1_approve=='APPROVED' && $DatabaseCo->dbRow->photo_pswd=='')      { ?>
										<img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" />
									<?php
									}elseif($DatabaseCo->dbRow->photo_protect=='Yes'){
										if($DatabaseCo->dbRow->gender=='Male'){
									?>                                    
										<img  src="images/default-photo/photo-protected-male100.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" />
										<?php   } else { ?>
										<img  src="images/default-photo/photo-protected-female.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" />
									<?php } }  else {
									   if($DatabaseCo->dbRow->gender=='Male'){
									   ?>
											<img src="images/default-photo/male-200.png" alt="No Photo"  >
									   <?php      }else{            ?>
											<img src="images/default-photo/female-200.png" alt="No Photo"  >
									 <?php     }   }  ?>
									</div>
									<h4><?php echo $DatabaseCo->dbRow->username; ?></h4>
									<p>
									<?php $birthDate = $DatabaseCo->dbRow->birthdate;
								list($year,$month,$day) = explode("-",$birthDate);$year_diff = date("Y") - $year;$month_diff = date("m") - $month;$day_diff = date("d") - $day;if ($day_diff < 0 || $month_diff < 0)$year_diff--;echo $year_diff; ?> yrs ,  <?php echo $DatabaseCo->dbRow->caste_name; ?><br />
									<?php echo $DatabaseCo->dbRow->city_name; ?>
									</p>
								</a>
							</li>
							
							<?php } } ?>
							
						</ul>
					</div>
					<span class="control next"><i class="ion-chevron-right"></i></span>
					<a class="view-all-highlight" href="#">View all highlighted profiles <i class="ion-arrow-right-b"></i></a>	
					<hr/>
				</div>
				
				
							<div class="bottom">
								<div class="left">
									<div class="service-provider">
										<h3>Find your nearest matrimonial service</h3>
										<?php include('page-part/homewp.php'); ?>
										
									</div>
									<?php include('page-part/sstory.php'); ?>
								</div>
								<div class="right">
									<a href="#" class="reseller"><img src="assets/images/reseller.png" /></a>
									<div class="facebook-posts">
										<div id="fb-root"></div>
										<script>
										(function(d, s, id) {
										  var js, fjs = d.getElementsByTagName(s)[0];
										  if (d.getElementById(id)) return;
										  js = d.createElement(s); js.id = id;
										  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=343784129114213";
										  fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));
										</script>
										<div class="fb-page" data-href="https://www.facebook.com/peoplematrimony" data-width="305" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/peoplematrimony"><a href="https://www.facebook.com/peoplematrimony">peoplematrimony.com</a></blockquote></div></div>
									</div>
								</div>
							</div>
							<div class="bottom-links">
								<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td style="width:200px; border-right:1px solid #ccc;">
											<a href="#" class="chat quicklink">
												<i class="ion-person-stalker"></i>
												<h4>Live Chat</h4>
											</a>
										</td>
										<td style="width:200px; border-right:1px solid #ccc; padding-left:18px;">
											<a href="#" class="forum quicklink">
												<i class="ion-chatbubble-working"></i>
												<h4>Forum</h4>
											</a>
										</td>
										<td style="width:200px; padding-left:18px;">
											<a href="#" class="blog quicklink">
												<i class="ion-social-wordpress"></i>
												<h4>Our Blog</h4>
											</a>
										</td>
										<td><a href="#" class="advertise-btn">Advertise with PeopleMatrimony</a></td>
									</tr>
								</table>
							</div>
			
			</div>
		</div>
	
	</article>
	<?php include "page-part/footer.php";?>
</div>