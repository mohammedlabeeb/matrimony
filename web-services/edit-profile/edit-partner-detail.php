<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	

require_once '../../BusinessLogic/class.religion.php';
require_once("../../BusinessLogic/class.edu_detail.php");  

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
   $SQL_STATEMENT = "select username,looking_for,part_frm_age,part_to_age,part_income,	part_expect,part_height,part_height_to,part_complexation,part_mtongue,part_religion,part_caste,part_edu,part_country_living,part_resi_status from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	

$r5=new religion();
$rel321=$r5->get_religion_by_status();

$eduob=new edu_detail();
$edures2=$eduob->get_edu_by_status();
	
	
	?>
<link rel="stylesheet" href="css/chosen.css">
<link rel="stylesheet" href="css/validate.css">
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validetta.js" type="text/javascript"></script>
<script src="js/chosen.jquery.min.js" type="text/javascript"></script>
  	<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	
  </script>	
  
  
<div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Partner Preference of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Expectations &nbsp;</label>
                            <div class="col-sm-4">
    <textarea name="txtPPE" class="form-control" rows="1"><?php echo $DatabaseCo->dbRow->part_expect; ?></textarea>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Looking for  &nbsp;</label>
                            <div class="col-sm-4">
                              <select name="txtlooking[]" data-placeholder="Choose Looking for..." class="chosen-select form-control" multiple data-validetta="required">
                              
                               <?php 
							$search_array = explode(', ',$DatabaseCo->dbRow->looking_for);
							  
							  ?>
                              
                                    <option value="Unmarried" <?php if(in_array('Unmarried', $search_array)){ echo "selected"; } ?>>Unmarried</option>
                                    
                                    <option value="Widow/Widower" <?php if(in_array('Widow/Widower', $search_array)){ echo "selected"; } ?>>Widow/Widower</option>
                                    
                                    <option value="Divorcee" <?php if(in_array('Divorcee', $search_array)){ echo "selected"; } ?>>Divorcee</option>
                                    
                                    <option value="Separated" <?php if(in_array('Separated', $search_array)){ echo "selected"; } ?>>Separated</option>
                                    
                                </select>
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Age Preference&nbsp;</label>
                            <div class="col-sm-2">
                              <select class="form-control" name="Fromage">
                         
 <option value="<?php echo $DatabaseCo->dbRow->part_frm_age;?>"><?php echo $DatabaseCo->dbRow->part_frm_age;?></option>           
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
                                                                                <option value="37">37</option>
                                                                                <option value="38">38</option>
                                                                                <option value="39">39</option>
                                                                                <option value="40">40</option>
                                                                                <option value="41">41</option>
                                                                                <option value="42">42</option>
                                                                                <option value="43">43</option>
                                                                                <option value="44">44</option>
                                                                                <option value="45">45</option>
                                                                                <option value="46">46</option>
                                                                                <option value="47">47</option>
                                                                                <option value="48">48</option>
                                                                                <option value="49">49</option>
                                                                                <option value="50">50</option>
                                                                                <option value="51">51</option>
                                                                                <option value="52">52</option>
                                                                                <option value="53">53</option>
                                                                                <option value="54">54</option>
                                                                                <option value="55">55</option>
                                                                                <option value="56">56</option>
                                                                                <option value="57">57</option>
                                                                                <option value="58">58</option>
                                                                                <option value="59">59</option>
                                                                              </select>
               
                            </div>
                            <div class="col-sm-1">
                            <label>To</label>
                            </div>
                             <div class="col-sm-2">
                              <select class="form-control" name="ToAge">
 <option value="<?php echo $DatabaseCo->dbRow->part_to_age;?>"><?php echo $DatabaseCo->dbRow->part_to_age;?></option>        
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
                                                                                <option value="37">37</option>
                                                                                <option value="38">38</option>
                                                                                <option value="39">39</option>
                                                                                <option value="40">40</option>
                                                                                <option value="41">41</option>
                                                                                <option value="42">42</option>
                                                                                <option value="43">43</option>
                                                                                <option value="44">44</option>
                                                                                <option value="45">45</option>
                                                                                <option value="46">46</option>
                                                                                <option value="47">47</option>
                                                                                <option value="48">48</option>
                                                                                <option value="49">49</option>
                                                                                <option value="50">50</option>
                                                                                <option value="51">51</option>
                                                                                <option value="52">52</option>
                                                                                <option value="53">53</option>
                                                                                <option value="54">54</option>
                                                                                <option value="55">55</option>
                                                                                <option value="56">56</option>
                                                                                <option value="57">57</option>
                                                                                <option value="58">58</option>
                                                                                <option value="59">59</option>
                                                                                <option value="60">60</option>
                                                                              </select>
               
                            </div>
                           
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Height&nbsp;</label>
                            <div class="col-sm-2">
                              
           					 <select name="txtPHeight" class="form-control">
         <option value="<?php echo $DatabaseCo->dbRow->part_height;?>"><?php echo $DatabaseCo->dbRow->part_height;?></option>
                     <option  value="">Does not Matter</option>
                      <option value="Below 4ft 6in - 137cm">Below 4ft 6in - 137cm</option>
                      <option value="4ft 6in - 137cm">4ft 6in - 137cm</option>
                      <option value="4ft 7in - 139cm">4ft 7in - 139cm</option>
                      <option value="4ft 8in - 142cm">4ft 8in - 142cm</option>
                      <option value="4ft 9in - 144cm">4ft 9in - 144cm</option>
                      <option value="4ft 10in - 147cm">4ft 10in - 147cm</option>
                      <option value="4ft 11in - 149cm">4ft 11in - 149cm</option>
                      <option value="5ft - 152cm">5ft - 152cm</option>
                      <option value="5ft 1in - 154cm">5ft 1in - 154cm</option>
                      <option value="5ft 2in - 157cm">5ft 2in - 157cm</option>
                      <option value="5ft 3in - 160cm">5ft 3in - 160cm</option>
                      <option value="5ft 4in - 162cm">5ft 4in - 162cm</option>
                      <option value="5ft 5in - 165cm">5ft 5in - 165cm</option>
                      <option value="5ft 6in - 167cm">5ft 6in - 167cm</option>
                      <option value="5ft 7in - 170cm">5ft 7in - 170cm</option>
                      <option value="5ft 8in - 172cm">5ft 8in - 172cm</option>
                      <option value="5ft 9in - 175cm">5ft 9in - 175cm</option>
                      <option value="5ft 10in - 177cm">5ft 10in - 177cm</option>
                      <option value="5ft 11in - 180cm">5ft 11in - 180cm</option>
                      <option value="6ft - 182cm">6ft - 182cm</option>
                      <option value="6ft 1in - 185cm">6ft 1in - 185cm</option>
                      <option value="6ft 2in - 187cm">6ft 2in - 187cm</option>
                      <option value="6ft 3in - 190cm">6ft 3in - 190cm</option>
                      <option value="6ft 4in - 193cm">6ft 4in - 193cm</option>
                      <option value="6ft 5in - 195cm">6ft 5in - 195cm</option>
                      <option value="6ft 6in - 198cm">6ft 6in - 198cm</option>
                      <option value="6ft 7in - 200cm">6ft 7in - 200cm</option>
                      <option value="6ft 8in - 203cm">6ft 8in - 203cm</option>
                      <option value="6ft 9in - 205cm">6ft 9in - 205cm</option>
                      <option value="6ft 10in - 208cm">6ft 10in - 208cm</option>
                      <option value="6ft 11in - 210cm">6ft 11in - 210cm</option>
                      <option value="7ft - 213cm">7ft - 213cm</option>
                      <option value="Above 7ft - 213cm">Above 7ft - 213cm</option>
                                         </select>
                            </div>
                            <div class="col-sm-1">
                			<label>To</label>
                			</div>
                             <div class="col-sm-2">
                              <select name="txtPReS" class="form-control" id="txtCitizen" >
<option value="<?php echo $DatabaseCo->dbRow->part_height_to;?>"><?php echo $DatabaseCo->dbRow->part_height_to;?></option>
					  <option value="Below 4ft 6in - 137cm">Below 4ft 6in - 137cm</option>
                      <option value="4ft 6in - 137cm">4ft 6in - 137cm</option>
                      <option value="4ft 7in - 139cm">4ft 7in - 139cm</option>
                      <option value="4ft 8in - 142cm">4ft 8in - 142cm</option>
                      <option value="4ft 9in - 144cm">4ft 9in - 144cm</option>
                      <option value="4ft 10in - 147cm">4ft 10in - 147cm</option>
                      <option value="4ft 11in - 149cm">4ft 11in - 149cm</option>
                      <option value="5ft - 152cm">5ft - 152cm</option>
                      <option value="5ft 1in - 154cm">5ft 1in - 154cm</option>
                      <option value="5ft 2in - 157cm">5ft 2in - 157cm</option>
                      <option value="5ft 3in - 160cm">5ft 3in - 160cm</option>
                      <option value="5ft 4in - 162cm">5ft 4in - 162cm</option>
                      <option value="5ft 5in - 165cm">5ft 5in - 165cm</option>
                      <option value="5ft 6in - 167cm">5ft 6in - 167cm</option>
                      <option value="5ft 7in - 170cm">5ft 7in - 170cm</option>
                      <option value="5ft 8in - 172cm">5ft 8in - 172cm</option>
                      <option value="5ft 9in - 175cm">5ft 9in - 175cm</option>
                      <option value="5ft 10in - 177cm">5ft 10in - 177cm</option>
                      <option value="5ft 11in - 180cm">5ft 11in - 180cm</option>
                      <option value="6ft - 182cm">6ft - 182cm</option>
                      <option value="6ft 1in - 185cm">6ft 1in - 185cm</option>
                      <option value="6ft 2in - 187cm">6ft 2in - 187cm</option>
                      <option value="6ft 3in - 190cm">6ft 3in - 190cm</option>
                      <option value="6ft 4in - 193cm">6ft 4in - 193cm</option>
                      <option value="6ft 5in - 195cm">6ft 5in - 195cm</option>
                      <option value="6ft 6in - 198cm">6ft 6in - 198cm</option>
                      <option value="6ft 7in - 200cm">6ft 7in - 200cm</option>
                      <option value="6ft 8in - 203cm">6ft 8in - 203cm</option>
                      <option value="6ft 9in - 205cm">6ft 9in - 205cm</option>
                      <option value="6ft 10in - 208cm">6ft 10in - 208cm</option>
                      <option value="6ft 11in - 210cm">6ft 11in - 210cm</option>
                      <option value="7ft - 213cm">7ft - 213cm</option>
                      <option value="Above 7ft - 213cm">Above 7ft - 213cm</option>
                                          </select>
               
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Complexion&nbsp;</label>
                            <div class="col-sm-4" id="CityDiv">
                           <select name="txtComplexion[]" data-placeholder="Choose Complexion" class="chosen-select form-control" multiple>
                       <?php $search_array1 = explode(', ',$DatabaseCo->dbRow->part_complexation);?>                   
                                        
                                       
                      <option value="Very Fair" <?php if(in_array('Very Fair', $search_array1)){ echo "selected"; } ?>>Very Fair</option>
                      
                      <option value="Fair" <?php if(in_array('Fair', $search_array1)){ echo "selected"; } ?>>Fair</option>
                      
                      <option value="Wheatish" <?php if(in_array('Wheatish', $search_array1)){ echo "selected"; } ?>>Wheatish</option>
                      
                      <option value="Wheatish Brown" <?php if(in_array('Wheatish Brown', $search_array1)){ echo "selected"; } ?>>Wheatish Brown</option>
                      
                      <option value="Dark" <?php if(in_array('Dark', $search_array1)){ echo "selected"; } ?>>Dark</option>
                                      </select>
                            </div>
                          </div>
                         <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mother Tongue&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                            <select data-placeholder="Choose Mother Tongue" class="chosen-select form-control" multiple name="part_m_tongue[]" id="part_m_tongue" data-validetta="required" >
<option value="<?php echo $DatabaseCo->dbRow->part_mtongue;?>"><?php echo $DatabaseCo->dbRow->part_mtongue_name;?></option>
                     <?php 
			$search_arr2 = explode(',',$DatabaseCo->dbRow->part_mtongue);		 
					 
		    $sel =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
		    $fetchrow->dbResult=$DatabaseCo->getSelectQueryResult($sel);
		    while($fetch->dbRow1 = mysql_fetch_object($fetchrow->dbResult))
		    {
				
		    ?>
     <option value="<?php echo $fetch->dbRow1->mtongue_id; ?>" <?php 
									if (in_array($fetch->dbRow1->mtongue_id, $search_arr2)) 
									{
										echo "selected";
									}
									?>><?php echo $fetch->dbRow1->mtongue_name; ?></option>
		    <?php } ?>
                        </select>
                            </div>
                          </div> 
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Country Living in&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="CityDiv">
                            <select name="txtPcountry[]" id="txtPcountry" data-validetta="required" class="chosen-select form-control" multiple>
                                   
                                        
                     <?php
			$search_array3 = explode(',',$DatabaseCo->dbRow->part_country_living);
			$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
			$DatabaseCo1->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1);
			while($DatabaseCo1->dbRow = mysql_fetch_object($DatabaseCo1->dbResult))
				{
			?>
			<option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" 
			<?php 
				if (in_array($DatabaseCo1->dbRow->country_id, $search_array3)) 
									{
										echo "selected";
									}
									?>><?php echo $DatabaseCo1->dbRow->country_name; ?></option>
			<?php } ?>
                                    </select>
                            </div>
                          </div>
                          
                          
                          
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Religion &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                          <select  name="txtreligion[]" id="part_religion_id" data-placeholder=" Select multiple religion"  class="form-control chosen-select" multiple data-validetta="required">
                                        <?php
		$search_array5 = explode(',',$DatabaseCo->dbRow->part_religion);
									
								while($row=mysql_fetch_array($rel321))
								{
							?>
	<option value="<?php echo $row['religion_id']; ?>" 
	<?php if (in_array($row['religion_id'], $search_array5)) 
									{
										echo "selected";
									}
									?>><?php echo $row['religion_name']; ?></option>
							<?php		
								}
							?> 
                                      </select>
                            </div>
                            &nbsp; <div id="CasteDivloader"></div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Caste&nbsp;&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="partCasteDiv">
                             <select class="form-control" name="part_caste_id[]" id="caste_id"   data-validetta="required" >
                       <option value="<?php echo $DatabaseCo->dbRow->part_caste; ?>"><?php $a=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_caste FROM register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste ) >0 WHERE a.matri_id='$s_id'  GROUP BY a.part_caste"));
				echo $a['part_caste'];?>
                    </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Resident Status &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                     <select class="form-control" name="residence" id="residence">
                        <option value="Citizen" <?php if($DatabaseCo->dbRow->part_resi_status=="Citizen" ){?> selected="selected" <?php }?>>Citizen</option>
                        <option value="Permanent Resident" <?php if($DatabaseCo->dbRow->part_resi_status=="Permanent Resident" ){?> selected="selected" <?php }?>>Permanent Resident</option>
                        <option value="Student Visa" <?php if($DatabaseCo->dbRow->part_resi_status=="Student Visa" ){?> selected="selected" <?php }?>>Student Visa</option>
                        <option value="Temporary Visa" <?php if($DatabaseCo->dbRow->part_resi_status=="Temporary Visa" ){?> selected="selected" <?php }?>>Temporary Visa</option>
                        <option value="Work permit" <?php if($DatabaseCo->dbRow->part_resi_status=="Work permit" ){?> selected="selected" <?php }?>>Work permit</option>
                            
                    </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Education &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                     <select name="txtEducation[]" data-validetta="required" data-placeholder="Choose Education" class="chosen-select form-control" multiple>
                                        <?php
				$search_array6 = explode(',',$DatabaseCo->dbRow->part_edu);
								while($row=mysql_fetch_array($edures2))
								{
							?>
			<option value="<?php echo $row['edu_id']; ?>" <?php 
									if (in_array($row['edu_id'], $search_array6)) 
									{
										echo "selected";
									}
									?>><?php echo $row['edu_name']; ?></option>
							<?php		
								}
							?> 
                                      </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Annual income&nbsp;</label>
                            <div class="col-sm-4">
                              
              <select class="form-control" name="part_income">
      <option value="<?php echo $DatabaseCo->dbRow->part_income; ?>"><?php echo $DatabaseCo->dbRow->part_income; ?></option>                                                          
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
                            </div>
                           
                          </div>
                         
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-partner-detail" value="submit" class="btn btn-success">
                            </div>
                          </div>
                        </form>
      
    </div>
  </div>


<script type="text/javascript">
    $(function(){
    	$('#reg_form').validetta({
    		errorClose : false,
			custom : {
    			regname : {
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Custom Reg Error Message !'
    			},
                // you can add more
    			example : { 
    				pattern : /^[\+][0-9]+?$|^[0-9]+?$/,
    				errorMessage : 'Lan mal !'
    			}
    		},
            realTime : true
    	});	 
	
		
    });
    </script>
    
    <script type="text/javascript">  
		   $("#part_religion_id").on('change', function()
		   {
			   
			$("#CasteDivloader").html('<img src="images/loader/9.gif" align="absmiddle">&nbsp;Loading...');			
		    var selectedReligion = $("#part_religion_id").val() 
			var dataString = 'religion='+ selectedReligion;
			
						
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "part_rel_caste.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:dataString,			
			success:function(response)
			{
					
				$("#caste_id").remove();	
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