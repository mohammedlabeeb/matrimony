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
					$get=mysql_query("select * from register_view where matri_id='$mid'");
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
               <h4>This member has blocked you.You can't express your interest.</h4>
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
						<h4 class="modal-title text-danger" id="ExpressLabel">Express Interest</h4>
					  </div>     
					 
					 <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
								<div class="form-group">
								   <div class="col-sm-8">
									   <b>Send Express Interest Message to : <b class="text-danger"><?php echo $from_id;?></b></b>
								   </div>
								</div> 
									<div class="col-sm-12">
									
									  <ul class="list-unstyled">                              
										  <li><input name="exp_interest"  class="radio-inline" type="radio" value="I am interested in your profile. Please Accept if you are interested." checked  /> I am interested in your profile. Please Accept if you are interested.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value="You are the kind of person we have been looking for. Please respond to proceed further." > You are the kind of person we have been looking for. Please respond to proceed further.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value=" We liked your profile and interested to take it forward. Please reply at the earliest." > We liked your profile and interested to take it forward. Please reply at the earliest.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value="You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further."> You seem to be the kind of person who suits our family. We would like to contact your parents to proceed further.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value="You profile matches my sister's/brother's profile. Please 'Accept' if you are interested."> You profile matches my sister's/brother's profile. Please 'Accept' if you are interested.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value="Our children's profile seems to match. Please reply to proceed further."> Our children's profile seems to match. Please reply to proceed further.</li>
											<li><input name="exp_interest" class="radio-inline" type="radio" value="We find a good life partner in you for our friend. Please reply to proceed further."> We find a good life partner in you for our friend. Please reply to proceed further.</li>
									  </ul>                           
								  </div>                           
								  <div class="modal-footer">
										<p class="pull-left text-danger">Date - <?php echo date('l j F ,Y g:i A');?></p>   
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" name="edit-basic-detail" value="submit" class="btn btn-primary" id="go_go_go">Send Interest</button>
										<input type="hidden" name="ExmatriId" id="ExmatriId" value="<?php echo $from_id; ?>" />
								</div>
						</form>
					  </div>
				   </div>
                   					<?php
									}?>
				 
				 <?php
				}
				else
				{?>
				
				  <div class="modal-dialog yoyo-large">
				  
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership</h4>
					  </div>
					  
					  <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
									  <div class="form-group">
									   <div class="col-sm-12">
							   <h5>&nbsp;&nbsp;You are not a paid member, Please upgrade your membership to express the interest.</h5>
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
{?>
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
	$('#go_go_go').click(function(){
	
	var dataString =$("#MatriForm").serialize();
	
	
	$.ajax({	
			
	     url:"web-services/admit_interest.php",
         type:"POST",
         data:dataString,
        cache: false,
        success: function(response)
		{
		   
		  $("#MatriForm").fadeOut("slow");
		  $('#ExpressLabel').text(response).addClass('text-success');		 
		 	
		}
		
	   });
    
	
}) 

</script>