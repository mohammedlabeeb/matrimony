 <?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';

	

	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    $save_btn_text = "Save";

	$expectation = "";

    $looking_for = "";

    $part_frm_age = "";

    $part_to_age = "";

    $part_country_living = "";

    $part_height = "";

    $part_height_to = "";

    $part_edu = "";	
	
	$part_complexion = "";
	
	$part_mtongue = "";
	
	$part_religion = "";
	
	$part_caste = "";

    $part_income='';


	$ACTION_MODE = "ADD";

	if(!empty($user_id)){

		$getRowCountSQL = "SELECT count(index_id) as 'TOTAL_USER' FROM   register where index_id=".$user_id;

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

	    $looking_for =$DatabaseCo->dbRow->looking_for;
	    $part_frm_age = $DatabaseCo->dbRow->part_frm_age;
		$part_to_age= $DatabaseCo->dbRow->part_to_age;
	    $part_country_living = $DatabaseCo->dbRow->part_country_living;
	    $part_height = $DatabaseCo->dbRow->part_height;
		$part_height_to = $DatabaseCo->dbRow->part_height_to;
	    $part_edu = $DatabaseCo->dbRow->part_edu;
	    $part_caste = $DatabaseCo->dbRow->part_caste;
		$part_religion = $DatabaseCo->dbRow->part_religion;
	    $part_resi_status = $DatabaseCo->dbRow->part_resi_status;
		$part_expect = $DatabaseCo->dbRow->part_expect;	    
		$part_mtongue = $DatabaseCo->dbRow->part_mtongue;	    
		$part_complexion = $DatabaseCo->dbRow->part_complexation;
		$part_income = $DatabaseCo->dbRow->part_income;	    

	  }

	  $ACTION_MODE = "UPDATE";

	  

	  $save_btn_text = "Update";

  }

  

	 

?>
 <link rel="stylesheet" href="./css/chosen.css">   

	 <span class="field_marked">* Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/partner-preference.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"   class="form-data" id="add-form">   

		<p class="cf">

	      <label><font id="star">*</font> 1. Looking for:</label>
		<?php $search_array = explode(', ',$looking_for);  ?>
	    <input type="checkbox"  value="Unmarried" name="part_m_status[]" <?php if (in_array('Unmarried', $search_array)) 
									{echo "checked";}?> />

            <span class="radio-btn-text">Unmarried</span>

            <input type="checkbox"  value="Widow/Widower" name="part_m_status[]" <?php if (in_array('Widow/Widower', $search_array)) 
									{echo "checked";}?>/>

            <span class="radio-btn-text">Widow/Widower</span>
            
             <input type="checkbox"  value="Separated" name="part_m_status[]" <?php if (in_array('Separated', $search_array)) 
									{echo "checked";}?>/>

            <span class="radio-btn-text">Separated</span> <br>
            
             <input type="checkbox"  value="Divorcee" name="part_m_status[]" <?php if (in_array('Divorcee', $search_array)) 
									{echo "checked";}?>/>

            <span class="radio-btn-text"> Divorcee</span>
            
             
	      

	      </p>

	    <p class="cf">

	      <label><font id="star">*</font> 2.  Partner Age:</label>

	   <select class="comboBox" name="part_from_age">
					<option value="<?php echo $part_frm_age;?>"><?php echo $part_frm_age;?> Years</option>
                 				<option value="18">18 Years</option>
                                <option value="19">19 Years</option>
                                <option value="20">20 Years</option>
                                <option value="21">21 Years</option>
                                <option value="22">22 Years</option>
                                <option value="23">23 Years</option>
                                <option value="24">24 Years</option>
                                <option value="25">25 Years</option>
                                <option value="26">26 Years</option>
                                <option value="27">27 Years</option>
                                <option value="28">28 Years</option>
                                <option value="29">29 Years</option>
                                <option value="30">30 Years</option>
                                <option value="31">31 Years</option>
                                <option value="32">32 Years</option>
                                <option value="33">33 Years</option>
                                <option value="34">34 Years</option>
                                <option value="35">35 Years</option>
                                <option value="36">36 Years</option>
                                <option value="37">37 Years</option>
                                <option value="38">38 Years</option>
                                <option value="39">39 Years</option>
                                <option value="40">40 Years</option>
                                <option value="41">41 Years</option>
                                <option value="42">42 Years</option>
                                <option value="43">43 Years</option>
                                <option value="44">44 Years</option>
                                <option value="45">45 Years</option>
                                <option value="46">46 Years</option>
                                <option value="47">47 Years</option>
                                <option value="48">48 Years</option>
                                <option value="49">49 Years</option>
                                <option value="50">50 Years</option>
                                <option value="51">51 Years</option>
                                <option value="52">52 Years</option>
                                <option value="53">53 Years</option>
                                <option value="54">54 Years</option>
                                <option value="55">55 Years</option>
                                <option value="56">56 Years</option>
                                <option value="57">57 Years</option>
                                <option value="58">58 Years</option>
                                <option value="59">59 Years</option>
                                <option value="60">60 Years</option>
            

                </select>  To &nbsp;&nbsp;  &nbsp;  
                
                <select class="comboBox" name="part_to_age">
<option value="<?php echo $part_to_age;?>"><?php echo $part_to_age;?> Years</option>
                <option value="18">18 Years</option>
                                <option value="19">19 Years</option>
                                <option value="20">20 Years</option>
                                <option value="21">21 Years</option>
                                <option value="22">22 Years</option>
                                <option value="23">23 Years</option>
                                <option value="24">24 Years</option>
                                <option value="25">25 Years</option>
                                <option value="26">26 Years</option>
                                <option value="27">27 Years</option>
                                <option value="28">28 Years</option>
                                <option value="29">29 Years</option>
                                <option value="30">30 Years</option>
                                <option value="31">31 Years</option>
                                <option value="32">32 Years</option>
                                <option value="33">33 Years</option>
                                <option value="34">34 Years</option>
                                <option value="35">35 Years</option>
                                <option value="36">36 Years</option>
                                <option value="37">37 Years</option>
                                <option value="38">38 Years</option>
                                <option value="39">39 Years</option>
                                <option value="40">40 Years</option>
                                <option value="41">41 Years</option>
                                <option value="42">42 Years</option>
                                <option value="43">43 Years</option>
                                <option value="44">44 Years</option>
                                <option value="45">45 Years</option>
                                <option value="46">46 Years</option>
                                <option value="47">47 Years</option>
                                <option value="48">48 Years</option>
                                <option value="49">49 Years</option>
                                <option value="50">50 Years</option>
                                <option value="51">51 Years</option>
                                <option value="52">52 Years</option>
                                <option value="53">53 Years</option>
                                <option value="54">54 Years</option>
                                <option value="55">55 Years</option>
                                <option value="56">56 Years</option>
                                <option value="57">57 Years</option>
                                <option value="58">58 Years</option>
                                <option value="59">59 Years</option>
                                <option value="60">60 Years</option>
                                <option value="61">61 Years</option>
                                <option value="62">62 Years</option>
                                <option value="63">63 Years</option>
                                <option value="64">64 Years</option>
                                <option value="65">65 Years</option>
                                <option value="66">66 Years</option>
                                <option value="67">67 Years</option>
                                <option value="68">68 Years</option>
                                <option value="69">69 Years</option>
                                <option value="70">70 Years</option>
                                <option value="71">71 Years</option>
                                <option value="72">72 Years</option>
                                <option value="73">73 Years</option>
                                <option value="74">74 Years</option>
                                <option value="75">75 Years</option>
                                <option value="76">76 Years</option>
                                <option value="77">77 Years</option>
                                <option value="78">78 Years</option>
                                <option value="79">79 Years</option>
                                <option value="80">80 Years</option>
                                <option value="81">81 Years</option>
                                <option value="82">82 Years</option>
                                <option value="83">83 Years</option>
                                <option value="84">84 Years</option>
                                <option value="85">85 Years</option>
                                <option value="86">86 Years</option>
                                <option value="87">87 Years</option>
                                <option value="88">88 Years</option>
                                <option value="89">89 Years</option>
                                <option value="90">90 Years</option>
            

                </select>

				</p>
                
                <p class="cf">

	      <label><font id="star">*</font> 3. Partner Height:</label>

	      <select class="comboBox" name="to_height">
<option value="<?php echo $part_height;?>"><?php echo $part_height;?></option>
               <option value="Below 4ft 6in">Below 4ft 6in - 137cm</option>
               <option value="4ft 6in">4ft 6in - 137cm</option>
               <option value="4ft 7in">4ft 7in - 139cm</option>
               <option value="4ft 8in">4ft 8in - 142cm</option>
               <option value="4ft 9in">4ft 9in - 144cm</option>
               <option value="4ft 10in">4ft 10in - 147cm</option>
               <option value="4ft 11in">4ft 11in - 149cm</option>
               <option value="5ft">5ft - 152cm</option>
               <option value="5ft 1in">5ft 1in - 154cm</option>
               <option value="5ft 2in">5ft 2in - 157cm</option>
               <option value="5ft 3in">5ft 3in - 160cm</option>
               <option value="5ft 4in">5ft 4in - 162cm</option>
               <option value="5ft 5in">5ft 5in - 165cm</option>
               <option value="5ft 6in">5ft 6in - 167cm</option>
               <option value="5ft 7in">5ft 7in - 170cm</option>
               <option value="5ft 8in">5ft 8in - 172cm</option>
               <option value="5ft 9in">5ft 9in - 175cm</option>
               <option value="5ft 10in">5ft 10in - 177cm</option>
               <option value="5ft 11in">5ft 11in - 180cm</option>
               <option value="6ft">6ft - 182cm</option>
               <option value="6ft 1in">6ft 1in - 185cm</option>
               <option value="6ft 2in">6ft 2in - 187cm</option>
               <option value="6ft 3in">6ft 3in - 190cm</option>
               <option value="6ft 4in">6ft 4in - 193cm</option>
               <option value="6ft 5in">6ft 5in - 195cm</option>
               <option value="6ft 6in">6ft 6in - 198cm</option>
               <option value="6ft 7in">6ft 7in - 200cm</option>
               <option value="6ft 8in">6ft 8in - 203cm</option>
               <option value="6ft 9in">6ft 9in - 205cm</option>
               <option value="6ft 10in">6ft 10in - 208cm</option>
               <option value="6ft 11in">6ft 11in - 210cm</option>
               <option value="7ft">7ft - 213cm</option>
               <option value="Above 7ft">Above 7ft - 213cm</option>
            

                </select>  To &nbsp;&nbsp; &nbsp;   
                
                <select class="comboBox" name="from_height">
<option value="<?php echo $part_height_to;?>"><?php echo $part_height_to;?></option>
                <option value="Below 4ft 6in">Below 4ft 6in - 137cm</option>
               <option value="4ft 6in">4ft 6in - 137cm</option>
               <option value="4ft 7in">4ft 7in - 139cm</option>
               <option value="4ft 8in">4ft 8in - 142cm</option>
               <option value="4ft 9in">4ft 9in - 144cm</option>
               <option value="4ft 10in">4ft 10in - 147cm</option>
               <option value="4ft 11in">4ft 11in - 149cm</option>
               <option value="5ft">5ft - 152cm</option>
               <option value="5ft 1in">5ft 1in - 154cm</option>
               <option value="5ft 2in">5ft 2in - 157cm</option>
               <option value="5ft 3in">5ft 3in - 160cm</option>
               <option value="5ft 4in">5ft 4in - 162cm</option>
               <option value="5ft 5in">5ft 5in - 165cm</option>
               <option value="5ft 6in">5ft 6in - 167cm</option>
               <option value="5ft 7in">5ft 7in - 170cm</option>
               <option value="5ft 8in">5ft 8in - 172cm</option>
               <option value="5ft 9in">5ft 9in - 175cm</option>
               <option value="5ft 10in">5ft 10in - 177cm</option>
               <option value="5ft 11in">5ft 11in - 180cm</option>
               <option value="6ft">6ft - 182cm</option>
               <option value="6ft 1in">6ft 1in - 185cm</option>
               <option value="6ft 2in">6ft 2in - 187cm</option>
               <option value="6ft 3in">6ft 3in - 190cm</option>
               <option value="6ft 4in">6ft 4in - 193cm</option>
               <option value="6ft 5in">6ft 5in - 195cm</option>
               <option value="6ft 6in">6ft 6in - 198cm</option>
               <option value="6ft 7in">6ft 7in - 200cm</option>
               <option value="6ft 8in">6ft 8in - 203cm</option>
               <option value="6ft 9in">6ft 9in - 205cm</option>
               <option value="6ft 10in">6ft 10in - 208cm</option>
               <option value="6ft 11in">6ft 11in - 210cm</option>
               <option value="7ft">7ft - 213cm</option>
               <option value="Above 7ft">Above 7ft - 213cm</option>
            

                </select>

				</p>

	    <p class="cf">

	      <label><font id="star">*</font> 4. Partner Country Living in:</label>

	  <select name="txtPcountry[]"  id="txtPcountry" data-placeholder="Choose Country" class="chosen-select comboBox" multiple style="width:40% !important;">
                                   <?php
		    $search_array4 = explode(',',$part_country_living);
			$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
			$DatabaseCo1->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1);
			while($DatabaseCo1->dbRow = mysql_fetch_object($DatabaseCo1->dbResult))
				{
			?>
			<option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" 
	<?php 
									if (in_array($DatabaseCo1->dbRow->country_id, $search_array4)) 
									{
										echo "selected";
									}
									?>><?php echo $DatabaseCo1->dbRow->country_name; ?></option>
			<?php } ?>
                           
                     
                                    </select>

				</p>

	    

	   <p class="cf">

	      <label><font id="star">*</font> 5. Partner Education:</label>

	   <select  name="txtEducation[]" data-placeholder="Choose Education" class="chosen-select comboBox" multiple style="width:40% !important;">
                                        <?php
							$search_array5 = explode(',',$part_edu);
		$edures2=mysql_query("select * from  education_detail where status='APPROVED'");
								while($row=mysql_fetch_array($edures2))
								{
							?>
			<option value="<?php echo $row['edu_id']; ?>" <?php 
									if (in_array($row['edu_id'], $search_array5)) 
									{
										echo "selected";
									}
									?>><?php echo $row['edu_name']; ?></option>
							<?php		
								}
							?> 
                                      </select>
				</p>
                
                <p class="cf">

                <label> 6. Expectations  :</label>

       <textarea cols="70" rows="4" class="text-area" name="expectation" id="expectation"><?php echo $part_expect;?></textarea>

              </p>   
              

	    <p class="cf">

	      <label>7.Partner Complexion:</label>

	     <select  name="txtComplexion[]" data-placeholder="Choose Complexion" class="chosen-select comboBox" multiple style="width:40% !important;">
          <?php $search_array98 = explode(', ',$part_complexion);?>             
                                        
                                        
                      <option value="Very Fair" <?php if(in_array('Very Fair', $search_array98)){ echo "selected"; } ?>>Very Fair</option>
                      <option value="Fair" <?php if(in_array('Fair', $search_array98)){ echo "selected"; } ?>>Fair</option>
                      <option value="Wheatish" <?php if(in_array('Wheatish', $search_array98)){ echo "selected"; } ?>>Wheatish</option>
                      <option value="Wheatish Brown" <?php if(in_array('Wheatish Brown', $search_array98)){ echo "selected"; } ?>>Wheatish Brown</option>
                      <option value="Dark" <?php if(in_array('Dark', $search_array98)){ echo "selected"; } ?>>Dark</option>
                                      </select>

				</p>
                
                <p class="cf">

	      <label><font id="star">*</font> 8.Partner Mother Tongue:</label>

	   <select name="part_m_tongue[]" id="part_m_tongue" data-placeholder="Choose Mother Tongue" class="chosen-select comboBox" multiple style="width:40% !important;">
                            
          <?php
		    $search_arr2 = explode(',',$part_mtongue);
			$rescn2=mysql_query("select * from  mothertongue where status='APPROVED' order by  mtongue_name");
								while($rowcc=mysql_fetch_array($rescn2))
								{
									
							?>
                <option value="<?php echo $rowcc['mtongue_id']; ?>" <?php 
									if (in_array($rowcc['mtongue_id'], $search_arr2)) 
									{
										echo "selected";
									}
									?>><?php echo ucfirst($rowcc['mtongue_name']); ?></option>
							<?php
								}
							?>
                         
                        </select>              
</select>	

				</p>
                
                

	    	    <p class="cf">

	      <label>9. Residential Status:</label>
  <select  name="residence[]" id="residence" data-placeholder="Choose Residence Status" class="chosen-select comboBox" multiple style="width:40% !important;">
                         <?php 
				$search_array30 = explode(', ',$part_resi_status);
							  
							  ?>
                        <option value="Citizen" <?php if(in_array('Citizen', $search_array30)){ echo "selected"; } ?>>Citizen</option>
                        
                        <option value="Permanent Resident" <?php if(in_array('Permanent Resident', $search_array30)){ echo "selected"; } ?>>Permanent Resident</option>
                        
                        <option value="Student Visa" <?php if(in_array('Student Visa', $search_array30)){ echo "selected"; } ?>>Student Visa</option>
                        
                        <option value="Temporary Visa" <?php if(in_array('Temporary Visa', $search_array30)){ echo "selected"; } ?>>Temporary Visa</option>
                        
                        <option value="Work Permit" <?php if(in_array('Work Permit', $search_array30)){ echo "selected"; } ?>>Work Permit</option>
                            
                            
                    </select>

				</p>

	       
<p class="cf">

	      <label><font id="star">*</font> 10. Religion:</label>
 <select name="txtreligion[]" id="part_religion_id" data-placeholder="Choose Religion" class="chosen-select comboBox" multiple style="width:40% !important;">
					<?php
		$search_array7 = explode(',',$part_religion);
      $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
                  $DatabaseCooo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                  while($DatabaseCooo->dbRow = mysql_fetch_object($DatabaseCooo->dbResult))
                               {
                               ?>
                               <option value="<?php echo $DatabaseCooo->dbRow->religion_id; ?>" <?php if (in_array($DatabaseCooo->dbRow->religion_id, $search_array7)) 
									{
										echo "selected";
									}
									?>><?php echo $DatabaseCooo->dbRow->religion_name; ?></option>
                               <?php } ?>
                            
</select>	
			&nbsp; <span id="CasteDivloader"></span>
				</p>
                
                <p class="cf">

	      <label><font id="star">*</font> 11. Caste:</label>
          <span id="partCasteDiv">
 <select name="part_caste_id[]" id="part_caste_id" data-placeholder="Choose Caste" class="chosen-select comboBox" multiple style="width:40% !important;">
					<option value="<?php echo $part_caste; ?>" selected><?php $abc=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_caste FROM register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste ) >0 WHERE a.index_id='$user_id'  GROUP BY a.part_caste"));
				echo $abc['part_caste'];?>
                            
</select>	

		</span>
				</p>
                
                 <p class="cf">

	      <label>&nbsp; 12. Annual income:</label>
          <span id="partCasteDiv">
 <select name="part_income" id="part_income"  class="comboBox">
					 <option value="<?php echo $part_income; ?>"><?php echo $part_income; ?></option>                                                          
                                        <option value="No Income">No Income</option>
                                        <option value="Prefer not to say">Prefer not to say</option>
                                        <option value="Under Rs.50,000">Under Rs.50,000</option>
                                        <option value="Rs.50,001 - 1,00,000">Rs.50,001 - 1,00,000</option>
                                        <option value="Rs.1,00,001 - 2,00,000">Rs.1,00,001 - 2,00,000</option>
                                        <option value="Rs.2,00,001 - 3,00,000">Rs.2,00,001 - 3,00,000</option>
                                        <option value="Rs.3,00,001 - 4,00,000">Rs.3,00,001 - 4,00,000</option>
                                        <option value="Rs.4,00,001 - 5,00,000">Rs.4,00,001 - 5,00,000</option>
                                        <option value="Rs.5,00,001 - 7,50,000">Rs.5,00,001 - 7,50,000</option>
                                        <option value="Rs.7,50,001 - 10,00,000">Rs.7,50,001 - 10,00,000</option>
                                        <option value="Rs.10,00,001 and above">Rs.10,00,001 and above</option>
</select>	

		</span>
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
  
  <script type="text/javascript">  
		   $("#part_religion_id").on('change', function()
		   {
			   
			$("#CasteDivloader").html('<img src="../images/loader/9.gif" align="absmiddle">&nbsp;Loading...');			
		    var selectedReligion = $("#part_religion_id").val() 
			var dataString = 'religion='+ selectedReligion;
			
						
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "../part_rel_caste.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
					
				$("#caste_id_chosen").remove();	
				$('#partCasteDiv').find('option').remove().end().append(response);
				
				$("#part_caste_id_chosen").remove();
				$("#CasteDivloader").html('');		
				 
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
			},			
			});		
		});	
    </script>