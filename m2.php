<?php
	include_once 'databaseConn.php';
	require_once('auth.php');
    $mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
	include_once './lib/requestHandler.php';        
	include_once './class/Location.class.php';
	include_once './class/Config.class.php';	
	$configObj = new Config();
	$DatabaseCo = new DatabaseConn();
    $DatabaseCo1 = new DatabaseConn();
	$DatabaseCoCount = new DatabaseConn();
	include_once './lib/progressbar.php';
	
	
	if(isset($_REQUEST['submit']))
	{
		$abc=$_REQUEST['contact_secure'];
		$upd=mysql_query("update register set contact_view_security='$abc' where matri_id='$mid'");
	}
	
	//My Interest Received data
	$rec_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
	$rec_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
	$rec_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Reject'", $DatabaseCoCount);
   
	//My Interest Send data
	$sent_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
	$sent_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
	$sent_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Reject'", $DatabaseCoCount);
  
	//My Message received 
	$sent_msg = getRowCount("select count(mes_id) from messages where to_id='$mid' AND status='Sent'", $DatabaseCoCount);
	$receive_msg = getRowCount("select count(mes_id) from messages where from_id='$mid' AND status='Sent'", $DatabaseCoCount);
   
	//My Sortlist Member
	$srtlist = getRowCount("select count(save_id) from save_profile where user_id='$mid'", $DatabaseCoCount);
	
	//My Photo Request
	$sent_ph_req = getRowCount("select count(ph_reqid) from photoprotect_request where ph_requester_id='$mid' ", $DatabaseCoCount);
	$receive_ph_req = getRowCount("select count(ph_reqid) from photoprotect_request where ph_receiver_id='$mid' ", $DatabaseCoCount);
	
	//My Blocklist Member
	$blacklist = getRowCount("select count(block_id) from block_profile where block_by='$mid'", $DatabaseCoCount);
		
        $SQL_STATEMENT =  "SELECT * FROM register_view WHERE matri_id='$mid'";
        $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
        $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);        
       
        ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
<ol class="breadcrumb">
  		<li><a href="#">Home</a></li>
  		<li class="active">My Account</li>
	</ol>
     
        <div class="panel panel-default">
            <div class="panel-body bg-success">
                    <div class="col-sm-2 col-xs-12">
                    	<?php
                          if($DatabaseCo->dbRow->photo1!="")
                                            {
                                             ?><img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-xs-12" style="height:160px; width:120px;">
                                                
                                             <?php 
											}												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-xs-12" style="height:160px; width:120px;"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" class="img-thumbnail col-xs-12" style="height:160px; width:120px;"/>
                                              <?php } 
											 }?>    
                    </div>
                    <div class="col-sm-10">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-5"><strong>Complete Your Profile :</strong></div>
                            <div class="col-sm-7">
                            <div class="progress progress-striped active">
                             <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%;">                       
                                   <?php echo $percentage; ?> %
                             </div>   
                            </div> 
                            </div>
                            </div>
                            <div class="row text-danger">
                                <div class="col-sm-6">
                                <ul class="list-group-item-heading">
                                    <li><b>Name :</b> <?php echo $DatabaseCo->dbRow->username; ?></li><br>

                                    <li><b>Contact :</b> <?php echo $DatabaseCo->dbRow->mobile; ?></li><br>
                                    <li><b>Country : </b> <?php echo $DatabaseCo->dbRow->country_name; ?></li>
                                </ul>
                               
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-group-item-heading">
                                    <li><b>Religion : </b><?php echo $DatabaseCo->dbRow->religion_name; ?></li><br>
                                    <li><b>Caste : </b><?php echo $DatabaseCo->dbRow->caste_name; ?></li><br>
                                    <li><b>City : </b><?php echo $DatabaseCo->dbRow->city_name; ?></li>
                                </ul>
                            </div>
                            </div>
                        </div>                       
                       
                        <div class="col-sm-4">
                            <div class="row">                               
                                <!--  Outer wrapper for presentation only, this can be anything you like -->
                                <div id="banner-fade">
                                  <!-- start Basic Jquery Slider -->                                  
                                  <ul class="bjqs">
                                      <?php 
                                      $sql = mysql_query("select * from register where matri_id='$mid'");
                                      while ($row = mysql_fetch_array($sql)) {                                      
                                      if($row['profileby']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Profile Created by</a></span>
                                          <p>To improve you profile.</p>
                                      </li>  
                                      <?php } 
                                      if($row['reference']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Referenced by</a></span>
                                          <p>To improve you profile.</p>
                                      </li>  
                                      <?php } 
                                      if($row['birthtime']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Birth Time</a></span>
                                          <p>To improve you profile.</p>
                                      </li>  
                                      <?php                                      
                                      }
                                      if($row['birthplace']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Birth Place</a></span>
                                          <p>To improve you profile.</p>
                                      </li>  
                                      <?php } 
                                      if($row['income']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Income</a></span>
                                          <p>To improve you profile.</p>
                                      </li>  
                                      <?php                                       
                                      } 
                                       if($row['emp_in']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Employed In</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['subcaste']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Subcaste</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['diet']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Diet</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['residence']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Residence</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['father_name']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Father name & occupation</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
									  if($row['mother_name']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Mother name & occupation</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['family_details']=='' || $row['family_type']=='' || $row['family_status']=='' || $row['family_origin']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Family Details</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['part_income']=='')
                                      {
                                      ?>                                      
                                      <li> 	
                                          <span><a href="edit-profile.php">Add your Partner Income</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['part_expect']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="edit-profile.php">Add your Part Expectation</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      if($row['photo1']=='')
                                      {
                                      ?>                                      
                                      <li>
                                          <span><a href="modify-photo.php">Add your Photos</a></span>
                                          <p>To improve you profile.</p>
                                      <?php                                       
                                      } 
                                      } 
                                      ?>
                                  </ul>
                                  <!-- end Basic jQuery Slider -->                                 
                                </div>                            
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <div class="row">
       
     <div class="col-sm-9 col-xs-12 col-sm-push-3 col-xs-push-0">            
            <div class="panel panel-default">
             <div class="panel-body">             	
                 <form action="" method="post" id="contact" name="contact" class="col-xs-12">
                            <span class="col-xs-12 col-sm-9 padding-left-zero padding-right-zero">
                              <input type="radio" value="0" name="contact_secure" <?php if($DatabaseCo->dbRow->contact_view_security=='0'){?> checked <?php } ?> /> &nbsp;&nbsp;&nbsp;Show my contact details to all paid members without any Express Interest  <br />
                            <input type="radio" value="1" name="contact_secure" <?php if($DatabaseCo->dbRow->contact_view_security=='1'){?> checked <?php } ?>/> &nbsp;&nbsp;&nbsp;Show my contact details only to the Express Interest accepted paid members       </span>
                            <div class="clearfix visible-xs"></div>
                            <input class="btn btn-warning btn-sm col-xs-12 col-sm-3 pull-right" type="submit" name="submit" value="Set" >
                </form>
                  
               </div>
             </div>
          
            <div class="panel panel-default">            
            <div class="panel-body"> 
             <?php if ($DatabaseCo->dbRow->status!='Paid')
			 { ?>
           <a href="payment.php"><img src="images/bg/banner1_membership.jpg" class="img-responsive" style="max-height: 200px;min-width: 100%" /></a>
           <?php
			 }
			 else
			 { ?>
             <div class="col-sm-12"> 
             <h2 class="panel-title"><img src="./images/icons/user.png" style="height: 24px;width: 24px; margin-bottom:5px;" /> &nbsp;&nbsp; Membership Status</h2>
                          <div class="row">   
                          <div style="border:10px solid #DA3A3F;" class="col-xs-12 col-sm-6">
                              <address class="col-lg-offset-1">
                                <p>&nbsp;</p>
                                  <b>Membership Plan</b><br />
                                  <span class="red_text">Total View Profiles Allow : </span><span class="green_text"><?php echo $resultwe['profile'];?></span><br /> 
                                  <span class="red_text">Total Contacts Allow : </span><span class="green_text"><?php echo $resultwe['p_no_contacts'];?></span><br />
                                  <span class="red_text">Total Messages Allow : </span><span class="green_text"><?php echo $resultwe['p_msg'];?></span><br />
                                  <span class="red_text">Membership Expired on : </span><span class="green_text"><?php echo $resultwe['exp_date'];?></span><br />
                              </address>
                          </div>
                          
                          <div style="border:10px solid #DA3A3F;" class="col-xs-12 col-sm-6">
                              <address class="col-lg-offset-1">
                                  <p>&nbsp;</p>
                                  <b><?php echo $resultwe['p_plan'];?> Membership</b><br />
                                  <span class="red_text">Remaining View Profiles :  </span><span class="green_text"><?php echo ($resultwe['profile']-$resultwe['r_profile']);?></span><br /> 
                                  <span class="red_text">Remaining Contacts : </span><span class="green_text"><?php echo ($resultwe['p_no_contacts']-$resultwe['r_cnt']);?></span><br />
                                  <span class="red_text">Remaining Messages : </span><span class="green_text"><?php echo ($resultwe['p_msg']-$resultwe['r_sms']);?></span><br />
                                  <span class="red_text">Membership Activated on : </span><span class="green_text"><?php echo $resultwe['pactive_dt'];?></span><br />
                              </address>
                          </div>
                          </div>

                      </div>
             
             <?php				 
			 }
		   ?>
          	</div>
            </div>
            
            <?php
	if($_SESSION['gender123'])
	{
			if($_SESSION['gender123']=='Male')
			{
			 $gender="where gender='Female'";
			}
			else
			{
			 $gender="where gender='Male'";	
			}		
	}
	else
	{
	 	$gender='';
	}
               $SQL_STATEMENT1 =  "SELECT * FROM register_view $gender and status!='Inactive' and status!='Suspended' ORDER BY reg_date ASC LIMIT 0, 3";
               $DatabaseCo1->dbResult1=$DatabaseCo1->getSelectQueryResult($SQL_STATEMENT1);
               $recently_joined = getRowCount("select count(index_id) FROM register_view $gender and status!='Inactive' and status!='Suspended'", $DatabaseCoCount);
          ?>
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Recently Joined</h3>
            </div>
            <div class="panel-body"> 
                <?php 
				
				if($recently_joined!=0)
				{
				
						while($DatabaseCo1->dbRow1 = mysql_fetch_object($DatabaseCo1->dbResult1))
							{
							?>
						<div class="profile">                   
							 <?php
                                                 if($DatabaseCo1->dbRow1->photo1!="" && $DatabaseCo1->dbRow1->photo_pswd=="" &&  $DatabaseCo1->dbRow1->photo1_approve!="UNAPPROVED" )
                                            {
                                             ?><img src="photos/watermark.php?image=<?php echo $DatabaseCo1->dbRow1->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>" class="img-thumbnail" style="width:80px; height:80px;"/>
                                                
                                             <?php 
                                                  }
												  elseif($DatabaseCo1->dbRow1->photo_protect=="Yes" && $DatabaseCo1->dbRow1->photo_pswd!='')
												  {
                                                                if($DatabaseCo1->dbRow1->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                <?php } ?>                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo1->dbRow1->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo1->dbRow1->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo1->dbRow1->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php } 
											 }?>                
							<p>
								 <b><a href="memprofile.php?PMid=<?php echo $DatabaseCo1->dbRow1->matri_id; ?>"><?php echo $DatabaseCo1->dbRow1->username; ?>,</a></b><br />
								<?php echo floor((time() - strtotime($DatabaseCo1->dbRow1->birthdate))/31556926); ?> Years  , <?php echo $DatabaseCo1->dbRow1->height; ?> Inch, <?php echo $DatabaseCo1->dbRow1->religion_name; ?> ,<?php echo $DatabaseCo1->dbRow1->caste_name; ?> ,<br />
								<?php echo $DatabaseCo1->dbRow1->ocp_name; ?> , <?php echo $DatabaseCo1->dbRow1->city_name; ?> ,<?php echo $DatabaseCo1->dbRow1->country_name; ?><br />
								<a href="memprofile.php?PMid=<?php echo $DatabaseCo1->dbRow1->matri_id; ?>">View Full Profile</a>
							</p>
						</div>
						 <?php }
				}
				else
				{ ?>
                <div class="profile">                   
							                
							<p>
								No Profile Found !!! 
							</p>
						</div>
                <?php
				}
			    ?>
               
            </div>
          </div>
         
           <?php
                   $SQL_STATEMENT1 =  "SELECT * FROM register_view WHERE religion IN (".$DatabaseCo->dbRow->part_religion.") AND gender!='".$DatabaseCo->dbRow->gender."' and status!='Inactive' and status!='Suspended' ORDER BY RAND() LIMIT 0, 3";
					
                    $DatabaseCo1->dbResult1=$DatabaseCo1->getSelectQueryResult($SQL_STATEMENT1);
                   $my_matches = getRowCount("select count(index_id) FROM register_view WHERE religion IN (".$DatabaseCo->dbRow->part_religion.") AND gender!='".$DatabaseCo->dbRow->gender."' and status!='Inactive' and status!='Suspended'", $DatabaseCoCount);
           ?>
         <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">My Matches</h3>
            </div>
            <div class="panel-body">
            <?php
            if($my_matches!=0)
				{
                
                              
							while($DatabaseCo1->dbRow1 = mysql_fetch_object($DatabaseCo1->dbResult1))
							{
							?>
						<div class="profile">     
									  <?php
                                                 if($DatabaseCo1->dbRow1->photo1!="" && $DatabaseCo1->dbRow1->photo_protect=="" &&  $DatabaseCo1->dbRow1->photo1_approve!="UNAPPROVED"  )
                                            {
                                             ?><img src="photos/watermark.php?image=<?php echo $DatabaseCo1->dbRow1->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>" class="img-thumbnail" style="width:80px; height:80px;"/>
                                                
                                             <?php 
                                                  }
												  elseif($DatabaseCo1->dbRow1->photo_protect=="Yes" && $DatabaseCo1->dbRow1->photo_pswd!='')
												  {
                                                                if($DatabaseCo1->dbRow1->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo1->dbRow1->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                <?php } ?>                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo1->dbRow1->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo1->dbRow1->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo1->dbRow1->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php } 
											 }?>        
							<p>
								 <b><a href="memprofile.php?PMid=<?php echo $DatabaseCo1->dbRow1->matri_id; ?>"><?php echo $DatabaseCo1->dbRow1->username; ?>,</a></b><br />
								<?php echo floor((time() - strtotime($DatabaseCo1->dbRow1->birthdate))/31556926); ?> Years years , <?php echo $DatabaseCo1->dbRow1->height; ?> Inch, <?php echo $DatabaseCo1->dbRow1->religion_name; ?> ,<?php echo $DatabaseCo1->dbRow1->caste_name; ?> ,<br />
								<?php echo $DatabaseCo1->dbRow1->ocp_name; ?> , <?php echo $DatabaseCo1->dbRow1->city_name; ?> ,<?php echo $DatabaseCo1->dbRow1->country_name; ?><br />
								<a href="memprofile.php?PMid=<?php echo $DatabaseCo1->dbRow1->matri_id; ?>">View Full Profile</a>
							</p>
						</div>
						 <?php }
				}
				else
				{
					?>
                <div class="profile">                   
							                
							<p>
								No Profile Found !!! 
							</p>
						</div>
                <?php
				}
			 ?>
                
            </div>
          </div>
          
         <?php
               $SQL_STATEMENT1 =  "SELECT * FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.my_id=register_view.matri_id where who_viewed_my_profile.viewed_member_id='$mid' order by viewed_date DESC limit 0,3";
               $DatabaseCo->dbResult2=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1); 
			   
                $visited_member = getRowCount("select count(who_id) FROM who_viewed_my_profile JOIN register_view ON who_viewed_my_profile.my_id=register_view.matri_id where who_viewed_my_profile.viewed_member_id='".$mid."'", $DatabaseCoCount);
               ?>
            <div class="panel panel-default">
            <?php
            if($visited_member!=0)
				{ ?>
            <div class="panel-heading">
                <h3 class="panel-title">Member Visited My Profile</h3>
            </div>
            <div class="panel-body"> 
                <?php 				
				                      
						while($DatabaseCo->dbRow2 = mysql_fetch_object($DatabaseCo->dbResult2))
							{
							?>
						<div class="profile">                   
							
                                     <?php
                                                 if($DatabaseCo->dbRow2->photo1!="" && $DatabaseCo->dbRow2->photo_protect=="No" &&  $DatabaseCo->dbRow2->photo1_approve!="UNAPPROVED"  )
                                            {
                                             ?><img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow2->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow2->username; ?>" class="img-thumbnail" style="width:80px; height:80px;"/>
                                                
                                             <?php 
                                                  }
												  elseif($DatabaseCo->dbRow2->photo_protect=="Yes" && $DatabaseCo->dbRow2->photo_pswd!='')
												  {
                                                                if($DatabaseCo->dbRow2->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow2->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow2->username; ?>"  style="width:80px; height:80px;" class="img-thumbnail"/>
                                                                <?php } ?>                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow2->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow2->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow2->username; ?>" style="width:80px; height:80px;" class="img-thumbnail"/>
                                              <?php } 
											 }?>    
							<p>
								 <b><a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow2->matri_id; ?>"><?php echo $DatabaseCo->dbRow2->username; ?>,</a></b><br />
								<?php echo floor((time() - strtotime($DatabaseCo->dbRow2->birthdate))/31556926); ?> Years years , <?php echo $DatabaseCo->dbRow2->height; ?> Inch, <?php echo $DatabaseCo->dbRow2->religion_name; ?> ,<?php echo $DatabaseCo->dbRow2->caste_name; ?> ,<br />
								<?php echo $DatabaseCo->dbRow2->ocp_name; ?> , <?php echo $DatabaseCo->dbRow2->city_name; ?> ,<?php echo $DatabaseCo->dbRow2->country_name; ?><br />
								<a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow2->matri_id; ?>">View Full Profile</a>
							</p>
						</div>
							<?php }
					
					 
				?>
                 </div>
                 <?php	 
				}
				else
				{
					?>
                     <div class="panel-heading">
                <h3 class="panel-title">Featured Profile</h3>
            </div>
            <div class="panel-body"> 
                <?php include "page-part/featured-profile.php";?>
                 </div>
                <?php	
				}?>
               
           
          </div>
      </div>
      	<div class="col-sm-3 col-sm-pull-9 col-xs-12 col-xs-pull-0">      
        <?php 
        require_once 'page-part/left_colum.php';      
		
		require_once 'page-part/featured-video.php';      
        ?>
     </div>                 
	</div>
        <?php include 'advertise/add_full.php'; ?>
      <?php         require_once 'chat.php';         ?>	
     
<!-----------------------top part end-------------------------->

<?php include "page-part/footer.php";?>
</div>
     <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bjqs-1.3.min.js"></script>
        <script class="secret-source">
        jQuery(document).ready(function($) {
          $('#banner-fade').bjqs({
            height      : 120,
            width       : 620,
            responsive  : true
          });

        });
      </script>
 </body>
</html>