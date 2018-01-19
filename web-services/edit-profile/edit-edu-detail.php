<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
require_once("../../BusinessLogic/class.edu_detail.php");
require_once("../../BusinessLogic/class.occupation.php");
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,edu_detail,occupation,emp_in,income from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	$eduob=new edu_detail();
$edures1=$eduob->get_edu_by_status();

$ocpob=new occupation();
$ocpres=$ocpob->get_ocp_by_status();
	
	
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
        <h4 class="modal-title" id="myModalLabel">Educational Information of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Education  &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                               <select name="txtEducation[]" data-validetta="required" data-placeholder="Choose  Education..." class="chosen-select form-control" multiple>
                                        <?php
							$search_array = explode(',',$DatabaseCo->dbRow->edu_detail);			
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
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Occupation &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="CasteDiv">
                             <select class="form-control" name="txtOccupation" data-validetta="required">
                                       
                                        <?php
								while($row=mysql_fetch_array($ocpres))
								{
							?>
								<option value="<?php echo $row['ocp_id']; ?>" <?php if($DatabaseCo->dbRow->occupation==$row['ocp_id']){ ?> selected="selected" <?php } ?>><?php echo $row['ocp_name']; ?></option>
							<?php		
								}
							?>
                                      </select>
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Annual income&nbsp;</label>
                            <div class="col-sm-4">
                              
              <select class="form-control" name="txtAnnualincome">
      <option value="<?php echo $DatabaseCo->dbRow->income; ?>"><?php echo $DatabaseCo->dbRow->income; ?></option>                                                          
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
                            <label for="inputPassword3" class="col-sm-4 control-label">Employed In &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                            <select class="form-control" name="txtempin">
   <option value="<?php echo $DatabaseCo->dbRow->emp_in; ?>"><?php echo $DatabaseCo->dbRow->emp_in; ?></option>
                        <option value="Choose Employement">Choose Employement</option>
                        <option value="Private">Private</option>
                        <option value="Government">Government</option>
                        <option value="Business">Business</option>
                        <option value="Defence">Defence</option>
                        <option value="Not Employed in">Not Employed in</option>
                        <option value="Others">Others</option>
                        </select>
                            </div>
                          </div>
                          
                          
                          
                          
                          
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-edu-detail" value="submit" class="btn btn-success">
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
