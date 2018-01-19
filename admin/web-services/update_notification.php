<?php 
include_once '../databaseConn.php';

$DatabaseCo = new DatabaseConn();
$notification_type = $_POST['not_type'];

$SQL_STATEMENT = "update pending_action set NOTIFICATION_COUNT=0 where NOTIFICATION_TYPE='".$notification_type."'";

if($DatabaseCo->updateData($SQL_STATEMENT)){
	echo "true";
}else{
	echo "false";
}
?>