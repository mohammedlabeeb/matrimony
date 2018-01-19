<?php
error_reporting(0);
	include_once '../../databaseConn.php';

	$DatabaseCo = new DatabaseConn();
	$country_id = isset($_GET['country_id']) ? $_GET['country_id'] :"" ;
	if(empty($country_id))
		$SQL_STATEMENT = "SELECT * FROM state";
	else
		$SQL_STATEMENT = "SELECT * FROM state WHERE country_id=".$country_id;
	
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$state_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$state_id = $DatabaseCo->dbRow->state_id;
				$state_name = $DatabaseCo->dbRow->state_name;
				$state = array();
				$state['state_id'] = $state_id;
				$state['state_name'] = $state_name;
				array_push($state_list,$state);
	}
	header('Content-type: application/json');
	echo json_encode($state_list);
?>