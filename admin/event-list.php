<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $event_status = "";
  if(isset($_GET['event_status']))
  {
    $event_status = $_GET['event_status'];
    $_SESSION['event_status'] = $_GET['event_status'];
  }
  else if(isset($_GET['page']))
  {
      $event_status = $_SESSION['event_status'];
  }
  else
  {
      $_SESSION['event_status'] = "all";
      $event_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['id']) && is_array($_POST['id']))
	{
		$id_arr = $_POST['id'];
		$id_val = "(";
		foreach($id_arr as $id)
		{
			$id_val .=	$id.",";
		}
		$id_val = substr($id_val, 0, -1);
		$id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from events where id in ".$id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update events set STATUS='APPROVED' where id in ".$id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update events set STATUS='UNAPPROVED' where id in ".$id_val;	
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
<title>Admin | Event Management</title>
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


<script type="text/javascript">
setPageContext("add-new","events");
$(document).ready(function ()
   {
       $("#approove" ).button().click(function(){
	window.location = "event-list.php?event_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "event-list.php?event_status=unapproved";
      });
	 
    $("#all" ).button().click(function(){
	window.location = "event-list.php?event_status=all";
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Detail</a> / <a href="#" title="Role">Event</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="add-event.php" class="button" title="Add New Deatail" id="add_events"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Event</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Religion List" id="approove" value="Approved (<?php echo getRowCount("select count(id) from events where STATUS='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Religion List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(id) from events where STATUS='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Religion List"   id="all" value="All (<?php echo getRowCount("select count(id) from events",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Event </p>
        <a href="add-event.php" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        
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
     <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>      
      <div class="widecolumn-inner memership-detail">
    <?php
	    
	    $events_count = getRowCount("select count(id) from events".getWhereClauseForStatus($event_status),$DatabaseCo);
	    if($events_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($event_status); ?> Event List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["events_page_size"])?$_COOKIE["events_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM events ".getWhereClauseForStatus($event_status)." ORDER BY id DESC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="3%">Edit</th>
              <th width="8%">Status</th>
              <th width="15%">Name</th>
              <th width="10%">Date & Time</th>
              <th width="17%">Venue</th>
              <th width="11%">Image</th>
              <th width="7%">Ticket</th>
              <th width="18%">Description</th>
              <th width="20%">Limited</th>
             
            </tr>
            <form method="post" action="event-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="id[]" value="<?php  echo $DatabaseCo->dbRow->id;?>" /></td>
                <td><a class="edit-btn margin-none" href="add-event.php?id=<?php  echo $DatabaseCo->dbRow->id;?>" title="Edit" id="edit_events">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->name;?></td>
                <td ><?php echo $DatabaseCo->dbRow->event_date;?> & <?php echo $DatabaseCo->dbRow->event_time;?></td>
                <td ><?php echo $DatabaseCo->dbRow->venue;?></td>
                <td ><img src="../events-list/<?php echo $DatabaseCo->dbRow->image;?>" width="80" height="80" /></td>
                <td >₹ <?php echo $DatabaseCo->dbRow->ticket;?></td>
                <td ><?php echo (substr($DatabaseCo->dbRow->description,0,50));?></td>
                <td ><?php echo $DatabaseCo->dbRow->limited;?> Peoples</td>
                

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(id) as 'total_rows' from  events".getWhereClauseForStatus($event_status);		  
	echo getNewPagination('event-list.php','event_page_size','events','id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
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
            <h1>There are no data for <?php echo strtoupper($event_status); ?> Events. Please add data.</h1>
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
