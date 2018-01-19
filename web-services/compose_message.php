<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;

   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=mysql_query($select) or die(mysql_error());
$fetch=mysql_fetch_array($exe);

$total_msg=$fetch['p_msg'];
$used_msg=$fetch['r_sms'];
$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');

if($_SESSION['user_id']!='')
{
			if($total_msg-$used_msg>0 && $exp_date > $today)
			{
					$get=mysql_query("select * from register_view where matri_id='$from_id'");
					$fet=mysql_fetch_array($get);
			?>
		
		<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
		
            		<?php
					$sel=mysql_query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
					$num=mysql_num_rows($sel);
						if($num>0)
						{
							?>
                            <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">You are Blocked</h4>
      </div>
      
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
                      <div class="form-group">
                       <div class="col-sm-12">
               <h4>This member has blocked you. You can't send him messages anymore...</h4>
                            </div>
                          </div>
                                                   
                          
                        </form>
      
    </div>
  </div>
                            <?php
						}
						else
						{
					?>
					<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-danger" id="MessageLabel">Send Message  (<?php echo $total_msg-$used_msg;?>)</h4>
			  </div>
			  <span id="xyz">
			    <div class="modal-body">
			 <form name="message_form" id="message_form" class="form-horizontal" action="" method="post">
				 <div class="form-group">
				 <div class="col-sm-12">
				  <div class="col-sm-4">
			   <?php
					if($fet['photo1']!="" && $fet['photo_protect']=="No" )
					 {
					?>
					
				<img src="photos/watermark.php?image=<?php echo $fet['photo1']; ?>&watermark=watermark.png" class="img-responsive photo100" width="100px" height="100px" />
					<?php 
					}
					elseif($fet['photo_protect']=="Yes")
					{
									?>
					
							<?php  
												 if($fet['gender']=='Male')
											 {
											?>                                    
												<img  src="./images/default-photo/photopassword_male.png" class="img-responsive photo100"   title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
											<?php   }else{ ?>
												<img  src="./images/default-photo/photopassword_female.png" class="img-responsive photo100"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
											<?php } ?>
					<?php 
					}
					else
					{ ?>
					
						   <?php   
												if($fet['gender']=='Male')
												{
										   ?>                                    
												<img  src="images/default-photo/male-200.png" class="img-responsive photo100"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
										   <?php   }else{ ?>
												<img  src="images/default-photo/female-200.png" class="img-responsive photo100"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
										   <?php } ?>
					<?php
					 } 
					 ?>
				  </div>
				  <div class="col-sm-8">
					<ul class="list-unstyled">
						<li><b>To ,</b></li>
						<li><strong>Name :</strong> <?php echo $fet['username']; ?></li>
						<li><strong>Profile ID :</strong> <?php echo $from_id; ?></li>
					  </ul>
				 </div>
				 </div>
				 </div>      
				  <input type="hidden" name="txtTo" id="txtTo" value="<?php echo $from_id; ?>" />
				  <div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">Enter Message<font class="text-danger">*</font></label>
						<div class="col-sm-8">
						<textarea name="txtmsg" id="txtmsg" rows="4" cols="40" class="form-control">Hello Dear how are you??</textarea>
						</div>
				</div>  
				</form>
				</div>
				<div class="modal-footer">
				   <p class="pull-left text-danger">Date - <?php echo date('l j F ,Y g:i A');?></p>   
				
               	<button type="button" name="edit-basic-detail" class="btn btn-primary" id="go_go_message">Send Message</button>
				<input type="hidden" name="txtTo" id="txtTo" value="<?php echo $from_id; ?>" />
					</div>
              </span>      
			  </div>
		   </div>
		 				<?php
						}
						?>
			 <?php
			}
			else
			{ ?>
			
			  <div class="modal-dialog">
			  
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership</h4>
				  </div>
				  
				  <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
								  <div class="form-group">
								   <div class="col-sm-12">
						   <h4>&nbsp;&nbsp;Please get the send message balance by upgrading your membership.</h4>
										</div>
									  </div>
															   
									  <div class="form-group">
										<div class="col-sm-offset-4 col-sm-10">
							
										<button class="btn btn-success" formaction="payment.php">Upgrade Now</button>
										</div>
									  </div>
									</form>
				  
				</div>
			  </div>
			<?php
			}
}
else
{
?>
  <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">Please Login !!!</h4>
      </div>
      
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
                      <div class="form-group">
                       <div class="col-sm-12">
               <h4>&nbsp;&nbsp;Please Login to access this feature.</h4>
                            </div>
                          </div>
                                                   
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                
                            <button class="btn btn-success" formaction="login.php">Login Now</button>
                            </div>
                          </div>
                        </form>
      
    </div>
  </div>
<?php
 } ?>

<script type="text/javascript">
	$('#go_go_message').click(function(){	
	
		
		if ($("#txtmsg").val()=='')
		{
			alert( "Please Enter Message." );	
			formn.message.focus();
			return false;
		}
		
	var dataString =$("#message_form").serialize();
		
	$.ajax({	
			
	     url:"web-services/reply_message.php",
         type:"POST",
         data:dataString,
        cache: false,
        success: function(response)
		{
		   
		  $("#xyz").fadeOut("slow");
		  $('#MessageLabel').text(response).addClass('text-success');		 
		 	
		}
		
	   });
    
	
}) 

</script>

 
