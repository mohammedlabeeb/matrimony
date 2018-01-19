<?php
error_reporting(0);
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
	require_once '../BusinessLogic/class.caste.php';
	
	$religion_id=$_REQUEST['religion_id'];
	$castob=new caste();	
	$resultc=$castob->get_caste_religion_id($religion_id);	
?>	
<select name="caste_id" id="caste_id" class="forminput" style="width:220px;">
<option value="">-- Select Caste --</option>
<?php

while($a=mysql_fetch_array($resultc)) 
{
	$select = "";
	if($_REQUEST['caste_id']==$a['caste_id'])
	{
		$select = 'selected="selected"';
	}
 ?>
<option value="<?php echo $a['caste_id']?>"><?php echo $a['caste_name']?></option>
<?php
}
?>
</select>