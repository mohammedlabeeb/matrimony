<?php
	session_start();
	
	
	
		
		
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
						document.getElementById('StateDiv').innerHTML=req4.responseText;						
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

function GetCasteSearch(strURL) 
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
							console.log(req4.responseText);
							document.getElementById('caste_id_outer').innerHTML=req4.responseText;						
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

</script>
<form action="search-result.php" role="form" method="POST">
												<div class="form-row">
													<div class="form-label"><label>Looking for</label></div>
													<div class="form-fields">
														<table cellpadding="0" cellspacing="0">
															<tr>
																<td>
																	<input id="bride" type="radio" name="gender" value="Female">
																	<label class="css-label-radio clr" for="bride">Bride</label>
																</td>
																<td>
																	<input id="groom" type="radio" name="gender" value="Male">
																	<label class="css-label-radio clr" for="groom">Groom</label>
																</td>
															</tr>
														</table>
													</div>
												</div>
												<div class="form-row">
													<div class="form-label"><label>Age</label></div>
													<div class="form-fields">
														<table>
															<tr>
																<td style="padding-right:8px;">
																	<label>From</label>
																</td>
																<td style="padding-right:8px; width:80px">
																	<select name="fage" class="custom-select">
																		<option>18</option>
																		<option value="18">18</option>
																		<option value="19">19</option>
																		<option value="20">20</option>
																		<option value="21">21</option>
																		<option value="22">22</option>
																		<option value="23">23</option>
																		<option value="24">24</option>
																		<option value="25">25</option>
																		<option value="26">26</option>
																		<option value="27">27</option>
																		<option value="28">28</option>
																		<option value="29">29</option>
																		<option value="30">30</option>
																		<option value="31">31</option>
																		<option value="32">32</option>
																		<option value="33">33</option>
																		<option value="34">34</option>
																		<option value="35">35</option>
																		<option value="36">36</option>
																	</select>
																</td>
																<td style="padding-right:8px;">
																	<label>To</label>
																</td>
																<td style="padding-right:8px; width:80px">
																	<select name="tage" class="custom-select">
																		<option>36</option>
																		<option value="18">18</option>
																		<option value="19">19</option>
																		<option value="20">20</option>
																		<option value="21">21</option>
																		<option value="22">22</option>
																		<option value="23">23</option>
																		<option value="24">24</option>
																		<option value="25">25</option>
																		<option value="26">26</option>
																		<option value="27">27</option>
																		<option value="28">28</option>
																		<option value="29">29</option>
																		<option value="30">30</option>
																		<option value="31">31</option>
																		<option value="32">32</option>
																		<option value="33">33</option>
																		<option value="34">34</option>
																		<option value="35">35</option>
																		<option value="36">36</option>
																	</select>
																</td>
																<td>
																	<label>Years</label>
																</td>
															</tr>
														</table>
													</div>
												</div>
												<div class="form-row">
													<div class="form-label"><label>Religion</label></div>
													<div class="form-fields">
														<select name="religion_id"  id="religion_id" onchange="GetCasteSearch('ajax_search2.php?religionId='+this.value)" class="custom-select">
															<option value="0">Select</option>
															 <?php
                                $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
                                $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                                while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                                {
                                ?>
                                <option value="<?php echo $DatabaseCo->dbRow->religion_id; ?>"><?php echo $DatabaseCo->dbRow->religion_name; ?></option>
                                <?php                                 
                                } 
                                ?>
														</select>
													</div>
												</div>
												<div class="form-row">
													<div class="form-label"><label>Caste</label></div>
													<div class="form-fields" id="caste_id_outer">
														<select name="caste_id_search" id="caste_id_search" class="custom-select">
															<option disabled>Select</option>
														</select>
													</div>
												</div>
												<!--
												<div class="form-row">
													<div class="form-label"><label>Posted on</label></div>
													<div class="form-fields">
														<select class="custom-select">
															<option>Last two weeks</option>
														</select>
													</div>
												</div>
												-->
												<div class="form-row">
													<div class="form-label"><label>Show</label></div>
													<div class="form-fields">
														<input type="checkbox" id="photo" name="photo" class="css-checkbox"/>
														<label for="photo" name="photo" class="css-label-checkbox custom-check">
															Profiles with Photo
														</label>
													</div>
												</div>
												<div class="form-row" style="margin-top:10px; margin-bottom:30px">
													<div class="form-label">&nbsp;</div>
													<div class="form-fields">
														<input type="submit" value="Search Profiles" name="home_search" class="ion-arrow-right-b" style="float:left;"/>
													</div>
												</div>
												
											</form>
