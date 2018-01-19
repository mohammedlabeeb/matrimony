		
								<div class="box">
									<div class="box-head">Refine Search</div>
									<form name="frm_filter" id="frm_filter" method="post" action="">    
									<div class="box-content">
										<div class="block">
											<label>Profile ID</label>
											<input type="text" name="id_search" id="id_search" placeholder="USR00012345" />
										</div>
										<div class="block">
											<label>Looking for</label>
											<table cellpadding="0" cellspacing="0" class="inner-table">
												<tr>
													<td>
														<input id="bride" type="radio" value="Female" name="gender">
														<label class="css-label-radio clr" for="bride">Bride</label>
													</td>
													<td width="20">&nbsp;</td>
													<td>
														<input id="grome" type="radio" value="Male" name="gender">
														<label class="css-label-radio clr" for="grome">Grome</label>
													</td>
												</tr>
											</table>
										</div>
										<div class="block">
											<label>Age</label>
											<table class="inner-table">
												<tr>
													<td style="padding-right:8px;">
														<label>From</label>
													</td>
													<td style="padding-right:8px; width:80px">
														<select id="f_age" name="f_age" class="custom-select">
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
														<select name="t_age" id="t_age" class="custom-select">
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
												</tr>
											</table>
										</div>
										<div class="block">
											<label>Marital Status</label>
											<table cellpadding="0" cellspacing="0" class="inner-table marital">
												<tr>
													<td>
														<input id="unmarried" value="Unmarried" type="radio" name="mstatus">
														<label class="css-label-radio clr" for="unmarried">Unmarried</label>
													</td>
												</tr>
												<tr>
													<td>
														<input id="widow" value="Widow/Widower" type="radio" name="mstatus">
														<label class="css-label-radio clr" for="widow">Widow/Widower</label>
													</td>
												</tr>
												<tr>
													<td>
														<input id="divorcee" value="Divorcee" type="radio" name="mstatus">
														<label class="css-label-radio clr" for="divorcee">Divorcee</label>
													</td>
												</tr>
												<tr>
													<td>
														<input id="separated" value="Separated" type="radio" name="mstatus">
														<label class="css-label-radio clr" for="separated">Separated</label>
													</td>
												</tr>
											</table>
										</div>
										<div class="block">
											<label>Occupation</label>
											
											<select id="occupation" class="custom-select">
											<option value="">Any</option>
											 <?php
												 $search_array3 = explode(',',$_SESSION['occupation']);
													$rel=mysql_query("select * from  occupation where status='APPROVED'") or die(mysql_error());
													while($fetch_rel=mysql_fetch_array($rel))
													{ 
													
									?>
													<option value="<?php echo $fetch_rel['ocp_id'] ;?>" <?php if (in_array($fetch_rel['ocp_id'], $search_array3)) 
									{
										echo "selected";
									} ?>><?php echo $fetch_rel['ocp_name'] ;?></option>
													<?php } ?>
											</select>
										</div>
										<div class="block">
											<label>Education</label>
											<select id="education" name="education" class="custom-select">
											
												<option value="">Any</option>
												 <?php
												 $search_array2 = explode(',',$_SESSION['education123']);				
													$rel=mysql_query("select * from  education_detail where status='APPROVED'") or die(mysql_error());
													while($fetch_rel=mysql_fetch_array($rel))
													{	?>	
													<option value="<?php echo $fetch_rel['edu_id'] ;?>" <?php if (in_array($fetch_rel['edu_id'], $search_array2)) 
									{
										echo "selected";
									} ?>><?php echo $fetch_rel['edu_name'] ;?></option>
													<?php } ?>
											</select>
										</div>
										<div class="block">
											<label>Community</label>
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td style="padding-bottom:10px;">
														<select name="religion_id"  id="religion_id" onchange="GetCasteSearch('ajax_search2.php?religionId='+this.value)" class="custom-select">
															<option value="">Select</option>
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
													</td>
												</tr>
												<tr>
													<td>
													<div id="caste_id_outer">
														<select class="custom-select">
															<option>Caste</option>
														</select>
													</div>
													</td>
												</tr>
											</table>
										</div>
										<div class="block">
											<label>Location</label>
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td style="padding-bottom:10px;">
														<select name="txtCountry" class="form-control" id="txtCountry" onchange="GetState('ajax_search.php?countryId='+this.value);">
                             
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
												</tr>
												<tr>
													<td>
													<div id="state_outer">
														 <select name="cbo1State" id="cbo1State" class="form-control"  >
                                  
                                    
												<option value="">State</option>
											</select> 
													</div>
													</td>
												</tr>
											</table>
										</div>
										
									</div>
									</form>
								</div>
							
       	
		
		
		
		                 
        
		
		<script type="text/javascript">  
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
						document.getElementById('state_outer').innerHTML=req4.responseText;						
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
		   $("#frm_filter").on('change', function()
		   {

			$("#loaderID").css("opacity",1);
			
			var selectedOrderBy = new Array();
			$('input[name="orderby"]:checked').each(function() {
			selectedOrderBy.push(this.value);
			});
			if(selectedOrderBy=='')
			{
				var selectedOrderBy ='null';
			}
			
			
			
			var selectedGender = new Array();
			$('input[name="gender"]:checked').each(function() {
			selectedGender.push(this.value);
			});
			
			
			var selectedPhoto = new Array();
			$('input[name="photo"]:checked').each(function() {
			selectedPhoto.push(this.value);
			});
			if(selectedPhoto=='')
			{
				var selectedPhoto ='null';
			}
			
			
			var selectedMstatus = new Array();
			$('input[name="mstatus"]:checked').each(function() {
			selectedMstatus.push(this.value);			
			});
			if(selectedMstatus=='')
			{
				var selectedMstatus ='null';
			}
			
			
			
			
			
			
			
			
			
			
			var selectedMothertongue = new Array();
			$('input[name="mothertongue"]:checked').each(function() {
			selectedMothertongue.push(this.value);
			});
			if(selectedMothertongue=='')
			{
				var selectedMothertongue ='null';
			}
			
			var id_search = $('#id_search').val();
			var t3 =$('#f_age').val();
			var t4 =$('#t_age').val();
			var occupation =$('#occupation').val();
			var education =$('#education').val();
			var religion =$('#religion_id').val();
			var caste =$('#caste_id_search').val();
			var country =$('#txtCountry').val();
			var state =$('#cbo1State').val();
			if(caste>0) {
				
			} else {
				caste = "";
			}
			var dataString = 'id_search='+ id_search +'&religion='+ religion+ '&caste='+caste+'&occupation=' + occupation + '&t3=' + t3 + '&t4=' + t4 + '&country=' + country + '&state='+ state +'&gender=' + selectedGender + '&m_status=' + selectedMstatus+ '&photo=' + selectedPhoto+ '&m_tongue=' + selectedMothertongue+ '&education=' + education + '&orderby=' + selectedOrderBy + '&actionfunction=showData' + '&page=1';
			
			console.log(dataString);
			
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "dbmanupulate3.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,
			
			success:function(response)
			{
				$("#resultholder").empty();
				$("#loaderID").css("opacity",0);
				$("#resultholder").append(response);
				
				
			},
			
			});
		
		});
		
		$("#id_search").on('change keyup paste', function()
		   {

			$("#loaderID").css("opacity",1);
			
			var selectedOrderBy = new Array();
			$('input[name="orderby"]:checked').each(function() {
			selectedOrderBy.push(this.value);
			});
			if(selectedOrderBy=='')
			{
				var selectedOrderBy ='null';
			}
			
			
			
			var selectedGender = new Array();
			$('input[name="gender"]:checked').each(function() {
			selectedGender.push(this.value);
			});
			
			
			var selectedPhoto = new Array();
			$('input[name="photo"]:checked').each(function() {
			selectedPhoto.push(this.value);
			});
			if(selectedPhoto=='')
			{
				var selectedPhoto ='null';
			}
			
			
			var selectedMstatus = new Array();
			$('input[name="mstatus"]:checked').each(function() {
			selectedMstatus.push(this.value);			
			});
			if(selectedMstatus=='')
			{
				var selectedMstatus ='null';
			}
			
			var selectedReligion = new Array();
			$('input[name="religion"]:checked').each(function() {
			selectedReligion.push(this.value);
			
			});
			if(selectedReligion=='')
			{
				var selectedReligion ='null';
			}
			
			var selectedOccupation = new Array();
			$('input[name="occupation"]:checked').each(function() {
			selectedOccupation.push(this.value);
			});
			if(selectedOccupation=='')
			{
				var selectedOccupation ='null';
			}
			
			var selectedEducation = new Array();
			$('input[name="education"]:checked').each(function() {
			selectedEducation.push(this.value);
			});
			if(selectedEducation=='')
			{
				var selectedEducation ='null';
			}
			
			
			var selectedCountry = new Array();
			$('input[name="country"]:checked').each(function() {
			selectedCountry.push(this.value);
			});
			if(selectedCountry=='')
			{
				var selectedCountry ='null';
			}
			
			var selectedMothertongue = new Array();
			$('input[name="mothertongue"]:checked').each(function() {
			selectedMothertongue.push(this.value);
			});
			if(selectedMothertongue=='')
			{
				var selectedMothertongue ='null';
			}
			
			var id_search = $('#id_search').val();
			
			var dataString = 'id_search='+ id_search +'&religion='+ selectedReligion+ '&occupation=' + selectedOccupation + '&t3=' + '<?php echo $t3;?>' + '&t4=' + '<?php echo $t4;?>' + '&country=' + selectedCountry + '&gender=' + selectedGender + '&m_status=' + selectedMstatus+ '&photo=' + selectedPhoto+ '&m_tongue=' + selectedMothertongue+ '&education=' + selectedEducation + '&orderby=' + selectedOrderBy + '&actionfunction=showData' + '&page=1';
			
			console.log(dataString);
			
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "dbmanupulate3.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,
			
			success:function(response)
			{
				$("#pagination").empty();
				$("#loaderID").css("opacity",0);
				$("#pagination").append(response);
				
				
			},
			
			});
		
		});
		
    </script>