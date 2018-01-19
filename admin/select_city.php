<?php
error_reporting(0);
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
require_once("../BusinessLogic/class.city.php");
	
	
	$state_id=$_REQUEST['state_id'];
	$castob=new city();	
	$result=$castob->get_city_state_id($state_id);	
?>	
<select name="city_id" id="city_id" class="forminput" style="width:220px;" >
<option value="">-- Select city --</option>
<?php
while($a1=mysql_fetch_array($result)) 
{
	$select = "";
	if($_REQUEST['city_id']==$a['city_id'])
	{
		$select = 'selected="selected"';
	}
 ?>
<option value="<?php echo $a1['city_id']?>"><?php echo $a1['city_name']?></option>
<?php
}
?>
</select>