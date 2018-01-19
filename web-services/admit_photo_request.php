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

   


?>

<div class="modal-dialog yoyo-large">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">View Protected Photo</h4>
      </div>
      
      
   <form name="MatriForm" id="MatriForm" class="form-horizontal" action="./web-services/admit_photo_request.php" method="post">
         <div class="form-group">
          <div class="col-sm-8">
      
       
       <?php if(isset($result))
	   {
		  echo "<h4 style='color:red;'>$result</h4>"; 
	   }?>
         </div></div>
        
   
                          
        </form>
      </div>
   </div>
  </div>
 
 
