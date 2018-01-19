<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
			
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
$get=mysql_query("select * from register_view where matri_id='$from_id'");
$row=mysql_fetch_array($get);



?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Photo of <?php echo $row['username'];?></h4>
              </div>
               
              <div class="modal-body">                 
                      <div class="form-group"> 
            <img src="photos_big/watermark.php?image=<?php echo $row['photo1']; ?>&watermark=watermark.png" style="width:535px; height:500px;">          
                      </div>
     
              </div>
              
              
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                    
            </div>
          </div>