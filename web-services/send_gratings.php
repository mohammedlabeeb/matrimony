<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;

   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=mysql_query($select) or die(mysql_error());
$fetch=mysql_fetch_array($exe);

$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');

if($_SESSION['user_id']!='')
{
			if ($exp_date > $today)
			{
				$get=mysql_query("select * from register_view where matri_id='$from_id'");
				$fet=mysql_fetch_array($get);
			?>
			
			<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
			
			
				
                			<?php 
							$sel=mysql_query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
									$num_block=mysql_num_rows($sel);
									if($num_block>0)
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
               <h4>This member has blocked you.You can't send him gratings.</h4>
                            </div>
                          </div>
                                                   
                          
                        </form>
      
    </div>
  </div>
  									<?php
									}
									else
									{?>
									<div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title text-danger" id="GreetLabel">Send Greeting</h4>
				  </div>
				   
				 <form name="GreetForm" id="GreetForm" class="form-horizontal" action="" method="post">
					 <div class="col-lg-12 form-group">
					  <div class="col-lg-4">
				   <?php
						if($fet['photo1']!="" && $fet['photo_protect']=="No" )
						 {
						?>
						
					<img src="photos/watermark.php?image=<?php echo $fet['photo1']; ?>&watermark=watermark.png" class="img-responsive photo100" width="100px" height="100px" />
						<?php 
						}
						elseif($fet['photo_protect']=="Yes")
						{?>
						
								<?php  
													 if($fet['gender']=='Male')
												 {
												?>                                    
													<img  src="images/default-photo/photopassword_male.png" class="img-responsive photo100"   title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
												<?php   }else{ ?>
													<img  src="images/default-photo/photopassword_female.png" class="img-responsive photo100"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
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
					  <div class="col-lg-8">
						  <ul class="list-unstyled">
							<li><h4>To ,</h4></li>
							<li><strong class="text-danger"><?php echo $fet['username']; ?></strong></li>
							<li class="text-danger">Profile ID: <?php echo $from_id; ?></li>
						  </ul>
					  </div>
					 </div>      
					<div class="form-group">
							 <label for="inputEmail3" class="col-sm-4 control-label">
									Greeting Song<font class="text-danger">*</font>
							 </label>
						   <div class="col-sm-5">
							 <select class="form-control"  name="song" id="song" >
								 <option value="">--Please Choose Song--</option>
								 <?php 
								$select=mysql_query("select g_song from gratings_setting order by g_id DESC") or die(mysql_error());
								while($fet=mysql_fetch_array($select))
								{
									?>
								<option value="<?php echo $fet['g_song'];?>"><?php echo $fet['g_song'];?></option>
								<?php	}    ?>                      
								</select>               
							</div>
					</div>                         
					 <div class="form-group">
						  <label for="inputEmail3" class="col-sm-4 control-label">
						  Greeting Message<font class="text-danger">*</font>
						  </label>
						<div class="col-sm-5">
						 <select class="form-control" name="message" id="message" >
								 <option value="">--Please Choose Message--</option>
								  <?php 
					$select1=mysql_query("select g_message from gratings_setting order by g_id DESC") or die(mysql_error());
					while($fetch=mysql_fetch_array($select1))
					{?>
								  <option value="<?php echo $fetch['g_message'];?>"><?php echo $fetch['g_message'];?></option>
								 <?php
								 
					}?>
								  
							</select>
							
						</div>
				   </div>	     		
					      
					
						<div class="modal-footer">
					   <p class="pull-left text-danger">Date - <?php echo date('l j F ,Y g:i A');?></p>   
					 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" name="edit-basic-detail" value="submit" class="btn btn-primary" id="go_go_greeting">Send</button>
					<input type="hidden" name="txtTo" id="txtTo" value="<?php echo $from_id; ?>" />
						</div>
					</form>
				  
			   </div>
             </div>  
									 <?php
									}
			}
			else
			{?>
			
			  <div class="modal-dialog">
			  
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership</h4>
				  </div>
				  <div class="modal-body">
				  <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
								  <div class="form-group">
								   <div class="col-sm-12">
									<h4>&nbsp;&nbsp;You are not a paid member, Please upgrade your membership to view the contact details.</h4>
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
}
?>

 <script type="text/javascript">
	$('#go_go_greeting').click(function(){	
	
		
		if ($("#song").val()=='')
		{
			alert( "Please Select Song." );	
			formn.song.focus();
			return false;
		}
		if ($("#message").val()=='')
		{
			alert( "Please Select Message." );	
			formn.message.focus();
			return false;
		}
		
	var dataString =$("#GreetForm").serialize();
		
	$.ajax({	
			
	     url:"web-services/admit_gratings.php",
         type:"POST",
         data:dataString,
        cache: false,
        success: function(response)
		{
		   
		  $("#GreetForm").fadeOut("slow");
		  $('#GreetLabel').text(response).addClass('text-success');		 
		 	
		}
		
	   });
    
	
}) 

</script>
