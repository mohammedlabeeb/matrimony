<?php
error_reporting(0);
	include_once '../../databaseConn.php';

	$DatabaseCo = new DatabaseConn();
	$state_id = isset($_GET['state_id']) ? $_GET['state_id'] :"" ;
	if(empty($state_id))
		$SQL_STATEMENT = "SELECT * FROM city";
	else
		$SQL_STATEMENT = "SELECT * FROM city WHERE state_id=".$state_id;
	
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$city_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$city_id = $DatabaseCo->dbRow->city_id;
				$city_name = $DatabaseCo->dbRow->city_name;
				$city = array();
				$city['city_id'] = $city_id;
				$city['city_name'] = $city_name;
				array_push($city_list,$city);
	}
	header('Content-type: application/json');
	echo json_encode($city_list);
?>