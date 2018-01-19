<?php
error_reporting(0);
	include_once '../../databaseConn.php';

	$DatabaseCo = new DatabaseConn();
	$city_id = isset($_GET['city_id']) ? $_GET['city_id'] :"" ;
	if(empty($city_id))
		$SQL_STATEMENT = "SELECT * FROM locality";
	else
		$SQL_STATEMENT = "SELECT * FROM locality WHERE CITY_ID=".$city_id;
	
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$locality_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$locality_id = $DatabaseCo->dbRow->LOCALITY_ID;
				$locality_name = $DatabaseCo->dbRow->LOCALITY_NAME;
				$locality = array();
				$locality['locality_id'] = $locality_id;
				$locality['locality_name'] = $locality_name;
				array_push($locality_list,$locality);
	}
	header('Content-type: application/json');
	echo json_encode($locality_list);
?>