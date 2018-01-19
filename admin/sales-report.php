<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $member_status = "";
  if(isset($_GET['member_status']))
  {
    $member_status = $_GET['member_status'];
    $_SESSION['member_status'] = $_GET['member_status'];
  }
  else if(isset($_GET['page']))
  {
      $member_status = $_SESSION['member_status'];
  }
  else
  {
      $_SESSION['member_status'] = "all";
      $member_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['payid']))
	{
		$payid_arr = $_POST['payid'];
		$payid_val = "(";
		foreach($payid_arr as $payid)
		{
			$payid_val .=	$payid.",";
		}
		$payid_val = substr($payid_val, 0, -1);
		$payid_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from payments where payid in ".$payid_val;	
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $status_MESSAGE = $statusObj->getstatusMessage();
	}
	else
	{
	  $statusObj = new status();
	  $statusObj->setActionSuccess(false);
	  $status_MESSAGE = "Please select value to complete action.";	  
	}
 }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Sales Report </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="./css/web_dialog.css" />
<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />
<link rel="stylesheet" type="text/css" href="css/tool_tips.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
setPageContext("member_report","sale-report");
 
	function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#full_detail_dialog").fadeIn(300);
      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
            HideDialog();
         });
      }
   }

   function HideDialog()
   {
      $("#overlay").hide();
      $("#full_detail_dialog").fadeOut(300);

   } 
</script>
<script type="text/JavaScript">

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}

</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
//  End -->
</script>
</head>
<body>
<div id="wrapper">
  <?php
		require_once('./page-part/header.php');
	?>
  <!-- start content -->
  <div id="container" class="cf">
    <?php
	require_once('./page-part/left-menu.php');
	?>
    <div class="widecolumn alignleft">
      <div class="breadcum-wide"><a title="Member Report">Member Report</a> / <a title="Sales Report">Sales Report</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Sales Report"  onclick="window.location='sales-report.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List Sales Report</a>
         
         
        </div>
      </div>
      <?php
	if(!empty($status_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$status_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$status_MESSAGE."</li></ul></div>";	
		}
	}
      ?> 
      
      <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>      
      
      
      <div class="widecolumn-inner memership-detail">
	<?php
	    
	    $payments_count = getRowCount("select count(payid) from payment_view",$DatabaseCo);
	    if($payments_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($member_status); ?> Sales Report</h1>
          </div>  	
        <div class="cf membership-data">
	  <div style="position: relative;top:8px;left:13px;">
        <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/><span class="alignleft"><b>&nbsp;&nbsp;Check All</b></span>
	</div>
    
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	
	
    
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["payments_page_size"])?$_COOKIE["payments_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM payment_view ORDER BY payid DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	
	 
	
	<form method="post" action="sales-report.php" id="action_form">
	 <?php						
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		$rowCount=0;
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			if($rowCount%2!=0)
					$cssClass="odd";
			else
					$cssClass="even";
			$rec_not_found = false;			
        	?>	
	<!-- MEMBERSHIP PLAN-1 START -->
        <div class="plan-desc">
          <div class="plan-table-title">
	    <span class="plan-title1">
            <input type="checkbox"  class="table-checkbox"  name="payid[]" value="<?php  echo $DatabaseCo->dbRow->payid;?>"/>
            <?php echo $DatabaseCo->dbRow->pname;?>
            
           
           <a class="margin-none" href="javascript:;" onClick="newWindow('./web-services/user/get_invoice_detail.php?index_id=<?php  echo $DatabaseCo->dbRow->index_id;?>','','870','470')">
		<span title="View Full Profile" class="floor-plan" >Invoice</span></a>
            </span>
           
	    </div>
          <div class="table-desc">
            <table width="100%"  cellpadding="0" cellspacing="0" border="1" class="table-data">
              <tr>
                <th class="second-title">Matri-ID</th>
 				<th class="third-title">Email</th>
                <th class="third-title">Payment Mode</th>
                <th class="third-title">Plan Activated On</th>
				<th class="third-title">Plan Name</th>
                <th class="four-title">Plan Expired On</th>
                <th class="four-title">Amount</th>
              </tr>
              <tr class="odd">
                <td><?php echo $DatabaseCo->dbRow->pmatri_id;?></td>
                <td><?php echo $DatabaseCo->dbRow->pemail;?></td>
                 <td><?php echo $DatabaseCo->dbRow->paymode;?></td>
                <td><?php echo $DatabaseCo->dbRow->pactive_dt;?></td>
                <td><?php echo $DatabaseCo->dbRow->p_plan;?></td>
                <td><?php echo $DatabaseCo->dbRow->exp_date;?> </td>
                <td><?php echo $DatabaseCo->dbRow->p_amount;?></td>
              </tr>
	      
	    
            </table>
          </div>
        </div>
	<!-- MEMBERSHIP PLAN-1 END -->
	<?php
	$rowCount++;
	      }
	 ?>
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(payid) as 'total_rows' from payment_view".getWhereClauseForstatus($member_status);		  
	    echo getNewPagination('sales-report.php','payments_page_size','payments','payid',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($member_status); ?> Sales Report. Please add data.</h1>
         <br/>
	  <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
	  </div>
        </div>
	 
	 <?php
	  }
	 ?>

      </div>
      <?php
		require_once('./page-part/footer.php');
	?>
    </div>
  </div>
  <!-- end content --> 
</div>
</body>
</html>
 