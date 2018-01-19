<?php
	require_once('../databaseConn.php');
	$recId = isset($_GET['recid'])?$_GET['recid']:"";
	$keyName = isset($_GET['key_name'])?$_GET['key_name']:"";
	$table_name = isset($_GET['table_name'])?$_GET['table_name']:"";
	$image_data_field = isset($_GET['image_data_field'])?$_GET['image_data_field']:"";
	$image_type_field = isset($_GET['image_type_field'])?$_GET['image_type_field']:"";
	
	$DatabaseCo = new DatabaseConn();
	$sqlStateMent = "select * from ".$table_name." where ".$keyName."=$recId";
	
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($sqlStateMent);
							
			while($DatabaseCo->dbRow = mysql_fetch_array($DatabaseCo->dbResult))
			{
			$image_type = $DatabaseCo->dbRow[$image_type_field];
  			header("Content-type: $image_type");

					echo $DatabaseCo->dbRow[$image_data_field];			
  		}
?>