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
<?php include "page-part/head.php";?>	
</head>
<body>	
<div class="wrapper gradient">  
    <header>
		<?php
		
		
		include "page-part/top-black.php";
		
		?>
					
	</header>	
<article style="margin-top:-50px;z-index:99">
					<div class="inner">
						<div class="inner-content">
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev">
								<div class="well">
								 <?php if ($DatabaseCo->dbRow->status!='Paid') { ?>
									<h4>Paid Member Benefits :</h4>
									<p>
										Paid members have 10 times more chances of finding a life partner. <br/>
										<a href="#">Become a paid member today</a> and also get 100% more benefits right away.
									</p>
									<ul class="list-benefits">
										<li>Send/receive Unlimited Personalised Messages</li>
										<li>View the Verified contact phone numbers,Address of members.</li>
									</ul>
								<?php } else { ?>
									<h4>Membership Status : <?php echo $DatabaseCo->dbRow->status; ?></h4>
									<div class="row">
										<div style="" class="col-xs-12 col-sm-6">
										  <address class="col-lg-offset-1">
											<p>&nbsp;</p>
											  <b>Membership Plan</b><br />
											  <span class="red_text">Total View Profiles Allow : </span><span class="green_text"><?php echo $resultwe['profile'];?></span><br /> 
											  <span class="red_text">Total Contacts Allow : </span><span class="green_text"><?php echo $resultwe['p_no_contacts'];?></span><br />
											  <span class="red_text">Total Messages Allow : </span><span class="green_text"><?php echo $resultwe['p_msg'];?></span><br />
											  <span class="red_text">Membership Expired on : </span><span class="green_text"><?php echo $resultwe['exp_date'];?></span><br />
										  </address>
									  </div>
									  
									   <div style="" class="col-xs-12 col-sm-6">
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
								<?php } ?>
								</div>
								<div class="myaccount">
									<div class="left">
										<div class="avathar">
											<?php
											if($DatabaseCo->dbRow->photo1!="")
                                            {
                                             ?><img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" class="" style="height:160px; width:120px;">
                                                
                                             <?php 
											}												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" class="" style="height:160px; width:120px;"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" class="" style="height:160px; width:120px;"/>
                                              <?php } 
											 }?>
										</div>
										<h3>
											<?php echo $DatabaseCo->dbRow->username; ?>
											<span><label>Profile ID</label> : <?php echo $DatabaseCo->dbRow->matri_id; ?></span>
										</h3>
									</div>
									<div class="right">
										<div class="top">
											<div class="row">
												<div class="col-md-6">
													<table width="100%" class="profile-details">
														<tbody>
															<tr><td><label>Membership </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->status; ?></td></tr>
															<tr><td><label>Looking </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->looking_for; ?></td></tr>
															<tr><td><label>Posted by </label></td><td width="25" style="text-align:center">:</td><td><?php echo $DatabaseCo->dbRow->profileby; ?></td></tr>
															<tr><td><label>Created  </label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->reg_date)); ?></td></tr>
															<tr><td><label>Last Login </label></td><td width="25" style="text-align:center">:</td><td><?php echo date('d-m-Y',strtotime($DatabaseCo->dbRow->last_login)); ?></td></tr>
														</tbody>
													</table>
												</div>
												<div class="col-md-6">
													<div class="messages">
														<div class="block">
															<label>Personal Messages</label>
															<ul class="vertical-nav">
																<li><a href="my-message.php">Inbox <span class="badge"><?php echo $sent_msg = getRowCount("select count(mes_id) from messages where to_id='$mid'", $DatabaseCoCount);   ?></span></a></li>
																<li><a href="my-message.php">Send <span class="badge"><?php echo $receive_msg = getRowCount("select count(mes_id) from messages where from_id='$mid'", $DatabaseCoCount);
	?></span></a></li>
															</ul>
														</div>
														<div class="block">
															<label>Express Interest Requests</label>
															<ul class="vertical-nav">
																<li><a href="my-interest.php">Inbox <span class="badge"><?php echo $rec_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Pending'", $DatabaseCoCount); ?></span></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="bottom">
										<p><?php echo $DatabaseCo->dbRow->profile_text; ?></p>
										</div>
									</div>
								</div>
								
								
          
             
								<?php
								 $rec_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
								   $rec_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
								   $rec_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Reject'", $DatabaseCoCount);
								   
								   //My Interest Send data
								   $sent_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
								   $sent_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
								   $sent_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Reject'", $DatabaseCoCount);  
								?>
								</div><!-- End of Content -->
								<div class="main-area gradient-rev block-level" style="margin-top:20px">
								<h3>My Interest</h3>
								<div class="block-level-matter">
									<div class="row">
										<div class="col-md-6">
											<div class="messages">
												<div class="block">
													<label>Express Interest Received by other</label>
													<ul class="vertical-nav">
														<li><a href="#">Accepted<span class="badge"><?php echo $rec_ei_accept; ?></span></a></li>
														<li><a href="#">Declined<span class="badge"><?php echo $rec_ei_decline; ?></span></a></li>
														<li><a href="#">Pending<span class="badge"><?php echo $rec_ei_pending; ?></span></a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="messages">
												<div class="block">
													<label>Express Interest send by me</label>
													<ul class="vertical-nav">
														<li><a href="#">Accepted<span class="badge"><?php echo $sent_ei_accept; ?></span></a></li>
														<li><a href="#">Declined<span class="badge"><?php echo $sent_ei_pending; ?></span></a></li>
														<li><a href="#">Pending<span class="badge"><?php echo $sent_ei_pending; ?></span></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="main-area gradient-rev block-level" style="margin-top:20px">
								<h3>My Messages</h3>
								<div class="block-level-matter">
									<div class="row">
										<div class="col-md-6">
											<div class="messages">
												<div class="block">
													<label>Personal Messages</label>
													<ul class="vertical-nav">
														<li><a href="#">Recieved<span class="badge"><?php echo $sent_msg = getRowCount("select count(mes_id) from messages where to_id='$mid'", $DatabaseCoCount);   ?></span></a></li>
														<li><a href="#">Sent<span class="badge"><?php echo $receive_msg = getRowCount("select count(mes_id) from messages where from_id='$mid'", $DatabaseCoCount);
	?></span></a></li>
														
													</ul>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="messages">
												<div class="block">
													<label>Photo Password Request</label>
													<ul class="vertical-nav">
														<li><a href="#">Recieved<span class="badge"><?php echo getRowCount("select count(ph_reqid) from photoprotect_request where ph_receiver_id='$mid' and  	receiver_response='Pending' ", $DatabaseCoCount)?></span></a></li>
														<li><a href="#">Sent<span class="badge"><?php echo getRowCount("select count(ph_reqid) from photoprotect_request where ph_receiver_id='$mid' and  	receiver_response='Accepted' ", $DatabaseCoCount)?></span></a></li>
														
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
	</article>
		

     

<?php include "page-part/footer.php";?>
</div>
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