<?php
session_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();
$DatabaseCoCount = new DatabaseConn();		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
        <title>Admin | Dashboard</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.horizontal.scroll.css" />
		<link rel="stylesheet" type="text/css" href="./css/web_dialog.css" />
		<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />	
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.placeholder.js"></script>
	    <script type="text/javascript" src="js/jquery.horizontal.scroll.js"></script>
	    <script type="text/javascript" src="js/general.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript" src="js/cookieapi.js"></script>
        <script type="text/javascript" src="js/util/redirection.js"></script>
		<script type="text/javascript" src="js/jsapi.js"></script>

      
    </head>
    <body>
        <div id="wrapper">
<?php
require_once('./page-part/header.php');
?>
            <!-- start content -->
            <div id="container" class="cf">
<?php
require_once('./page-part/left-menu.php');
?>
                <div class="widecolumn alignleft">
                    <div class="breadcum-wide"><a href="#" title="Properties">Administration </a>/ <a href="#" title="Sell Listing">Dashboard</a></div>
					<!-- start Dashboard -->
                    <div class="dashboard-section">
                        <div class="title bottom-space">Matrimonial Dashboards</div>
                        
                        <div class="sub-title">Site Statistics</div>
                    	<div class="notification-section cf">
                            <ul class="notification-list">  
                            	
                      <li class="cf" ><p class="label">Advertisement : <span class="number-text">(<?php echo getRowCount("select count(adv_id) from advertisement", $DatabaseCoCount);?>)</span></p></li>
                      <li class="cf" ><p class="label">Wedding Planners : <span class="number-text">(<?php echo getRowCount("select count(adv_id) from advertisement", $DatabaseCoCount);?>)</span></p></li>
                      <li class="cf" ><p class="label">Express Interest : <span class="number-text">(<?php echo getRowCount("select count(wp_id) from wedding_planner", $DatabaseCoCount);?>)</span></p></li>
                      <li class="cf" ><p class="label">Membership Plans : <span class="number-text">(<?php echo getRowCount("select count(plan_id) from membership_plan", $DatabaseCoCount);?>)</span></p></li>
                      <li class="cf" ><p class="label">Success Story : <span class="number-text">(<?php echo getRowCount("select count(story_id) from success_story", $DatabaseCoCount);?>)</span></p></li>
                             
                              
                               
                                
                            </ul>
                        </div>
                        <!-- START of Notification AREA -->
                        <?php 
 $inactive_total = getRowCount("select count(index_id) from register_view where status='Inactive'", $DatabaseCoCount);
 
 $video = getRowCount("select count(index_id) from register_view where (video!='' and video_approval='UNAPPROVED') or (video_url!='' and  video_chk='UNAPPROVED')", $DatabaseCoCount);
 
 $suc_story = getRowCount("select count(story_id) from success_story where status='UNAPPROVED'", $DatabaseCoCount);
 
 $horoscope = getRowCount("select count(index_id) from register_view where hor_photo!='' and  hor_check='UNAPPROVED'", $DatabaseCoCount);
 
 $photo1 = getRowCount("select count(index_id) from register_view where photo1!='' and photo1_approve='UNAPPROVED'", $DatabaseCoCount);
 $photo2 = getRowCount("select count(index_id) from register_view where photo2!='' and photo2_approve='UNAPPROVED'", $DatabaseCoCount);
 $photo3 = getRowCount("select count(index_id) from register_view where photo3!='' and photo3_approve='UNAPPROVED'", $DatabaseCoCount);
 $photo4 = getRowCount("select count(index_id) from register_view where photo4!='' and photo4_approve='UNAPPROVED'", $DatabaseCoCount);
 $photo5 = getRowCount("select count(index_id) from register_view where photo5!='' and photo5_approve='UNAPPROVED'", $DatabaseCoCount);
 $photo6 = getRowCount("select count(index_id) from register_view where photo6!='' and photo6_approve='UNAPPROVED'", $DatabaseCoCount);
 $advertise = getRowCount("select count(adv_id) from advertisement where status='UNAPPROVED'", $DatabaseCoCount);
 
 $message = getRowCount("select count(mes_id) from messages where to_id='admin' and status='Unread'", $DatabaseCoCount);
 
                        ?>
                        <div class="sub-title">Notifications (<span class="number-text"><?php 
		$total=$message+$advertise+$photo1+$photo2+$photo3+$photo4+$photo5+$photo6+$horoscope+$suc_story+$video+$inactive_total;
		echo $total;?></span>)</div>
                    	<div class="notification-section cf">
                            <ul class="notification-list">  
                            	<?php  if($inactive_total>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $inactive_total;?></span> New Inactive <strong> <a href="member-list.php?member_status=Inactive">User</a></strong> Pending</p></li>
                              <?php  } if($video>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $video;?></span> Unapproved <strong> <a href="video_approve.php?video_status=unapproved">Video</a></strong> Pending</p></li>
                                <?php } if($suc_story>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $suc_story;?></span> Unapproved <strong> <a href="success_approve.php?success_approval=unapproved">Success story</a></strong> Pending</p></li>
                                <?php } if($horoscope>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $horoscope;?></span> Unapproved <strong> <a href="horoscope_approve.php?horoscope_status=unapproved">Horoscope</a></strong> Pending</p></li>
                                <?php } if($advertise>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $advertise;?></span> Unapproved <strong> <a href="advertise.php?advertise_status=unapproved">Advertisement</a></strong> Pending</p></li>
                                <?php } if($message>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $message;?></span> Unread <strong> <a href="inbox.php">Message</a></strong> in inbox</p></li>
                                <?php } if($photo1>0){?>
                                <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo1;?></span> Unapproved <strong> <a href="photo1_approve.php?photo_status=unapproved">Photo 1</a></strong> Pending</p></li>
                                <?php } if($photo2>0){?>
                                 <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo2;?></span> Unapproved <strong> <a href="photo2_approve.php?photo_status=unapproved">Photo 2</a></strong> Pending</p></li>
                                <?php } if($photo3>0){?>
                                 <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo3;?></span> Unapproved <strong> <a href="photo3_approve.php?photo_status=unapproved">Photo 3</a></strong> Pending</p></li>
                                <?php } if($photo4>0){?>
                                 <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo4;?></span> Unapproved <strong> <a href="photo4_approve.php?photo_status=unapproved">Photo 4</a></strong> Pending</p></li>
                                <?php } if($photo5>0){?>
                                 <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo5;?></span> Unapproved <strong> <a href="photo5_approve.php?photo_status=unapproved">Photo 5</a></strong> Pending</p></li>
                                <?php } if($photo6>0){?>
                                 <li class="cf" ><p class="label"><span class="number-text"><?php echo $photo6;?></span> Unapproved <strong> <a href="photo6_approve.php?photo_status=unapproved">Photo 6</a></strong> Pending</p></li>
                                <?php } ?>
                               
                                
                            </ul>
                        </div>
                        <!-- End of Notification AREA -->
                        <div class="sub-title cf">Members (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view", $DatabaseCoCount);?></span>)</div>
                        <div class="users-section-outer">			
                          <ul id="horiz_container_outer" class="cf">
                            <li id="horiz_container_inner" style="position: static;">
                                <ul id="horiz_container" class="users-section-outer">
                                    <li class="cf">
                                      <div class="users-section alignleft">
                                <ul class="cf users-section-list">
                                    <li>
                                        <div class="cf header-title"><span class="title1">Inactive (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Inactive'", $DatabaseCoCount)?></span>)</span> </div>
                                        
                                    </li>
                                    <li>
                                        Male (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Inactive' and gender='Male'", $DatabaseCoCount)?></span>)
                                    </li>
                                    <li>
                                        Female (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where  status='Inactive' and gender='Female'", $DatabaseCoCount)?></span>)
                                    </li>
                                
                                </ul>
                            </div>
                            	      <div class="users-section alignleft">    
                                <ul class="cf users-section-list">
                                <li>
                                    <div class="cf header-title"><span class="title1">Active (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Active'", $DatabaseCoCount)?></span>)</span> </div>
                                    
                                </li>
                                <li>
                                    Male (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Active' and gender='Male'", $DatabaseCoCount)?></span>)
                                </li>
                                 <li>
                                    Female (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Active' and gender='Female'", $DatabaseCoCount)?></span>)
                                </li>
                                                            
                            </ul>
                            </div>
							<div class="users-section alignleft">    
                            
                                <ul class="cf users-section-list">
                                <li>
                                    <div class="cf header-title"><span class="title1">Paid (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Paid'", $DatabaseCoCount)?></span>)</span> </div>
                                    
                                </li>
                                <li>
                                    Male (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Paid' and gender='Male'", $DatabaseCoCount)?></span>)
                                </li>
                                <li>
                                    Female (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Paid' and gender='Female'", $DatabaseCoCount)?></span>)
                                </li>
                            
                            </ul>
                            </div>
                            <div class="users-section alignleft">    
                            
                                <ul class="cf users-section-list">
                                <li>
                                    <div class="cf header-title"><span class="title1">Featured (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Featured'", $DatabaseCoCount)?></span>)</span> </div>
                                    
                                </li>
                                <li>
                                    Male (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Featured' and gender='Male'", $DatabaseCoCount)?></span>)
                                </li>
                                <li>
                                    Female (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Featured' and gender='Female'", $DatabaseCoCount)?></span>)
                                </li>
                            
                            </ul>
                            </div>
                            		  <div class="users-section alignleft">    
                                <ul class="cf users-section-list">
                                <li>
                                    <div class="cf header-title"><span class="title1">Suspended (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Suspended'", $DatabaseCoCount)?></span>)</span> </div>
                                    
                                </li>
                                <li>
                                    Male (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Suspended' and gender='Male'", $DatabaseCoCount)?></span>)
                                </li>
                                <li>
                                    Female (<span class="number-text"><?php echo getRowCount("select count(index_id) from register_view where status='Suspended' and gender='Female'", $DatabaseCoCount)?></span>)
                                </li>
                            
                            </ul>
                            </div>
                            		</li>
                                 </ul>
                            </li>
                           </ul>
                           <div id="scrollbar">
                            <a id="left_scroll" class="mouseover_left" href="#"></a>
                            <div id="track">
                                 <div id="dragBar"></div>
                            </div>
                            <a id="right_scroll" class="mouseover_right" href="#"></a>
                            </div>
                          </div>  
                       <!-- End of member AREA --> 
                          
                          
                      <!-- End of advertisement AREA --> 
                           
                        <div class="property-section-outer cf">
							<div class="property-section alignleft" style="width:400px;">
								<ul class="property-listing cf">
                                	<li class="first">
                                       <p class="first-li first-li1"><span class="property-title">Membership </span>(<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view", $DatabaseCoCount);?></span>)</p>
                                       <p class="second-li"><strong>Male</strong> (<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view where gender='Male'", $DatabaseCoCount);?></span>)</p>
                                       <p class="third-li"><strong>Female</strong> (<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view where gender='Female'", $DatabaseCoCount);?></span>)</p>	
                                    </li>
          <?php
		$select=mysql_query("select * from membership_plan");
		while($fet=mysql_fetch_array($select))
		{
		  ?>
                                    <li class="first">
                                    	<p class="first-li"><?php echo $pp=$fet['plan_name'];?> (<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view where p_plan='$pp'", $DatabaseCoCount);?></span>)</p>
                                        
                                       <p class="second-li">(<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view where p_plan='$pp' and gender='Male'", $DatabaseCoCount);?></span>)</p>
                                       <p class="third-li">(<span class="number-text"><?php echo getRowCount("select count(payid) from payment_view where p_plan='$pp' and gender='Female'", $DatabaseCoCount);?></span>)</p>	
                                    </li>
        <?php
		}
		?>
                                  
                                
      						    </ul>           	
                        	</div>
                     		<div class="property-section alignright">
								 <div id="chart_div_prop" style="width: 425px; height:285px;"></div>         	
                        	</div>
                        </div>
                        
                       
						
                        <?php
                        require_once('./page-part/footer.php');
                        ?>
                </div>
                	<!-- end Dashboard -->
            </div>
            <!-- end content -->
        </div>
        </div>
    </body>
</html>
<script type="text/javascript">
            $(document).ready(function()
			{
				$('#horiz_container_outer').horizontalScroll();
					
					
			});
					//Property and Requirement Charts
					  google.load("visualization", "1", {packages:["corechart"]});
					  google.setOnLoadCallback(drawChart);
					  function drawChart() {
						
						//Property Chart
						var data_prop = google.visualization.arrayToDataTable([
						['Membership Plan', 'Listing'],
	 <?php
		$sel=mysql_query("select * from membership_plan");
		while($fetch=mysql_fetch_array($sel))
		{
		 
		  $ppp=$fetch['plan_name'];			
		  $data=getRowCount("select count(payid) from payment_view where p_plan='$ppp'", $DatabaseCoCount);
?>

						  ['<?php echo $ppp;?>', <?php echo $data;?>],
		<?php
		}
		?>
						 					  
						]);

						var options_prop = {
						  title: 'Membership Plan Listing'
						};

						var chart_prop = new google.visualization.PieChart(document.getElementById('chart_div_prop'));
						chart_prop.draw(data_prop, options_prop);
												
					  }
					  //Transactions Chart
					  google.load("visualization", "1", {packages:["corechart"]});
					  google.setOnLoadCallback(drawTransactionChart);
					  
					  
        </script>