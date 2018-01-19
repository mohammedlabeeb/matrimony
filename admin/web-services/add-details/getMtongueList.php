<?php
	include_once '../../databaseConn.php';
	$DatabaseCo = new DatabaseConn();
	
	$SQL_STATEMENT = "SELECT * FROM mothertongue";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$mtongue_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)){
				$mtongue_id = $DatabaseCo->dbRow->mtongue_id;
				$mtongue_name = $DatabaseCo->dbRow->mtongue_name;
				$mtongue = array();
				$mtongue['mtongue_id'] = $mtongue_id;
				$mtongue['mtongue_name'] = $mtongue_name;
				array_push($mtongue_list,$mtongue);
	}
	header('Content-type: ../application/json');
	echo json_encode($mtongue_list);
?>