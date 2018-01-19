<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,address,country_id,state_id,city,phone,mobile,residence,time_to_call  from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	
	?>
<link rel="stylesheet" href="css/validate.css">
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validetta.js" type="text/javascript"></script>
       
<div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Information of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Address  &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
    <textarea name="txtFullAddress" id="txtFullAddress" class="form-control" data-validetta="required"><?php echo $DatabaseCo->dbRow->address; ?></textarea>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Country &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                              <select class="form-control" name="txtCountry" id="txtCountry"onchange="GetState('ajax_search.php?countryId='+this.value);" data-validetta="required">
                      
                        <option value="">--Please select country--</option>
                     <?php
			$SQL_STATEMENT1 =  "SELECT * FROM country WHERE status='APPROVED'";
			$DatabaseCo1->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT1);
			while($DatabaseCo1->dbRow = mysql_fetch_object($DatabaseCo1->dbResult))
				{
			?>
			<option value="<?php echo $DatabaseCo1->dbRow->country_id; ?>" <?php if($DatabaseCo->dbRow->country_id==$DatabaseCo1->dbRow->country_id ){?> selected="selected" <?php }?>><?php echo $DatabaseCo1->dbRow->country_name; ?></option>
			<?php } ?>
                        
                                          </select>
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">State&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="StateDiv">
                              
              <select class="form-control" name="cbo1State" id="cbo1State" onchange="GetCity('ajax_search1.php?stateId='+this.value)"  data-validetta="required">
                                    <?php
							
                       		 $query="select * from state where state_id ='".$DatabaseCo->dbRow->state_id."'";
                        	 $result=mysql_query($query) or die(mysql_error());
								while($state=mysql_fetch_array($result))
								{
							?>
					<option value="<?php echo $state['state_id']; ?>" <?php if($DatabaseCo->dbRow->state_id==$state['state_id']){ ?> selected="selected" <?php } ?>><?php echo $state['state_name']; ?></option>
							<?php		
								}
							?> 
                       <option value="">--Select country first--</option>
                    </select> 
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">City &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="CityDiv">
                           <select class="form-control" name="cbo1City" id="cbo1City" data-validetta="required">
                     
                             <?php 
                       $query="select * from city where city_id = '".$DatabaseCo->dbRow->city."'";
                        $result=mysql_query($query) or die(mysql_error());
                        while($a=mysql_fetch_array($result)) 
                        {  
                        ?>
						<option value="<?php echo $a['city_id']?>" <?php if($DatabaseCo->dbRow->city==$a['city_id']){ ?> selected="selected" <?php } ?>><?php echo $a['city_name']?></option>
                        <?php
                        }
                        					
						?>
                    </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Residence Status   &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                            <select class="form-control" name="residence" id="residence">
                        <option value="Citizen" <?php if($DatabaseCo->dbRow->residence=="Citizen" ){?> selected="selected" <?php }?>>Citizen</option>
                        <option value="Permanent Resident" <?php if($DatabaseCo->dbRow->residence=="Permanent Resident" ){?> selected="selected" <?php }?>>Permanent Resident</option>
                        <option value="Student Visa" <?php if($DatabaseCo->dbRow->residence=="Student Visa" ){?> selected="selected" <?php }?>>Student Visa</option>
                        <option value="Temporary Visa" <?php if($DatabaseCo->dbRow->residence=="Temporary Visa" ){?> selected="selected" <?php }?>>Temporary Visa</option>
                        <option value="Work permit" <?php if($DatabaseCo->dbRow->residence=="Work permit" ){?> selected="selected" <?php }?>>Work permit</option>
                            
                    </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mobile &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                           <input type="text"  name="txtMobile" class="form-control" value="<?php echo $DatabaseCo->dbRow->mobile; ?>" data-validetta="required" />
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Phone &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                              <input type="text"  name="phone" value="<?php echo $DatabaseCo->dbRow->phone; ?>" class="form-control"/>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Time to call &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                     <input type="text" class="form-control" name="time_to_call" maxlength="30" value="<?php echo $DatabaseCo->dbRow->time_to_call; ?>" />
                            </div>
                          </div>
                                
                          
                          
                          
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-contact-detail" value="submit" class="btn btn-success">
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