<?php
    require("connect/config1.php");
	require("secure.php");	
	include("BusinessLogic/class.register.php");
	
$mid=$_SESSION['mid'];
$msg1 = "";
$msg2 = "";
$m=$info['web_name'];
$sub="Send SMS From Member Of"." ".$m;
if(isset($_POST['submit']))
{
        $b=$_POST['brideid'];
        $sgg2="select * from register where matri_id='$b'";
		$rrr2=mysql_query($sgg2);
		$num_row22 = mysql_num_rows($rrr2); 
		$sm=mysql_fetch_array($rrr2);
		
			if ($num_row22 == 0) 
			{ 
				/*echo "<script>alert('Your Bride MatriId Not Found in Our Database.Please, Enter Valid Bride MatriId.')</script>";
				echo "<script>window.location='success_story.php'</script>";*/
				$msg1="Your MatriId Not Found in Our Database.Please, Enter Valid MatriId.";
			} 
			else
			{				
					$smsres = mysql_query("SELECT * FROM sms_config");
					$row = mysql_fetch_array($smsres);
						
						$ID=$row['sms_uname'];
						$Pwd=$row['sms_pswd'];
						$baseurl =$row['sms_baseurl'];
						
					//$mn = implode(",",$_POST['mno']);
					$mno=$sm['mobile'];
					$subject=$_POST['subject'];
					$msg =$_POST['msg'];
					$dt=date('Y-m-d h:i:s');	
						
/*					$url = "$baseurl/dpanel/sms.aspx?uid=$ID&pwd=$Pwd&mno=$mno&subject=Subject: $subject&msg=Message: $msg&sender=SAIEDU";*/

$smsurl = "http://api.urlsms.com/SendSMS.aspx?UserID=m9924242420@yahoo.com&Password=pioneer&SenderID=PIONEER&MsgText=$msg&RecipientMobileNo=$mno";
$ret = implode('', file($smsurl));
					//Process $ret to check whether it contains "Message Submitted"
					//echo "yes";
					if(isset($ret))
					{
					$id=$_SESSION['mid'];
					$sql="insert into sms_msg(to_id,from_id,subject,message,sent_date,status)values('$b','$mid','$subject','$msg','$dt','1')";
					$rr=mysql_query($sql);
					
					$mid1 = $_SESSION['mid'];
					$sel=mysql_query("SELECT * FROM payments where pmatri_id='$mid'"); 
					$fet=mysql_fetch_array($sel);
					$tot_sms=$fet['p_msg'];
					$use_sms=$fet['r_sms'];
					$use_sms=$use_sms+1;
					if($tot_sms==$use_sms)
					{
						$update="UPDATE payments SET r_sms='$use_sms' WHERE pmatri_id='$mid1' ";
						$d=mysql_query($update);
					}
					
					
					echo "<script>alert('Your Msg sent successfully.')</script>";

					
					
					
					$sql2p="select r.*,p.* from register r,payments p where p.pmatri_id='".$_SESSION['mid']."' && p.pmatri_id=r.matri_id";
					$ssp=mysql_query($sql2p)  or die(mysql_error());
					$rrp=mysql_fetch_array($ssp);
					
					$rp=$rrp['r_sms'];
					$rp2=$rp+1;
					
					$sql22p="update payments set r_sms='$rp2' where pmatri_id='".$_SESSION['mid']."'";
					$dd2=mysql_query($sql22p);
					echo "<script>window.location='mymsg2.php'</script>";
					}
					else
					{
					//echo "Your Msg not sent successfully.";
					
					}

					
		}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $info['title']; ?></title>
<meta name="Description" content="<?php echo $info['description']; ?>">
<meta name="keywords" content="<?php echo $info['keywords']; ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $info['favicon']; ?>">
<script type="text/javascript"><?php echo $info['google_analytics_code']; ?></script>
<link rel="stylesheet" type="text/css" href="css/style.css">

<script type="text/javascript">
function checkbride(str)
{
if (str=="")
  {
  document.getElementById("bridename").value="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("bridename").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","checksmsname.php?q="+str,true);
xmlhttp.send();
}
</script>


<script language="javascript" type="text/javascript">

// Function to validate all the inputs
	function Valid()
	{
		var MatriForm = this.document.MatriForm;
		
		// Check the Name field
		if ( MatriForm.brideid.value == "" )
		{
			alert("Please Enter Matrimonial Id.");
			MatriForm.brideid.focus();
			return false;
		}
		if ( MatriForm.subject.value == "" )
		{
			alert("Please Enter Subject.");
			MatriForm.subject.focus();
			return false;
		}
		
		
       if ( MatriForm.msg.value == "" )
		{
			alert( "Please Enter Lastname." );
			MatriForm.msg.focus( );
			return false;
		}
		

	/*	var g=document.getElementById('mobile').value;
		if(g.length>0)
		{
		  if((g.length<10)||(g.length>13))
		  {
		   	alert( "Please Check Mobile Number. Minimum 10 And Maximum 13 Allow");	
			document.getElementById('mobile').focus();
			return false;		
		  }
		  else
		  {
		  	var h3=/[^0-9]/;
			if(g.match(h3)!=null)
			{
			alert( "Please Enter Valid Mobile Number");	
			document.getElementById('mobile').focus();
			return false;
			}
		  }	*/	  
	
			
return true;

}
</script>
</head>

<body>
<center>
        <div id="mainarea" style="margin-left:auto; margin-right:auto;">
            <div id="header"><?php include('header.php'); ?></div>
            <div id="logoarea"><?php include('logoarea.php'); ?></div>
            <div class="menu"><?php include('menu.php'); ?></div>
            <div id="search"><?php include('search.php'); ?> </div>
            <div id="banner"><?php include('banner_part.php'); ?></div>
            <div id="content2">
				<table border="0">
                	<tr>
                    	<td width="240px" valign="top" align="left">
                        	<?php include('left2.php'); ?>
                        </td>
                        <td width="520px" style="padding:5px; " valign="top" bgcolor="" align="left">
						  
<!--midddle content-->
<form action="" method="post" name="MatriForm"  onsubmit="return Valid()" id="storyform">
<table width="500"  border="0" style="margin-left:10px;height:1260px; padding:10px; border:groove 5px #9999CC;" class="text">
<tr>
<td height="25" colspan="2"  style="" class="bgtitle">Send SMS</td>
</tr>
<tr>
<td height="5px" valign="top">&nbsp;</td>
</tr>	 
<tr>
<td valign="top">


	 <fieldset class="b" style="background-color:#ECEAEA; border-color:#999933; border-width:thick;">
                            	<legend class="red_text" style="margin-left:25px;"><img src="images/sms.jpeg"  width="25" height="25" border="0"/>&nbsp;Send SMS</legend><br />
							
            <table cellpadding="10"  align="left">
				
                <tr>
                <td colspan="2">
                <div class="">
                <table cellspacing="10">
				
				<tr>
                           <td class="text" width="350px" height="20px" valign="top" style="padding-left:5px; color:#FF0000; border:none;" colspan="2">
                                <?php echo $msg1; ?> </td>
                            </tr>
                 <tr>
					<td valign="top" class="text"><font color="#ff0000">*</font>&nbsp;Matrimony Id :</td>
					<td valign="top" align="left" >
                   <input name="brideid" type="text" id="brideid" value="" style="width:150px;" onBlur="return checkbride(this.value)" />
                    </td>
                </tr>
<!--				    <tr>
					<td valign="top" class="text"><font color="#ff0000">*</font>&nbsp;Name :</td>
					<td valign="top" align="left" >
                  <input name="bridename" type="text" id="bridename" value="" readonly="true" style="width:150px;" />
                    </td>
                </tr>-->
                <tr>
					<td valign="top" class="text"><font color="#ff0000">*</font>&nbsp;Subject :</td>
					<td valign="top" align="left" >
                    <input type="text" name="subject" id="subject">
                    </td>
                </tr>
                
                <tr>
                <td valign="top" class="text"><font color="#ff0000">*</font>&nbsp;Message :</td>
                <td valign="top" align="left" >
               <textarea id='msg' name="msg" cols="30" rows="5" ></textarea>
		       </td>
                </tr>
                
                
				<tr>
					<td valign="top">&nbsp;</td>
					<td valign="top" align="left"><input type="image" name="submit" src="images/btn_submit.gif" value="submit" /><input type="hidden" name="submit" value="submit" /><img src="images/btn_cancel.gif" onClick="window.location='mymsg2.php'" /></td>
				</tr>
                </table>
                </div>
                </td>
                </tr> 
           </table>
				</fieldset>				  
				 
</td>
</tr>
</table> 
</form>
<!--midddle content-->     
                        </td>
                        <td width="240px" valign="top" align="right">
                        	<?php include('right_general4.php'); ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="footer">
            	<?php include('footer.php'); ?>
            </div>
        </div>
			<?php include('chat.php'); ?>
</center> 
</body>
</html>

