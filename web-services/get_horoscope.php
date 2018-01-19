<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 
 
 */
					
$from_id = isset($_GET['frmid'])?$_GET['frmid']:0;
$get=mysql_query("select * from register_view where matri_id='$from_id'");
$row=mysql_fetch_array($get);

	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Horoscope of <?php echo $row['username'];?></h4>
              </div>
               
              <div class="modal-body">                 
                      <div class="form-group"> 
            <img src="horoscope-list/<?php echo $row['hor_photo'];?>" class="img-responsive">          
                      </div>
     
              </div>
              
             
              <div class="modal-footer">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                    
            </div>
          </div>