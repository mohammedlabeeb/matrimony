<?php
	error_reporting(0);
	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';

	
	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    $page_title = "Add New Member";

    $save_btn_text = "Save";    

    $profile_text = "";
    $hobby = "";		
	$txtFamilyDetails = "";
	$txtFamilyStatus = "";
	$txtFamilyType = "";
	$family_origin = "";
	$txtFathername = "";
	$txtFathersoccupation = "";
	$txtMothername = "";
	$txtMothersoccupation = "";
	$txtNoBrothers = "";
	$nbm = "";
	$txtnoofsisters = "";
	$nsm = "";

    


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

	  $SQL_STATEMENT2 = "SELECT * FROM register where index_id=".$user_id;

	  $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);

					  

	  while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))

	  {
		    		$profile_text = $DatabaseCo->dbRow->profile_text;
                    $hobby = $DatabaseCo->dbRow->hobby;   
					$txtFamilyDetails = $DatabaseCo->dbRow->family_details; 
					$txtFamilyStatus =$DatabaseCo->dbRow->family_status; 
					$txtFamilyType = $DatabaseCo->dbRow->family_type; 
					$family_origin = $DatabaseCo->dbRow->family_origin; 
					$txtFathername = $DatabaseCo->dbRow->father_name; 
					$txtFathersoccupation =$DatabaseCo->dbRow->father_occupation; 
					$txtMothername =$DatabaseCo->dbRow->mother_name; 
					$txtMothersoccupation = $DatabaseCo->dbRow->mother_occupation; 
					$txtNoBrothers = $DatabaseCo->dbRow->no_of_brothers; 
					$nbm =$DatabaseCo->dbRow->no_marri_brother; 
					$txtnoofsisters = $DatabaseCo->dbRow->no_of_sisters; 
					$nsm = $DatabaseCo->dbRow->no_marri_sister;           

	  }

	  $ACTION_MODE = "UPDATE";

	  $page_title = "Update Member ".$user_id;

	  $save_btn_text = "Update";

  }

  

	 

?>
<style type="text/css">
.form-data label {
    color: #3c3c3c;
    display: block;
    float: left;
    font-family: 'helvetica_neueregular';
    font-size: 14px;
    line-height: 27px;
    margin-right: 17px;
    text-align: right;
    width: 250px;
}
</style>
<span class="field_marked">* Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/other-info.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"  class="form-data" id="add-form">

              <p class="cf">

                <label><font id="star">*</font> 1. Profile text:</label>

                <textarea cols="70" rows="4" class="text-area" name="about_me" id="about_me"><?php echo $profile_text ;?></textarea>

              </p>              

      <p class="cf">

                <label> 2. Hobby :</label>

               <textarea cols="70" rows="4" class="text-area" name="hobby" id="hobby"><?php echo $hobby ;?></textarea>

          
              
       </p>
        <h4>
      Family Details
       </h4>
       
        <p class="cf">

                <label>3. Family Details  </label>

				 <textarea cols="70" rows="4" class="text-area" name="fam_details" id="fam_details"><?php echo $txtFamilyDetails ;?></textarea>
                
          
              </p>
              
          <p class="cf">

                <label>4.  Family Type   </label>

				 <select class="comboBox" name="txtFamilyType">
                                        
             <option value="Seperate Family" <?php if($txtFamilyType=="Seperate Family"){ ?> selected="selected"<?php } ?>>Seperate Family</option>
             <option value="Joint Family" <?php if($txtFamilyType=="Joint Family"){ ?> selected="selected"<?php } ?>>Joint Family</option>
                                      </select>
                
          
              </p>  
              
          <p class="cf">

                <label>5.   Family Status   </label>

				<select class="comboBox" name="txtFamilyStatus">
                                        <option value="Rich" <?php if($txtFamilyStatus=="Rich"){ ?> selected="selected"<?php } ?>>Rich</option>
                                        <option value="Upper Middle Class" <?php if($txtFamilyStatus=="Upper Middle Class"){ ?> selected="selected"<?php } ?> >Upper Middle Class</option>
                                        <option value="Middle Class" <?php if($txtFamilyStatus=="Middle Class"){ ?> selected="selected"<?php } ?>>Middle Class</option>
                                        <option value="Lower Middle Class" <?php if($txtFamilyStatus=="Lower Middle Class"){ ?> selected="selected"<?php } ?>>Lower Middle Class</option>
                                        <option value="Poor Family" <?php if($txtFamilyStatus=="Poor Family"){ ?> selected="selected"<?php } ?>>Poor Family</option>
                                        
                                      </select> 
                
          
              </p> 
              
          <p class="cf">

                <label>6.   Family Origin   </label>

				<input type="text" name="family_origin" class="input-textbox" value="<?php echo $family_origin; ?>" />
                
          
              </p>
              
            <p class="cf">

                <label>7.   Father Name    </label>

				<input type="text" name="father_name" class="input-textbox" value="<?php echo $txtFathername; ?>" />
                
          
              </p>
             <p class="cf">

                <label>8.   Father Occupation     </label>

				<input type="text" name="father_ocp" class="input-textbox" value="<?php echo $txtFathersoccupation; ?>" />
                
          
              </p>
              
               <p class="cf">

                <label>9.  Mother Name    </label>

				 <input type="text" name="mother_name" class="input-textbox" value="<?php echo $txtMothername; ?>" />
                
          
              </p>
             <p class="cf">

                <label>10.   Mother Occupation  </label>

				 <input type="text" name="mother_ocp" class="input-textbox" value="<?php echo $txtMothersoccupation; ?>" />
                
          
              </p>
              <p class="cf">

                <label>11.  Total Brothers </label>

				<select class="comboBox" name="txtNoBrothers">
                                       
                                        <option value="0" <?php if($txtNoBrothers=="o"){ ?> selected="selected"<?php } ?>>0</option>
                                        <option value="1" <?php if($txtNoBrothers=="1"){ ?> selected="selected"<?php } ?>>1</option>
                                        <option value="2" <?php if($txtNoBrothers=="2"){ ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if($txtNoBrothers=="3"){ ?> selected="selected"<?php } ?>>3</option>
                                        <option value="4" <?php if($txtNoBrothers=="4"){ ?> selected="selected"<?php } ?>>4</option>
                                        <option value="4 +" <?php if($txtNoBrothers=="4 +"){ ?> selected="selected"<?php } ?>>4 +</option>
                                      </select>
                
          
              </p>  
              <p class="cf">

                <label>12.  Married Brothers  </label>

				 <select class="comboBox" name="nbm">
                                        
                                        <option value="No married brother" <?php if($nbm=="No married brother"){ ?> selected="selected"<?php } ?>>No married brother</option>
                                        <option value="One married brother" <?php if($nbm=="One married brother"){ ?> selected="selected"<?php } ?>>One married brother</option>
                                        <option value="Two married brothers" <?php if($nbm=="Two married brothers"){ ?> selected="selected"<?php } ?>>Two married brothers</option>
                                        <option value="Three married brothers" <?php if($nbm=="Three married brothers"){ ?> selected="selected"<?php } ?>>Three married brothers</option>
                                        <option value="Four married brothers" <?php if($nbm=="Four married brothers"){ ?> selected="selected"<?php } ?>>Four married brothers</option>
                                        <option value="Above four married brothers" <?php if($nbm=="Above four married brothers"){ ?> selected="selected"<?php } ?>>Above four married brothers</option>
                                      </select>
                
          
              </p>  
              <p class="cf">

                <label>13.  Total Sisters  </label>

				<select name="txtnoofsisters" class="comboBox">
                                     
                                        <option value="0" <?php if($txtnoofsisters=="o"){ ?> selected="selected"<?php } ?>>0</option>
                                        <option value="1" <?php if($txtnoofsisters=="1"){ ?> selected="selected"<?php } ?>>1</option>
                                        <option value="2" <?php if($txtnoofsisters=="2"){ ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if($txtnoofsisters=="3"){ ?> selected="selected"<?php } ?>>3</option>
                                        <option value="4" <?php if($txtnoofsisters=="4"){ ?> selected="selected"<?php } ?>>4</option>
                                        <option value="4 +" <?php if($txtnoofsisters=="4 +"){ ?> selected="selected"<?php } ?>>4 +</option>
                                      </select>
                
          
              </p>  
              <p class="cf">

                <label>14.  Married Sisiters   </label>

				 <select name="nsm" class="comboBox">
                                      
                                        <option value="No married sister" <?php if($nsm=="No married sister"){ ?> selected="selected"<?php } ?>>No married sister</option>
                                        <option value="One married sister" <?php if($nsm=="One married sister"){ ?> selected="selected"<?php } ?>>One married sister</option>
                                        <option value="Two married sister" <?php if($nsm=="Two married sister"){ ?> selected="selected"<?php } ?>>Two married sister</option>
                                        <option value="Three married sister" <?php if($nsm=="Three married sister"){ ?> selected="selected"<?php } ?>>Three married sister</option>
                                        <option value="Four married sister" <?php if($nsm=="Four married sister"){ ?> selected="selected"<?php } ?>>Four married sister</option>
                                        <option value="Above four married sister" <?php if($nsm=="Above four married sister"){ ?> selected="selected"<?php } ?>>Above four married sister</option>
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
    