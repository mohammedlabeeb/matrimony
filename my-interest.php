<?php
		include_once 'databaseConn.php';
		include_once './lib/requestHandler.php';
		require_once('auth.php');
	  	include_once './class/Config.class.php';
		$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		$configObj = new Config();
		$DatabaseCo = new DatabaseConn();
		$DatabaseCoCount = new DatabaseConn();	
		
		 if(isset($_GET['Id']))
		{
		  	$exp_id = $_GET['Id'];
			$SQL_STATEMENT =  mysql_query("DELETE FROM expressinterest WHERE ei_id=$exp_id");
		}
		
		
   //My Interest Received data
   $rec_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
   $rec_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
   $rec_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_receiver='$mid' AND receiver_response='Reject'", $DatabaseCoCount);
   
   //My Interest Send data
   $sent_ei_accept = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Accept'", $DatabaseCoCount);
   $sent_ei_pending = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Pending'", $DatabaseCoCount);
   $sent_ei_decline = getRowCount("select count(ei_id) from expressinterest where ei_sender='$mid' AND receiver_response='Reject'", $DatabaseCoCount);  
 
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
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
						<div class="main-area gradient-rev">
                       	
                        
                            <div class="gradient-rev block-level" style="margin-top:20px">
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
							<div style="clear:both;"></div>
               
               <div class="gradient-rev block-level" style="margin-top:20px">
               
                  <h3 class="panel-title">Your Recent Express Interest</h3>                
              
                    <div class="">
                        <h4 style="margin-top:20px">Recently Received Express Interest</h4>
                      
                        <?php
                 $SQL_STATEMENT =  "SELECT * FROM expressinterest,register WHERE register.matri_id=expressinterest.ei_sender and ei_receiver='$mid' order by ei_sent_date DESC limit 0,3";
           $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                 while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
                            ?>
                            <div class="load col-xs-12 col-lg-12 col-md-12 col-sm-12 panel-body exp-hover">
                        	<div class="row">
								<div class="col-lg-3 col-xs-12">
                                	<div class="col-xs-12 thumbnail margin-bottom-10px">
                            			
      
        <?php
                                                 if($DatabaseCo->dbRow->photo1!="" && $DatabaseCo->dbRow->photo_protect=="No" )
                                            {
                                             ?>
                                                                                                  
                                                     <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                 
                                             <?php 
                                                  }
												  elseif($DatabaseCo->dbRow->photo_protect=="Yes" && $DatabaseCo->dbRow->photo_pswd!='')
												  {
                                             ?>
                                                
                                                                <?php  
                                                                if($DatabaseCo->dbRow->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                                <?php } ?>
                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                              <?php } }?>
        
        
                                    </div>
                            	</div>
                               
                                <div class="col-lg-6 col-xs-12">
                                	<div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		From:
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_sender; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Response :	
                                        	</div>
                                        	<div class="col-lg-8  col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->receiver_response; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4  col-xs-5 line-break">
                                        		Received On :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php $date1=$DatabaseCo->dbRow->ei_sent_date; echo $date2 = date("D d F ,Y  H:i a", (strtotime($date1)));?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Message :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_message; ?>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                	<div class="thumbnail col-xs-12">
                                    	<a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow->ei_sender; ?>" target="_blank" class="btn btn-default col-xs-12">
                                            	
                                                <span class="col-xs-9">
                                                	View Full Profile
                                                </span>
                                         </a>
                                         
                                    </div>
                                </div>
                            </div>
						</div>          
 
                            
                            <?php
                            }
                        ?>
                       

                        <h4 style="padding-top:20px;clear:both">Recently Sent Express Interest</h4>
                        
                         <?php
              $SQL_STATEMENT =  "SELECT * FROM expressinterest,register WHERE register.matri_id=expressinterest.ei_receiver and ei_sender='$mid' order by ei_sent_date DESC limit 0,3";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
								?>
                                <li class="load col-xs-12 col-lg-12 col-md-12 col-sm-12 panel-body exp-hover">
                        	<div class="row">
								<div class="col-lg-3 col-xs-12">
                                	<div class="col-xs-12 thumbnail margin-bottom-10px">
                            			
      
        <?php
                                                 if($DatabaseCo->dbRow->photo1!="" && $DatabaseCo->dbRow->photo_protect=="No" )
                                            {
                                             ?>
                                                                                                  
                                                     <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                 
                                             <?php 
                                                  }
												  elseif($DatabaseCo->dbRow->photo_protect=="Yes" && $DatabaseCo->dbRow->photo_pswd!='')
												  {
                                             ?>
                                                
                                                                <?php  
                                                                if($DatabaseCo->dbRow->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                                                <?php } ?>
                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;" class="img-responsive col-xs-12"/>
                                              <?php } }?>
        
        
                                    </div>
                            	</div>
                               
                                <div class="col-lg-6 col-xs-12">
                                	<div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		To:
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_receiver; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Response :	
                                        	</div>
                                        	<div class="col-lg-8  col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->receiver_response; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4  col-xs-5 line-break">
                                        		Received On :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php $date1=$DatabaseCo->dbRow->ei_sent_date; echo $date2 = date("D d F ,Y  H:i a", (strtotime($date1)));?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Message :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_message; ?>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                	<div class="thumbnail col-xs-12">
                                    	<a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow->ei_receiver; ?>" target="_blank" class="btn btn-default col-xs-12">
                                            	
                                                <span class="col-xs-9">
                                                	View Full Profile
                                                </span>
                                         </a>
                                         
                                    </div>
                                </div>
                            </div>
						</div>
                                <?php
							}
                            ?> 
                    </div>
            </div>
            </div>
            
         </div>
         </div>
         </article>
    
    
	  
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>

</div>
</body>
</html>


