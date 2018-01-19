<li>
	<div class="avathar">
	 <?php
                        if($Row['photo1']!="" && $Row['photo_pswd']=="" && 
						$Row['photo1_approve']!="UNAPPROVED")
                          {
                    ?>
                 <a href="#"  data-toggle="modal" data-target="#myModal5" onclick="Getphotos('<?php echo $Row['matri_id']; ?>')">                  <img src="photos/watermark.php?image=<?php echo $Row['photo1']; ?>&watermark=watermark.png" class="img-responsive img-thumbnail"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                 </a>
                    <?php 
                         }
						 
						 elseif($Row['photo_protect']=="Yes" && $Row['photo_pswd']!='' && $_SESSION['user_id'])
						 
						 {
                     ?>
                   <a href="#"  data-toggle="modal" onClick="newWindow('send_pass_request.php?id=<?php echo $Row['matri_id'];?>','','790','440')" >
                    <?php  
                         if($Row['gender']=='Male')
                         {
                     ?>                                    
                         <img  src="./images/default-photo/photopassword_male.png" class="img-responsive img-thumbnail"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                    <?php   
					     }
						 else
						 { 
					?>
                         <img  src="./images/default-photo/photopassword_female.png" class="img-responsive img-thumbnail"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                    <?php 
					     }
					?>
                   </a>
                     <?php 											  
						 }
						 else
						 {   
                         if($Row['gender']=='Male')
                         {
                     ?>
                         <img  src="./images/default-photo/male-200.png" class="img-responsive image-thumbnail"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                     <?php   
					     }
						 else
						 { 
					  ?>
                         <img  src="./images/default-photo/female-200.png" class="img-responsive image-thumbnail"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                     <?php 
					     
						 } 
						 }
					  ?>
		 
	</div>
	<div class="details">
		<div class="left">
			<table class="profile-details" width="100%">
				<tr><td><label>Name</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['username']; ?></td></tr>
				<tr><td><label>Age</label></td><td width="25" style="text-align:center">:</td><td><?php echo floor((time() - strtotime($Row['birthdate']))/31556926); ?></td></tr>
				<tr><td><label>Height</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['height']; ?></td></tr>
				<tr><td><label>Marital Status</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['m_status']; ?></td></tr>
				<tr><td><label>Religion</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['religion_name']; ?></td></tr>
				<tr><td><label>Caste</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['caste_name']; ?></td></tr>
				<tr><td><label>Location</label></td><td width="25" style="text-align:center">:</td><td><?php echo $Row['city_name']; ?>, <?php echo $Row['state_name']; ?></td></tr>
			</table>
		</div>
		<div class="right">
			 <?php	
				if($_SESSION['user_id']!='')
				{	
				
					
$select=mysql_query("select * from shortlist where to_id='".$Row['matri_id']."' and from_id='$mid'");
                                                        if(mysql_num_rows($select)==0)
                                                        {
                                                        ?>   
                    	
                           <a href="#" id="<?php echo $Row['matri_id']; ?>" onclick="add_shortlist();" class="addToshort-link favorite">
                              <i class="ion-heart"></i>Add to Favorite
                           </a>
                            <?php    }else{   ?>
                            <a href="#" id="<?php echo $Row['matri_id']; ?>" onclick="remove_shortlist();" class="addToblock-link favorite">
                                <i class="ion-heart"></i>Remove Favorite</a>
                           
                           
                          
                       
                        <?php
                                                         }
														 
														 
												 
														 
				} else {
                               ?>
			<button class="favorite"><i class="ion-heart"></i>Add to Favorite</button>
		<?php	} ?>
			<a href="memprofile.php?PMid=<?php echo $Row['matri_id']; ?>" class="profile-btn">View Profile</a>
		</div>
	</div>
</li>