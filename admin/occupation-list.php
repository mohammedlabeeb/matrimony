<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $occupation_status = "";
  if(isset($_GET['occupation_status']))
  {
    $occupation_status = $_GET['occupation_status'];
    $_SESSION['occupation_status'] = $_GET['occupation_status'];
  }
  else if(isset($_GET['page']))
  {
      $occupation_status = $_SESSION['occupation_status'];
  }
  else
  {
      $_SESSION['occupation_status'] = "all";
      $occupation_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['ocp_id']) && is_array($_POST['ocp_id']))
	{
		$ocp_id_arr = $_POST['ocp_id'];
		$ocp_id_val = "(";
		foreach($ocp_id_arr as $ocp_id)
		{
			$ocp_id_val .=	$ocp_id.",";
		}
		$ocp_id_val = substr($ocp_id_val, 0, -1);
		$ocp_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from occupation where ocp_id in ".$ocp_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update occupation set STATUS='APPROVED' where ocp_id in ".$ocp_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update occupation set STATUS='UNAPPROVED' where ocp_id in ".$ocp_id_val;	
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
<title>Admin | Occupation Management</title>
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
setPageContext("add-new","occupation");
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "occupation-list.php?occupation_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "occupation-list.php?occupation_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "occupation-list.php?occupation_status=all";
      });

     $("#save" ).button().click(function(){
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/add-details/add-occupation.php?action="+$("#update_action").val(),
		      $("#occupation-form").serialize(),
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
     
      $("#add_occupation").click(function (e)
      {
					
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New Occupation");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#occupation_Name").focus();
		$("#occupation_Name").val("");
      });
      
      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
   });
   function edit_occupation(ocp_id,occupation_name,occupation_status)
      {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Occupation");
	 $("#update_action").val("UPDATE"); 
	 $("#ocp_id").val(ocp_id); 
	 $("#occupation_Name").val(occupation_name);
		 		
         if(occupation_status=='APPROVED'){
	    $("#occupation_status1").attr("checked","checked");
	 }else{	
	      $("#occupation_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#occupation_Name").focus();	      
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Deatail</a> / <a href="#" title="Role">Occupation</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="Add New Deatail" id="add_occupation"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Occupation</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Religion List" id="approove" value="Approved (<?php echo getRowCount("select count(ocp_id) from occupation where STATUS='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Religion List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(ocp_id) from occupation where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Religion List"   id="all" value="All (<?php echo getRowCount("select count(ocp_id) from occupation",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Occupation </p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        <span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
        <form action="" method="post" class="form-data" id="occupation-form">
          <p class="cf">
            <label class="popup-label">1. Occupation :</label>
            <input type="text" class="textBox"  name="occupation_name" id="occupation_Name"/>
          </p>
          <p class="cf"> <label class="popup-label">2. Status:</label>
            <input type="radio"  value="APPROVED" name="occupation_visibility_status" id="occupation_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="occupation_visibility_status" id="occupation_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  
          <p class="submit-btn cf">
            <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
            <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>
          </p>
	  <input type="hidden" name="ocp_id" value="" id="ocp_id"/>
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
	    
	    $occupation_count = getRowCount("select count(ocp_id) from occupation".getWhereClauseForStatus($occupation_status),$DatabaseCo);
	    if($occupation_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($occupation_status); ?> Occupation List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["occupation_page_size"])?$_COOKIE["occupation_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM occupation ".getWhereClauseForStatus($occupation_status)." ORDER BY ocp_id DESC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="23%">Occupation ID</th>
              <th width="57%">Occupation Name</th>
            </tr>
            <form method="post" action="occupation-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="ocp_id[]" value="<?php  echo $DatabaseCo->dbRow->ocp_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_occupation" onclick="edit_occupation('<?php  echo $DatabaseCo->dbRow->ocp_id;?>','<?php  echo $DatabaseCo->dbRow->ocp_name;?>','<?php  echo $DatabaseCo->dbRow->status;?>');">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->ocp_id;?></td>
                <td ><?php echo $DatabaseCo->dbRow->ocp_name;?></td>

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(ocp_id) as 'total_rows' from  occupation".getWhereClauseForStatus($occupation_status);		  
	echo getNewPagination('occupation-list.php','occupation_page_size','occupation','ocp_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
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
            <h1>There are no data for <?php echo strtoupper($occupation_status); ?> Occupation. Please add data.</h1>
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
