<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$state_id =$_REQUEST['stateId'];
		$country_id=$_SESSION['country_code'];
	?>
  <select class="form-control" name="cbo1City" id="cbo1City" data-validetta="required">
   <option value="">All City</option>
   <?php 
	$SQL_STATEMENT =  "SELECT * FROM city_view WHERE state_id='$state_id' and cnt_id='$country_id' ORDER BY city_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->city_id ?>"><?php echo $DatabaseCo->dbRow->city_name ?></option>
     <?php } ?>
     </select>
    


       
