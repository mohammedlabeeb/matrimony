<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $income_status = "";
  if(isset($_GET['income_status']))
  {
    $income_status = $_GET['income_status'];
    $_SESSION['income_status'] = $_GET['income_status'];
  }
  else if(isset($_GET['page']))
  {
      $income_status = $_SESSION['income_status'];
  }
  else
  {
      $_SESSION['income_status'] = "all";
      $income_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['inc_id']) && is_array($_POST['inc_id']))
	{
		$inc_id_arr = $_POST['inc_id'];
		$inc_id_val = "(";
		foreach($inc_id_arr as $inc_id)
		{
			$inc_id_val .=	$inc_id.",";
		}
		$inc_id_val = substr($inc_id_val, 0, -1);
		$inc_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from income where inc_id in ".$inc_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update income set STATUS='APPROVED' where inc_id in ".$inc_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update income set STATUS='UNAPPROVED' where inc_id in ".$inc_id_val;	
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $STATUS_MESSAGE = $statusObj->getStatusMessage();
	}
	else
	{
	  $statusObj = new Status();
	  $statusObj->setActionSuccess(false);
	  $STATUS_MESSAGE = "Please select value to complete action.";	  
	}
 }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Income Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
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
setPageContext("add-new","income");
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "income-list.php?income_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "income-list.php?income_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "income-list.php?income_status=all";
      });

     $("#save" ).button().click(function(){
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/add-details/add-income.php?action="+$("#update_action").val(),
		      $("#income-form").serialize(),
		      function(data){
				      if(data.successStatus){
				        $("#validationSummary").attr("class","success-msg cf");
					$("#validationSummary").html("<h3>"+data.responseMessage+"</h3>");
					$("#validationSummary").show();
					refreshRequired = true;
				      }else{
					$("#validationSummary").attr("class","error-msg");
					$("#validationSummary").html("<h3>Please correct following errors.</h3><ul class='error-hint cf'>"+data.responseMessage+"</ul>");
					$("#validationSummary").show();
				      }
			    }
		  );
	});
     
     $("#cancel" ).button().click(function(e){
	 			HideDialog();
        e.preventDefault();
			});
     
      $("#add_income").click(function (e)
      {
					
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New Income");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#income_rate").focus();
		$("#income_rate").val("");
      });
      
      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
   });
   function edit_income(inc_id,income_rate,currency,income_status)
      {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Income");
	 $("#update_action").val("UPDATE"); 
	 $("#inc_id").val(inc_id); 
	 $("#income_rate").val(income_rate);
	  $("#currency").val(currency);
		 		
         if(income_status=='APPROVED'){
	    $("#income_status1").attr("checked","checked");
	 }else{	
	      $("#income_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#income_rate").focus();	      
      }

   function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#dialog").fadeIn(300);
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
      $("#dialog").fadeOut(300);
      if(refreshRequired)
	  window.location.reload(true);
   } 
        
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Deatail</a> / <a href="#" title="Role">Income</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="Add New Deatail" id="add_income"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Income</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Income List" id="approove" value="Approved (<?php echo getRowCount("select count(inc_id) from income where STATUS='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Income List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(inc_id) from income where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Income List"   id="all" value="All (<?php echo getRowCount("select count(inc_id) from income",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Income Amount </p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        <span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
        <form action="" method="post" class="form-data" id="income-form">
          <p class="cf">
            <label class="popup-label">1. Income Amount:</label>
            <input type="text" class="textBox"  name="income_rate" id="income_rate"/>
          </p>
           <p class="cf">
            <label class="popup-label">2. Currency:</label>
           <select name="currency" id="currency">
           <option value="">Select</option>
           <option value="$">Dollar</option>
           <option value="€">Euro</option>
           <option value="£">British Pound</option>
           <option value="Rs.">Indian Rupee</option>
           </select>
          </p>
          <p class="cf"> <label class="popup-label">3. Status:</label>
            <input type="radio"  value="APPROVED" name="income_visibility_status" id="income_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="income_visibility_status" id="income_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  
          <p class="submit-btn cf">
            <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
            <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>
          </p>
	  <input type="hidden" name="inc_id" value="" id="inc_id"/>
	  <input type="hidden" name="action" value="" id="update_action"/>
        </form>
      </div>
 <?php
	if(!empty($STATUS_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$STATUS_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
		}
	}
	 ?>       
      <div class="widecolumn-inner memership-detail">
    <?php
	    
	    $income_count = getRowCount("select count(inc_id) from income".getWhereClauseForStatus($income_status),$DatabaseCo);
	    if($income_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($income_status); ?> Income List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["income_page_size"])?$_COOKIE["income_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM income ".getWhereClauseForStatus($income_status)." ORDER BY inc_id ASC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="10%">Income ID</th>
              <th width="10%">Currency</th>
              <th width="57%">Income Amount</th>
            </tr>
            <form method="post" action="income-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="inc_id[]" value="<?php  echo $DatabaseCo->dbRow->inc_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_income" onclick="edit_income('<?php  echo $DatabaseCo->dbRow->inc_id;?>','<?php  echo $DatabaseCo->dbRow->income_rate;?>','<?php  echo $DatabaseCo->dbRow->currency;?>','<?php  echo $DatabaseCo->dbRow->status;?>');">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->inc_id;?></td>
                <td ><?php echo $DatabaseCo->dbRow->currency;?></td>
                <td ><?php echo $DatabaseCo->dbRow->income_rate;?></td>

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(inc_id) as 'total_rows' from  income".getWhereClauseForStatus($income_status);		  
	echo getNewPagination('income-list.php','income_page_size','income','inc_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
?>		  
        </div>
		<!-- copy from here -->
		        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($income_status); ?> Income. Please add data.</h1>
          <br/>
	  <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
	  </div>
        </div>
        <?php
	    }
	   ?>
<!-- copy from here  end -->
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
