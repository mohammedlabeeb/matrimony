<?php
  error_reporting(0);
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $page_status = "";
  if(isset($_GET['page_status']))
  {
    $page_status = $_GET['page_status'];
    $_SESSION['page_status'] = $_GET['page_status'];
  }
  else if(isset($_GET['page']))
  {
      $page_status = $_SESSION['page_status'];
  }
  else
  {
      $_SESSION['page_status'] = "all";
      $page_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['cms_id']))
	{
		$cms_id_arr = $_POST['cms_id'];
		$cms_id_val = "(";
		foreach($cms_id_arr as $cms_id)
		{
			$cms_id_val .=	$cms_id.",";
		}
		$cms_id_val = substr($cms_id_val, 0, -1);
		$cms_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  cms_pages where cms_id in ".$cms_id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  cms_pages set status='APPROVED' where cms_id in ".$cms_id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  cms_pages set status='UNAPPROVED' where cms_id in ".$cms_id_val;	
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
<title>Admin | cms page list</title>
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
setPageContext("cms","cms-page");
 $(document).ready(function ()
   {
     $("#approove" ).button().click(function(){
	window.location = "cms-page-list.php?page_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "cms-page-list.php?page_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "cms-page-list.php?page_status=all";
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
      <div class="breadcum-wide"><a href="#" title="User">CMS</a> / <a href="#" title="Role"> CMS Page List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button"  title="List All Cms Pages"  onclick="window.location='cms-page-list.php?page=1'"><img src="img/bgi/list-icon.png" alt="List"/>List All CMS Pages</a>
          <a href="javascript:;"  class="button" title="Add New Cms Pages"  onclick="window.location='add-cms-page.php?action=ADD'"><img src="img/bgi/add-icon.png" alt="Add"/>Add New Page</a>
          <div class="approval alignleft">
            <input type="button" title="Approved Cms Pages"  id="approove" value="Approved (<?php echo getRowCount("select count(cms_id) from cms_pages where status='APPROVED'",$DatabaseCo);?>)"/>
            +
            <input type="button" title="Unapproved Cms Pages"  id="unapproove" value="Unapproved (<?php echo getRowCount("select count(cms_id) from cms_pages where status='UNAPPROVED'",$DatabaseCo);?>)"/>
            =
            <input type="button" title="All Cms Pages"  id="all" value="All (<?php echo getRowCount("select count(cms_id) from cms_pages",$DatabaseCo);?>)"/>
          </div>
        </div>
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
      <div class="widecolumn-inner memership-detail">
        <?php
	    
	    $cms_page_count = getRowCount("select count(cms_id) from cms_pages".getWhereClauseForstatus($page_status),$DatabaseCo);
	    if($cms_page_count>0){  
	   ?>
	  <div class="nodata-avail ">
            <h1><?php echo strtoupper($page_status); ?> CMS Page List</h1>
          </div>   
        <div class="cf membership-data">
          <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["cms_page_page_size"])?$_COOKIE["cms_page_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM cms_pages ".getWhereClauseForstatus($page_status)." ORDER BY cms_id DESC  LIMIT ".$lim_str;
		
?>

        </div>
        <div class="table-desc cf">

          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th width="3%"><input type="checkbox" onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="7%">status</th>
              <th width="20%">Page Name</th>
              <th width="20%">Page Title</th>
              <th width="53%">Page Content</th>
            </tr>
            <form method="post" action="cms-page-list.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="cms_id[]" value="<?php  echo $DatabaseCo->dbRow->cms_id;?>" /></td>
                <td><a class="edit-btn margin-none" href="add-cms-page.php?action=UPDATE&cms_id=<?php echo $DatabaseCo->dbRow->cms_id;?>" title="Edit">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='APPROVED')
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->page_name;?></td>
                <td ><?php echo $DatabaseCo->dbRow->cms_title;?></td>
                <td ><?php echo substr($DatabaseCo->dbRow->cms_content,0,200);?></td>
              </tr>
              <?php
	      $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(cms_id) as 'total_rows' from  cms_pages".getWhereClauseForstatus($page_status);		  
	echo getNewPagination('cms-page-list.php','cms_page_page_size','cms_pages','cms_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
?>		  
        </div>
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($page_status); ?> CMS Pages. Please add data.</h1>
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
