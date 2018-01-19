<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $blood_group_status = "";
  if(isset($_GET['blood_group_status']))
  {
    $blood_group_status = $_GET['blood_group_status'];
    $_SESSION['blood_group_status'] = $_GET['blood_group_status'];
  }
  else if(isset($_GET['page']))
  {
      $blood_group_status = $_SESSION['blood_group_status'];
  }
  else
  {
      $_SESSION['blood_group_status'] = "all";
      $blood_group_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['bg_id']) && is_array($_POST['bg_id']))
	{
		$bg_id_arr = $_POST['bg_id'];
		$bg_id_val = "(";
		foreach($bg_id_arr as $bg_id)
		{
			$bg_id_val .=	$bg_id.",";
		}
		$bg_id_val = substr($bg_id_val, 0, -1);
		$bg_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from blood_group where bg_id in ".$bg_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update blood_group set STATUS='APPROVED' where bg_id in ".$bg_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update blood_group set STATUS='UNAPPROVED' where bg_id in ".$bg_id_val;	
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
<title>Admin | Blood Group Management</title>
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
setPageContext("add-new","blood");
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "blood-group-list.php?blood_group_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "blood-group-list.php?blood_group_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "blood-group-list.php?blood_group_status=all";
      });

     $("#save" ).button().click(function(){
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/add-details/add-blood_group.php?action="+$("#update_action").val(),
		      $("#blood_group-form").serialize(),
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
     
      $("#add_blood_group").click(function (e)
      {
					
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New Blood Group");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#bg_name").focus();
		$("#bg_name").val("");
      });
      
      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
   });
   function edit_blood_group(bg_id,bg_name,blood_group_status)
      {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Blood Group");
	 $("#update_action").val("UPDATE"); 
	 $("#bg_id").val(bg_id); 
	 $("#bg_name").val(bg_name);
		 		
         if(blood_group_status=='APPROVED'){
	    $("#blood_group_status1").attr("checked","checked");
	 }else{	
	      $("#blood_group_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#blood_group_rate").focus();	      
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Deatail</a> / <a href="#" title="Role">Blood Group</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="Add New Deatail" id="add_blood_group"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Blood Group</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Blood Group List" id="approove" value="Approved (<?php echo getRowCount("select count(bg_id) from blood_group where STATUS='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Blood Group List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(bg_id) from blood_group where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Blood Group List"   id="all" value="All (<?php echo getRowCount("select count(bg_id) from blood_group",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Blood Group Detail </p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        <span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
        <form action="" method="post" class="form-data" id="blood_group-form">
          <p class="cf">
            <label class="popup-label">1. Blood Group:</label>
            <input type="text" class="textBox"  name="bg_name" id="bg_name"/>
          </p>
         
          <p class="cf"> <label class="popup-label">2. Status:</label>
            <input type="radio"  value="APPROVED" name="blood_group_visibility_status" id="blood_group_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="blood_group_visibility_status" id="blood_group_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  
          <p class="submit-btn cf">
            <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
            <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>
          </p>
	  <input type="hidden" name="bg_id" value="" id="bg_id"/>
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
	    
	    $blood_group_count = getRowCount("select count(bg_id) from blood_group".getWhereClauseForStatus($blood_group_status),$DatabaseCo);
	    if($blood_group_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($blood_group_status); ?> Blood Group List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["blood_group_page_size"])?$_COOKIE["blood_group_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM blood_group ".getWhereClauseForStatus($blood_group_status)." ORDER BY bg_id ASC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="10%">Blood Group ID</th>
              <th width="40%">Blood Group</th>
            </tr>
            <form method="post" action="blood-group-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="bg_id[]" value="<?php  echo $DatabaseCo->dbRow->bg_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_blood_group" onclick="edit_blood_group('<?php  echo $DatabaseCo->dbRow->bg_id;?>','<?php  echo $DatabaseCo->dbRow->bg_name;?>','<?php  echo $DatabaseCo->dbRow->status;?>');">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->bg_id;?></td>
                 <td ><?php echo $DatabaseCo->dbRow->bg_name;?></td>
             
               

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(bg_id) as 'total_rows' from  blood_group".getWhereClauseForStatus($blood_group_status);		  
	echo getNewPagination('blood-group-list.php','blood_group_page_size','blood_group','bg_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
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
            <h1>There are no data for <?php echo strtoupper($blood_group_status); ?> Blood Group. Please add data.</h1>
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
