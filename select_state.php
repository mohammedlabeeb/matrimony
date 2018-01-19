<?php
error_reporting(0);
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
	require_once 'BusinessLogic/class.state.php';
	
	
	$country_id=$_REQUEST['country_id'];
	$castob=new state();	
	$result=$castob->get_state_country_id($country_id);	
?>	

<select name="state_id" id="state_id" class="comboBox" onChange="getCity('select_city.php?state_id='+this.value)">
<option value="">Select State</option>
<?php

while($a1=mysql_fetch_array($result)) 
{
	$select = "";
	if($_REQUEST['state_id']==$a['state_id'])
	{
		$select = 'selected="selected"';
	}
 ?>
<option value="<?php echo $a1['state_id']?>"><?php echo $a1['state_name']?></option>
<?php
}
?>
</select>