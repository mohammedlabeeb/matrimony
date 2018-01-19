<?php
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM occupation";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$occupation_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$ocp_id = $DatabaseCo->dbRow->ocp_id;
				$ocp_name = $DatabaseCo->dbRow->ocp_name;
				$occupation = array();
				$occupation['ocp_id'] = $ocp_id;
				$occupation['ocp_name'] = $ocp_name;
				array_push($occupation_list,$occupation);
	}
	header('Content-type: ../application/json');
	echo json_encode($occupation_list);
?>