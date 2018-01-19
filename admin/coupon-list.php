<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  $search_case = false;
  $coupon_status = "";
  if(isset($_GET['coupon_status']))
  {
    $coupon_status = $_GET['coupon_status'];
    $_SESSION['coupon_status'] = $_GET['coupon_status'];
  }
  else if(isset($_GET['page']))
  {
      $coupon_status = $_SESSION['coupon_status'];
  }
  else
  {
      $_SESSION['coupon_status'] = "all";
      $coupon_status = "all";
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
	if(isset($_POST['coupon_id']) && $ACTION!="SEARCH" )
	{
		$coupon_id_arr = $_POST['coupon_id'];
		$coupon_id_val = "(";
		foreach($coupon_id_arr as $coupon_id)
		{
			$coupon_id_val .=	$coupon_id.",";
		}
		$coupon_id_val = substr($coupon_id_val, 0, -1);
		$coupon_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  coupon where COUPON_ID in ".$coupon_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  coupon set STATUS='APPROVED' where COUPON_ID in ".$coupon_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  coupon set STATUS='UNAPPROVED' where COUPON_ID in ".$coupon_id_val;	
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
		
	}
	else
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
<title>Admin | coupon list</title>
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
setPageContext("coupon","coupon-mgmt");
 $(document).ready(function ()
   {
     $("#approove" ).button().click(function(){
	window.location = "coupon-list.php?coupon_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "coupon-list.php?coupon_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "coupon-list.php?coupon_status=all";
      });
    $("#btnClose_filter").click(function(){
		HideDialogFilter();
	});
	$("#cancelFilter").click(function(){
		HideDialogFilter();
	});

	//search action
	$("#search_user").click(function(){
	 	
	   	var coupon_id = $("#coupon_id").val();

	   	var discount = $("#discount").val();
	   	
	   	
	   	var search_title = "";
	   	var where_clause = "";
	
			
		if(coupon_id!=""){
			search_title += "  Coupon Id : "+coupon_id;
			where_clause += "  	COUPON_ID="+coupon_id+" ";	
		}
		
		if(discount!=""){
			search_title += "  Discount : "+discount;
			if(where_clause.length>0){
				where_clause += " and PERCENTAGE_DISCOUNT="+discount+" ";	
			}else{
				where_clause += " PERCENTAGE_DISCOUNT="+discount+" ";
			}
		}	
		//alert(search_title);
		//alert(where_clause);
		if(where_clause.length>0){
			$("#search_title").val(search_title);
			$("#where_clause").val(where_clause);
			$("#search_data").submit();
		}
			
	});
	
   });
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
      <div class="breadcum-wide"><a href="#" title="User">Coupon Management</a> / <a href="#" title="Role"> Coupon List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="List All Coupon"  onclick="window.location='coupon-list.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All Coupon</a>
          <a href="javascript:;" class="button" title="Add New Coupon"  onclick="window.location='add-coupon.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Coupon</a>
           <?php 
						$SQL_STATEMENT_APP = "";
						$SQL_STATEMENT_UNAPP = "";
						$SQL_STATEMENT_ALL = "";
						
						if($search_case){
						
							$SQL_STATEMENT_APP = "select count(COUPON_ID) from coupon where STATUS='APPROVED' and ".$where_clause;
							$SQL_STATEMENT_UNAPP =  "select count(COUPON_ID) from coupon where STATUS='UNAPPROVED' and ".$where_clause;
							$SQL_STATEMENT_ALL = "select count(COUPON_ID) from coupon where ".$where_clause;							
						}else{
							$SQL_STATEMENT_APP = "select count(COUPON_ID) from coupon where STATUS='APPROVED'";
							$SQL_STATEMENT_UNAPP = "select count(COUPON_ID) from coupon where STATUS='UNAPPROVED'";
							$SQL_STATEMENT_ALL = "select count(COUPON_ID) from coupon ";
						}
						
					?>
          <div class="approval alignleft">
            <input type="button" title="Approved Coupon List"  id="approove" value="Approved (<?php echo getRowCount($SQL_STATEMENT_APP,$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Coupon List"  id="unapproove" value="Unapproved (<?php echo getRowCount($SQL_STATEMENT_UNAPP,$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Coupon List"  id="all" value="All (<?php echo getRowCount($SQL_STATEMENT_ALL,$DatabaseCo);?>)"/>	    
          </div>
        </div>
      </div>
      <div class="filter-section">
	<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter States</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a> 
	    	<form action="" method="post" class="form-data" id="search_data">
	    <p class="cf">
		<label class="filter-label">Coupon Id:</label>
			<input type="text" name="coupon_id" id="coupon_id" />
	     </p>   
	     	      
	     	    <p class="cf">
		<label class="filter-label">Discount:</label>
			<input type="text" name="discount" id="discount" />
			
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
							echo "<span style='float:right'><a href='coupon-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span>";
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Filter states'
							class='floor-plan'>Filter States</span> </a></span>";
						} 
					?>		    
	</div>	
	 
	
	<div id="overlay" class="web_dialog_overlay"></div>
	
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
        	$where_state_status = getWhereClauseForStatus($coupon_status);
        
        	if(empty($where_state_status))
        		$where_state_status = " where ";
        	else
        		$where_state_status .= " and ";
        	$SQL_STATEMENT_COUNT = "select count(COUPON_ID) from coupon ".$where_state_status." ".$where_clause;
        }else{
        	$SQL_STATEMENT_COUNT = "select count(COUPON_ID) from coupon".getWhereClauseForStatus($coupon_status);
        }
        
        $coupon_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
	    
	    if($coupon_count>0){  
	   ?>
	  <div class="nodata-avail ">
            <h1>
             <?php 
			if($search_case)
				echo strtoupper($coupon_status)." Filtered ";
			else
				echo strtoupper($coupon_status); 
			
		?>Coupon List
            </h1>
          </div>   	
        <div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["coupon_page_size"])?$_COOKIE["coupon_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		if($search_case){
			$where_state_status = getWhereClauseForStatus($coupon_status);
		
			if(empty($where_state_status))
				$where_state_status = " where ";
			else
				$where_state_status .= " and ";
			$SQL_STATEMENT = "SELECT * FROM coupon ".$where_state_status."   ".$where_clause." ORDER BY COUPON_ID DESC LIMIT " . $lim_str;
			$SQL_STATEMENT_PAGINATION = "select count(COUPON_ID) as 'total_rows' from  coupon ".$where_state_status." ".$where_clause;
		}else{
			$SQL_STATEMENT =  "SELECT * FROM coupon ".getWhereClauseForStatus($coupon_status)." ORDER By COUPON_ID DESC  LIMIT ".$lim_str;
			$SQL_STATEMENT_PAGINATION = "select count(COUPON_ID) as 'total_rows' from  coupon".getWhereClauseForStatus($coupon_status);
		}
		
		
		
	  ?>

        </div>
        <div class="table-desc cf">
	  <a href="javascript:;"  class="alignleft delete-btn" title="Approved" > Sens SMS</a>
	  <a href="javascript:;"  class="alignleft delete-btn" title="Approved" >Send Email</a>
	  <br/><br/>
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%"> Status</th>
              <th width="10%">Coupon ID</th>
              <th width="17%">From Date</th>
              <th width="18%">To Date</th>
              <th width="10%">Discount</th>
              <th width="25%">Coupon Code</th>
            </tr>
            <form method="post" action="coupon-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="coupon_id[]" value="<?php  echo $DatabaseCo->dbRow->COUPON_ID;?>" /></td>
                <td><a class="edit-btn margin-none" href="add-coupon.php?action=UPDATE&coupon_id=<?php echo $DatabaseCo->dbRow->COUPON_ID;?>" title="Edit">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->STATUS=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->COUPON_ID;?></td>
              <td><?php
              $from = new DateTime($DatabaseCo->dbRow->FROM_DATE);
              echo $from->format('d-m-Y');
              
              ?></td>
              <td><?php
              $to = new DateTime($DatabaseCo->dbRow->TO_DATE);
              echo $to->format('d-m-Y');
              
              ?></td>
              <td ><?php echo $DatabaseCo->dbRow->PERCENTAGE_DISCOUNT;?>%</td>
              <td><?php echo $DatabaseCo->dbRow->COUPON_CODE;?></td>
            </tr>
	  <?php
		$rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
          </table>
          <?php 	
				  
	echo getNewPagination('coupon-list.php','coupon_page_size','coupon','COUPON_ID',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($coupon_status); ?> Coupon. Please add data.</h1>
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
