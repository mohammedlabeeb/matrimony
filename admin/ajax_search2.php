<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$religion_id =$_REQUEST['religionId'];
?>
  <select class="comboBox" name="caste_id" id="caste_id" >
  <option value="">--Please select Caste--</option>
   <?php 
	$SQL_STATEMENT =  "SELECT * FROM caste WHERE religion_id='$religion_id' ORDER BY caste_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->caste_id ?>"><?php echo $DatabaseCo->dbRow->caste_name ?></option>
     <?php } ?>
     </select>    
