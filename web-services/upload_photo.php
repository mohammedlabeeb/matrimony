<?php
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';

$DatabaseCo = new DatabaseConn();	
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$from_id = isset($_GET['toid'])?$_GET['toid']:0;

?>

<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Protect Photo Password</h4>
              </div>
                <form name="form" class="form-horizontal" action="modify-photo.php" method="post">
              <div class="modal-body">                 
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Password : </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" name="photo_password" id="photo_password" placeholder="Put password Here.." required>
                        </div>
                      </div>
                  
              </div>
              <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" value="Save" name="protect_photo">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
                    </form>
            </div>
          </div>