<?php
error_reporting(0);
include_once '../databaseConn.php';
include_once '../lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();	
$mid = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';
$from_id = isset($_REQUEST['toid']) ? $_REQUEST['toid']:0;   
$select="select * from payment_view where pmatri_id='$mid'";
$exe=mysql_query($select) or die(mysql_error());
$fetch=mysql_fetch_array($exe);
$total_cnt=$fetch['p_no_contacts'];
$used_cnt=$fetch['r_cnt'];
$exp_date=$fetch['exp_date'];
$today= date('Y-m-d');

$checker=mysql_num_rows(mysql_query("select * from contact_checker where my_id='$mid' and viewed_id='$from_id'"));


if($_SESSION['user_id']!='')
{

		if($total_cnt-$used_cnt>0 && $exp_date > $today)
		{
			$get=mysql_query("select * from register_view where matri_id='$from_id'");
			$fet=mysql_fetch_array($get);
		?>
					<?php if($fet['contact_view_security']=='0')
                    {?>
                    	
                        <div class="modal-dialog yoyo-large">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel" style="color:red;">
                           <?php if($checker!=0){ echo "Contact details have been already seen.";} else {?>
                            Remaining Contacts  (<?php echo $total_cnt-$used_cnt;?>) <?php } ?>
                            
                            </h4>
                          </div>
                          <div class="modal-body">
                          
                         <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
                              <div class="col-sm-12 form-group">
                              <div class="col-sm-6">
                             <div class="form-group">
                              
                           <?php
                                if($fet['photo1']!="" && $fet['photo_protect']=="No" )
                                 {
                                ?>
                                
                                        <img src="photos/<?php echo $fet['photo1']; ?>" class="img-responsive photo" ></img>
                                <?php 
                                }
                                elseif($fet['photo_protect']=="Yes")
                                {
                                                ?>
                                
                                        <?php  
                                                             if($fet['gender']=='Male')
                                                         {
                                                        ?>                                    
                                                            <img  src="images/default-photo/photopassword_male.png" class="img-responsive photo"   title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
                                                        <?php   }else{ ?>
                                                            <img  src="images/default-photo/photopassword_female.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
                                                        <?php } ?>
                                <?php 
                                }
                                else
                                { ?>
                                
                                        <?php   
                                                            if($fet['gender']=='Male')
                                                            {
                                                       ?>                                    
                                                            <img  src="images/default-photo/male-200.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
                                                       <?php   }else{ ?>
                                                            <img  src="images/default-photo/female-200.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
                                                       <?php } ?>
                                <?php
                                 } 
                                 ?>
                              </div>
                              </div>     
                             <div class="col-sm-6">  
                             <table class="table table-hover table-striped">
                                                                                 <tr>
                                                                                     <td><strong>Matri ID :</strong></td> <td><?php echo $fet['matri_id']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Name :</strong></td> <td> <?php echo $fet['username']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Address :</strong> </td> <td><?php echo $fet['address']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Country :</strong></td> <td> <?php echo $fet['country_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>State :</strong> </td> <td><?php echo $fet['state_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>City :</strong> </td> <td><?php echo $fet['city_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Phone :</strong> </td> <td><?php echo $fet['phone']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Mobile :</strong> </td> <td><?php echo $fet['mobile']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Email :</strong></td> <td> <?php echo $fet['email']; ?></td>
                                                                                 </tr>
                                                                             </table>	
                            </div>
                             </div>
                            </form>
                            </div>
                                <?php
								 if($checker==0)
								{
                                        $sel=mysql_query("SELECT * FROM payments where pmatri_id='$mid'"); 
                                        $fet=mysql_fetch_array($sel);
                                        $tot_cnt=$fet['p_no_contacts'];
                                        $use_cnt=$fet['r_cnt'];
                                        $use_cnt=$use_cnt+1;
                                        if($tot_cnt>=$use_cnt)
                                        {
                                         $update="UPDATE payments SET r_cnt='$use_cnt' WHERE pmatri_id='$mid' ";
                                            $d=mysql_query($update);
                                        }
				$ins=mysql_query("insert into contact_checker (my_id,viewed_id,date) values ('$mid','$from_id',now())");	
								}
                                        ?>
                          </div>
                       </div>
                       	}
                     <?php
					}
					else
					{
						$exp_sel=mysql_query("select * from expressinterest where ei_sender='$mid' and ei_receiver='$from_id' and receiver_response ='Accept'");
						$num=mysql_num_rows($exp_sel);
						if($num>0)
						{
							
									$sel=mysql_query("select * from  block_profile where block_by='$from_id' and block_to='$mid'");
									$num_block=mysql_num_rows($sel);
									if($num_block>0)
									{
										?>
                                    <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">You are Blocked</h4>
      </div>
      
      <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
                      <div class="form-group">
                       <div class="col-sm-12">
               <h4>This member has blocked you.You can't see his contact details.</h4>
                            </div>
                          </div>
                                                   
                          
                        </form>
      
    </div>
  </div>
  									<?php
									}
									else
									{?>
									 <div class="modal-dialog yoyo-large">
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel" style="color:red;"><?php if($checker!=0){ echo "Contact details have been already seen.";} else {?>
                            Remaining Contacts  (<?php echo $total_cnt-$used_cnt;?>) <?php } ?></h4>
								  </div>
								  <div class="modal-body">
								  
								 <form name="MatriForm" id="MatriForm" class="form-horizontal" action="" method="post">
									  <div class="col-sm-12 form-group">
									  <div class="col-sm-6">
									 <div class="form-group">
									  
								   <?php
										if($fet['photo1']!="" && $fet['photo_protect']=="No" )
										 {
										?>
										
												<img src="photos/watermark.php?image=<?php echo $fet['photo1']; ?>&watermark=watermark.png" class="img-responsive photo" ></img>
										<?php 
										}
										elseif($fet['photo_protect']=="Yes")
										{
														?>
										
												<?php  
																	 if($fet['gender']=='Male')
																 {
																?>                                    
																	<img  src="images/default-photo/photopassword_male.png" class="img-responsive photo"   title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
																<?php   }else{ ?>
																	<img  src="images/default-photo/photopassword_female.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
																<?php } ?>
										<?php 
										}
										else
										{ ?>
										
												<?php   
																	if($fet['gender']=='Male')
																	{
															   ?>                                    
																	<img  src="images/default-photo/reqest-photo-male.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
															   <?php   }else{ ?>
																	<img  src="images/default-photo/reqest-photo-female.png" class="img-responsive photo"  title="<?php echo $fet['username']; ?>" alt="<?php echo $fet['username']; ?>" />
															   <?php } ?>
										<?php
										 } 
										 ?>
									  </div>
									  </div>     
									 <div class="col-sm-6">         
                                                                             <table class="table table-hover table-striped">
                                                                                 <tr>
                                                                                     <td><strong>Matri ID :</strong></td> <td><?php echo $fet['matri_id']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Name :</strong></td> <td> <?php echo $fet['username']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Address :</strong> </td> <td><?php echo $fet['address']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Country :</strong></td> <td> <?php echo $fet['country_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>State :</strong> </td> <td><?php echo $fet['state_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>City :</strong> </td> <td><?php echo $fet['city_name']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Phone :</strong> </td> <td><?php echo $fet['phone']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Mobile :</strong> </td> <td><?php echo $fet['mobile']; ?></td>
                                                                                 </tr>
                                                                                 <tr>
                                                                                     <td><strong>Email :</strong></td> <td> <?php echo $fet['email']; ?></td>
                                                                                 </tr>
                                                                             </table>								 
									   
									</div>
									 </div>
									</form>
									</div>
										<?php
										 if($checker==0)
								{
												$sel=mysql_query("SELECT * FROM payments where pmatri_id='$mid'"); 
												$fet=mysql_fetch_array($sel);
												$tot_cnt=$fet['p_no_contacts'];
												$use_cnt=$fet['r_cnt'];
												$use_cnt=$use_cnt+1;
												if($tot_cnt>=$use_cnt)
												{
												 $update="UPDATE payments SET r_cnt='$use_cnt' WHERE pmatri_id='$mid' ";
													$d=mysql_query($update);
												}
					$ins=mysql_query("insert into contact_checker (my_id,viewed_id,date) values ('$mid','$from_id',now())");	
								}
												?>
								  </div>
							   </div>
                               		<?php
									}
									?>
									 <?php
						}
						else
						{
							?>
                            <div class="modal-dialog">  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:red;">Only Express Interest not Accepted</h4>
      </div>
      
     
                      <div class="form-group">
                       <div class="col-sm-12">
               <h4>&nbsp;&nbsp;This member only shows his/her contact details if you have already sent him/her express interest, and he/she has accepted it.</h4>
                            </div>
                          <div class="col-sm-12"><h4 style="color:red;">&nbsp;&nbsp;Please send him/her express interest if you are interested.</h4></div>
                          </div>
    </div>
  </div>
                 <?php   } } ?>
		 <?php	}else{  ?>		
		  <div class="modal-dialog yoyo-large">		  
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel" style="color:red;">Upgrade Your Membership</h4>
			  </div>			  
			  <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
				<div class="form-group">
                                    <div class="col-sm-12">
					 <h4>&nbsp;&nbsp;Please get the contact view balance by upgrading your membership.</h4>
                                    </div>
				</div>
                              <div class="form-group">
                                  <div class="col-sm-offset-4 col-sm-10"><button class="btn btn-success" formaction="payment.php">Upgrade Now</button></div>
                              </div>
                          </form>			  
			</div>
		  </div>
		<?php	}    }else{   ?>
	<div class="modal-dialog">  
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color:red;">Please Login !!!</h4>
                </div>      
                <form name="MatriForm" id="MatriForm" class="form-horizontal" action="payment.php" method="post">
                        <div class="form-group">
                            <div class="col-sm-12">
                            <h4>&nbsp;&nbsp;Please Login to access this feature.</h4>
                            </div>
                        </div>                                                   
                          <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">                
                            <button class="btn btn-success" formaction="login.php">Login Now</button>
                            </div>
                          </div>
              </form>      
            </div>
        </div>
    <?php    }    ?>

 
