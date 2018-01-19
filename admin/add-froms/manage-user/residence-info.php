 <?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';

	

	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

	



    $page_title = "Add New User";

    $save_btn_text = "Save";

	$address = "";

    $country_id = "";

    $state_id = "";

    $city = "";

    $residence = "";
	
	$mobile = "";
	
	$phone = "";
	
	$time_to_call = "";

   



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
		  	$address = $DatabaseCo->dbRow->address;
		  
            $country_id = $DatabaseCo->dbRow->country_id;

		    $state_id = $DatabaseCo->dbRow->state_id;

		    $city = $DatabaseCo->dbRow->city;

		    $residence = $DatabaseCo->dbRow->residence;  
			
			$mobile = $DatabaseCo->dbRow->mobile;  
			 
			$phone = $DatabaseCo->dbRow->phone;  
			  
			$time_to_call = $DatabaseCo->dbRow->time_to_call;  

	  }

	  $ACTION_MODE = "UPDATE";

	  $page_title = "Update Member ".$user_id;

	  $save_btn_text = "Update";

  }

  

	 

?>

<script type="text/javascript">
$(document).ready(function()
{
	
$("#country_id").change(function()
{
	$("#status1").html('<img src="../images/loader/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
	
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "../ajax_country_state.php",
data: dataString,
cache: false,
success: function(html)
{
$("#StateDiv").html(html);
$("#status1").html('');

} 
});

});


$("#StateDiv").change(function()
{
	$("#status2").html('<img src="../images/loader/9.gif" align="absmiddle">&nbsp;Loading Please wait...');
	var id=$(this).val();
var cnt_id=$("#country_id").val();
var dataString = 'state_id='+ id+'&country_id='+ cnt_id;

$.ajax
({
type: "POST",
url: "../ajax_country_state.php",
data: dataString,
cache: false,
success: function(html)
{
$("#city_id").html(html);
$("#status2").html('');

} 
});

});


});
</script>

<link rel="stylesheet" href="./css/chosen.css">
	 <span class="field_marked">* Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/residence-info.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"   class="form-data" id="add-form">



			 <p class="cf">

                <label><font id="star">*</font> 1. Address :</label>

      <textarea cols="70" rows="4" class="text-area" name="address" id="address"><?php echo $address; ?></textarea>

              </p>              


		<p class="cf">

	      <label><font id="star">*</font> 2. Country :</label>

	   <select class="comboBox" name="txtCountry" id="country_id">
                      
                        <option value="">--Please select country--</option>
                     <?php
			$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
			$DatabaseCo1->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1);
			while($DatabaseCo1->dbRow = mysql_fetch_object($DatabaseCo1->dbResult))
				{
			?>
			<option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" <?php if($country_id==$DatabaseCo1->dbRow->country_id ){?> selected="selected" <?php }?>><?php echo $DatabaseCo1->dbRow->country_name; ?></option>
			<?php } ?>
                        
                                          </select>
	      
&nbsp; <span id="status1"></span>
	      </p>

	    <p class="cf">

	      <label><font id="star">*</font> 3. State :</label>

	     <select class="comboBox" name="state" id="StateDiv" >
                                    <?php
				
          $query=mysql_fetch_array(mysql_query("select state_name from state where state_id ='".$state_id."'"));
                        
							?>
	<option value="<?php echo $state_id; ?>"><?php echo $query['state_name']; ?></option>
							
                       <option value="">--Select country first--</option>
                    </select> 
                    
                    &nbsp; <span id="status2"></span>
				</p>
                
                 <p class="cf">

	      <label><font id="star">*</font> 4. City :</label>

	     <select class="comboBox" name="city" id="city_id" >
                     <option value="">--Select state first--</option>
                             <?php 
                       
                   $query="select * from city where city_id = '".$city."'";
                        $result=mysql_query($query) or die(mysql_error());
                        while($a=mysql_fetch_array($result)) 
                        {  
                        ?>
						<option value="<?php echo $a['city_id']?>" <?php if($city==$a['city_id']){ ?> selected="selected" <?php } ?>><?php echo $a['city_name']?></option>
                        <?php
                        }
                        					
						?>
                    </select>
				</p>
				</p>
                

	   
	    <p class="cf">

	      <label>&nbsp; 5.  Residence status:</label>

	  <select  name="residence" id="residence"  class="comboBox" >
                            
                            
                        <option value="Citizen" <?php if($residence=='Citizen'){ echo "selected"; } ?>>Citizen</option>
                        
                        <option value="Permanent Resident" <?php if($residence=='Permanent Resident'){ echo "selected"; } ?>>Permanent Resident</option>
                        
                        <option value="Student Visa" <?php if($residence=='Student Visa'){ echo "selected"; } ?>>Student Visa</option>
                        
                        <option value="Temporary Visa" <?php if($residence=='Temporary Visa'){ echo "selected"; } ?>>Temporary Visa</option>
                        
                        <option value="Work Permit" <?php if($residence=='Work Permit'){ echo "selected"; } ?>>Work Permit</option>
                            
                    </select>

				</p>

	   
		 <p class="cf">

                <label><font id="star">*</font> 6. Mobile :</label>

                <input type="text" class="input-textbox" name="mobile" value="<?php echo $mobile;?>"/>

              </p>    
              
               <p class="cf">

                <label> 7. Phone :</label>

                <input type="text" class="input-textbox" name="phone" value="<?php echo $phone;?>"/>

              </p>    
              
               <p class="cf">

                <label> 8. Time to call :</label>

                <input type="text" class="input-textbox" name="time_to_call" value="<?php echo $time_to_call;?>"/>

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