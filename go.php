<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
require_once("BusinessLogic/class.events.php");
$id=$_SESSION['id'];
$asd=$_SESSION['amount'];
$ob=new event();
$events=$ob->get_event_by_id($id);
$event=mysql_fetch_array($events);
$sql="select * from payment_method where status='APPROVED' && pay_id='1'";
$rr=mysql_query($sql) or die(mysql_error());
$fetch=mysql_fetch_array($rr);
$email=$fetch['pay_email'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body>		

        <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Events</li>
    </ol>
 		<div class="row">
    		
                <div class="col-md-12">
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Events Final Go</h3>
                  </div>
                  <div class="panel-body">
                      
                      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="rest-page">
                      <tr>
                        <td><h3> Event - Payment (Continue..)  </h3></td>
                      </tr>
                      <tr>
                        <td height="20"></td>
                      </tr>
                      <tr>
                        <td valign="top">
                        <table width="90%" height="200" border="0" align="center" cellpadding="0" cellspacing="5">
                          
                          <tr>
                            <td align="left" bgcolor="#FFFFFF" class="my-page h4"><h4>After Making Payment You will get the confirmation detail of all your participants and timing details in your confirmation mail.....</h4></td>
                          </tr>
                          
                          <tr><td align="left"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td><table width="100%" cellpadding="2" cellspacing="10" height="30">
                        
                        
                        
                        
                        
						</table>		</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                            </table></td></tr>
                          
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
                            <fieldset>
                                <legend>Payment Methods<br />
                                </legend>
                                <table width="98%" border="0" align="center" cellpadding="2" cellspacing="0">
                                  
                                    <tr>
                                      <td width="71%" height="35" align="center"><a href="membership-plan.html"><strong>Please Make Payment By</strong></a></td>
                                    </tr>
                                    <tr>
                                      <td align="center"><!--a href="membership-plan.html"><img src="../images/Winter.jpg" width="150" height="113" border="0" /></a--></td>
                                    </tr>
                                    <tr>
                                      <td align="center">
                                      
                                       
														<table border="0">
														<tr><td width="157" align="center" class="greentext" valign="top"> <bR />
    
<form action="https://www.paypal.com/cgi-bin/webscr" target="paypal" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $email; ?>">
<input type="hidden" name="lc" value="GBP">
<input type="hidden" name="item_name" value="<?php echo $event['name']; ?>">
<input type="hidden" name="item_number" value="CP1">
<input type="hidden" name="amount" value="<?php echo $asd; ?>">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="button_subtype" value="Membership Plan">
<input type="hidden" name="bn" value="PP-BuyNowBF:buynow.jpg:NonHosted">
<input type="image" src="images/pay-now.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
</form>
												<br />
														
													      </td>
														</tr>
														</table>
														
														    
                              
                                      
                                      
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center"><!--a href="membership-plan.html"><img src="images/ccavenue_logo.jpg" width="150" height="53" border="0" /></a--></td>
                                    </tr>
                                    
                                    
                                     
                                     
                            <tr>
                                      <td align="center"><!--a href="membership-plan.html"><img src="images/ccavenue_logo.jpg" width="150" height="53" border="0" /></a--></td>
                                    </tr>
                                    
                                    
                                </table>
                              </fieldset>                            </td>
                          </tr>
                          
                          
                        </table>
                          <br /></td>
                      </tr>
                      
                    </table>
                  </div>
                </div>
          </div>
      </div>	

        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>
</div>
 </body>
</html>
 