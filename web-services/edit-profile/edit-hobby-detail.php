<?php
error_reporting(0);
include_once '../../databaseConn.php';
include_once '../../lib/requestHandler.php';	
   

	$s_id =$_GET['sid'];
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select username,hobby from register_view where matri_id='$s_id'";
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    $DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult);
	
	
	?>
   
<div class="modal-dialog">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Hobbies and Interests  of <?php echo $DatabaseCo->dbRow->username; ?></h4>
      </div>
      
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
       
             
                           <div class="form-group" style="margin-top:10px;">
                <label for="inputPassword3" class="col-sm-4 control-label">Hobbies and Interests</label>
                            <div class="col-sm-4">
                  <textarea class="form-control" id="hobby" name="hobby" style="width:330px; height:130px;"><?php echo $DatabaseCo->dbRow->hobby; ?></textarea>
                            </div>
                          </div> 
                                      
                         
                          
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                    <input type="submit" name="edit-hobby-desc" value="submit" class="btn btn-success">
                            </div>
                          </div>
                        </form>
      
    </div>
  </div>
