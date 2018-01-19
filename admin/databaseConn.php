<?php
error_reporting(0);
session_start();
	if($_SESSION['admin_user_name']=='')
	{
		echo "<script>window.location='index.php'</script>";	
	}

	require_once('dbConf.php');
	class DatabaseConn
	{
		var $dbLink;
		var $sqlQuery;
		var $dbResult;
		var $dbRow;
		
		
		function __construct()
		{
			$this->dbLink = '';
			$this->sqlQuery = '';
			$this->dbResult = '';
			$this->dbRow = '';
			
			/**************
			* End databse parameter
			*****************/
			
			
			$this->dbLink = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			mb_language('uni');
			mb_internal_encoding('UTF-8');
			mysql_select_db(DB_DATABASE, $this->dbLink);
			mysql_query("set names 'utf8'",$this->dbLink);
		}
		function convertToLocalHtml($localHtmlEquivalent)
		{
			$localHtmlEquivalent = mb_convert_encoding($localHtmlEquivalent,"HTML-ENTITIES","UTF-8");
			return $localHtmlEquivalent;
		}

		function getSelectQueryResult($selectQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $selectQuery;
			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			return $this->dbResult;
		}
		function updateData($updateQuery)
		{
			mysql_query("SET character_set_results=utf8", $this->dbLink);
			$this->sqlQuery = $updateQuery;

			$this->dbResult = mysql_query($this->sqlQuery, $this->dbLink);
			
			if($this->dbResult)
				return true;
			else
				return false;
		}
	}
?>
