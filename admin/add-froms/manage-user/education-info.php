<?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';


	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;    

    $save_btn_text = "Save";


    $income = "";

    $edu_detail = "";

    $occupation = "";
	
	$emp_in = "";

   

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

			 

		    $edu_detail = $DatabaseCo->dbRow->edu_detail;

		    $occupation = $DatabaseCo->dbRow->occupation;

		    $income = $DatabaseCo->dbRow->income;
			
			$emp_in = $DatabaseCo->dbRow->emp_in;


  

	  }

	  $ACTION_MODE = "UPDATE";

	  $save_btn_text = "Update";

  }
  

	 

?> 
<link rel="stylesheet" href="./css/chosen.css">
<span class="field_marked">All Fields are required.</span>    

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/education-info.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"  class="form-data" id="add-form">

		<p class="cf">

	      <label><font id="star">*</font> 1. Education :</label>

	   <select name="education[]" data-placeholder="Select Multiple Education" class="chosen-select comboBox" multiple style="width:40% !important;">
                                         <?php
							$search_array = explode(',',$edu_detail);
			$edures1=mysql_query("select * from  education_detail where status='APPROVED'");
				while($row=mysql_fetch_array($edures1))	
						{
							?>
			<option value="<?php echo $row['edu_id']; ?>" <?php 
									if (in_array($row['edu_id'], $search_array)) 
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

	      <label><font id="star">*</font> 2. Occupation:</label>

	<select  class="comboBox" name="occupation" id="occupation">

              <option value="">Select Occupation</option>
              <?php $rescn2=mysql_query("select * from  occupation where status='APPROVED'");
								while($rowcc=mysql_fetch_array($rescn2))
								{
									
							?>
                <option value="<?php echo $rowcc['ocp_id']; ?>" <?php if($occupation==$rowcc['ocp_id']){ ?> selected="selected" <?php } ?>><?php echo ucfirst($rowcc['ocp_name']); ?></option>
							<?php
								}
							?>

            </select>

				</p>
                
                 <p class="cf">

	      <label><font id="star">*</font> 3. Annual Income:</label>

	<select class="comboBox" name="annual_income">
              <option value="<?php echo $income; ?>"><?php echo $income; ?></option>                                       <option value="Rs.10,000 - 50,000">Rs.10,000 - 50,000</option>
					<option value="Rs.50,000 - 1,00,000">Rs.50,000 - 1,00,000</option>
					<option value="Rs.1,00,000 - 2,00,000">Rs.1,00,000 - 2,00,000</option>
					<option value="Rs.2,00,000 - 5,00,000">Rs.2,00,000 - 5,00,000</option>
					<option value="Rs.5,00,000 - 10,00,000">Rs.5,00,000 - 10,00,000</option>
					<option value="Rs.10,00,000 - 50,00,000">Rs.10,00,000 - 50,00,000</option>
					<option value="Rs.50,00,000 - 1,00,00,000">Rs.50,00,000 - 1,00,00,000</option>
					<option value="Above Rs.1,00,00,000">Above Rs.1,00,00,000</option>
                                      </select>

				</p>
                
                 <p class="cf">

	      <label><font id="star">*</font> 4. Employed In:</label>

	  <select class="comboBox" name="emp_in">
   <option value="<?php echo $emp_in; ?>"><?php echo $emp_in; ?></option>                                                          
                        <option value="">Choose Employement</option>
                        <option value="Private">Private</option>
                        <option value="Government">Government</option>
                        <option value="Business">Business</option>
                        <option value="Defence">Defence</option>
                        <option value="Not Employed in">Not Employed in</option>
                        <option value="Others">Others</option>
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