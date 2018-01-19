<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$message_id = isset($_GET['id'])?$_GET['id']:0;
if($message_id!=0){
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select * from messages where mes_id=".$message_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
	//$DatabaseCo2 = new DatabaseConn();
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
    { 
?>   
<div class="modal-dialog yoyo-large">
  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red; text-align:center;"><?php echo $DatabaseCo->dbRow->subject; ?></h4>
      </div>
      
      
                      <div class="form-group">
                       <div class="col-sm-12">
               <h5 style="text-align:justify;"><?php echo $DatabaseCo->dbRow->message; ?></h5>
                            </div>
                          </div>
                                                   
                         
                          <div class="form-group">
                       <div class="col-sm-12">
               <h6 style="text-align:left; color:green;"><?php $date1=$DatabaseCo->dbRow->sent_date;									 
									 echo $date2 = date("D d M ,Y  H:i a", (strtotime($date1)));?></h6>
                            </div>
                          </div> 
                       
      
    </div>
  </div>
<?php
    }
}
?>