<?php
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,family_details,family_type,family_status,father_name,father_occupation,
	mother_name,mother_occupation,family_origin,no_of_brothers,no_of_sisters,no_marri_brother,
	no_marri_sister from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	
	?>

       
<div class="modal-dialog">
  
    <div class="modal-content" style="overflow-y:scroll; overflow-x:hidden; height:500px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Family Details of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Family Details &nbsp;</label>
                            <div class="col-sm-4">
    <textarea  class="form-control" name="txtFamilyDetails" rows="2"><?php echo $DatabaseCo->dbRow->family_details; ?></textarea>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Family Type &nbsp;</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="txtFamilyType">
                                        
              <option value="Seperate Family" <?php if($DatabaseCo->dbRow->family_type=="Seperate Family"){ ?> selected="selected"<?php } ?>>Seperate Family</option>
             <option value="Joint Family" <?php if($DatabaseCo->dbRow->family_type=="Joint Family"){ ?> selected="selected"<?php } ?>>Joint Family</option>
                                      </select>
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Family Status&nbsp;</label>
                            <div class="col-sm-4" id="StateDiv">
                              
              <select class="form-control" name="txtFamilyStatus">
                                        <option value="Rich" <?php if($DatabaseCo->dbRow->family_status=="Rich"){ ?> selected="selected"<?php } ?>>Rich</option>
                                        <option value="Upper Middle Class" <?php if($DatabaseCo->dbRow->family_status=="Upper Middle Class"){ ?> selected="selected"<?php } ?> >Upper Middle Class</option>
                                        <option value="Middle Class" <?php if($DatabaseCo->dbRow->family_status=="Middle Class"){ ?> selected="selected"<?php } ?>>Middle Class</option>
                                        <option value="Lower Middle Class" <?php if($DatabaseCo->dbRow->family_status=="Lower Middle Class"){ ?> selected="selected"<?php } ?>>Lower Middle Class</option>
                                        <option value="Poor Family" <?php if($DatabaseCo->dbRow->family_status=="Poor Family"){ ?> selected="selected"<?php } ?>>Poor Family</option>
                                        
                                      </select> 
                            </div>
                           
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Family Origin&nbsp;</label>
                            <div class="col-sm-4" id="StateDiv">
                              
              <input type="text" name="family_origin" class="form-control" value="<?php echo $DatabaseCo->dbRow->family_origin; ?>" />
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Father Name&nbsp;</label>
                            <div class="col-sm-4" id="CityDiv">
                            <input type="text" name="txtFathername" class="form-control" value="<?php echo $DatabaseCo->dbRow->father_name; ?>" />
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Father Occupation&nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                            <input type="text" name="txtFathersoccupation" class="form-control" value="<?php echo $DatabaseCo->dbRow->father_occupation; ?>" />
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mother Name &nbsp;</label>
                            <div class="col-sm-4">
                           <input type="text" name="txtMothername" class="form-control" value="<?php echo $DatabaseCo->dbRow->mother_name; ?>"  />
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Mother Occupation&nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                              <input type="text" name="txtMothersoccupation" class="form-control" value="<?php echo $DatabaseCo->dbRow->mother_occupation; ?>"  />
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Total Brothers &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                     <select class="form-control" name="txtNoBrothers">
                                       
                                        <option value="0" <?php if($DatabaseCo->dbRow->no_of_brothers=="o"){ ?> selected="selected"<?php } ?>>0</option>
                                        <option value="1" <?php if($DatabaseCo->dbRow->no_of_brothers=="1"){ ?> selected="selected"<?php } ?>>1</option>
                                        <option value="2" <?php if($DatabaseCo->dbRow->no_of_brothers=="2"){ ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if($DatabaseCo->dbRow->no_of_brothers=="3"){ ?> selected="selected"<?php } ?>>3</option>
                                        <option value="4" <?php if($DatabaseCo->dbRow->no_of_brothers=="4"){ ?> selected="selected"<?php } ?>>4</option>
                                        <option value="4 +" <?php if($DatabaseCo->dbRow->no_of_brothers=="4 +"){ ?> selected="selected"<?php } ?>>4 +</option>
                                      </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Married Brothers  &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                    <select class="form-control" name="nbm">
                                        
                                        <option value="No married brother" <?php if($DatabaseCo->dbRow->no_marri_brother=="No married brother"){ ?> selected="selected"<?php } ?>>No married brother</option>
                                        <option value="One married brother" <?php if($DatabaseCo->dbRow->no_marri_brother=="One married brother"){ ?> selected="selected"<?php } ?>>One married brother</option>
                                        <option value="Two married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=="Two married brothers"){ ?> selected="selected"<?php } ?>>Two married brothers</option>
                                        <option value="Three married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=="Three married brothers"){ ?> selected="selected"<?php } ?>>Three married brothers</option>
                                        <option value="Four married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=="Four married brothers"){ ?> selected="selected"<?php } ?>>Four married brothers</option>
                                        <option value="Above four married brothers" <?php if($DatabaseCo->dbRow->no_marri_brother=="Above four married brothers"){ ?> selected="selected"<?php } ?>>Above four married brothers</option>
                                      </select>
                            </div>
                          </div>
                          
                          
                           <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Total Sisters &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                    <select name="txtnoofsisters" class="form-control">
                                     
                                        <option value="0" <?php if($DatabaseCo->dbRow->no_of_sisters=="o"){ ?> selected="selected"<?php } ?>>0</option>
                                        <option value="1" <?php if($DatabaseCo->dbRow->no_of_sisters=="1"){ ?> selected="selected"<?php } ?>>1</option>
                                        <option value="2" <?php if($DatabaseCo->dbRow->no_of_sisters=="2"){ ?> selected="selected"<?php } ?>>2</option>
                                        <option value="3" <?php if($DatabaseCo->dbRow->no_of_sisters=="3"){ ?> selected="selected"<?php } ?>>3</option>
                                        <option value="4" <?php if($DatabaseCo->dbRow->no_of_sisters=="4"){ ?> selected="selected"<?php } ?>>4</option>
                                        <option value="4 +" <?php if($DatabaseCo->dbRow->no_of_sisters=="4 +"){ ?> selected="selected"<?php } ?>>4 +</option>
                                      </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Married Sisiters &nbsp;&nbsp;</label>
                            <div class="col-sm-4">
                     <select name="nsm" class="form-control">
                                      
                                        <option value="No married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="No married sister"){ ?> selected="selected"<?php } ?>>No married sister</option>
                                        <option value="One married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="One married sister"){ ?> selected="selected"<?php } ?>>One married sister</option>
                                        <option value="Two married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="Two married sister"){ ?> selected="selected"<?php } ?>>Two married sister</option>
                                        <option value="Three married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="Three married sister"){ ?> selected="selected"<?php } ?>>Three married sister</option>
                                        <option value="Four married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="Four married sister"){ ?> selected="selected"<?php } ?>>Four married sister</option>
                                        <option value="Above four married sister" <?php if($DatabaseCo->dbRow->no_marri_sister=="Above four married sister"){ ?> selected="selected"<?php } ?>>Above four married sister</option>
                                      </select>
                            </div>
                          </div>
                                
                          
                          
                          
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-family-detail" value="submit" class="btn btn-success">
                            </div>
                          </div>
                        </form>
      
    </div>
  </div>
