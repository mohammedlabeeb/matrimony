<?php
ob_start();
include_once 'databaseConn.php';
include_once './lib/pagination.php';
include_once './class/Location.class.php';
include_once './class/Config.class.php';
$DatabaseCo = new DatabaseConn();
$configObj = new Config();

if(isset($_POST['delete']))
		{
		  		$msg_id = $_POST['delete'];
			    $SQL_STATEMENT = "DELETE FROM expressinterest WHERE ei_id=$msg_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
		
if(isset($_REQUEST['reject']))
		{
				$id=$_REQUEST['reject'];
				$SQL_STATEMENT = "update expressinterest set receiver_response='Reject' WHERE ei_id='$id'";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
		
		} 
if(isset($_REQUEST['accept']))
		{
				$id=$_REQUEST['accept'];
				$SQL_STATEMENT = "update expressinterest set receiver_response='Accept' WHERE ei_id='$id'";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
		
		} 
		
		
if(isset($_POST['grating_id']))
		{
		  		$gra_id = $_POST['grating_id'];
			    $SQL_STATEMENT = "DELETE FROM gratings WHERE g_id=$gra_id";
				$exe=mysql_query($SQL_STATEMENT) or die(mysql_error());
							
		}
ob_flush();	
?>