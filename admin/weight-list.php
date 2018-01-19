<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $weight_status = "";
  if(isset($_GET['weight_status']))
  {
    $weight_status = $_GET['weight_status'];
    $_SESSION['weight_status'] = $_GET['weight_status'];
  }
  else if(isset($_GET['page']))
  {
      $weight_status = $_SESSION['weight_status'];
  }
  else
  {
      $_SESSION['weight_status'] = "all";
      $weight_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['weight_id']) && is_array($_POST['weight_id']))
	{
		$weight_id_arr = $_POST['weight_id'];
		$weight_id_val = "(";
		foreach($weight_id_arr as $weight_id)
		{
			$weight_id_val .=	$weight_id.",";
		}
		$weight_id_val = substr($weight_id_val, 0, -1);
		$weight_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from weight where weight_id in ".$weight_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update weight set STATUS='APPROVED' where weight_id in ".$weight_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update weight set STATUS='UNAPPROVED' where weight_id in ".$weight_id_val;	
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
<title>Admin | Weight Management</title>
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
setPageContext("add-new","weight");
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "weight-list.php?weight_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "weight-list.php?weight_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "weight-list.php?weight_status=all";
      });

     $("#save" ).button().click(function(){
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/add-details/add-weight.php?action="+$("#update_action").val(),
		      $("#weight-form").serialize(),
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
     
      $("#add_weight").click(function (e)
      {
					
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New Weight");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#weight_value").focus();
		$("#weight_value").val("");
      });
      
      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
   });
   function edit_weight(weight_id,weight_value,unit1,weight_status)
      {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Weight");
	 $("#update_action").val("UPDATE"); 
	 $("#weight_id").val(weight_id); 
	 $("#weight_value").val(weight_value);
	 $("#unit").val(unit1);
		 		
         if(weight_status=='APPROVED'){
	    $("#weight_status1").attr("checked","checked");
	 }else{	
	      $("#weight_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#weight_rate").focus();	      
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Deatail</a> / <a href="#" title="Role">Weight</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="Add New Deatail" id="add_weight"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Weight</a>
          <div class="approval alignleft">
          <input type="button" title="Approved weight List" id="approove" value="Approved (<?php echo getRowCount("select count(weight_id) from weight where STATUS='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved weight List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(weight_id) from weight where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All weight List"   id="all" value="All (<?php echo getRowCount("select count(weight_id) from weight",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Weight Detail </p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        <span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
        <form action="" method="post" class="form-data" id="weight-form">
          <p class="cf">
            <label class="popup-label">1. Weight Value:</label>
            <input type="text" class="textBox"  name="weight_value" id="weight_value"/>
          </p>
           <p class="cf">
            <label class="popup-label">2. Unit:</label>
           <select name="unit" id="unit">
           <option value="">Select</option>
           <option value="KG">KiloGrams</option>
           <option value="Pound">Pound</option>
           </select>
          </p>
          <p class="cf"> <label class="popup-label">3. Status:</label>
            <input type="radio"  value="APPROVED" name="weight_visibility_status" id="weight_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="weight_visibility_status" id="weight_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  
          <p class="submit-btn cf">
            <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
            <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>
          </p>
	  <input type="hidden" name="weight_id" value="" id="weight_id"/>
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
	    
	    $weight_count = getRowCount("select count(weight_id) from weight".getWhereClauseForStatus($weight_status),$DatabaseCo);
	    if($weight_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($weight_status); ?> Weight List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["weight_page_size"])?$_COOKIE["weight_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM weight ".getWhereClauseForStatus($weight_status)." ORDER BY weight_id ASC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="10%">Weight ID</th>
              <th width="40%">Weight Value</th>
              <th width="27%">Unit</th>
            </tr>
            <form method="post" action="weight-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="weight_id[]" value="<?php  echo $DatabaseCo->dbRow->weight_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_weight" onclick="edit_weight('<?php  echo $DatabaseCo->dbRow->weight_id;?>','<?php  echo $DatabaseCo->dbRow->value;?>','<?php  echo $DatabaseCo->dbRow->unit;?>','<?php  echo $DatabaseCo->dbRow->status;?>');">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->weight_id;?></td>
                 <td ><?php echo $DatabaseCo->dbRow->value;?></td>
                <td ><?php echo $DatabaseCo->dbRow->unit;?></td>
               

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(weight_id) as 'total_rows' from  weight".getWhereClauseForStatus($weight_status);		  
	echo getNewPagination('weight-list.php','weight_page_size','weight','weight_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
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
            <h1>There are no data for <?php echo strtoupper($weight_status); ?> Weight. Please add data.</h1>
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
