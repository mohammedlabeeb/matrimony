<?php
			include_once 'databaseConn.php';
			include_once 'lib/requestHandler.php';
			include_once './class/Config.class.php';
			$configObj = new Config();
			$DatabaseCo = new DatabaseConn();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcuticon" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/AC_RunActiveContent.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/hp-success-stories.js"></script>
<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/mi.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
</head>


<body>
<div id="body">
<?php include "page-part/header.php";?>
<br />
<div class="fix">
<p class="cb"></p>
<?php include "page-part/menu.php";?>
<p class="cb"></p>
	
	<br class="lh05em" >
	
	<br class="lh05em" >
	

<form name="paid_membership_order" action="" method="POST" onsubmit="return order_form1_validate(this);">
<div class="plr"><!--padding div start-->
		
<p class="cb"></p>
<p class="breadcrumb tree ar pr5px">&bull; <a href="index.php">Home</a> &bull; Advertise with Narjis Enterprise.com</p>
<br />


<div  style="border: 0px solid #ff0000">

<p class="addOn xxxlarge dif p10px">Choose a package and payment mode that suits you best from the various options.</p>

<table class="advertise" width="100%" border="0" cellspacing="0" cellpadding="10">
<tr class="large b  ac">
<td width="6%">S.No</td>
<td class="al">Features</td>
<td width="15%">Silver Membership</td>
<td width="15%">Gold Membership</td>
<td width="17%">Platinum Membership</td>
</tr>
<tr class="g1 b large dif ac">
<td>&nbsp;</td>
<td class="al b">&nbsp;</td>
<td>1 Month</td>
<td>3 Months</td>
<td>6 Months</td>
</tr>
<tr class="ac">
<td>1.</td>
<td class="al b">Create Profile, Create Album, Define Partner Profile, Search profiles</td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>2.</td>
<td class="al b">Members Looking For Me</td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>3.</td>
<td class="al b">Members I am looking for </td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>4.</td>
<td class="al b">Perfect E-matches</td>
<td><img src="images/no.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>5.</td>
<td class="al b">Express Interest </td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>6.</td>
<td class="al b">View Contact Details of accepted members </td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>7.</td>
<td class="al b">Send Messages along with your Contact Details</td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>8.</td>
<td class="al b">View Verified Contact details</td>
<td>75</td>
<td>200</td>
<td>500</td>
</tr>
<tr class="ac">
<td>9.</td>
<td class="al b">Send and Receive messages to Free members</td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
<tr class="ac">
<td>10.</td>
<td class="al b">Chat Online</td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
<td><img src="images/yes.gif" alt="" /></td>
</tr>
				
<tr class="b ac">
<td>&nbsp;</td>
<td class="al maroon">PRICE</td>
<td><label><input name="MembershipType" type="radio" title="Rs. 2190" value="20023" id="MembershipType1" /> <img src="images/icon_rupee_7x9.gif" class="vam" /> 2190</label></td>
<td><label><input name="MembershipType" type="radio" title="Rs. 3190" value="10013" id="MembershipType2" /> <img src="images/icon_rupee_7x9.gif" class="vam" /> 3190 </label></td>
<td><label><input name="MembershipType" type="radio" title="Rs. 5190" value="10006" id="MembershipType3" /> <img src="images/icon_rupee_7x9.gif" class="vam" /> 5190 </label></td>
</tr>
</table>

<!-- curve div ends -->
<div style="width:740px;margin:0 auto;">
<p class="fr mt7px">
<input type="hidden" value="Proceed_To_Buy" name="proceed_to_buy">
<input type="submit" value="Proceed to Buy" class="vam button cp p5px10px c5px" id="proceed"></p>

<p style="font:bold 24px/1.5em Arial;">Your Total Amount is <img src="../../static.matrimonialsindia.com/images/icon_rupee_7x9.gif" class="vam" /> <b class="dif xxlarge dib vam" id="TotalAmount">0</b> &nbsp;</p>
<p style="visibility:hidden;height:0">Your Payable Amount is <img src="../../static.matrimonialsindia.com/images/icon_rupee_7x9.gif" /> <b class="dif xxlarge dib vam" id="PayableAmount">0</b> &nbsp; (Inclusive 12.36% Service Tax.)</p>
</div>

<br class="clr" />
<p class="ac">Every transaction on Narjis Enterprise.com is secure. Any personal information provided by you will be handled according to our Privacy Policy.</p>
</div>
</div>
</form>

<br class="clr" />


		
			<p class="cb"></p>
	<!--banner div end-->
	<br class="lh12em" >
	<!--footer div start-->
	<?php include "page-part/footer.php";?>
	<!--footer div end-->
	</div>
	<!--fix div end-->	
	</body>


</html>
<style type="text/css">
.advertise td, .advertise th  { border:1px solid #d0e7bc; }
.addOn{background:url(http://static.matrimonialsindia.com/images/bg.png) repeat-x 0 -997px;}
.selectedHead{background:url(http://static.matrimonialsindia.com/images/bg.png) repeat-x 0 -2956px;color:#fff;}
input.button{background:url(http://static.matrimonialsindia.com/images/bg.png) repeat-x -10px -2910px;color:#fff;font-size:20px;border:1px solid #360;height:40px;width:180px;}
.td1,.td2,.td3,.td4{border:1px solid #d0e7bc;border-width:0 0 1px 1px;text-align:center;padding:10px;width:118px;}
.td1{width:27px;border-left:0;}
.td2{width:578px;text-align:left;}
</style>