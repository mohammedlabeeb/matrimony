<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  $search_case = false;
  $caste_status = "";
  if(isset($_GET['caste_status']))
  {
    $caste_status = $_GET['caste_status'];
    $_SESSION['caste_status'] = $_GET['caste_status'];
  }
  else if(isset($_GET['page']))
  {
      $caste_status = $_SESSION['caste_status'];
  }
  else
  {
      $_SESSION['caste_status'] = "all";
      $caste_status = "all";
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
	if(isset($_POST['caste_id']) && is_array($_POST['caste_id']) && $ACTION!='SEARCH')
	{
		$caste_id_arr = $_POST['caste_id'];
		$caste_id_val = "(";
		foreach($caste_id_arr as $caste_id)
		{
			$caste_id_val .=	$caste_id.",";
		}
		$caste_id_val = substr($caste_id_val, 0, -1);
		$caste_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  caste where caste_ID in ".$caste_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  caste set status='APPROVED' where caste_id in ".$caste_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  caste set status='UNAPPROVED' where caste_id in ".$caste_id_val;	
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
<title>Admin | caste management</title>
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

<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->

<script type="text/javascript">
setPageContext("add-new","caste");
function religionList(data){
     $.each(data,function(index,val){
	 // alert(val.religion_id+" "+val.religion_name);
	  
	  $('#religion_id').append($('<option>', { 
	      value: val.religion_id,
	      text : val.religion_name 
	  }));
	  $('#filter_religion_id').append($('<option>', { 
	      value: val.religion_id,
	      text : val.religion_name 
	  }));	  
	  
      });
    
}

var refreshRequired = false;
 $(document).ready(function ()
   {
     $("#approove" ).button().click(function(){
	window.location = "caste-list.php?caste_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "caste-list.php?caste_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "caste-list.php?caste_status=all";
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
		      "./web-services/add-details/add-caste.php?action="+$("#update_action").val(),
		      $("#caste-form").serialize(),
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
     
      $("#add_caste").click(function (e)
      {
		$("#save").val("Save");
	 	$("#dialog_title").text("Add New caste");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#caste_name").focus();
		$("#caste_name").val("");
      });

      $("#btnClose").click(function (e)
      {
         HideDialog();
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
    getreligion();
    //search action
	$("#search_user").click(function(){
	 	
	   	var religion_id = $("#filter_religion_id").val();
	   	
	   	var search_title = "";
	   	var where_clause = "";

   		
   		if(religion_id!="")
		{
   				var religion_name = $("#filter_religion_id option:selected").text();	
				search_title += "  Religion : "+religion_name;
				where_clause += "  religion_id="+religion_id+" ";	
		}
			

			//alert(search_title);
			//alert(where_clause);
			$("#search_title").val(search_title);
			$("#where_clause").val(where_clause);
			$("#search_data").submit();
			
	});


   });
   function edit_caste(caste_id,religion_id,caste_name,caste_status)
   {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update caste");
	 $("#update_action").val("UPDATE"); 
	 $("#religion_id").val(religion_id);
	 $("#caste_id").val(caste_id); 
	 $("#caste_name").val(caste_name);
		 		
         if(caste_status=="APPROVED"){
	    $("#caste_status1").attr("checked","checked");
	 }else{	
	      $("#caste_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#caste_name").focus();	      
   } 
   function ShowDialogImp(modal)
   {
      $("#overlay").show();
      $("#import_caste").fadeIn(300);

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
      $("#import_caste").fadeOut(300);
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
    <div class="breadcum-wide"><a href="#" title="User">Add New Deatail</a> / <a href="#" title="Role"> castes</a></div>	
	<div class="listing-section">
	<?php 
						$SQL_STATEMENT_APP = "";
						$SQL_STATEMENT_UNAPP = "";
						$SQL_STATEMENT_ALL = "";
						
						if($search_case){
						
							$SQL_STATEMENT_APP = "select count(caste_id) from caste_view where STATUS='APPROVED' and ".$where_clause;
							$SQL_STATEMENT_UNAPP =  "select count(caste_id) from caste_view where STATUS='UNAPPROVED' and ".$where_clause;
							$SQL_STATEMENT_ALL = "select count(caste_id) from caste_view where ".$where_clause;							
						}else{
							$SQL_STATEMENT_APP = "select count(caste_id) from caste_view where STATUS='APPROVED'";
							$SQL_STATEMENT_UNAPP = "select count(caste_id) from caste_view where STATUS='UNAPPROVED'";
							$SQL_STATEMENT_ALL = "select count(caste_id) from caste_view";
						}
						
					?>
	  <div class="member-list cf">
	   
           <a href="javascript:;" class="button"  title="Add New User Role" id="add_caste"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Caste</a>
          			
	   <div class="approval alignleft">
	    <input type="button" title="Approved Caste List" id="approove" value="Approved (<?php echo getRowCount($SQL_STATEMENT_APP,$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Caste List"  id="unapproove" value="Unapproved (<?php echo getRowCount($SQL_STATEMENT_UNAPP,$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Caste List"   id="all" value="All (<?php echo getRowCount($SQL_STATEMENT_ALL,$DatabaseCo);?>)"/>
 
	    </div>		              
	  </div>
	</div>
	
	
	<div class="filter-section">
	<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter Castes</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a> <br />
	    	<form action="" method="post" class="form-data" id="search_data">
	    <p class="cf">
		
		<label class="filter-label">Religion:</label>
		<select class="comboBox" id="filter_religion_id" name="filter_religion_id">
		    <option value="">Select Religion</option>
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
							echo "<span style='float:right'><a href='caste-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span>";
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Filter castes'
							class='floor-plan'>Filter castes</span> </a></span>";
						} 
					?>		    
	</div>	
	 
	
	<div id="overlay" class="web_dialog_overlay"></div>
	<div id="dialog" class="web_dialog">
	  <p class="web_dialog_title" id="dialog_title">Add New caste </p>
	  <a href="#" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a>
		<br/>
		<span class="field_marked">All Fields are required.</span>
		<div class='error-msg' id='validationSummary'></div>
		<form action="" method="post" class="form-data" id="caste-form">
			<p class="cf">	
			<label class="popup-label">1. Religion:</label>
			<select name="religion_id" id="religion_id" class="comboBox">
			 <option value="">Select religion</option>
			    
			</select>
			
			</p>
			<p class="cf">	
			<label class="popup-label">2. Caste Name:</label>
			<input type="text" class="textBox" name="caste_name"  id="caste_name" />
			</p>
          <p class="cf"> <label class="popup-label">3. Status:</label>
            <input type="radio"  value="APPROVED" name="caste_visibility_status" id="caste_status1"  />
            <span class="radio-btn-text">Active</span>
            <input type="radio"  value="UNAPPROVED" name="caste_visibility_status" id="caste_status2"  />
            <span class="radio-btn-text">Inactive</span>
	  </p>	  	  			
			
		<p class="submit-btn cf">
		
		      <input type="button" id="save" class="popup-save" value="Save" title="Save"/>
		      <input type="button" id="cancel" class="popup-save" value="Cancel" title="Cancel"/>

		</p>
	  <input type="hidden" name="caste_id" value="" id="caste_id"/>
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
	    if($search_case){
						$where_caste_status = getWhereClauseForStatus($caste_status);
						
						if(empty($where_caste_status))
							$where_caste_status = " where ";
						else 
							$where_caste_status .= " and ";
						$SQL_STATEMENT_COUNT = "select count(caste_id) from caste_view ".$where_caste_status." ".$where_clause;
				}else{
					$SQL_STATEMENT_COUNT = "select count(caste_id) from caste_view ".getWhereClauseForStatus($caste_status);
				}
				$caste_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
	  
	    if($caste_count>0){  
	   ?>
	  <div class="nodata-avail ">
            <h1>
       <?php 
			if($search_case)
				echo strtoupper($caste_status)." Filtered ";
			else
				echo strtoupper($caste_status); 
			
		?> Caste List
            </h1>
       </div>     
		  <div class="cf membership-data">
		    <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
		    <a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	      <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["caste_page_size"])?$_COOKIE["caste_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
	    if($search_case)
		{
				$where_caste_status = getWhereClauseForStatus($caste_status);
				
				if(empty($where_caste_status))
					$where_caste_status = " where ";
				else 
					$where_caste_status .= " and ";
				$SQL_STATEMENT = "SELECT * FROM caste_view ".$where_caste_status."   ".$where_clause." ORDER BY caste_id DESC LIMIT " . $lim_str;
				$SQL_STATEMENT_PAGINATION = "select count(caste_id) as 'total_rows' from  caste_view ".$where_caste_status." ".$where_clause;
		}
		else
		{
			$SQL_STATEMENT =  "SELECT * FROM caste_view ".getWhereClauseForStatus($caste_status)." ORDER BY caste_id DESC  LIMIT ".$lim_str;
			$SQL_STATEMENT_PAGINATION = "select count(caste_id) as 'total_rows' from  caste_view ".getWhereClauseForStatus($caste_status);
		}
		
	      ?>
	  </div>
	    <div class="table-desc cf">
	    
	       <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
		    <tr>
		    <th  width="3%"><input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
		    <th width="10%">Edit</th>
		    <th width="10%">Status</th>
		    <th width="20%">Caste ID</th>
		    <th width="29%">Caste Name</th>
		    <th width="28%">Religion</th>
		    

		</tr>
		<form method="post" action="caste-list.php" id="action_form">
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
		<td><input type="checkbox"  class="table-checkbox" name="caste_id[]" value="<?php  echo $DatabaseCo->dbRow->caste_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="#" title="Edit" id="edit_caste" onclick="edit_caste(<?php  echo $DatabaseCo->dbRow->caste_id;?>,<?php  echo $DatabaseCo->dbRow->religion_id;?>,'<?php  echo $DatabaseCo->dbRow->caste_name;?>','<?php  echo $DatabaseCo->dbRow->status;?>')">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->caste_id;?></td>
                <td ><?php echo $DatabaseCo->dbRow->caste_name;?></td>
				<td ><?php echo $DatabaseCo->dbRow->religion_name;?></td>

		</tr>
		
		<?php
		$rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
	       </table>
		  <?php 	
					  
			echo getNewPagination('caste-list.php','caste_page_size','caste_view','caste_ID',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
		 ?>
	       </div>
	    <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($caste_status); ?> Castes. Please add data.</h1>
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
