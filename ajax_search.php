<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$country_id =$_REQUEST['countryId'];
		$_SESSION['country_code'] =$country_id;
?>
  <select class="form-control custom-select" name="cbo1State" id="cbo1State" onchange="GetCity('ajax_search1.php?stateId='+this.value)" data-validetta="required">
  <option value="">State</option>
   <?php 
	$SQL_STATEMENT =  "SELECT * FROM state_view WHERE cnt_id='$country_id' ORDER BY state_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->state_id ?>"><?php echo $DatabaseCo->dbRow->state_name ?></option>
     <?php } ?>
     </select>    
