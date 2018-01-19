<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
 

  $express_status = "";
  if(isset($_GET['express_status']))
  {
    $express_status = $_GET['express_status'];
    $_SESSION['express_status'] = $_GET['express_status'];
  }
  else if(isset($_GET['page']))
  {
      $express_status = $_SESSION['express_status'];
  }
  else
  {
      $_SESSION['express_status'] = "all";
      $express_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['ei_id']))
	{
		$ei_id_arr = $_POST['ei_id'];
		$ei_id_val = "(";
		foreach($ei_id_arr as $ei_id)
		{
			$ei_id_val .=	$ei_id.",";
		}
		$ei_id_val = substr($ei_id_val, 0, -1);
		$ei_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from expressinterest where ei_id in ".$ei_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update expressinterest set status='APPROVED' where ei_id in ".$ei_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update expressinterest set status='UNAPPROVED' where ei_id in ".$ei_id_val;	
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
<title>Admin | Express Interest </title>
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
<script type="text/javascript">
setPageContext("activity","express-interest");
 $(document).ready(function ()
   {
      $("#approove" ).button().click(function(){
	window.location = "express-interest.php?express_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "express-interest.php?express_status=unapproved";
      });
	  
    $("#all" ).button().click(function(){
	window.location = "express-interest.php?express_status=all";
      });
   });
  
	
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
      <div class="breadcum-wide"><a href="#" title="Express Interest">Express Interest</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Express Interest"  onclick="window.location='express-interest.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Express Interest</a>
       
          <div class="approval alignleft">
	   <input type="button" title="APPROVED Express Interest List" id="approove" value="Approved (<?php echo getRowCount("select count(ei_id) from expressinterest where status='APPROVED'",$DatabaseCo);?>)"/>
            
            +     
            <input type="button" title="UNAPPROVED Express Interest List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(ei_id) from expressinterest where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =         
            
            <input type="button" title="All Express Interest List" id="all" value="All (<?php echo getRowCount("select count(ei_id) from expressinterest",$DatabaseCo);?>)"/>
          </div>
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
	    
	  $expressinterest_count = getRowCount("select count(ei_id) from expressinterest".getWhereClauseForstatus($express_status),$DatabaseCo);
	    if($expressinterest_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($express_status); ?> Express Interest List</h1>
          </div>  	
        <div class="cf membership-data">
	  
    
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="APPROVED" onclick="submitActionForm('APPROVED');">Approve</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="UNAPPROVED" onclick="submitActionForm('UNAPPROVED');">Unapprove</a>
     
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["expressinterest_page_size"])?$_COOKIE["expressinterest_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM expressinterest ".getWhereClauseForstatus($express_status)." ORDER BY ei_id DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	
	 
	
	<form method="post" action="express-interest.php" id="action_form">
	 
	<!-- MEMBERSHIP PLAN-1 START -->
        <div class="plan-desc">
          
          <div class="table-desc">
            <table width="100%"  cellpadding="0" cellspacing="0" border="1" class="table-data">
              <tr>
                <th  width="3%">
             <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="8%">status</th>
              <th width="8%">Sender</th>
              <th width="8%">Receiver</th>
              <th width="10%">Receiver Response 	</th>
              <th width="36%">Message</th>
              <th width="14%">Sent Date</th>
              </tr>
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
              <tr class="<?php echo $cssClass;?>">
                <td><input type="checkbox"  class="table-checkbox" name="ei_id[]" value="<?php  echo $DatabaseCo->dbRow->ei_id;?>" /></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->ei_sender;?></td>
                <td ><?php echo $DatabaseCo->dbRow->ei_receiver;?></td>
                <td ><?php echo $DatabaseCo->dbRow->receiver_response;?></td>
                <td ><?php echo (substr($DatabaseCo->dbRow->ei_message,0,140));?></td>
                <td ><?php $a=$DatabaseCo->dbRow->ei_sent_date;
				 echo date('F j, Y, g:i a', (strtotime($a)));?></td>
                

            </tr>
	      <?php
	$rowCount++;
	      }
	 ?>
	    
            </table>
          </div>
        </div>
	<!-- MEMBERSHIP PLAN-1 END -->
	
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(ei_id) as 'total_rows' from expressinterest".getWhereClauseForstatus($express_status);		  
	    echo getNewPagination('express-interest.php','expressinterest_page_size','expressinterest','ei_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($express_status); ?> Express Interest. Please add data.</h1>
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
