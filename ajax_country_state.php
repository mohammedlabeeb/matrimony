<?php 

		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		 $country_id =$_REQUEST['id'];
                 $_SESSION['country_code']=$country_id;
                
?>

  <option value="">--Please select state--</option>
   <?php 
	$SQL_STATEMENT =  "SELECT * FROM state_view WHERE cnt_id='$country_id' ORDER BY state_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
	{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->state_id; ?>"><?php echo $DatabaseCo->dbRow->state_name ?></option>
     <?php } ?>


<?php
	if(isset($_REQUEST['state_id']))
	{
		?>
        
        <select class="form-control" name="cbo1City" id="cbo1City" data-validetta="required">
   <option value="">All City</option>
        <?php 
	 $SQL_STATEMENT =  "SELECT * FROM city_view WHERE cnt_id='".$_REQUEST['country_id']."' AND state_id='".$_REQUEST['state_id']."' ORDER BY city_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
        {
        ?>
   <option value="<?php echo $DatabaseCo->dbRow->city_id; ?>"><?php echo $DatabaseCo->dbRow->city_name ?></option>
     <?php } ?>
     </select>
        <?php
		
	}

?>