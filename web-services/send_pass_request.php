<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;

if(isset($_REQUEST['req-password']))
{
	$msg="I am interested in your profile. I would like to view your photo now, so Please send me password.";
	$strresponse = "Pending";
	$receiver = $_POST['receiver'];
	
	$insert = mysql_query("insert into photoprotect_request(ph_requester_id,ph_receiver_id,ph_msg,ph_reqdate,
	receiver_response,status) values ('$mid','$receiver','$msg',now(),'$strresponse','1')")
or die("Could not insert data because ".mysql_error());
	$result="Your Request has been Sent to the member Successful. (Note : Your Request password has been sent to your email after your receiver responded.) ";

}

   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=mysql_query($select) or die(mysql_error());
$fetch=mysql_fetch_array($exe);

$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');

if ($exp_date > $today)
{
	$get=mysql_query("select * from register_view where matri_id='$mid'");
	$fet=mysql_fetch_array($get);
?>
<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

	<script>
		jQuery(document).ready(function()
		{
			//alert("hi");
			jQuery("#MatriForm").validationEngine();
		});
	</script>
<div class="modal-dialog yoyo-large">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">View Protected Photo</h4>
      </div>      
 <form name="MatriForm" id="MatriForm" class="form-horizontal" action="./web-services/admit_photo_request.php" method="post">
                        <div class="form-group">
                               <div class="col-sm-8">
                                     <h4>Please enter password to view photo</span></h4>

                                     <?php if(isset($result))
                                         {
                                                echo "<h4 style='color:red;'>$result</h4>"; 
                                         }?>
                              </div>
                        </div>
        
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-5 control-label">Enter Password</label>
                                <div class="col-sm-5">                              
                                <input name="exp_interest"  class="form-control" type="text" value=""  />                  	
                                </div>                           
                            </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <input type="submit" name="view_photo" value="View Photo" class="btn btn-success">
                                 <input type="hidden" name="ExmatriId" id="ExmatriId" value="<?php echo $from_id; ?>" />
                            </div>
                          </div> 
               <div class="modal-footer">
                    <p class="pull-left text-danger">Date - <?php echo date('l j F ,Y g:i A');?></p>   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="req-password" value="submit" class="btn btn-primary">Request Password</button>
                    <input type="hidden" name="receiver" id="receiver" value="<?php echo $from_id; ?>" />
               </div>
     
     
        </form>
      </div>
   </div>
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
<?php
}
?>

 
