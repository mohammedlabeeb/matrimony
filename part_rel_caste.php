<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './class/Location.class.php';
		$DatabaseCo = new DatabaseConn();
		$religion_id =$_REQUEST['religion'];
		$each=explode(',',$religion_id);
		?>
  <select name="part_caste_id[]" id="part_caste_id" data-placeholder=" Select multiple caste"  class="form-control chosen-select" multiple >
  
  <?php
  
   foreach ($each as $rel)
   {?>
  
 <optgroup label="<?php $a=mysql_fetch_array(mysql_query("select religion_name from religion where religion_id='$rel'")); echo $a['religion_name'];?>">
  
   <?php 
  $SQL_STATEMENT =  "SELECT * FROM caste WHERE religion_id ='$rel' ORDER BY caste_name ASC";
	$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
   ?>
   <option value="<?php echo $DatabaseCo->dbRow->caste_id ?>"><?php echo $DatabaseCo->dbRow->caste_name ?></option>
     <?php } ?>
</optgroup>
	<?php
   }
   ?>

</select>