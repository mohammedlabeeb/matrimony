<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $advertise_status = "";
  if(isset($_GET['advertise_status']))
  {
    $advertise_status = $_GET['advertise_status'];
    $_SESSION['advertise_status'] = $_GET['advertise_status'];
  }
  else if(isset($_GET['page']))
  {
      $advertise_status = $_SESSION['advertise_status'];
  }
  else
  {
      $_SESSION['advertise_status'] = "all";
      $advertise_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['adv_id']) && is_array($_POST['adv_id']))
	{
		$adv_id_arr = $_POST['adv_id'];
		$adv_id_val = "(";
		foreach($adv_id_arr as $adv_id)
		{
			$adv_id_val .=	$adv_id.",";
		}
		$adv_id_val = substr($adv_id_val, 0, -1);
		$adv_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from advertisement where adv_id in ".$adv_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update advertisement set status='APPROVED' where adv_id in ".$adv_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update advertisement set status='UNAPPROVED' where adv_id in ".$adv_id_val;	
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
<title>Admin | Advertisement</title>
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
setPageContext("advertisement","advertise");
$(document).ready(function ()
   {
       $("#approove" ).button().click(function(){
	window.location = "advertise.php?advertise_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "advertise.php?advertise_status=unapproved";
      });
	 
    $("#all" ).button().click(function(){
	window.location = "advertise.php?advertise_status=all";
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
      <div class="breadcum-wide"><a href="#" title="User">Add New Advertisement</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="add-advertise.php" class="button" title="Add New Advertisement" id="add_advertise"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Advertisement</a>
          <div class="approval alignleft">
          <input type="button" title="Approved Advertisement List" id="approove" value="Approved (<?php echo getRowCount("select count(adv_id) from advertisement where status='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Advertisement List"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(adv_id) from advertisement where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Advertisement List"   id="all" value="All (<?php echo getRowCount("select count(adv_id) from advertisement",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      <div id="overlay" class="web_dialog_overlay"></div>
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title">Add New Advertisement </p>
        <a href="add-advertise.php" id="btnClose" class="close"><img src="img/bgi/close_black.png" alt="Close"/></a> <br/>
        
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
	    
	    $advertisement_count = getRowCount("select count(adv_id) from advertisement".getWhereClauseForstatus($advertise_status),$DatabaseCo);
	    if($advertisement_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($advertise_status); ?> Advertisement List</h1>
          </div>   

        <div class="cf membership-data">
  <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["advertisement_page_size"])?$_COOKIE["advertisement_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM advertisement ".getWhereClauseForstatus($advertise_status)." ORDER BY adv_id DESC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="3%">Edit</th>
              <th width="8%">status</th>
              <th width="15%">Name</th>
              <th width="10%">Link</th>
              <th width="6%">Ad Level</th>
              <th width="17%">Image</th>
              <th width="11%">Contact Person</th>
              <th width="7%">Phone</th>
              <th width="12%">Date</th>
                        
            </tr>
            <form method="post" action="advertise.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="adv_id[]" value="<?php  echo $DatabaseCo->dbRow->adv_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="add-advertise.php?id=<?php  echo $DatabaseCo->dbRow->adv_id;?>" title="Edit" id="edit_advertisement">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->adv_name;?></td>
                <td ><?php echo $DatabaseCo->dbRow->adv_link;?></td>
                <td ><?php echo $DatabaseCo->dbRow->adv_level;?></td>
          <td ><img src="../advertise/<?php echo $DatabaseCo->dbRow->adv_img;?>" width="170" height="160" style="vertical-align:middle;" /></td>
                <td ><?php echo $DatabaseCo->dbRow->contact_name;?></td>
                <td ><?php echo $DatabaseCo->dbRow->phone;?></td>
                 <td ><?php $a=$DatabaseCo->dbRow->adv_date;
				 echo date('F j, Y', (strtotime($a)));?></td>
                

            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(adv_id) as 'total_rows' from  advertisement".getWhereClauseForstatus($advertise_status);		  
	echo getNewPagination('advertise.php','event_page_size','advertisement','adv_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
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
            <h1>There are no data for <?php echo strtoupper($advertise_status); ?> Advertisement. Please add data.</h1>
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
