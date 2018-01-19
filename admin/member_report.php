<?php
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

 
require 'exportcsvmember.inc.php';
 
$table="register"; // this is the tablename that you want to export to csv from mysql.
 
exportMysqlToCsv($table);
 
?>