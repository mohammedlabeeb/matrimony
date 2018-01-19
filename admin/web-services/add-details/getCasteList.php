<?php
	include_once '../../databaseConn.php';

	$DatabaseCo = new DatabaseConn();
	$religion_id = isset($_GET['religion_id']) ? $_GET['religion_id'] :"" ;
	if(empty($religion_id))
		$SQL_STATEMENT = "SELECT * FROM caste";
	else
		$SQL_STATEMENT = "SELECT * FROM caste WHERE religion_id=".$religion_id;
	
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	$caste_list = array();
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
				$caste_id = $DatabaseCo->dbRow->caste_id;
				$caste_name = $DatabaseCo->dbRow->caste_name;
				$caste = array();
				$caste['caste_id'] = $caste_id;
				$caste['caste_name'] = $caste_name;
				array_push($caste_list,$caste);
	}
	header('Content-type: ../application/json');
	echo json_encode($caste_list);
?>