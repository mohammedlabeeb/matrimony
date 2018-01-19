<?php 
require_once("BusinessLogic/class.weddingplanner.php");
require_once("BusinessLogic/class.wpcategory.php");
$w=new wpcategory();
$result=$w->get_wpcat3();
$result1=$w->get_wpcat3();

?>
<script language="javascript" type="text/javascript">
function getXMLHTTP()
{ //fuction to return the xml http object
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
}
function GetState(strURL) 
{
		var req4 = getXMLHTTP();		
		if (req4) 
		{
			req4.onreadystatechange = function() 
			{
					if (req4.readyState == 4) 
					{
						if(req4.status == 200) 
						{	
							
						document.getElementById('cbo1State').innerHTML=req4.responseText;						
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req4.statusText);
						}
					}				
			}			
			req4.open("GET", strURL, true);
			req4.send(null);
		}				
}
function GetCity(strURL) 
{
		var req5 = getXMLHTTP();		
		if (req5) 
		{
			req5.onreadystatechange = function() 
			{
					if (req5.readyState == 4) 
					{
						if(req5.status == 200) 
						{						
						document.getElementById('CityDiv').innerHTML=req5.responseText;						
						} 
						else 
						{
						alert("There was a problem while using XMLHTTP:\n" + req5.statusText);
						}
					}				
			}			
			req5.open("GET", strURL, true);
			req5.send(null);
		}				
}


</script>
<div class="search-filter">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td style="padding-right:10px; width:160px">
				<select name="txtCountry" class="form-control custom-select" id="txtCountry" onchange="GetState('ajax_search.php?countryId='+this.value);" data-validation-engine="validate[required]">
					<option value="">Country</option>
					<?php
                                    $SQL_STATEMENT =  "SELECT * FROM country WHERE status='APPROVED'";
                                    $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                    while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                            {
                                    ?>
                                    <option value="<?php echo $DatabaseCo->dbRow->country_id; ?>"><?php echo $DatabaseCo->dbRow->country_name; ?></option>
                    <?php } ?>
				</select>
			</td>
			<td style="padding-right:10px; width:160px">
				<div id="cbo1State">
					<select name="cbo1State" class="form-control custom-select" onchange="GetCity('ajax_search1.php?stateId='+this.value)">
						<option value="">State</option>
					</select>
				</div>
			</td>
			<td style="padding-right:10px; width:220px">
				<select class="custom-select" name="id"><option value="">Service type</option>
				<?php 
				
				while($reswp=mysql_fetch_array($result))
				{ 
					?>
				
					<option value="<?php echo $reswp['wp_cat_id'];?>"><?php  echo $reswp['wp_cat_name'];?></option>
			
					<?php 
				}
					?> 
					
				</select>
			</td>
			<td>
				<input type="submit" value="Search" />
			</td>
		</tr>
	</table>
</div>
<div class="search-categories">
		<ul class="category-list">
		<?php while($reswp=mysql_fetch_array($result1))
				{ 
					?>
			<li><a href="wedding-planner.php?id=<?php echo $reswp['wp_cat_id'];?>"><?php  echo $reswp['wp_cat_name'];?></a></li>
		<?php } ?>	
		</ul>
</div>