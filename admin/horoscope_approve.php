<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $horoscope_status = "";
  if(isset($_GET['horoscope_status']))
  {
    $horoscope_status = $_GET['horoscope_status'];
    $_SESSION['horoscope_status'] = $_GET['horoscope_status'];
  }
  else if(isset($_GET['page']))
  {
	$horoscope_status = $_SESSION['horoscope_status'];
      
  }
  else
  {
      $_SESSION['horoscope_status'] = "all";
      $horoscope_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['index_id']))
	{
		$index_id_arr = $_POST['index_id'];
		$index_val = "(";
		foreach($index_id_arr as $index_id)
		{
			$index_val .=	$index_id.",";
		}
		$index_val = substr($index_val, 0, -1);
		$index_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "update register set hor_photo='' where index_id in ".$index_val;	
			      break;
		    case 'APPROVED':
				 $SQL_STATEMENT =  "update  register set hor_check='APPROVED' where index_id in ".$index_val;	
			      break;
		    case 'UNAPPROVED':
				 $SQL_STATEMENT =  "update  register set hor_check='UNAPPROVED' where index_id in ".$index_val;	
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
<title>Admin | Horoscope Approval</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
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
	setPageContext("approve","horoscope-appprove");
	$(document).ready(function ()
	   {
		$("#approove" ).button().click(function(){
		   window.location = "horoscope_approve.php?horoscope_status=approved";
		 });
		$("#unapproove" ).button().click(function(){
		   window.location = "horoscope_approve.php?horoscope_status=unapproved";
		 });
	       $("#all" ).button().click(function(){
		   window.location = "horoscope_approve.php?horoscope_status=all";
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
      <div class="breadcum-wide"><a href="#" title="User">Approval</a> / <a href="#" title="Role"> Horoscope Approval List</a></div>
      <div class="listing-section">
        <div class="member-list cf">         
          <div class="approval alignleft">
	    <input type="button"  title="Enabledd Horoscope Approval"   id="approove"  value="Approved (<?php echo getRowCount("select count(index_id) from register where hor_photo!='' AND hor_check='APPROVED'",$DatabaseCo);?>)"/>+
	    <input type="button"  title="Disabled Horoscope Approval"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(index_id) from register where hor_photo!='' AND hor_check='UNAPPROVED'",$DatabaseCo);?>)"/>=
	     <input type="button" title="All Horoscope Approval"  id="all" value="All (<?php echo getRowCount("select count(index_id) from register WHERE hor_photo!='' ",$DatabaseCo);?>)"/>	    
          </div>
        </div>
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
	    
	    $horoscope_approve_count = getRowCount("select count(index_id) from register".getWhereClauseForHoro($horoscope_status),$DatabaseCo);
	    if($horoscope_approve_count>0){  
	?>
	  <div class="nodata-avail ">
            <h1><?php echo strtoupper($horoscope_status); ?> Horoscope</h1>
          </div> 	
        <div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["horoscope_approve_page_size"])?$_COOKIE["horoscope_approve_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM register ".getWhereClauseForHoro($horoscope_status)." ORDER By index_id DESC LIMIT ".$lim_str;
	  ?>


        </div>
        <div class="table-desc cf" style="margin-bottom:20px;">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="10%">Status</th>
              <th width="15%">Matri ID</th>
              <th width="20%">User name</th>
              <th width="15%">User Satus</th>
              <th width="37%">Horoscope Image</th>
            </tr>
	<form method="post" action="horoscope_approve.php" id="action_form">
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
		    <td><input type="checkbox"  class="table-checkbox"  name="index_id[]" value="<?php  echo $DatabaseCo->dbRow->index_id;?>"/></td>		    
		    <td>
		    <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->hor_check=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
			<a href="#" class="<?php echo $likeDisLikeCss;?>"></a>
		    </td>
		    <td><?php echo $DatabaseCo->dbRow->matri_id;?></td>
		    <td><?php echo $DatabaseCo->dbRow->username;?></td>
		    <td><?php echo $DatabaseCo->dbRow->status;?></td>
		    <td title="<?php echo $DatabaseCo->dbRow->username;?>">
			<img src="../horoscope-list/<?php echo $DatabaseCo->dbRow->hor_photo;?>" width="200px" height="80px" style="vertical-align: middle;"></td>
            </tr>
		 <?php
		 $rowCount++;
	      }
	      ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>	    
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(index_id) as 'total_rows' from  register ".getWhereClauseForHoro($horoscope_status);		  
	echo getNewPagination('horoscope_approve.php','horoscope_approve_page_size','register','index_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
           <h1>There are no data for <?php echo strtoupper($horoscope_status); ?> Horoscope.</h1>
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
