<?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';
	

	
	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    $page_title = "Add New Member";

    $save_btn_text = "Save";    

    $firstname = '';

    $lastname = '';

    $gender = '';

    $m_status = '';

    $m_tongue = '';

    $birthplace = '';

    $reference = '';

    $profileby = '';

    $birthtime = '';

    $religion = '';

    $caste = '';
	
	$caste_name = '';
					
	$subcaste = '';

    $horoscope = '';

    $manglik = '';
					
	$gothra = '';
					 
	$star = '';  
	
	$moonsign = '';  


	$ACTION_MODE = "ADD";

	if(!empty($user_id))
	{		

		$getRowCountSQL = "SELECT count(index_id) as 'TOTAL_USER' FROM  register where index_id=".$user_id;

		$rowCount = getRowCount($getRowCountSQL,$DatabaseCo);

		if($rowCount==1)

		$ACTION = "UPDATE";

	}	

  

  if($ACTION == "UPDATE")

  {

	  $SQL_STATEMENT2 = "SELECT * FROM register_view where index_id=".$user_id;

	  $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);

					  

	  while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))

	  {

		    		$firstname = $DatabaseCo->dbRow->firstname;

                    $lastname = $DatabaseCo->dbRow->lastname;

                    $gender = $DatabaseCo->dbRow->gender;
					
					$birthdate = $DatabaseCo->dbRow->birthdate;

                    $m_status = $DatabaseCo->dbRow->m_status;

                    $m_tongue = $DatabaseCo->dbRow->m_tongue;

                    $birthplace = $DatabaseCo->dbRow->birthplace;

                    $reference = $DatabaseCo->dbRow->reference;

                    $profileby = $DatabaseCo->dbRow->profileby;

                    $birthtime = $DatabaseCo->dbRow->birthtime;

                    $religion = $DatabaseCo->dbRow->religion;

                    $caste = $DatabaseCo->dbRow->caste;
					
					$caste_name = $DatabaseCo->dbRow->caste_name;
					
					$subcaste = $DatabaseCo->dbRow->subcaste;

                    $horoscope = $DatabaseCo->dbRow->horoscope;

                    $manglik = $DatabaseCo->dbRow->manglik;
					
					$gothra = $DatabaseCo->dbRow->gothra;
					 
					$star = $DatabaseCo->dbRow->star;    
					
					$moonsign = $DatabaseCo->dbRow->moonsign;                   

  

	  }

	  $ACTION_MODE = "UPDATE";

	  $page_title = "Update Member ".$user_id;

	  $save_btn_text = "Update";

  }

?>

<link rel="stylesheet" href="./css/chosen.css">
<span class="field_marked">* Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/user-basic.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post" enctype="multipart/form-data"  class="form-data" id="add-form" name="MatriForm">

							
			
              <p class="cf">

                <label><font id="star">*</font> 1. First name :</label>

                <input type="text" class="input-textbox" name="firstname" value="<?php echo $firstname;?>"/>

              </p>              

      <p class="cf">

                <label><font id="star">*</font> 2. Last name :</label>

                <input type="text" class="input-textbox" name="lastname" value="<?php echo $lastname;?>"/>

                     
              </p>
              
               <p class="cf">

                <label><font id="star">*</font> 3. Gender :</label>

                <input type="radio"  value="Male" name="gender"   <?php if($gender=='Male') echo "checked";?>/>

            <span class="radio-btn-text">Male</span>

            <input type="radio"  value="Female" name="gender"   <?php if($gender=='Female') echo "checked";?>/>

            <span class="radio-btn-text">Female</span>

          
              </p>

<p class="cf">

            <label><font id="star">*</font> 4. Marital Status :</label>

            <input type="radio"  value="Unmarried" name="m_status"   <?php if($m_status=='Unmarried') echo "checked";?>/>

            <span class="radio-btn-text">Unmarried</span>

            <input type="radio"  value="Widow/Widower" name="m_status"   <?php if($m_status=='Widow/Widower') echo "checked";?>/>

            <span class="radio-btn-text">Widow/Widower</span><br>
            
             <input type="radio"  value="Divorcee" name="m_status"   <?php if($m_status=='Divorcee') echo "checked";?>/>

            <span class="radio-btn-text">Divorcee</span> 
            
             <input type="radio"  value="Separated" name="m_status"   <?php if($m_status=='Separated') echo "checked";?>/>

            <span class="radio-btn-text"> Separated</span>
            
          


          </p>              

			
          <p class="cf">

            <label><font id="star">*</font> 5. Mothertongue :</label>

           <select  name="mtongue[]" id="mtongue" data-placeholder="Select Multiple Mothertongue" class="chosen-select comboBox" multiple style="width:35% !important;">
           
                     <?php
		    $SQL_STATEMENT =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
		    $DatabaseCoo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
			$search_array = explode(',',$m_tongue);
		    while($DatabaseCoo->dbRow = mysql_fetch_object($DatabaseCoo->dbResult))
		    {
		    ?>
		    <option value="<?php echo $DatabaseCoo->dbRow->mtongue_id; ?>" <?php 
									if (in_array($DatabaseCoo->dbRow->mtongue_id, $search_array)) 
									{
										echo "selected";
									}
									?>><?php echo $DatabaseCoo->dbRow->mtongue_name; ?></option>
		    <?php } ?>
                              </select>         

          </p>              

            <p class="cf">
            <label><font id="star">*</font> 6. Birthdate :</label>
			 
            
             <select name="day" id="day"  class="comboBox" onchange="setDays(month,this,year)">
  <?php if($ACTION=='UPDATE')
  { 
   $ad=explode('-',$birthdate); 
   
   ?><option value="<?php echo $ad[2];?>"><?php echo $ad[2];?></option><?php
  }
  ?>
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
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
                               
                             </select>
                             
                              <select name="month" id="month"  class="comboBox" onchange="setDays(this,day,year)" required>
                              
 <?php if($ACTION=='UPDATE')
  { 
     
   ?><option value="<?php echo $ad[1];?>"><?php echo $ad[1];?></option><?php
  }
  ?>                             
                              
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
                               
                             </select>
                             
                              <select name="year" id="year"  class="comboBox" required onchange="setDays(month,day,this)">
 
  <?php if($ACTION=='UPDATE')
  { 
     
   ?><option value="<?php echo $ad[0];?>"><?php echo $ad[0];?></option><?php
  }
  ?>             
<option value="1924">1924</option>
<option value="1925">1925</option>
<option value="1926">1926</option>
<option value="1927">1927</option>
<option value="1928">1928</option>
<option value="1929">1929</option>
<option value="1930">1930</option>
<option value="1931">1931</option>
<option value="1932">1932</option>
<option value="1933">1933</option>
<option value="1934">1934</option>
<option value="1935">1935</option>
<option value="1936">1936</option>
<option value="1937">1937</option>
<option value="1938">1938</option>
<option value="1939">1939</option>
<option value="1940">1940</option>
<option value="1941">1941</option>
<option value="1942">1942</option>
<option value="1943">1943</option>
<option value="1944">1944</option>
<option value="1945">1945</option>
<option value="1946">1946</option>
<option value="1947">1947</option>
<option value="1948">1948</option>
<option value="1949">1949</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
                               
                             </select>
                             
  <input type="hidden" class="form-control" name="datepicker" value="<?php if($_GET['action']=='UPDATE'){ echo $birthdate;} else { echo '1924-01-01';}?>" />                            
            
          </p>
            

            <p class="cf">

                <label> 7. Place of Birth :</label>
 <input type="text" class="input-textbox" name="birthplace" id="birthplace" value="<?php echo $birthplace;?>">
              </p>
              
               <p class="cf">

                <label>8. Birth Time :</label>

             <input type="text" class="input-textbox" name="birthtime" id="birthtime" value="<?php echo $birthtime;?>">

              </p>

              <p class="cf">

                <label> 9. Reference :</label>

               <select class="comboBox"  name="reference" id="reference">
                <option value="<?php echo $reference; ?>"><?php echo $reference; ?></option>
  		    						<option value="Advertisements">Advertisements</option>
		    						<option value="Friends">Friends</option>
                   					<option value="Searh Engines">Searh Engines</option>
                   					<option value="Others">Others</option>
                            </select>

              </p>

          <p class="cf">

            <label>10.  Profile Created by :</label>

             <select class="comboBox"   name="profileby" id="profileby">
             <option value="<?php echo $profileby; ?>"><?php echo $profileby; ?></option>
                                        <option value="Self">Self</option>
                                        <option value="Parents">Parents</option>
                                        <option value="Guardian">Guardian</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Relatives">Relatives</option>
                            </select>

          </p>              

             

              <p class="cf">

                <label><font id="star">*</font> 11. Religion :</label>

                <select class="comboBox" name="religion_id" id="religion_id" onchange="GetCaste('ajax_search2.php?religionId='+this.value)"  >
                      <option value="">--Please select Religion--</option>
                     <?php
		    $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
		    $rel->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		    while($religion1->dbRow = mysql_fetch_object($rel->dbResult))
		    {
		    ?>
		    <option value="<?php echo $religion1->dbRow->religion_id; ?>" <?php if($religion==$religion1->dbRow->religion_id ){?> selected="selected" <?php }?>><?php echo $religion1->dbRow->religion_name; ?></option>
		    <?php } ?>
                        </select>
              </p>

              <p class="cf">

                <label><font id="star">*</font> 12.  Caste  :</label>

                 <select class="comboBox" name="caste_id" id="CasteDiv" >
                     <option value="<?php echo $caste; ?>"><?php echo $caste_name; ?></option>             
                    <option value="">--Select Religion first--</option>
                    </select> 
              </p>

              <p class="cf">

                <label> 13. Sub caste :</label>

              <input type="text" class="input-textbox" name="subcaste" id="subcaste" value="<?php echo $subcaste;?>">

              </p>
              
              <p class="cf">

                <label> 14. Horoscope  :</label>

            <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="Yes" <?php if($horoscope=="Yes" ){?> checked="checked" <?php }?>>
                                      Yes &nbsp;
                                      <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="No" <?php if($horoscope=="No" ){?> checked="checked" <?php }?>>
                                      No &nbsp;
                                      <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="Does Not Matter" <?php if($horoscope=="Does Not Matter" ){?> checked="checked" <?php }?>>
                                      Does Not Matter  &nbsp;

              </p>

              <p class="cf">

                <label> 15. Manglik  :</label>

              <input name="manglik" id="manglik" type="radio" class="radio-inline" value="Yes" <?php if($manglik=="Yes" ){?> checked="checked" <?php }?>>
                                      Yes &nbsp;
                                      <input name="manglik" class="radio-inline" id="manglik" type="radio" value="No" <?php if($manglik=="No" ){?> checked="checked" <?php }?>>
                                      No &nbsp;
                                      <input name="manglik" class="radio-inline" id="manglik" type="radio" value="Does Not Matter" <?php if($manglik=="Does Not Matter" ){?> checked="checked" <?php }?>>
                                      Does Not Matter  &nbsp;
              </p>

          <p class="cf"> <label> 16. Gothra :</label>

           <input type="text" class="input-textbox"  name="gothra" id="gothra" value="<?php echo $gothra;?>">

          </p>     
          
          <p class="cf"> <label> 17. Star :</label>

         			<select class="comboBox" name="mem_star" id="mem_star">
                     <option value="<?php echo $star;?>"><?php echo $star;?></option>
                           <option value="Does not matter">Does not matter</option>
                            <option value="ANUSHAM">ANUSHAM</option>
                            <option value="ASWINI">ASWINI</option>
                            <option value="AVITTAM">AVITTAM</option>
                            <option value="AYILYAM">AYILYAM</option>
                            <option value="BHARANI">BHARANI</option>
                            <option value="CHITHIRAI">CHITHIRAI</option>
                            <option value="HASTHAM">HASTHAM</option>
                            <option value="KETTAI">KETTAI</option>
                            <option value="KRITHIGAI">KRITHIGAI</option>
                            <option value="MAHAM">MAHAM</option>
                            <option value="MOOLAM">MOOLAM</option>
                            <option value="MRIGASIRISHAM">MRIGASIRISHAM</option>
                            <option value="POOSAM">POOSAM</option>
                            <option value="PUNARPUSAM">PUNARPUSAM</option>
                            <option value="PURADAM">PURADAM</option>
                            <option value="PURAM">PURAM</option>
                            <option value="PURATATHI">PURATATHI</option>
                            <option value="REVATHI">REVATHI</option>
                            <option value="ROHINI">ROHINI</option>
                            <option value="SADAYAM">SADAYAM</option>
                            <option value="SWATHI">SWATHI</option>
                            <option value="THIRUVADIRAI">THIRUVADIRAI</option>
                            <option value="THIRUVONAM">THIRUVONAM</option>
                            <option value="UTHRADAM">UTHRADAM</option>
                            <option value="UTHRAM">UTHRAM</option>
                            <option value="UTHRATADHI">UTHRATADHI</option>
                            <option value="VISAKAM">VISAKAM</option>
                          </select>

          </p>   
          
          <p class="cf"> <label> 18. Moonsign :</label>

          <select class="comboBox" name="moonsign" id="moonsign">
           <option value="<?php echo $moonsign;?>"><?php echo $moonsign;?></option>
                          <option value="Does not matter">Does not matter</option>
                            <option value="Mesh (Aries)">Mesh (Aries)</option>
                            <option value="Vrishabh (Taurus)">Vrishabh (Taurus)</option>
                            <option value="Mithun (Gemini)">Mithun (Gemini)</option>
                            <option value="Karka (Cancer)">Karka (Cancer)</option>
                            <option value="Simha (Leo)">Simha (Leo)</option>
                            <option value="Kanya (Virgo)">Kanya (Virgo)</option>
                            <option value="Tula (Libra)">Tula (Libra)</option>
                            <option value="Vrischika (Scorpio)">Vrischika (Scorpio)</option>
                            <option value="Dhanu (Sagittarious)">Dhanu (Sagittarious)</option>
                            <option value="Makar (Capricorn)">Makar (Capricorn)</option>
                            <option value="Kumbha (Aquarious)">Kumbha (Aquarious)</option>
                            <option value="Meen (Pisces)">Meen (Pisces)</option>
                          </select>

          </p>            



          

	  <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />	  

	  <input type="hidden" id="action" value="<?php echo $ACTION_MODE;?>"/>

	  

          <p class="submit-btn cf">

            <input type="submit"  class="save-btn" value="<?php echo $save_btn_text;?>" title="Save" id="add_basic_save"/>

            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>

          </p>

        </form>

	<script type="text/javascript" src="./js/util/location-validation.js"></script>

	<script type="text/javascript" >

		registerForm();

	</script>
    <script language="javascript">
        
		function getXMLHTTP()
{
	var xmlhttp=false;
	try{
		xmlhttp=new XMLHttpRequest();
		}
	catch(e){
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
        function GetCaste(strURL) 
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
						document.getElementById('CasteDiv').innerHTML=req4.responseText;						
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
<script type="text/javascript">

var numDays = {
                '01': 31, '02': 28, '03': 31, '04': 30, '05': 31, '06': 30, 
                '07': 31, '08': 31, '09': 30, '10': 31, '11': 30, '12': 31
              }; 

function setDays(oMonthSel, oDaysSel, oYearSel)
{ 
	var nDays, oDaysSelLgth, opt, i = 1; 
	nDays = numDays[oMonthSel[oMonthSel.selectedIndex].value]; 
	if (nDays == 28 && oYearSel[oYearSel.selectedIndex].value % 4 == 0) 
		++nDays; 
	oDaysSelLgth = oDaysSel.length; 
	if (nDays != oDaysSelLgth)
	{ 
		if (nDays < oDaysSelLgth) 
			oDaysSel.length = nDays; 
		else for (i; i < nDays - oDaysSelLgth + 1; i++)
		{ 
			opt = new Option(oDaysSelLgth + i, oDaysSelLgth + i); 
                  	oDaysSel.options[oDaysSel.length] = opt;
		} 
	}
	var oForm = oMonthSel.form;
	var month = oMonthSel.options[oMonthSel.selectedIndex].value;
	var day = oDaysSel.options[oDaysSel.selectedIndex].value;
	var year = oYearSel.options[oYearSel.selectedIndex].value;	
	oForm.datepicker.value = year + '-' + month + '-' + day;
} 

</script>
 <script src="./js/chosen.jquery.min.js" type="text/javascript"></script>
  	<script type="text/javascript">
	
		
	
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
	  
	  
    }
    for (var selector in config)
	 {
      $(selector).chosen(config[selector]);
	 
    }
	
  </script>