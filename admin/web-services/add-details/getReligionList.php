<?php
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM religion";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$religion_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$religion_id = $DatabaseCo->dbRow->religion_id;
				$religion_name = $DatabaseCo->dbRow->religion_name;
				$religion = array();
				$religion['religion_id'] = $religion_id;
				$religion['religion_name'] = $religion_name;
				array_push($religion_list,$religion);
	}
	header('Content-type: ../application/json');
	echo json_encode($religion_list);
?>