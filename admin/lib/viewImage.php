<?php
	require_once('../databaseConn.php');
	$recId = isset($_GET['recid'])?$_GET['recid']:"";
	$keyName = isset($_GET['key_name'])?$_GET['key_name']:"";
	$table_name = isset($_GET['table_name'])?$_GET['table_name']:"";
	$DatabaseCo = new DatabaseConn();
	$sqlStateMent = "select * from ".$table_name." where ".$keyName."=".$recId;
	
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($sqlStateMent);
							
			while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
			{
			$image_type = $DatabaseCo->dbRow->IMAGE_TYPE;
  			header("Content-type:". $image_type);

					echo $DatabaseCo->dbRow->IMAGE_DATA;			
  		}
?>