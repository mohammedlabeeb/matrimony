<?php 

	require_once './lib/requestHandler.php';
	require_once './databaseConn.php';
	$DatabaseCoCount = new DatabaseConn();
?>
<div class="narrowcolumn alignleft">
      <h3 class="title"><a href="dashboard.php" style="color:#FFF;">Admin Dashboard</a></h3>
      <ul id="accordion" class="cf accordion">
         
	<li id="site-settings">
	    <h3><a href="javascript:;" title="SITE SETTINGS"> <span class="menu-icon"><img src="img/setting-icon.png" alt="setting-icon" title="setting"/></span>site settings</a>
		<span class="arrow-image"></span>
		</h3>
	    <ul class="sub-nav">
		<li> <a href="site-settings.php" title="Site Settings" id="site" >site setting</a></li>
		<li> <a href="change_pass.php" title="Change Password" id="change-password" >Change Password</a></li>
		<li><a href="edit_matriprefix.php"  title="Matri Prefix" id="matri-prefix">Matrimony Id Prefix</a></li>
		<li><a href="social_neticon.php"  title="Social Networking Icon" id="social_neticon">Social Networking Icon</a></li>
	    </ul>
	</li>
	
    <li id="add-new">
	    <h3><a href="javascript:;" title="Add New">
      <span class="menu-icon"><img src="img/location-icon.png" alt="detail-icon" title="Add New"/></span>Add New</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="religion-list.php?option=clear_search" title="Religion" id="religion">Religion<span class="digit"><?php echo getRowCount("select count(religion_id) from religion", $DatabaseCoCount);?></span></a></li>
        <li><a href="caste-list.php?option=clear_search" title="Caste" id="caste">Caste<span class="digit"><?php echo getRowCount("select count(caste_id) from caste", $DatabaseCoCount);?></span></a></li>
        <li><a href="country-list.php?option=clear_search" title="Countries" id="country">Countries <span class="digit"><?php echo getRowCount("select count(COUNTRY_ID) from country", $DatabaseCoCount);?></span></a></li>
		<li><a href="state-list.php?option=clear_search" title="States" id="state">States<span class="digit"><?php echo getRowCount("select count(STATE_ID) from state", $DatabaseCoCount);?></span></a></li>
		<li><a href="city-list.php?option=clear_search" title="Cities" id="city">Cities<span class="digit"><?php echo getRowCount("select count(CITY_ID) from city", $DatabaseCoCount);?></span></a></li>
		<li><a href="occupation-list.php?option=clear_search" title="Occupation" id="occupation">Occupation<span class="digit"><?php echo getRowCount("select count(ocp_id) from occupation", $DatabaseCoCount);?></span></a></li>
        <li><a href="education-list.php?option=clear_search" title="Education" id="education">Education<span class="digit"><?php echo getRowCount("select count(edu_id) from education_detail", $DatabaseCoCount);?></span></a></li>
        <li><a href="mother-tongue-list.php?option=clear_search" title="Mother Tongue" id="mother-tongue">Mother Tongue<span class="digit"><?php echo getRowCount("select count(mtongue_id) from mothertongue", $DatabaseCoCount);?></span></a></li>
        <li><a href="event-list.php?option=clear_search" title="Events" id="events">Events<span class="digit"><?php echo getRowCount("select count(id) from events", $DatabaseCoCount);?></span></a></li>
       
		</ul>
	</li>
    
    <li id="member">
	    <h3><a href="javascript:;" title="Members"> <span class="menu-icon"><img src="img/user-icon.png" alt="user-icon" title="Members"/></span>Members</a>
		<span class="arrow-image"></span>
		</h3>
	    <ul class="sub-nav">
		<li><a href="member-list.php" title="All Members" id="all-members">All Members<span class="digit"><?php echo getRowCount("select count(index_id) from register_view", $DatabaseCoCount);?></span></a></li>
		
		<li><a href="approve_paid.php?member_status=Active" title="Approve Active to Paid" id="approve-paid">Approve Active to Paid<span class="digit"><?php echo getRowCount("select count(index_id) from register_view where status='Active'", $DatabaseCoCount);?></span></a></li>
        
        <li><a href="approve_featured.php?member_status=Paid" title="Approve Paid to Featured" id="approve-featured">Approve Paid to Featured<span class="digit"><?php echo getRowCount("select count(index_id) from register_view where status='Paid' and fstatus=''", $DatabaseCoCount);?></span></a></li>
        
		<li><a href="renew-member-list.php" title="Renew Membership" id="renew-member">Renew Membership<span class="digit"><?php
	  $today1 = strtotime ('now');
	 $today=date("Y-m-d",$today1);
	    echo  getRowCount("select count(r.index_id) from register_view r,payments p where r.matri_id=p.pmatri_id and p.exp_date<'$today'",$DatabaseCoCount);?></span></a></li>
        
        <li><a href="edit-plan.php?member_status=Paid" title="Edit Plan" id="edit-plan">Edit Plan<span class="digit"><?php echo getRowCount("select count(index_id) from register_view where status='Paid'", $DatabaseCoCount);?></span></a></li>
		
	    </ul>
	</li>
    <li id="gratings">
	   <h3><a href="javascript:;" title="greetings">
		<span class="menu-icon"><img src="img/globle-setting-icon.png" alt="Greetings" title="Greetings"/></span>Greetings Management</a>
		<span class="arrow-image"></span>
	   </h3>
	    <ul class="sub-nav">
		<li><a href="gratings-list.php" title="Greetings Detail"  id="gratings-detail">Greetings Detail<span class="digit"><?php echo getRowCount("select count(g_id) from gratings_setting", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>
    
	<li id="membership">
	   <h3><a href="javascript:;" title="MEMBERSHIP PLAN">
		<span class="menu-icon"><img src="img/multi-user-icon.png" alt="member-icon" title="membership plan"/></span>membership plan</a>
		<span class="arrow-image"></span>
	   </h3>
	    <ul class="sub-nav">
		<li><a href="membership-plan.php" title="Membership Plan"  id="membership-plan">Membership Plan<span class="digit"><?php echo getRowCount("select count(PLAN_ID) from membership_plan", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>
	
	
	<li id="approve">
	   <h3><a href="javascript:;" title="Approval">
		<span class="menu-icon"><img src="img/manage-req-icon.png" alt="Approval-icon" title="Approval"/></span>Approval</a>
		<span class="arrow-image"></span>
	   </h3>
	    <ul class="sub-nav">
		<li><a href="video_approve.php" title="Video Approval"  id="video-appprove">Video Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where video!='' or video_url!=''", $DatabaseCoCount);?></span></a></li>
		
		<li><a href="success_approve.php" title="Success Story Approval"  id="success-appprove">Success Story Approval<span class="digit"><?php echo getRowCount("select count(story_id) from success_story", $DatabaseCoCount);?></span></a></li>
		
		<li><a href="horoscope_approve.php" title="Horoscope Approval"  id="horoscope-appprove">Horoscope Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register WHERE hor_photo!='' ",$DatabaseCoCount);?></span></a></li>
        <li><a href="photo1_approve.php" title="Photo 1 Approval"  id="photo1-appprove">Photo 1 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo1!=''", $DatabaseCoCount);?></span></a></li>
        <li><a href="photo2_approve.php" title="Photo 2 Approval"  id="photo2-appprove">Photo 2 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo2!=''", $DatabaseCoCount);?></span></a></li>
        <li><a href="photo3_approve.php" title="Photo 3 Approval"  id="photo3-appprove">Photo 3 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo3!=''", $DatabaseCoCount);?></span></a></li>
        <li><a href="photo4_approve.php" title="Photo 4 Approval"  id="photo4-appprove">Photo 4 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo4!=''", $DatabaseCoCount);?></span></a></li>
        <li><a href="photo5_approve.php" title="Photo 5 Approval"  id="photo5-appprove">Photo 5 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo5!=''", $DatabaseCoCount);?></span></a></li>
        <li><a href="photo6_approve.php" title="Photo 6 Approval"  id="photo6-appprove">Photo 6 Approval<span class="digit"><?php echo getRowCount("select count(index_id) from register where photo6!=''", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>
	

	
	<li id="advertisement">
	    <h3><a href="javascript:;" title="advertisement">
      <span class="menu-icon"><img src="img/advertise-icon.png" alt="manage-req-icon" title="advertisement"/></span>advertisement</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">      
		<li><a href="advertise.php" title="List of all Advertisement" id="advertise">List of all Advertisement<span class="digit"><?php echo getRowCount("select count(adv_id) from advertisement", $DatabaseCoCount);?></span></a></li>
		
	    </ul>
	</li>
     
      <li id="messages">
	    <h3><a href="javascript:;" title="MESSAGES"> <span class="menu-icon"><img src="img/email-icon.png" alt="Email-Icon" title="messages"/></span>MESSAGES</a>
		<span class="arrow-image"></span>
		</h3>
	    <ul class="sub-nav">
		<li> <a href="inbox.php" title="Inbox" id="inbox" >Inbox</a></li>
		<li> <a href="sent.php" title="Sent" id="sent" >Sent</a></li>
	    </ul>
	</li> 
      
	<!--<li id="trans">
	    <h3><a href="javascript:;" title="TRANSACTIONS">
      <span class="menu-icon"><img src="img/transactions-icon.png" alt="transactions-icon" title="transactions"/></span>transactions</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="transaction-list.php?option=clear_search" title="View Transactions" id="trans-list">View Transactions<span class="digit"><?php echo getRowCount("select count(payid) from  payments", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>-->
    
    
	 <li id="activity">
	   <h3><a href="javascript:;" title="Activity">
		<span class="menu-icon"><img src="img/news-icon.png" alt="icon" title="Express Interest"/></span>Customer Activity</a>
		<span class="arrow-image"></span>
	   </h3>
	    <ul class="sub-nav">
		<li><a href="express-interest.php" title="Express Interest"  id="express-interest">Express Interest<span class="digit"><?php echo getRowCount("select count(ei_id) from expressinterest", $DatabaseCoCount);?></span></a></li>
        
        <li><a href="email-messages.php" title="Message Details"  id="email">Message Details<span class="digit"><?php echo getRowCount("select count(mes_id) from messages", $DatabaseCoCount);?></span></a></li>
        
        <li><a href="chat-details.php" title="Chat Details"  id="chat">Chat Details<span class="digit"><?php echo getRowCount("select count(id) from chat", $DatabaseCoCount);?></span></a></li>
         <li><a href="greetings-sent.php" title="Greetings Sent<"  id="greetings-sent<">Greetings Sent<span class="digit"><?php echo getRowCount("select count(g_id) from gratings", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>
	<li id="cms">
	    <h3><a href="javascript:;" title="CONTENT MANAGEMENT">
      <span class="menu-icon"><img src="img/content-mange-icon.png" alt="content-mange-icon" title="content management"/></span>content management</a>
	  <span class="arrow-image"></span>
	  </h3>
     
	    <ul class="sub-nav">
		<li><a href="cms-page-list.php" title="Content Management" id="cms-page">CMS Pages<span class="digit"><?php echo getRowCount("select count(cms_id) from cms_pages", $DatabaseCoCount);?></span></a></li>
	    </ul>
	</li>

	<li id="wp">
	    <h3><a href="javascript:;" title="Wedding Directory">
      <span class="menu-icon"><img src="img/location-icon.png" alt="manage-req-icon" title="Wedding Directory"/></span>Wedding Directory</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">      
		<li><a href="wedding-planners.php" title="Wedding Planners" id="wedding-planners">Wedding Planners<span class="digit"><?php echo getRowCount("select count(wp_id) from wedding_planner", $DatabaseCoCount);?></span></a></li>
		<li><a href="wedding-planners-category.php" title="Wedding Planners Category" id="wedding-planners-category">Wedding Planners Category<span class="digit"><?php echo getRowCount("select count(wp_cat_id) from wp_category", $DatabaseCoCount);?></span></a></li>
		              
               	
	    </ul>
	</li>
    
    <li id="email-templates">
	     <h3><a href="javascript:;" title="EMAIL TEMPLATES">
      <span class="menu-icon"><img src="img/email-icon.png" alt="email-icon" title="email"/></span>email templates</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="email-templates.php" title="Email Template List" id="email-mgmt">Email Template List<span class="digit"><?php echo getRowCount("select count(EMAIL_TEMPLATE_ID) from email_templates", $DatabaseCoCount);?></span></a></li>
	     
	    </ul>
	</li>
    
	<li id="sms">
	     <h3><a href="javascript:;" title="SMS  SETTINGS">
      <span class="menu-icon"><img src="img/sms-setting-icon.png" alt="sms-setting-icon" title="sms-setting"/></span>sms settings</a>
	  <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="sms-api-settings.php" title="SMS API Settings" id="sms-api">SMS API Settings</a></li>
		 </ul>
	</li>
	<li id="payment">
		 <h3><a href="javascript:;" title="PAYMENT GATEWAY">
      <span class="menu-icon"><img src="img/payment-icon.png" alt="payment-icon" title="payment"/></span>payment gateway</a>
	   <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="paypal-settings.php" title="Paypal Settings" id="paypal">Paypal Settings</a></li>
		<li><a href="2checkout-settings.php" title="2Checkout Settings" id="twocheckout">2Checkout Settings</a></li>
		<li><a href="cc-avenue-settings.php" title="CC Avenue Settings" id="cc-avenue">CC Avenue Settings</a></li>
		<li><a href="bank-detail.php" title="Bank Detail" id="bank">Bank Detail</a></li>
		
	    </ul>
	</li>
    
    <li id="member_report">
		 <h3><a href="javascript:;" title="Member Report">
      <span class="menu-icon"><img src="img/multi-user-icon.png" alt="payment-icon" title="Member Report"/></span>Member Report</a>
	   <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="member_report.php" title="Export Members" id="export-members">Export Members to Excel File </a></li>
		<li><a href="import-member.php" title="Import Members" id="import_member">Import Members By Excel File</a></li>
		<li><a href="sales-report.php" title="Sales Reports" id="sale-report">Sales Reports</a></li>
		<li><a href="newsletter.php?action=ADD" title="Send Emails to Members" id="send-email">Send Emails to Members </a></li>
		
	    </ul>
	</li>
    
    <li id="database-operation">
		 <h3><a href="javascript:;" title="Database Operation">
      <span class="menu-icon"><img src="img/location-icon.png" alt="payment-icon" title="Database Operation"/></span>
      Database Operation</a>
	   <span class="arrow-image"></span>
	  </h3>
	    <ul class="sub-nav">
		<li><a href="db-checkup.php" title="Database CheckUp" id="checkup">Database CheckUp</a></li>
		<li><a href="db-backup.php" title="Database BackUp" id="backup">Database BackUp</a></li>
		
		
	    </ul>
	</li>
	
	  </ul>
  
    </div>

