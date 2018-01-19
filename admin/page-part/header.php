<?php 
error_reporting(0);
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
$DatabaseCoCount = new DatabaseConn();
	session_start();
    if(!isset($_SESSION['admin_user_name']))
    {
            header("location: index.php");
            exit();
    }
$loggedn_user = isset($_SESSION['admin_user_name'])?$_SESSION['admin_user_name']:"Admin";
?>

<div id="header" class="cf">
<h1 id="logo" class="alignleft">
	<a href="#" title="Matrimonial Admin Panel">Control Panel</a>
</h1>
<div class="alignleft">

</div>

<div class="alignright">
<ul class="second-navigation cf">
<li class="last"><a href="#" class="action">Logged in as: <em class="admin-login"><?php echo $loggedn_user;?></em></a>
	
</li>
<li><a href="index.php?option=logout" class="action" title="Logout">Logout</a></li>
<li><a href="../index.php" target="_blank" title="Front-End" class="action">Front-End</a></li>
</ul>


</div>
<!-- end logo -->
</div>
