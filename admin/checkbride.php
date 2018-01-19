<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
$q=$_GET["q"];

$sql="SELECT * FROM register WHERE matri_id = '".$q."' and gender='Female'";

$result = mysql_query($sql) or die(mysql_error());


if(mysql_num_rows($result)==0)
{
	echo "";
}
else
{
	$fname=mysql_result($result,0,"firstname");
	$lname=mysql_result($result,0,"lastname");
	$fullname=$fname." ".$lname;
	echo $fullname;
}

?> 