<?php 

		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		 $country_id =$_REQUEST['countryId'];
                
?>
<select class="comboBox" name="state" id="state" onchange="GetCity('ajax_search1?stateId='+this.value)">
  <option value="">--Please select state--</option>
   <?php 
	$SQL_STATEMENT =  "SELECT * FROM state_view WHERE cnt_id='$country_id' ORDER BY state_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>"><?php echo $DatabaseCo->dbRow->state_name ?></option>
     <?php } ?>
</select>