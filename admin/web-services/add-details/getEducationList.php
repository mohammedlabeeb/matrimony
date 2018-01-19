<?php
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM education_detail";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$education_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$edu_id = $DatabaseCo->dbRow->edu_id;
				$edu_name = $DatabaseCo->dbRow->edu_name;
				$education = array();
				$education['edu_id'] = $edu_id;
				$education['edu_name'] = $edu_name;
				array_push($education_list,$education);
	}
	header('Content-type: ../application/json');
	echo json_encode($education_list);
?>