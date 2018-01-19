<?php
  error_reporting(0);
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  $search_case = false;
  $state_status = "";
  if(isset($_GET['state_status']))
  {
    $state_status = $_GET['state_status'];
    $_SESSION['state_status'] = $_GET['state_status'];
  }
  else if(isset($_GET['page']))
  {
      $state_status = $_SESSION['state_status'];
  }
  else
  {
      $_SESSION['state_status'] = "all";
      $state_status = "all";
  }
  if(isset($_GET['option']) && $_GET['option']=='clear_search')
{
	unset($_SESSION['search_title']);
	unset($_SESSION['where_clause']);
	unset($_SESSION['search_action']);
	$search_case = false;
}
  $search_title = "";
  $where_clause = "";
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['state_id']) && is_array($_POST['state_id']) && $ACTION!='SEARCH')
	{
		$state_id_arr = $_POST['state_id'];
		$state_id_val = "(";
		foreach($state_id_arr as $state_id)
		{
			$state_id_val .=	$state_id.",";
		}
		$state_id_val = substr($state_id_val, 0, -1);
		$state_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  state where state_id in ".$state_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  state set status='APPROVED' where state_id in ".$state_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  state set status='UNAPPROVED' where state_id in ".$state_id_val;	
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $STATUS_MESSAGE = $statusObj->getStatusMessage();
	}else if($ACTION=='SEARCH'){
		$search_case = true;
		$search_title = isset($_POST['search_title'])?$_POST['search_title']:"";
		$where_clause = isset($_POST['where_clause'])?$_POST['where_clause']:"";
		$_SESSION['search_title'] = $search_title;
		$_SESSION['where_clause'] = $where_clause;
		$_SESSION['search_action'] = 'SEARCH';
		
	}else{
	  $statusObj = new Status();
	  $statusObj->setActionSuccess(false);
	  $STATUS_MESSAGE = "Please select value to complete action.";	  
	}
 }
  if(isset($_SESSION['search_action']) && $_SESSION['search_action']=='SEARCH')
{
	$search_case = true;
	$search_title = $_SESSION['search_title'];
    $where_clause = $_SESSION['where_clause'];
}  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | State management</title>
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
<script type="text/javascript" src="js/util/location.js"></script>
<script type="text/javascript">
setPageContext("add-new","state");

function countryList(data)
{
	
     $.each(data,function(index,val){
	 // alert(val.country_id+" "+val.country_name);
	  
	  $('#country_id').append($('<option>', { 
	      value: val.country_id,
	      text : val.country_name 
	  }));
	  $('#filter_country_id').append($('<option>', { 
	      value: val.country_id,
	      text : val.country_name 
	  }));	  
	  
      });
    
}

var refreshRequired = false;
 $(document).ready(function ()
   {
     $("#approove" ).button().click(function(){
	window.location = "state-list.php?state_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "state-list.php?state_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "state-list.php?state_status=all";
      });
     $("#saveImp" ).button();
     $("#cancelImp" ).button().click(function(e){
	 HideDialogImp();
         e.preventDefault();
	});

     $("#save" ).button().click(function(){
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/location/add-state.php?action="+$("#update_action").val(),
		      $("#state-form").serialize(),
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
     
      $("#add_state").click(function (e)
      {
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New State");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#state_name").focus();
		$("#state_name").val("");
      });

      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
      $("#importStates").click(function (e)
      {
         ShowDialogImp(true);
         e.preventDefault();
      });

      $("#btnCloseImp").click(function (e)
      {
         HideDialogImp();
         e.preventDefault();
      });
      $("#btnClose_filter").click(function(){
			HideDialogFilter();
		});
	$("#cancelFilter").click(function(){
		HideDialogFilter();
	});
	
    getCountries();
    //search action
	$("#search_user").click(function(){
	 	
	   	var country_id = $("#filter_country_id").val();
	   	
	   	var search_title = "";
	   	var where_clause = "";

   		
   		if(country_id!=""){
   				var country_name = $("#filter_country_id option:selected").text();	
				search_title += "  Country : "+country_name;
				where_clause += "  country_id="+country_id+" ";	
		}
			

			//alert(search_title);
			//alert(where_clause);
			$("#search_title").val(search_title);
			$("#where_clause").val(where_clause);
			$("#search_data").submit();
			
	});


   });
   function edit_state(state_id,country_id,state_name,state_status)
   {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update State");
	 $("#update_action").val("UPDATE"); 
	 $("#country_id").val(country_id);
	 $("#state_id").val(state_id); 
	 $("#state_name").val(state_name);
		 		
         if(state_status=="APPROVED"){
	    $("#state_status1").attr("checked","checked");
	 }else{	
	      $("#state_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#state_name").focus();	      
   } 
   function ShowDialogImp(modal)
   {
      $("#overlay").show();
      $("#import_state").fadeIn(300);

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

   function HideDialogImp()
   {
      $("#overlay").hide();
      $("#import_state").fadeOut(300);
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
   function ShowDialogFilter(modal)
   {
      $("#overlay").show();
      $("#adv_search").fadeIn(300);
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

   function HideDialogFilter()
   {
      $("#overlay").hide();
      $("#adv_search").fadeOut(300);

   } 
   function showAdvanceSearch(){
	   ShowDialogFilter(true);
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
    <div class="breadcum-wide"><a href="#" title="User">Location</a> / <a href="#" title="Role"> States</a></div>	
	<div class="listing-section">
	<?php 
						$SQL_STATEMENT_APP = "";
						$SQL_STATEMENT_UNAPP = "";
						$SQL_STATEMENT_ALL = "";
						
						if($search_case){
						
							$SQL_STATEMENT_APP = "select count(state_id) from state where status='APPROVED' and ".$where_clause;
							$SQL_STATEMENT_UNAPP =  "select count(state_id) from state where status='UNAPPROVED' and ".$where_clause;
							$SQL_STATEMENT_ALL = "select count(state_id) from state where ".$where_clause;							
						}else{
							$SQL_STATEMENT_APP = "select count(state_id) from state where status='APPROVED'";
							$SQL_STATEMENT_UNAPP = "select count(state_id) from state where status='UNAPPROVED'";
							$SQL_STATEMENT_ALL = "select count(state_id) from state ";
						}
						
					?>
	  <div class="member-list cf">
	   
           <a href="javascript:;" class="button"  title="Add New User Role" id="add_state"><img src="img/bgi/add-icon.png" alt="Add"/>Add New State</a>
          			
	   <div class="approval alignleft">
	    <input type="button" title="Approved State List" id="approove" value="Approved (<?php echo getRowCount($SQL_STATEMENT_APP,$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved State List"  id="unapproove" value="Unapproved (<?php echo getRowCount($SQL_STATEMENT_UNAPP,$DatabaseCo);?>)"/>
            =
            <input type="button" title="All State List"   id="all" value="All (<?php echo getRowCount($SQL_STATEMENT_ALL,$DatabaseCo);?>)"/>
 
	    </div>		              
	  </div>
	</div>
	
	
	<div class="filter-section">
	<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter States</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a> <br />
	    	<form action="" method="post" class="form-data" id="search_data">
	    <p class="cf">
		
		<label class="filter-label">Country:</label>
		<select class="comboBox" id="filter_country_id" name="filter_country_id">
		    <option value="">Select Country</option>
	        </select>
	     </p>   
	     <p class="submit-btn cf">

								<input type="button" id="search_user" class="popup-save" value="Search"
									title="Search"  /> 
									<input type="button" id="cancelFilter"
									class="popup-save" value="Cancel" title="Cancel" />
							</p>
	     <input type="hidden" name="search_title"  id="search_title" value="" />
		<input type="hidden" name="where_clause"  id="where_clause" value="" />
		<input type="hidden" name="action"  id="filter_action" value="SEARCH" />
	     </form>  
		   
	    </div>
			<?php
						if($search_case){
							echo "<strong>Search String:</strong> ".$search_title;
							echo "<span style='float:right'><a href='state-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span>";
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Filter states'
							class='floor-plan'>Filter States</span> </a></span>";
						} 
					?>		    
	</div>	
	 
	
	<div id="overlay" class="web_dialog_overlay"></div>
	<div id="dialog" class="web_dialog">
	  <p class="web_dialog_title" id="dialog_title">Add New State </p>
	  <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a>
		<br/>
		<span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
		<form action="" method="post" class="form-data" id="state-form">
			<p class="cf">	
			<label class="popup-label">1. Country:</label>
			<select name="country_id" id="country_id" class="comboBox">
			 <option value="">Select Country</option>
			    
			</select>
			
			</p>
			<p class="cf">	
			<label class="popup-label">2. State Name:</label>
			<input type="text" class="textBox" name="state_name"  id="state_name" />
			</p>
          <p class="cf"> <label class="popup-label">3. Status:</label>
            <input type="radio"  value="APPROVED" name="state_visibility_status" id="state_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="state_visibility_status" id="state_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  			
			
		<p class="submit-btn cf">
		
		      <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
		      <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>

		</p>
	  <input type="hidden" name="state_id" value="" id="state_id"/>
	  <input type="hidden" name="action" value="" id="update_action"/>
		
		</form>	
	</div>
	<div id="import_state" class="web_dialog">
	  <p class="web_dialog_title">Import States </p>
	  <a href="#" id="btnCloseImp" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a>
		<br/>
		<form action="" method="" class="form-data">
			<p class="cf">	
			<label class="popup-label">1. Country:</label>
			<select name="country" class="comboBox">
			  <option value="">Select Country</option>
			  <option value="">India</option>
			  <option value="">US</option>
			</select>
			</p>

			<p class="cf">	
			<label class="popup-label">2. States FIle:</label>
			<input type="file" class="textBox" />
			</p>
			
		<p class="submit-btn cf">
		
		
		      <input type="button" id="saveImp" class="popup-save" value="Import" title="Save"/>
		      <input type="button" id="cancelImp" class="popup-save"  value="Cancel" title="Cancel"/>
		</p>	
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
	    if($search_case){
						$where_state_status = getWhereClauseForStatus($state_status);
						
						if(empty($where_state_status))
							$where_state_status = " where ";
						else 
							$where_state_status .= " and ";
						$SQL_STATEMENT_COUNT = "select count(state_id) from state ".$where_state_status." ".$where_clause;
				}else{
					$SQL_STATEMENT_COUNT = "select count(state_id) from state ".getWhereClauseForStatus($state_status);
				}
				$state_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
	  
	    if($state_count>0){  
	   ?>
	  <div class="nodata-avail ">
            <h1>
       <?php 
			if($search_case)
				echo strtoupper($state_status)." Filtered ";
			else
				echo strtoupper($state_status); 
			
		?> State List
            </h1>
       </div>     
		  <div class="cf membership-data">
		    <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	      <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["state_page_size"])?$_COOKIE["state_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
	    if($search_case){
				$where_state_status = getWhereClauseForStatus($state_status);
				
				if(empty($where_state_status))
					$where_state_status = " where ";
				else 
					$where_state_status .= " and ";
				$SQL_STATEMENT = "SELECT * FROM state_view ".$where_state_status."   ".$where_clause." ORDER BY state_id DESC LIMIT " . $lim_str;
				$SQL_STATEMENT_PAGINATION = "select count(state_id) as 'total_rows' from  state_view ".$where_state_status." ".$where_clause;
		}else{
			$SQL_STATEMENT =  "SELECT * FROM state_view ".getWhereClauseForStatus($state_status)." ORDER BY state_id DESC  LIMIT ".$lim_str;
			$SQL_STATEMENT_PAGINATION = "select count(state_id) as 'total_rows' from  state_view ".getWhereClauseForStatus($state_status);
		}
		
	      ?>
	  </div>
	    <div class="table-desc cf">
	     
	       <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
		    <tr>
		    <th  width="3%"><input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
		    <th width="10%">Edit</th>
		    <th width="10%"> Status</th>
		    <th width="20%">State ID</th>
		    <th width="29%">State Name</th>
		    <th width="28%">Country</th>
		    

		</tr>
		<form method="post" action="state-list.php" id="action_form">
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
		<td><input type="checkbox"  class="table-checkbox" name="state_id[]" value="<?php  echo $DatabaseCo->dbRow->state_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_state" onclick="edit_state(<?php  echo $DatabaseCo->dbRow->state_id;?>,<?php  echo $DatabaseCo->dbRow->country_id;?>,'<?php  echo $DatabaseCo->dbRow->state_name;?>','<?php  echo $DatabaseCo->dbRow->status;?>')">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->state_id;?></td>
                <td ><?php echo $DatabaseCo->dbRow->state_name;?></td>
		<td ><?php echo $DatabaseCo->dbRow->country_name;?></td>

		</tr>
		
		<?php
		$rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
	       </table>
		  <?php 	
					  
			echo getNewPagination('state-list.php','state_page_size','state','state_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
		 ?>
	       </div>
	    <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($state_status); ?> States. Please add data.</h1>
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
