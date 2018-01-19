<?php
ob_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './class/Location.class.php';
include_once './class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();

if(isset($_POST['id']))
		{
		  		$sh_id = $_POST['id'];
			    $SQL_STATEMENT = "DELETE FROM shortlist WHERE sh_id=$sh_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
if(isset($_POST['block_id']))
		{
		  		$block_id = $_POST['block_id'];
			    $SQL_STATEMENT = "DELETE FROM block_profile WHERE block_id=$block_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
ob_flush();	
?>