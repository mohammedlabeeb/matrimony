<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,firstname,lastname,m_status,m_tongue,birthplace,birthdate,birthtime,reference,profileby from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	
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
        <h4 class="modal-title" id="myModalLabel">Basic Information of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">First name&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                              <input type="text" name="fname" class="form-control" id="fname"  value="<?php echo $DatabaseCo->dbRow->firstname; ?>" data-validetta="required">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Last name&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                              <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $DatabaseCo->dbRow->lastname; ?>" data-validetta="required" >
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Marital Status&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-8">
                              
               <input name="m_status" checked="checked" class="radio-inline" type="radio" value="Unmarried"  <?php if($DatabaseCo->dbRow->m_status=="Unmarried" ){?> checked="checked" <?php }?> />
                  Unmarried &nbsp;
                  <input name="m_status" class="radio-inline" type="radio" value="Widow/Widower" <?php if($DatabaseCo->dbRow->m_status=="Widow/Widower" ){?> checked="checked" <?php }?>>
                  Widow/Widower &nbsp;
                  <input name="m_status" class="radio-inline" type="radio" value="Divorcee" <?php if($DatabaseCo->dbRow->m_status=="Divorcee" ){?> checked="checked" <?php }?>>
                  Divorcee  &nbsp;
                  <input name="m_status" class="radio-inline" type="radio" value="Separated" <?php if($DatabaseCo->dbRow->m_status=="Separated" ){?> checked="checked" <?php }?>>
                  Separated
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mothertongue&nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                              <select  name="mtongue[]" id="mtongue" data-validetta="required"  data-placeholder="Choose Mother Tongue" class="chosen-select form-control" multiple>
                             
                     <?php
			 $search_arr1 = explode(',',$DatabaseCo->dbRow->m_tongue);		 
		    $SQL_STATEMENT =  "SELECT * FROM mothertongue WHERE status='APPROVED' ORDER BY mtongue_name ASC";
		    $DatabaseCoo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		    while($DatabaseCoo->dbRow = mysql_fetch_object($DatabaseCoo->dbResult))
		    {
		    ?>
		    <option value="<?php echo $DatabaseCoo->dbRow->mtongue_id; ?>" <?php 
									if (in_array($DatabaseCoo->dbRow->mtongue_id, $search_arr1)) 
									{
										echo "selected";
									}
									?>><?php echo $DatabaseCoo->dbRow->mtongue_name; ?></option>
		    <?php } ?>
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Place Of Birth</label>
                            <div class="col-sm-4">
         <input type="text" class="form-control" name="birthplace" id="birthplace" value="<?php echo $DatabaseCo->dbRow->birthplace; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Reference</label>
                            <div class="col-sm-4">
                             <select class="form-control"  name="reference" id="reference">
  <option value="<?php echo $DatabaseCo->dbRow->reference; ?>"><?php echo $DatabaseCo->dbRow->reference; ?></option> 
		    						<option value="Advertisements">Advertisements</option>
		    						<option value="Friends">Friends</option>
                   					<option value="Searh Engines">Searh Engines</option>
                   					<option value="Others">Others</option>
                            </select>
                            </div>
                          </div>
                          
                          
                           <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Profile Created by</label>
                            <div class="col-sm-4">
                             <select class="form-control"   name="profileby" id="profileby">
                          <option value="<?php echo $DatabaseCo->dbRow->profileby; ?>"><?php echo $DatabaseCo->dbRow->profileby; ?></option> 
                                        <option value="Self">Self</option>
                                        <option value="Parents">Parents</option>
                                        <option value="Guardian">Guardian</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Sibling">Sibling</option>
                                        <option value="Relatives">Relatives</option>
                            </select>
                            </div>
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Birth Time</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" name="birthtime" id="birthtime" value="<?php echo $DatabaseCo->dbRow->birthtime; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-basic-detail" value="submit" class="btn btn-success">
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