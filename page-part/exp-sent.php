<div class="load col-xs-12 col-lg-12 col-md-12 col-sm-12 panel-body exp-hover">
                        	<div class="row">
								<div class="col-lg-3 col-xs-12">
                                	<div class="col-xs-12 thumbnail margin-bottom-10px">
                            			<?php
                                                 if($DatabaseCo->dbRow->photo1!="" && $DatabaseCo->dbRow->photo_protect=="No" )
                                            {
                                             ?>
                                                                                                  
                                                     <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;"/>
                                                 
                                             <?php 
                                                  }
												  elseif($DatabaseCo->dbRow->photo_protect=="Yes" && $DatabaseCo->dbRow->photo_pswd!='')
												  {
                                             ?>
                                                
                                                                <?php  
                                                                if($DatabaseCo->dbRow->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;"/>
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;"/>
                                                                <?php } ?>
                                                  
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;"/>
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" style="height:140px; width:130px;"/>
                                              <?php } }?>
                                    </div>
                            	</div>
                               
                                <div class="col-lg-6 col-xs-12">
                                	<div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		To:
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_receiver; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Response :	
                                        	</div>
                                        	<div class="col-lg-8  col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->receiver_response; ?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4  col-xs-5 line-break">
                                        		Sent On :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php $date1=$DatabaseCo->dbRow->ei_sent_date; echo $date2 = date("D d F ,Y  H:i a", (strtotime($date1)));?>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                    	<div class="row">
                                    		<div class="col-lg-4 col-xs-5 line-break">
                                        		Message :
                                        	</div>
                                        	<div class="col-lg-8 col-xs-7 line-break">
                                        		<?php echo $DatabaseCo->dbRow->ei_message; ?>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-12">
                                	<div class="thumbnail col-xs-12">
                                    	<a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow->ei_receiver; ?>" target="_blank" class="btn btn-default col-xs-12">
                                            	<i class="glyphicon glyphicon-fullscreen col-xs-3"></i>
                                                <span class="col-xs-9">
                                                	View Full Profile
                                                </span>
                                         </a>
                                         <a href="#" title="Remove" id="<?php echo $DatabaseCo->dbRow->ei_id; ?>" class="delete btn btn-default col-xs-12">
                                            	<i class="glyphicon glyphicon-trash col-xs-3"></i>
                                                <span class="col-xs-9">
                                                	Delete Request
                                                </span>
                                         </a>
                                         
                                         
                                    </div>
                                </div>
                            </div>
						</div>