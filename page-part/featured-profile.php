                    <?php
	if($_SESSION['gender123'])
	{
			if($_SESSION['gender123']=='Male')
			{
			 $gender="and gender='Female'";
			}
			else
			{
			 $gender="and gender='Male'";	
			}		
	}
	else
	{
	 	$gender='';
	}
$SQL_STATEMENT =  "SELECT * FROM register_view WHERE fstatus='Featured' and matri_id!='$mid' $gender order by rand() limit 0,3";
                               $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		if($DatabaseCo->dbRow = mysql_num_rows($DatabaseCo->dbResult)>0)
		{					   
?>							   

                        <ul class="photo-grid padding-left-zero padding-right-zero">                         
           						<?php
                               while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                               {
                               ?> 
                               <div class="col-lg-4 col-xs-4 padding-left-zero padding-right-zero">
                                       <li class="">
                          
                                               <figure class="">
                                                  <?php
                                                 if($DatabaseCo->dbRow->photo1!="" && $DatabaseCo->dbRow->photo_protect=="No" )
                                            {
                                             ?>
                                                <img src="photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="" />
                                             <?php 
                                                  }
												  elseif($DatabaseCo->dbRow->photo_protect=="Yes" && $DatabaseCo->dbRow->photo_pswd!='')
												  {
                                             ?>
                                                  <a href="#"  data-toggle="modal" onClick="newWindow('send_pass_request.php?id=<?php echo $DatabaseCo->dbRow->matri_id;?>','','790','440')" >
                                                                <?php  
                                                                if($DatabaseCo->dbRow->gender=='Male')
                                                                {
                                                                ?>                                    
                                                                <img  src="./images/default-photo/photopassword_male.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="" />
                                                                    <?php   }else{ ?>
                                                                <img  src="./images/default-photo/photopassword_female.png"   title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="" />
                                                                <?php } ?>
                                                  </a>
                                              <?php 											  
											  	 	}
												 
											  else
											  {   
                                                  if($DatabaseCo->dbRow->gender=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class="" />
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png"  title="<?php echo $DatabaseCo->dbRow->username; ?>" alt="<?php echo $DatabaseCo->dbRow->username; ?>" class=""/>
                                              <?php } }?>
                                                   <figcaption>
                                                   
                                                       <p>
                                                           <?php echo $DatabaseCo->dbRow->username; ?><br> 
                                                           <?php $birthDate = $DatabaseCo->dbRow->birthdate;
    list($year,$month,$day) = explode("-",$birthDate);$year_diff = date("Y") - $year;$month_diff = date("m") - $month;$day_diff = date("d") - $day;if ($day_diff < 0 || $month_diff < 0)$year_diff--;echo $year_diff; ?> / <?php echo $DatabaseCo->dbRow->religion_name; ?><br> <?php echo $DatabaseCo->dbRow->country_name; ?>
                                                       </p>
                                                   </figcaption>
                                               </figure>
                                              
											<p style="margin-top:5px;">
                                           <a href="memprofile.php?PMid=<?php echo $DatabaseCo->dbRow->matri_id; ?>" target="_blank">View Profile</a></p>	
															
                                         
                                       </li> 
                                       </div> 
                                                          

                               <?php } ?>                        
                       </ul>
                       
      <?php
		}
		?>