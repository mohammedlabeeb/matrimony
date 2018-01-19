<?php
	error_reporting(0);
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM country where status='APPROVED'";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$country_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$country_id = $DatabaseCo->dbRow->country_id;
				$country_name = $DatabaseCo->dbRow->country_name;
				$country = array();
				$country['country_id'] = $country_id;
				$country['country_name'] = $country_name;
				array_push($country_list,$country);
	}
	header('Content-type: ../application/json');
	echo json_encode($country_list);
	
?>