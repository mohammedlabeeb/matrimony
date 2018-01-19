<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
			
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
$mid = $_SESSION['user_id'];



$result = mysql_query("SELECT * FROM register,site_config where matri_id='$mid'");
$row=mysql_fetch_array($result);



$result3 = mysql_query("SELECT * FROM register,site_config where matri_id='$from_id'");
$rowcc = mysql_fetch_array($result3);

$name = $rowcc['username'];
$matriid = $rowcc['matri_id'];
$to = $rowcc['email'];
$website = $rowcc['web_name'];
$webfriendlyname = $rowcc['web_frienly_name'];


$from = $rowcc['from_email'];
$photo_pass=$row['photo_pswd'];

$subject = "Your requested Photo Password of $mid for $webfriendlyname";	
$message = "
<html>
<head>
<title>Dear $name,</title>
</head>
<body>
<table style='margin:auto;border:5px solid #43609c;min-height:auto;font-family:Arial,Helvetica,sans-serif;font-size:12px;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
  <tbody>
  <tr>
    <td style='float:left;min-height:auto;border-bottom:5px solid #43609c'>	
  	  <table style='margin:0;padding:0' border='0' cellpadding='0' cellspacing='0' width='710px'>
  		<tbody>
			<tr style='background:#f9f9f9'>
    			<td style='float:right;font-size:13px;padding:10px 15px 0 0;color:#494949'>
					<span tabindex='0' class='aBn' data-term='goog_849968294'>
					
    <td style='float:left;margin-top:5px;color:#048c2e;font-size:26px;padding-left:15px'>$website</td>
    
  </tr>
  
</tbody></table>
    </td>
  </tr>
  <tr>
    <td style='float:left;width:710px;min-height:auto'>
    
    <h6 style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px'>Hello,</h6>
	<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
	Thank you for requesting member's Photo Password.
			</p>
		<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>
		<b style='float:left;margin:5px 0 5px 30px;padding:5px 20px;background:#f3f3f3;font-size:13px;color:#096b53'>
		Here is your Requested Photo Password<br>
  MatriID :$mid<br>
  Photo Password : $photo_pass
		</b></p>
		
	<p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 0 15px;color:#494949'>Thank you for helping us reach you better,</p><p style='float:left;clear:both;width:680px;font-size:13px;margin:10px 0 5px 15px;color:#494949'>Thanks & Regards ,<br>Team $webfriendlyname</p>
    
    </td>
  </tr>
</tbody></table>
</body>
</html>
";

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";


mail($to,$subject,$message,$headers);

$upd=mysql_query("update photoprotect_request set receiver_response='Accepted' where ph_receiver_id ='$mid'");

?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Photo password request of <?php echo $name;?></h4>
              </div>
               
              <div class="modal-body">                 
                      <div class="form-group"> 
            <h5>Your Photo Password has been successfully sent to requester's email id.</h5>        
                      </div>
     
              </div>
              
              
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </div>
          </div>