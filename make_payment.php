    <?php
                error_reporting(0);
                session_start();
	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();    
                ?>		
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon"/>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script type="text/javascript" src="js/jquery.min.js"></script> 
</head>
<body>		

    <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
   
        <ol class="breadcrumb">
         <li><a href="index.php">Home</a></li>
         <li class="active">Payment Option</li>
        </ol>
 	<div class="row">    
        <div class="col-xs-12">
       
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Choose payment Method That suit you best .</h3>
            </div>      
              <div class="panel-body">
                  <div  class="col-sm-12">            
                    <div class="col-sm-3"> 
                        <!-- Nav tabs -->
                        <ul class="nav-stacked tabs-left">
                          <li class="active"><a href="#office" data-toggle="tab">Cash At Office</a></li>
                          <li><a href="#net_banking" data-toggle="tab">Net Banking</a></li>
                          <li><a href="#credit_card" data-toggle="tab">Credit Card</a></li>
                          <li><a href="#debit_card" data-toggle="tab">Debit Card</a></li>
                          <li><a href="#cheque" data-toggle="tab">Cheque/DD</a></li>
                          <li><a href="#paypal" data-toggle="tab">Paypal</a></li>                          
                        </ul>
                    </div>
					<div class="clearfix visible-xs"></div>
                    <div class="col-sm-9">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="office">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h3 class="panel-title">You can make Payment at our branch office.</h3>
                                    </div>
                                    <div class="panel-body">
                                     <?php
								 $res2=mysql_query("select * from cms_pages where cms_id='9'");
								  $row2 = mysql_fetch_array($res2);
								  echo htmlspecialchars_decode($row2['cms_content']);?>
                                    </div>
                               </div>                                
                            </div>
                            <div class="tab-pane" id="net_banking">                          
                                     <h4 class="text-danger">You can make Payment online with Net Banking.</h4>                                        
                                    <div class="row">                                     
                                        <div class="col-sm-6" style="border-right: 2px solid #eee;">
                                            <img src="images/icons/icici_logo.jpg" class="img-thumbnail img-responsive" style="height: 150px;" />
                                        </div>
                                        <div class="col-sm-6" style="padding-top: 10px;">
                                            <ul class="list-unstyled">
                                                <?php $sel=mysql_query("select * from bank_detail where STATUS ='APPROVED'");
					 	   					$fet=mysql_fetch_array($sel);
											echo htmlspecialchars_decode($fet['BANK_DETAIL']);
											?>                                                
                                            </ul>
                                        </div>
                                    </div>                                    
                                     <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <i class="glyphicon glyphicon-check"></i> &nbsp; Your membership plan will activete after confirmation of payment.
                                  </div>

                                
                            </div>
                            <div class="tab-pane" id="credit_card">
                                <div class="col-sm-12">
                                    <h4 class="text-danger">Payment With Credit Card</h4>
                                    <p>For use of credit card you have to purchase payment gateway system. To get payment with credit card.</p>                                       
                                    <img src="images/icons/ccavenue-net[1].gif" class="img-responsive" />
                                </div>
                            </div>
                            <div class="tab-pane" id="debit_card">
                                <div class="col-sm-12">
                                    <h4 class="text-danger">Payment With Debit Card</h4>
                                    <p>For use of Debit card you have to purchase payment gateway system. To get payment with Debit card.</p>                                       
                                    <img src="images/icons/ccavenue-net[1].gif" class="img-responsive" />
                                </div>
                            </div>
                            <div class="tab-pane" id="cheque">
                                <h4 class="text-danger">You can make Payment through Cheque.</h4>
                                <div class="col-sm-12">                                        
                                        <div class="col-sm-12" style="padding-top: 10px;">
                                            <ul class="list-unstyled">
                                            
                                         <?php  echo htmlspecialchars_decode($fet['BANK_DETAIL']);?>                                                
                                            </ul>
                                            
                                            <img src="images/icons/ccavenue-net[1].gif" class="img-responsive img-thumbnail" />

                                        </div>
                                    </div>
                                <div class="alert alert-success alert-dismissable" style="margin-top: 10px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                     Please write the User ID & Name which you have used when registering your profile in our website behind the Cheque / Demand Draft. 
                                  </div>
                            </div>
                          <div class="tab-pane" id="paypal">
                                <div class="tab-1">
                                    <h4>Online Payment</h4>
                                    <table class="table table-bordered table-striped">   
                                        <thead>
                                        <tr class="warning">
                                        <td>Plan</td>
                                        <td>Amount</td>
                                        <td>Select</td>
                                        </tr>
                                        </thead>                                        
                                        <tbody>
                                        <?php
                                            $SQL_STATEMENT =  "SELECT * FROM membership_plan WHERE status='APPROVED' and plan_amount!='0'";
                                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                            {
                                        ?>
                                        <tr>
                                        <td><?php echo $DatabaseCo->dbRow->plan_name;?></td>
                                        <td><?php echo $DatabaseCo->dbRow->plan_amount_type;?> <?php echo $DatabaseCo->dbRow->plan_amount;?></td>
                                        <td>                                           
                     <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frmPayPal1">
                     <?php $sel=mysql_query("select * from payment_method where pay_id='1'");
					 	   $fet=mysql_fetch_array($sel);
					 ?>
                                            <input type="hidden" name="business" value="<?php echo $fet['pay_email'];?>">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="item_name" value="Membership Plan <?php echo $DatabaseCo->dbRow->plan_name;?> Purchase">
                                            <input type="hidden" name="item_number" value="1">
                                            <input type="hidden" name="credits" value="510">
                                            <input type="hidden" name="userid" value="1">
 <input type="hidden" name="amount" value="
 <?php if($DatabaseCo->dbRow->plan_amount_type=='$')
 { 
 echo $DatabaseCo->dbRow->plan_amount;
 }
 else
 {
 echo ($DatabaseCo->dbRow->plan_amount/60);
 }?>">
                                            <input type="hidden" name="no_shipping" value="1">
                                            <input type="hidden" name="currency_code" value="USD">
                                            <input type="hidden" name="handling" value="0">
                                            <input type="hidden" name="cancel_return" class="cancel_URL" value="<?php echo $configObj->getConfigname();?>/payment2.php" />
                                            <input type="hidden" name="return" class="success_URL" value="<?php echo $configObj->getConfigname();?>/success_payment.php" />
                                            <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                            </form> 

                                        </td>
                                        </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                    <div>
                                        <img src="images/icons/paypal.png" class="img-responsive" style="height:100px;width: 300px;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="clearfix"></div>
        </div>
              </div>
           </div>
          </div>           
        </div>	

<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 </body>
</html>