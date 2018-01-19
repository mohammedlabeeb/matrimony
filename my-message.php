<?php
	  	include_once 'databaseConn.php';
		require_once('auth.php');
	    include_once 'lib/requestHandler.php';
		include_once 'class/Config.class.php';
		$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		$configObj = new Config();
		$DatabaseCo = new DatabaseConn();
		$DatabaseCoCount = new DatabaseConn();
	
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>
<script type="text/javascript" src="js/jquery.min.js"></script>
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
                  <h3 >My Messages</h3>                
                
                    

						<div class="block-level-matter">
									<div class="row">
										<div class="col-md-6">
											<div class="messages">
												<div class="block">
													<label>Personal Messages Received  </label>
													<ul class="vertical-nav">
														<li><a href="inbox-msg.php">Personal Message Received <span class="badge pull-right"><?php echo $sent_msg = getRowCount("select count(mes_id) from messages where to_id='$mid'", $DatabaseCoCount);   ?></span></a></li>
                        <li><a href="sent-msg.php">Personal Message Sent <span class="badge pull-right"><?php echo $receive_msg = getRowCount("select count(mes_id) from messages where from_id='$mid'", $DatabaseCoCount);
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
														<li><a href="photo-protect-pass-request.php">Photo Password Request Received <span class="badge pull-right"><?php echo getRowCount("select count(ph_reqid) from photoprotect_request where ph_receiver_id='$mid' and  	receiver_response='Pending' ", $DatabaseCoCount)?></span></a></li>
                        <li><a href="photo-protect-pass-sent.php">Photo Password Request Sent <span class="badge pull-right"><?php echo getRowCount("select count(ph_reqid) from photoprotect_request where ph_receiver_id='$mid' and  	receiver_response='Accepted' ", $DatabaseCoCount)?></span></a></li>  
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>

					
                       
                        
                        
               </div>          
             
         
							<div style="clear:both;"></div>
               
               <div class="gradient-rev block-level" style="margin-top:20px">
                  <h3 class="panel-title">Your Recent Messages</h3>                
               
                   
                        <h4>Recently Received Messages</h4>
                       
                        <div class="col-sm-12">
                            <?php
                            $SQL_STATEMENT =  "SELECT * FROM messages WHERE to_id='$mid'";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
                            ?>    
                                <table class="table table-hover">
                                    <tr>
                                       
                                        <td width="50%">
                                            <table class="table-condensed">
                                                <tr>
                                                    <td>From</td><td>:</td><td><?php echo $DatabaseCo->dbRow->from_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Subject</td><td>:</td><td><?php echo $DatabaseCo->dbRow->subject; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sent On</td><td>:</td><td><?php $date1=$DatabaseCo->dbRow->sent_date; echo $date2 = date("D d F ,Y  H:i a", (strtotime($date1)));?></td>
                                                </tr>
                                                <tr>
                                                    <td>Message</td><td>:</td><td><?php echo substr($DatabaseCo->dbRow->message,0,375)  ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        
                                    </tr>                                    
                                </table>
                                             
                            <?php } ?>
                        </div>
                        
                        <br><br>

                        <h4>Recently Sent Messages</h4>
                      
                        <div class="col-sm-12">
                            <?php
                            $SQL_STATEMENT =  "SELECT * FROM messages WHERE from_id='$mid'";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
                            ?>    
                                <table class="table table-hover">
                                    <tr>
                                        
                                        <td width="50%">
                                            <table class="table-condensed">
                                                <tr>
                                                    <td>To</td><td>:</td><td><?php echo $DatabaseCo->dbRow->to_id; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Subject</td><td>:</td><td><?php echo $DatabaseCo->dbRow->subject; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Sent On</td><td>:</td><td><?php $date1=$DatabaseCo->dbRow->sent_date; echo $date2 = date("D d F ,Y  H:i a", (strtotime($date1)));?></td>
                                                </tr>
                                                <tr>
                                                    <td>Message</td><td>:</td><td><?php echo substr($DatabaseCo->dbRow->message,0,375)  ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        
                                    </tr>                                    
                                </table>                                             
                            <?php } ?>
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
 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>