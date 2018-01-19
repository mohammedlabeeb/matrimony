<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,religion,caste,caste_name,subcaste,horoscope,manglik,gothra,star,moonsign,profileby from register_view where matri_id='$s_id'";
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
        <h4 class="modal-title" id="myModalLabel">Socio Religious Information of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="reg_form" id="reg_form" class="form-horizontal" action="" method="post">
       
             
                          <div class="form-group" style="margin-top:10px;">
                            <label for="inputEmail3" class="col-sm-4 control-label">Religion &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4">
                              <select class="form-control" name="religion_id" id="religion_id" onchange="GetCaste('ajax_search2.php?religionId='+this.value)" data-validetta="required" >
                      <option value="">--Please select Religion--</option>
                     <?php
		    $SQL_STATEMENT =  "SELECT * FROM religion WHERE status='APPROVED' ORDER BY religion_name ASC";
		    $rel->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		    while($religion->dbRow = mysql_fetch_object($rel->dbResult))
		    {
		    ?>
		    <option value="<?php echo $religion->dbRow->religion_id; ?>" <?php if($DatabaseCo->dbRow->religion==$religion->dbRow->religion_id ){?> selected="selected" <?php }?>><?php echo $religion->dbRow->religion_name; ?></option>
		    <?php } ?>
                        </select>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Caste &nbsp;<font class="text-danger">*</font></label>
                            <div class="col-sm-4" id="CasteDiv">
                             <select class="form-control" name="caste_id" id="caste_id"   data-validetta="required" >
                      <option value="<?php echo $DatabaseCo->dbRow->caste; ?>"><?php echo $DatabaseCo->dbRow->caste_name; ?></option>            
                    <option value="">--Select Religion first--</option>
                    </select> 
                            </div>
                          </div>
                                      
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Sub caste&nbsp;</label>
                            <div class="col-sm-4">
                              
                <input type="text" class="form-control" name="subcaste" id="subcaste" value="<?php echo $DatabaseCo->dbRow->subcaste; ?>">
                            </div>
                           
                          </div>
                          
                          <div class="form-group">
                            <label for="inputPassword3" class="col-sm-4 control-label">Horoscope &nbsp;&nbsp;</label>
                            <div class="col-sm-6">
                              <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="Yes" <?php if($DatabaseCo->dbRow->horoscope=="Yes" ){?> checked="checked" <?php }?>>
                                      Yes &nbsp;
                                      <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="No" <?php if($DatabaseCo->dbRow->horoscope=="No" ){?> checked="checked" <?php }?>>
                                      No &nbsp;
                                      <input name="horoscope" class="radio-inline" id="horoscope" type="radio" value="Does Not Matter" <?php if($DatabaseCo->dbRow->horoscope=="Does Not Matter" ){?> checked="checked" <?php }?>>
                                      Does Not Matter  &nbsp;
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Manglik </label>
                            <div class="col-sm-6">
        <input name="manglik" id="manglik" type="radio" class="radio-inline" value="Yes" <?php if($DatabaseCo->dbRow->manglik=="Yes" ){?> checked="checked" <?php }?>>
                                      Yes &nbsp;
                                      <input name="manglik" class="radio-inline" id="manglik" type="radio" value="No" <?php if($DatabaseCo->dbRow->manglik=="No" ){?> checked="checked" <?php }?>>
                                      No &nbsp;
                                      <input name="manglik" class="radio-inline" id="manglik" type="radio" value="Does Not Matter" <?php if($DatabaseCo->dbRow->manglik=="Does Not Matter" ){?> checked="checked" <?php }?>>
                                      Does Not Matter  &nbsp;
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Gothra</label>
                            <div class="col-sm-4">
                             <input type="text" class="form-control"  name="gothra" id="gothra" value="<?php echo $DatabaseCo->dbRow->gothra;?>">
 
                            </div>
                          </div>
                          
                          
                           <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Star</label>
                            <div class="col-sm-4">
                             <select class="form-control" name="star" id="star">
         <option value="<?php echo $DatabaseCo->dbRow->star;?>"><?php echo $DatabaseCo->dbRow->star;?></option>
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
                            </div>
                          </div>
                          
                          
                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Moonsign</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="moonsign" id="moonsign">
        <option value="<?php echo $DatabaseCo->dbRow->moonsign;?>"><?php echo $DatabaseCo->dbRow->moonsign;?></option>
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
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-social-detail" value="submit" class="btn btn-success">
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
