<?php 
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		
if(isset($_REQUEST['religion_id']))
		{
		  		$religion_id = $_REQUEST['religion_id'];
			    $SQL_STATEMENT = "select * FROM caste WHERE religion_id=$religion_id";
				$exe=mysql_query($SQL_STATEMENT);
				?>
               	<select name="caste[]" id="caste" multiple="multiple" class="src_field_select" >
                <option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
    		 <?php
			    while($resrel=mysql_fetch_array($exe))
								{
							?>
			<option value="<?php echo $resrel['caste_id']; ?>"><?php echo ucfirst($resrel['caste_name']); ?></option>
							<?php
								}
							?>
</select>		
			
                <?php
							
		}
		
		
if(isset($_REQUEST['country_id']))
		{
		  		$country_id = $_REQUEST['country_id'];
			    $SQL_STATEMENT1 = "select * FROM state_view WHERE cnt_id=$country_id";
				$exe1=mysql_query($SQL_STATEMENT1);
				
				?>
                <select name="state" id="state"  class="form-control" onchange="GetCity(this.value)" style="height:30px; padding:5px 0 2px 3px;">
				<option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
               <?php
			    while($resrel1=mysql_fetch_array($exe1))
								{
							?>
			<option value="<?php echo $resrel1['state_id']; ?>"><?php echo ucfirst($resrel1['state_name']); ?></option>
							<?php
								}
							?>
                </select>
                <?php
							
		}
		
if(isset($_REQUEST['state_id']))
		{
		  		$state_id = $_REQUEST['state_id'];
			   $SQL_STATEMENT2 = "select * FROM city_view WHERE state_id='$state_id'";
				$exe2=mysql_query($SQL_STATEMENT2);
				
				?>
                <select name="city[]" id="city" multiple="multiple" class="src_field_select">
				<option value="" label="Doesn't Matter" selected="selected">Doesn't Matter</option>
               <?php
			    while($resrel2=mysql_fetch_array($exe2))
								{
							?>
			<option value="<?php echo $resrel2['city_id']; ?>"><?php echo ucfirst($resrel2['city_name']); ?></option>
							<?php
								}
							?>
                </select>
                <?php
							
		}
		
?>