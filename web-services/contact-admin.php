<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-danger" id="myModalLabel">Send Grating</h4>
      </div>
      <div class="modal-body">    
     <form name="MatriForm" id="MatriForm" class="form-horizontal" action="./web-services/admit_gratings.php" method="post">
         <div class="col-lg-12 form-group">
          <div class="col-lg-4">
       
          </div>
          <div class="col-lg-8">
              <ul class="list-unstyled">
                <li><h4>To ,</h4></li>
                <li><strong class="text-danger">Admin</strong></li>
                <li class="text-danger"></li>
              </ul>
          </div>
         </div>      
        <div class="form-group">
                 <label for="inputEmail3" class="col-sm-4 control-label">
                        Grating Song<font class="text-danger">*</font>
                 </label>
               <div class="col-sm-5">
                         
                </div>
        </div>                         
         <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">
              Grating Message<font class="text-danger">*</font>
              </label>
            <div class="col-sm-5">
            
                
            </div>
       </div>	     		
        </div>       
        
            <div class="modal-footer">
           <p class="pull-left text-danger">Date - <?php echo date('l j F ,Y g:i A');?></p>   
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="edit-basic-detail" value="submit" class="btn btn-primary">Save changes</button>
        <input type="hidden" name="txtTo" id="txtTo" value="" />
            </div>
        </form>
      </div>
   </div>