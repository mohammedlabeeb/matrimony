<?php
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM height";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$height_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$height_id = $DatabaseCo->dbRow->height_id;
				$value = $DatabaseCo->dbRow->value;
				$unit = $DatabaseCo->dbRow->unit;
				$height = array();
				$height['height_id'] = $height_id;
				$height['value'] = $value;
				$height['unit'] = $unit;
				array_push($height_list,$height);
	}
	header('Content-type: ../application/json');
	echo json_encode($height_list);
?>