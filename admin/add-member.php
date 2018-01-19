<?php
	require_once('auth.php');
	include_once 'databaseConn.php';
	include_once './lib/requestHandler.php';
	$DatabaseCo = new DatabaseConn();
	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;  
	$page_title = ($ACTION=="UPDATE")?"Update Member with ID : ".$user_id :"Add New Member";	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Add Member</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.2.custom.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.loader.css" />


<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.spinner.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript" src="js/util/location.js"></script>
<script type="text/javascript" src="js/util/jquery.form.js"></script>
<script type="text/javascript" src="js/util/tabbing.js"></script>
<script type="text/javascript" src="js/jquery.loader.js"></script>




<script type="text/javascript">


	setPageContext("member","all-members");
	$(document).ready(function()
	 {
		registerForActiveTab();
		setActiveTab("#user-basic");
		loadTab("#tabcontent","./add-froms/manage-user/user-basic.php?action=<?php echo $ACTION;?>&index_id=","#max_basic_id",1);
		

	});
</script>
<style type="text/css">
#star {
    color: #ff0000;
    font-size: 14px;
}
</style>
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
      <div class="breadcum-wide"><a href="#" title="Members">Members</a> / <a href="#" title="Members List">Members List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;" class="button" title="List All Members" onclick="window.location='member-list.php'">
          <img src="img/bgi/list-icon.png" alt=""/>List All Members</a>
          <a href="javascript:;" class="button" title="Add New Member" onclick="window.location='add-member.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Member</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4><?php echo $page_title;?></h4>
        <br/>
	<div id="navcontainer">
		<ul id="custom-tabs">
		<li><a href="javascript:;" id="user-basic" onclick="loadTab('#tabcontent','./add-froms/manage-user/user-basic.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',1)"> Basic Info</a></li>
		<li><a href="javascript:;" id="account-info" onclick="loadTab('#tabcontent','./add-froms/manage-user/account-info.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',2)">Account Info</a></li>
		<li><a href="javascript:;" id="education-info" onclick="loadTab('#tabcontent','./add-froms/manage-user/education-info.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',3)">Education Info</a></li>
		<li><a href="javascript:;" id="physical-info" onclick="loadTab('#tabcontent','./add-froms/manage-user/physical-info.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',4)">Physical Info</a></li>
		<li><a href="javascript:;" id="residence-info" onclick="loadTab('#tabcontent','./add-froms/manage-user/residence-info.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',5)">Residence</a></li>
		<li><a href="javascript:;" id="partner-preference" onclick="loadTab('#tabcontent','./add-froms/manage-user/partner-preference.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',6)">Partner Info</a></li>	
        <li><a href="javascript:;" id="other-info" onclick="loadTab('#tabcontent','./add-froms/manage-user/other-info.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',6)">Other Info</a></li>
        <li><a href="javascript:;" id="manage-photo" onclick="loadTab('#tabcontent','./add-froms/manage-user/manage-photo.php?action=<?php echo $ACTION;?>&index_id=','#max_basic_id',7)">Manage Photos</a></li>		
		</ul>
          <div id="tabcontent">
		<div class="loadinContainer">
		<img src="./img/ajax-request-loader.gif" alt="Loading" /> <span class="loadingText">Loading.Please Wait.</span>
		</div>
          </div>
        <input type="hidden" id="max_basic_id" value="<?php echo $user_id;?>"/>
	</div>
	
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
