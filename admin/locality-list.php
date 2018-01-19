<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
$search_case = false;
  $locality_status = "";
  if(isset($_GET['locality_status']))
  {
    $locality_status = $_GET['locality_status'];
    $_SESSION['locality_status'] = $_GET['locality_status'];
  }
  else if(isset($_GET['page']))
  {
      $locality_status = $_SESSION['locality_status'];
  }
  else
  {
      $_SESSION['locality_status'] = "all";
      $locality_status = "all";
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
	if(isset($_POST['locality_id']))
	{
		$locality_id_arr = $_POST['locality_id'];
		$locality_id_val = "(";
		foreach($locality_id_arr as $locality_id)
		{
			$locality_id_val .=	$locality_id.",";
		}
		$locality_id_val = substr($locality_id_val, 0, -1);
		$locality_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  locality where LOCALITY_ID in ".$locality_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  locality set STATUS='APPROVED' where LOCALITY_ID in ".$locality_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  locality set STATUS='UNAPPROVED' where LOCALITY_ID in ".$locality_id_val;	
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
		
	}else
	{
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
<title>Admin | locality management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />

<link rel="stylesheet" type="text/css" href="css/jquery.loader.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript" src="js/util/location.js"></script>
<script type="text/javascript" src="js/jquery.loader.js"></script>

<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->

<script type="text/javascript">
setPageContext("add-new","locality");
function countryList(data){
    $.each(data,function(index,val){
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
function stateList(data){
    $('#state_id').empty();
    $('#state_id').append($('<option>', { 
			      value: "",
			      text : "Select State" 
			  }));	      
    $.each(data,function(index,val){
			  $('#state_id').append($('<option>', { 
			      value: val.state_id,
			      text : val.state_name 
			  }));
	  
    });
    if(data.length==0)
      $("#state_loader").html("<b>No states in this country.</b>");
    else
      $("#state_loader").html("<b>States  are loaded.</b>");
		
    $("#state_loader").fadeOut(2000);
}
function stateListFilter(data){
    $('#filter_state_id').empty();
    $('#filter_state_id').append($('<option>', { 
			      value: "",
			      text : "Select State" 
			  }));	  
    $.each(data,function(index,val){
			  $('#filter_state_id').append($('<option>', { 
			      value: val.state_id,
			      text : val.state_name 
			  }));	  
    });
    
}
function cityList(data){
    $('#city_id').empty();
    $('#city_id').append($('<option>', { 
			      value: "",
			      text : "Select City" 
			  }));	      
    $.each(data,function(index,val){
			  $('#city_id').append($('<option>', { 
			      value: val.city_id,
			      text : val.city_name 
			  }));
	  
    });
      if(data.length==0)
	$("#city_loader").html("<b>No cities in this state.</b>");
      else
	$("#city_loader").html("<b>Cities are loaded.</b>");
       $("#city_loader").fadeOut(2000);  
}
function cityListFilter(data){
    $('#filter_city_id').empty();
    $('#filter_city_id').append($('<option>', { 
			      value: "",
			      text : "Select City" 
			  }));	  
    $.each(data,function(index,val){
			  $('#filter_city_id').append($('<option>', { 
			      value: val.city_id,
			      text : val.city_name 
			  }));	  
    });
    
}
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "locality-list.php?locality_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "locality-list.php?locality_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "locality-list.php?locality_status=all";
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
				      "./web-services/location/add-locality.php?action="+$("#update_action").val(),
				      $("#locality-form").serialize(),
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
     
      $("#add_locality").click(function (e)
      {
	    $("#save").val("Save");
	    $("#dialog_title").text("Add New Locality");
	    $("#update_action").val("ADD"); 
	    ShowDialog(true);
	    e.preventDefault();
	    $("#validationSummary").hide();
	    $("#locality_name").focus();
	    $("#locality_name").val("");
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

     getCountries();
     $("#country_id").change(function(){
     			var country_id = $(this).val();
     			
     	   	$("#state_loader").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#state_loader").show();
     			$('#state_id').empty();
     			
     			getStateList(country_id);
     			
     	});
     $("#filter_country_id").change(function(){
     			var country_id = $(this).val();
     			$('#filter_state_id').empty();
     			getStateListFilter(country_id);
     			
     	});
     $("#state_id").change(function(){
     			var state_id = $(this).val();
     			
     	   	$("#city_loader").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#city_loader").show();
     			$('#city_id').empty();
     			
     			getCityList(state_id);
     			
     	});
     $("#filter_state_id").change(function(){
     			var state_id = $(this).val();
     			$('#filter_city_id').empty();
     			getCityListFilter(state_id);
     			
     	});     	     
      
     $("#btnClose_filter").click(function(){
			HideDialogFilter();
		});
	$("#cancelFilter").click(function(){
		HideDialogFilter();
	});
	$("#search_user").click(function(){
	 	
	   	var country_id = $("#filter_country_id").val();
	   	var state_id = $("#filter_state_id").val();
	   	var city_id = $("#filter_city_id").val();
	   	var search_title = "";
	   	var where_clause = "";

		
		if(country_id!=""){
				var country_name = $("#filter_country_id option:selected").text();	
				search_title += "  Country : "+country_name;
				where_clause += "  COUNTRY_ID="+country_id+" ";
				if(state_id!=""){
	   				var state_name = $("#filter_state_id option:selected").text();	
					search_title += " | State : "+state_name;
					where_clause += "  and STATE_ID="+state_id+" ";	
					if(city_id!=""){
		   				var city_name = $("#filter_city_id option:selected").text();	
						search_title += " | City : "+city_name;
						where_clause += "  and CITY_ID="+city_id+" ";	
						
					}			
					
				}			
		}
			

			//alert(search_title);
			//alert(where_clause);
			$("#search_title").val(search_title);
			$("#where_clause").val(where_clause);
			$("#search_data").submit();
			
	});
   });
   function edit_locality(locality_id,city_id,state_id,country_id,locality_name,locality_status)
   {
	$.loader({className:"blue-with-image",content:""});
	getStateList(country_id);
	getCityList(state_id);
		$.loader('close');
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Locality");
	 $("#update_action").val("UPDATE"); 
	 $("#locality_id").val(locality_id);
	 $("#city_id").val(city_id);
	 $("#state_id").val(state_id); 
	 $("#country_id").val(country_id); 
	 $("#locality_name").val(locality_name);
		 		
	    if(locality_status=='APPROVED'){
		    $("#locality_status1").attr("checked","checked");
		 }else{	
		      $("#locality_status2").attr("checked","checked");
		 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#locality_name").focus();	      
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
      <div class="breadcum-wide"><a href="#" title="User">Location</a> / <a href="#" title="Role"> Localities</a></div>
      <div class="listing-section">
      <?php 
						$SQL_STATEMENT_APP = "";
						$SQL_STATEMENT_UNAPP = "";
						$SQL_STATEMENT_ALL = "";
						
						if($search_case){
						
							$SQL_STATEMENT_APP = "select count(LOCALITY_ID) from locality where STATUS='APPROVED' and ".$where_clause;
							$SQL_STATEMENT_UNAPP =  "select count(LOCALITY_ID) from locality where STATUS='UNAPPROVED' and ".$where_clause;
							$SQL_STATEMENT_ALL = "select count(LOCALITY_ID) from locality  where ".$where_clause;							
						}else{
							$SQL_STATEMENT_APP = "select count(LOCALITY_ID) from locality where STATUS='APPROVED'";
							$SQL_STATEMENT_UNAPP = "select count(LOCALITY_ID) from locality where STATUS='UNAPPROVED'";
							$SQL_STATEMENT_ALL = "select count(LOCALITY_ID) from locality ";
						}
						
					?>
        <div class="member-list cf">
          <a href="javascript:;" class="button"  title="Add New User Role" id="add_locality"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Locality</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Locality List" id="approove" value="Approved (<?php echo getRowCount($SQL_STATEMENT_APP,$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Locality List"  id="unapproove" value="Unapproved (<?php echo getRowCount($SQL_STATEMENT_UNAPP,$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Locality List"   id="all" value="All (<?php echo getRowCount($SQL_STATEMENT_ALL,$DatabaseCo);?>)"/>
          </div>
        </div>
      </div>
      <div class="filter-section">
	<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter Cities</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a> <br />
	    	<form action="" method="post" class="form-data" id="search_data">
	    <p class="cf">
		
		<label class="filter-label">Country:</label>
		<select class="comboBox" id="filter_country_id" name="filter_country_id">
		    <option value="">Select Country</option>
	        </select>
	     </p>   
	     	    <p class="cf">
		
		<label class="filter-label">State:</label>
		<select class="comboBox" id="filter_state_id" name="filter_state_id">
		    <option value="">Select State</option>
	        </select>
	     </p> 
	     <p class="cf">
		
		<label class="filter-label">City:</label>
		<select class="comboBox" id="filter_city_id" name="filter_city_id">
		    <option value="">Select City</option>
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
							echo "<span style='float:right'><a href='locality-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span>";
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Filter states'
							class='floor-plan'>Filter Localities</span> </a></span>";
						} 
					?>		    
	</div>
      
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Locality </p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
         <span class="field_marked">All Fields are required.</span>
		 <div class='error-msg' id='validationSummary'></div>
	 <form action="" method="post" class="form-data" id="locality-form">
	  <p class="cf">
            <label class="popup-label">1. Country:</label>
            <select name="country_id" class="comboBox" id="country_id">
              <option value="">Select Country</option>
            </select>
            </p>
          <p class="cf">
            <label class="popup-label">2. State:</label>
            <select name="state_id" class="comboBox" id="state_id">
              <option value="">Select State</option>
            </select>
	    <span id="state_loader"></span>	    
            </p>
          <p class="cf">
            <label class="popup-label">3. City:</label>
            <select name="city_id" class="comboBox" id="city_id">
              <option value="">Select City</option>
            </select>
	    <span id="city_loader"></span>
	  </p>
          <p class="cf">
            <label class="popup-label">4. Locality Name:</label>
            <input type="text" class="textBox" name="locality_name" id="locality_name"/>
          </p>
          <p class="cf"> <label class="popup-label">5. Status:</label>
            <input type="radio"  value="APPROVED" name="locality_visibility_status" id="locality_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="locality_visibility_status" id="locality_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  			          	  
          <p class="submit-btn cf">
            
            <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
            <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>
          </p>
	  <input type="hidden" name="locality_id" value="" id="locality_id"/>
	  <input type="hidden" name="action" value="" id="update_action"/>          	  
        </form>
      </div>
      <div id="import_state" class="web_dialog">
        <p class="web_dialog_title">Import Localities </p>
        <a href="#" id="btnCloseImp" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
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
	  <label class="popup-label">2. State:</label>
	  <select name="country" class="comboBox">
	    <option value="">Select State</option>
	    <option value="">India</option>
	    <option value="">US</option>
	  </select>
	  </p>
	  <p class="cf">	
	  <label class="popup-label">3. City:</label>
	  <select name="country" class="comboBox">
	    <option value="">Select Locality</option>
	    <option value="">India</option>
	    <option value="">US</option>
	  </select>
	  </p>          	  

          <p class="cf">
            <label class="popup-label">3. Localities File:</label>
            <input type="file" class="textBox" />
          </p>
          <p class="submit-btn cf">
            <input type="button" id="saveImp" class="popup-save"  value="Import" title="Save"/>
            <input type="button" id="cancelImp"  class="popup-save" value="Cancel" title="Cancel"/>
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
					$where_city_status = getWhereClauseForStatus($locality_status);
					
					if(empty($where_city_status))
						$where_city_status = " where ";
					else 
						$where_city_status .= " and ";
					$SQL_STATEMENT_COUNT = "select count(LOCALITY_ID) from locality ".$where_city_status." ".$where_clause;
			}else{
				$SQL_STATEMENT_COUNT = "select count(LOCALITY_ID) from locality ".getWhereClauseForStatus($locality_status);
			}
			$locality_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
    
	    if($locality_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1>
            <?php 
			if($search_case)
				echo strtoupper($locality_status)." Filtered ";
			else
				echo strtoupper($locality_status);
			
			?> Locality List
            </h1>
          </div>   
        <div class="cf membership-data">
         <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>                    
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["locality_page_size"])?$_COOKIE["locality_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
	     if($search_case){
				$where_city_status = getWhereClauseForStatus($locality_status);
				
				if(empty($where_city_status))
					$where_city_status = " where ";
				else 
					$where_city_status .= " and ";
				$SQL_STATEMENT = "SELECT * FROM locality_view ".$where_city_status."   ".$where_clause." ORDER BY LOCALITY_ID DESC LIMIT " . $lim_str;
				$SQL_STATEMENT_PAGINATION = "select count(LOCALITY_ID) as 'total_rows' from  locality_view ".$where_city_status." ".$where_clause;
		}else{
				$SQL_STATEMENT =  "SELECT * FROM locality_view ".getWhereClauseForStatus($locality_status)." ORDER BY LOCALITY_ID DESC LIMIT ".$lim_str;
			$SQL_STATEMENT_PAGINATION = "select count(LOCALITY_ID) as 'total_rows' from  locality_view".getWhereClauseForStatus($locality_status);
		}
		
		
		
		
?>
    
</div>
        <div class="table-desc cf">
          <a href="javascript:;"  class="alignleft delete-btn" id="importStates" title="Approved" > Import Localities</a>
          <a href="javascript:;"  class="alignleft delete-btn" title="Approved" >Export Localities</a>
          <br/>
          <br/>
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="7%"> Status</th>
              <th width="10%">Locality ID</th>
              <th width="16%">Locality Name</th>
              <th width="20%">City</th>
              <th width="20%">State</th>
              <th width="17%">Country</th>
            </tr>
            <form method="post" action="locality-list.php" id="action_form">
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
              
            <td><input type="checkbox"  class="table-checkbox" name="locality_id[]" value="<?php  echo $DatabaseCo->dbRow->LOCALITY_ID;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" onclick="edit_locality(<?php  echo $DatabaseCo->dbRow->LOCALITY_ID;?>,<?php  echo $DatabaseCo->dbRow->CITY_ID;?>,<?php  echo $DatabaseCo->dbRow->STATE_ID;?>,<?php  echo $DatabaseCo->dbRow->COUNTRY_ID;?>,'<?php  echo $DatabaseCo->dbRow->LOCALITY_NAME;?>','<?php  echo $DatabaseCo->dbRow->STATUS;?>');" > Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->STATUS=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->LOCALITY_ID;?></td>
                <td ><?php echo $DatabaseCo->dbRow->LOCALITY_NAME;?></td>
                <td ><?php echo $DatabaseCo->dbRow->CITY_NAME;?></td>
                <td ><?php echo $DatabaseCo->dbRow->STATE_NAME;?></td>
                <td ><?php echo $DatabaseCo->dbRow->COUNTRY_NAME;?></td>

            </tr>
      <?php
	$rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
          </table>
      <?php
			  
	echo getNewPagination('locality-list.php','locality_page_size','locality','LOCALITY_ID',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($locality_status); ?> Locality. Please add data.</h1>
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
      </div>
  <!-- end content --> 
</div>
</body>
</html>
