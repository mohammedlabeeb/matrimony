<?php
include_once '../../databaseConn.php';
include_once '../../class/Location.class.php';
include_once '../../lib/requestHandler.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$index_id = isset($_GET['index_id'])?$_GET['index_id']:0;
if($index_id!=0){
    $DatabaseCo = new DatabaseConn(); 
    $SQL_STATEMENT = "select * from register_view where index_id=".$index_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
                { 
                    			
    
?>   

    
       <p class="web_dialog_title" id="dialog_title">View Full Detail</p>
        <a href="#" id="btnClose" class="close" ><img src="img/bgi/close_black.png" alt="Close"/></a>
        <div class="dialog-box">
        <div class="dialog-box-first cf">
       		<span class="user-image">
            <?php
			if($DatabaseCo->dbRow->photo1=='')
			{
				?>
          <img src="../photos/nophoto.jpg" alt="User Image" height="150" width="130" />
          <?php
		  }else
          {?>
           <img src="../photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png" alt="User Image" height="150" width="130" />
           <?php
          }
          ?>
            </span>
            <div class="user-descrption">
             <p class="cf user-title">
             	<span class="user-name"><?php echo $DatabaseCo->dbRow->matri_id;?></span> 
                <span class="user-approved">
                 <?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=='Active' || $DatabaseCo->dbRow->status=='Paid')
			  $likeDisLikeCss = "./img/bgi/like-icon.png";
			else
			  $likeDisLikeCss = "./img/bgi/dislike-icon.png";
		      ?>
                <img src="<?php echo $likeDisLikeCss;?>" title="Status"></span>
             </p>
             <p class="cf user-title">
             	<span class="builder-title"><img src="img/builder.png" alt="" title="">&nbsp;&nbsp;&nbsp;
				<?php echo $DatabaseCo->dbRow->status;?> (<?php echo $DatabaseCo->dbRow->fstatus;?>)</span>
             </p>
             <ul class="cf user-deails">
             	<li class="first"><img src="img/mail.png" alt="" title="" /> : <?php echo $DatabaseCo->dbRow->username;?></li>
                <li><img src="img/cellphone.png" alt="" title="" /> : <?php echo $DatabaseCo->dbRow->mobile;?></li>
                <li class="second"><img src="img/contact.png" alt="" title="" /> :<?php echo $DatabaseCo->dbRow->phone;?></li>
                <li class="first"><img src="img/address.png" alt="" title=""  class="user-img"/> <span class="user-label">: <?php echo $DatabaseCo->dbRow->email;?></span></li>
                <li class="third"><b>City:</b> <?php echo $DatabaseCo->dbRow->city_name;?>&nbsp;&nbsp;&nbsp;<b>State:</b> <?php echo $DatabaseCo->dbRow->state_name;?>&nbsp;&nbsp;&nbsp;<b>Country:</b> <?php echo $DatabaseCo->dbRow->country_name;?> </li>
                 
             </ul>
            </div>
            
       </div>
       <div class="dialog-box-second cf">
        <h3 class="title">About</h3>
        <div class="business-desc cf">
          <div>
          	<p class="cf" style="width:700px;">
            	<span class="business-title">Profile Description : </span>
                <span style="width:600px;color:#666666;padding-left: 5px;font-size:1.1em;" ><?php echo $DatabaseCo->dbRow->profile_text;?></span>
            </p>
           
          </div>
          
        </div>
        
        
        <h3 class="title">Basic Information</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Name :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->username;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Marital Status :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->m_status;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">D.O.B :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->birthdate;?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Gender :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->gender;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Profile Created By :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->profileby;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Mother Tongue :</span>
                <span class="business-data">
				<?php $B=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS mtongue_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.m_tongue) >0 WHERE a.index_id = '$index_id'  GROUP BY a.m_tongue"));
				echo $B['mtongue_name']; ?>
				</span>
            </p>
          </div>
        </div>
        
         <h3 class="title">Socio Religious Attributes</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Religion :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->religion_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Caste :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->caste_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Sub caste :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->subcaste; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Horoscope :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->horoscope; ?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Manglik :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->manglik; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Gothra :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->gothra; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Star :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->star; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Moonsign :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->moonsign; ?></span>
            </p>
          </div>
        </div>
        
         <h3 class="title">Education and Occupation</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Education :</span>
                <span class="business-data"><?php $c=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.edu_detail) >0 WHERE a.index_id = '$index_id'  GROUP BY a.edu_detail"));
				echo $c['edu_name']; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Occupation :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->ocp_name; ?></span>
            </p>
           

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Employed In :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->emp_in; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Annual income :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->income; ?></span>
            </p>
           
          </div>
        </div>
        
         <h3 class="title">Physical Attributes</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Height :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->height; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Complexion :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->complexion; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Blood Group  :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->b_group; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Smoke :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->smoke; ?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Weight :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->weight; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Body type  :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->bodytype; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Diet :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->diet; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Drink :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->drink; ?></span>
            </p>
          </div>
        </div>
        
         <h3 class="title">Contact Details</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Address :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->address; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Country :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->country_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">State :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->state_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">City :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->city_name; ?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Mobile :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->mobile; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Phone :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->phone; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Time to call  :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->time_to_call; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Residence Status :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->residence; ?></span>
            </p>
          </div>
        </div>
        
         <h3 class="title">Family Details</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Family Details :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->family_details; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Father Name :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->father_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Father Occupation :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->father_occupation; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Mother Name :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->mother_name; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Mother Occupation :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->mother_occupation; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Family Type :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->family_type; ?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Family Status :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->family_status; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Total Brothers :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->no_of_brothers; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Married Brothers  :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->no_marri_brother; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Total Sisters :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->no_of_sisters; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Married Sisiters :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->no_marri_sister; ?></span>
            </p>
           
          </div>
        </div>
        
         <h3 class="title">Partner Preference</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Looking for :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->looking_for; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Age Preference :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_frm_age; ?> to <?php echo $DatabaseCo->dbRow->part_to_age; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Expectations :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_expect; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Country Living in  :</span>
                <span class="business-data"><?php $d=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', country_name, ''SEPARATOR ', ' ) AS part_country FROM register a INNER JOIN country b ON FIND_IN_SET(b.country_id, a.part_country_living) > 0 where a.index_id = '$index_id'  GROUP BY a.part_country_living"));
				echo $d['part_country'];?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Resident Status :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_resi_status; ?></span>
            </p>
            
            <p class="cf">
            	<span class="business-title">Mother Tongue :</span>
                <span class="business-data"><?php $h=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS part_mtongue  FROM   register a INNER JOIN  mothertongue b ON FIND_IN_SET(b.mtongue_id, a.part_mtongue) > 0 where a.index_id = '$index_id'  GROUP BY a.part_mtongue"));
				echo $h['part_mtongue'];?></span>
            </p>

          </div>
          <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Height :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_height; ?> To <?php echo $DatabaseCo->dbRow->part_height_to; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Complexion :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_complexation; ?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Education :</span>
                <span class="business-data"><?php $e=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', edu_name, ''SEPARATOR ', ' ) AS edu_name FROM register a INNER JOIN education_detail b ON FIND_IN_SET(b.edu_id,a.part_edu) >0 WHERE a.index_id = '$index_id'  GROUP BY a.edu_detail"));
				echo $e['edu_name']; ?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Religion :</span>
                <span class="business-data"><?php $f=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', religion_name, ''SEPARATOR ', ' ) AS part_religion  FROM   register a INNER JOIN religion b ON FIND_IN_SET(b.religion_id, a.part_religion) > 0 where a.index_id = '$index_id'  GROUP BY a.part_religion"));
				echo $f['part_religion'];?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Caste :</span>
                <span class="business-data"><?php $g=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', caste_name, ''SEPARATOR ', ' ) AS part_sect  FROM   register a INNER JOIN caste b ON FIND_IN_SET(b.caste_id, a.part_caste) > 0 where a.index_id = '$index_id'  GROUP BY a.part_caste"));
				echo $g['part_sect'];?></span>
            </p>
             <p class="cf">
            	<span class="business-title">Annual Income :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->part_income; ?></span>
            </p>
          </div>
        </div>
        
         <h3 class="title">Hobbies and Interest</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          	<p class="cf" style="width:700px;">
            	<span class="business-title">Hobbies & Interests : </span>
                <span style="width:600px;color:#666666;padding-left: 5px; font-size:1.1em;"><?php echo $DatabaseCo->dbRow->hobby; ?></span>
            </p>
            

          </div>
         
        </div>
        
            
        
        
       </div>
       <a href="#" class="close-btn close"></a> 
     </div>
   
 <script type="text/javascript">
     $("#btnClose").click(function (e){
            HideDialog();
            e.preventDefault();            
    });
    $(".chart-list li").click(function() {
		
        var ex = $(this).index();
        $(".chart-list li").removeClass('active');
        $(".chart-list li").eq(ex).addClass('active');

        $(".table-description > div").hide();
        $(".table-description > div").eq(ex).show();
       
    });
    $(".list-tabs li").click(function() {
        var ex = $(this).index();
        $(".list-tabs li").removeClass('active');
        $(".list-tabs li").eq(ex).addClass('active');

        $(".listing-outer > div").hide();
        $(".listing-outer > div").eq(ex).show();
    });	
    $(".list-tabs-in li").click(function() {
        var ex = $(this).index();
        $(".list-tabs-in li").removeClass('active');
        $(".list-tabs-in li").eq(ex).addClass('active');

        $(".listing-outer-in > div").hide();
        $(".listing-outer-in > div").eq(ex).show();
    });	
 
 </script>
<?php  
     }
}else{
    echo "<h1>Invalid User ID.</h1>";
}
?>
