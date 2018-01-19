<?php 
  include_once '../databaseConn.php';
  include_once '../lib/pagination.php';
  include_once '../lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  include_once '../class/Config.class.php';
  $configObj = new Config();
  ?>
<style type='text/css'>
		.green_text
		{
			font-family:Lucida Sans, Arial;
			font-weight:900;
			color:#727b0b;
		}
		.blue_text
		{
			font-family:Lucida Sans, Arial;
			font-size:14px;
			font-weight:900;
			color:#457bba;
		}
		
		.red_text
		{
			font-family:Lucida Sans, Arial;
			font-weight:900;
			color:#AA0610;
		}
		</style>
		
		<table width='98%' style='border:double 2px #000000; margin:10px; background:url(<?php echo $configObj->getConfigName();?>/images/12.jpg);'' cellspacing='20px' >
	    <tr>
        <td>
            <table width='100%' height='auto' border='0' style='margin-left:auto; margin-right:auto;'>
                
                 <tr>
                	<td  class='blue_text' colspan='2'>
                 <img src="<?php echo $configObj->getConfigName();?>/images/<?php echo $configObj->getConfigLogo();?>" height="100" width="400">
                    </td>
                </tr>
                <tr>
                	<td  class='red_text' colspan='2' height="10">
                    	
                    </td>
                </tr>
				
                <tr>
                	<td  class='red_text' colspan='2' style="font-size:20px; color:#AA0610">
                    	Here is the list of your matching profiles according to our system.
                    </td>
                </tr>
				
			     <tr>
                	<td style='line-height:25px; font-family:Lucida Sans, Arial;font-size:14px;font-weight:900;color:#7e0000;' colspan='2'>
             
			              <table border='0' width='90%'>
						 
                           <tr>
						  <td>
                         
<table style="padding-bottom:2px;" cellpadding="6" cellspacing="5" border="0" width="100%">
   <tr>
    <?php	
	$i=0;
	$rel=$ff['part_religion'];
	$cst=$ff['part_caste'];
	$result45  = mysql_query("SELECT * FROM register_view where gender='Male' and religion='$rel' and caste='$cst' order by rand() limit 0,10");
	while($pror= mysql_fetch_array($result45))
	{
	?>
   
    	
    <td>
		<table style="padding-bottom:5px;" cellpadding="6" cellspacing="5" border="0" width="80%">
			<tr>
			  <td colspan="2" class="green_text" style="font-size:15px;">
			<a  href="<?php echo $configObj->getConfigName();?>/memprofile.php?PMid=<?php echo $pror['matri_id'] ?>" target="_blank" style="text-decoration:none; color:#087C00"><?php echo $pror['username'];?></a> </td>
			</tr>
			<tr>
			  <td align="left" width="80" style="padding-left: 5px;">
			    <?php
			    if($pror['photo1']=='')
{
?>
<a  href="<?php echo $configObj->getConfigName();?>/memprofile.php?PMid=<?php echo $pror['matri_id'] ?>" style="color:#7e0000; font-size:13px;" target="_blank">
<img src="<?php echo $configObj->getConfigName();?>/images/nophoto.jpg" height="150" width="120" border="1" style="border:solid 1px #999999;" width="75" class="submenubox"/></a>
<?php
}
else
{ ?>
<a  href="<?php echo $configObj->getConfigName();?>/memprofile.php?PMid=<?php echo $pror['matri_id'] ?>" style="color:#7e0000; font-size:13px;" target="_blank">
<img src="<?php echo $configObj->getConfigName();?>/photos/<?php echo $pror['photo1']?>" height="150" alt="<?php echo $pror['matri_id']?>" border="1" style="border:solid 1px #999999;" width="120" class="submenubox"/> 
</a>
<?php
}
?>
			    </td>
			  <td valign="top" width="100" style="font-size: 12px;line-height:19px; font-family:Lucida Sans, Arial;">
			   
						<?php $birthday_date = $pror['birthdate'];
						$current_date = date('Y-m-d'); //today is 2011-10-04
						$diff_in_mill_seconds = strtotime($current_date) - strtotime($birthday_date);
						$age = floor($diff_in_mill_seconds / (365.2425 *60*60*24)) + 1; //365.2425 is the no. of days in a year.  
						  echo "$age";
						  ?> years, <?php echo $pror['height']; ?><br />
				<?php 
				 echo $pror['religion_name'];?>,<br />
                 
				 <?php echo $pror['edu_name'];?>,<br />


                 
                  <?php echo $pror['ocp_name'];?>,<br />
                
				 <?php 
				 	 echo $pror['city_name'];?>, <br />
                     
                <?php  echo $pror['country_name']; ?> <br />
                
               			
				<a  href="<?php echo $configObj->getConfigName();?>/memprofile.php?PMid=<?php echo $pror['matri_id'] ?>" style="color:#457bba; font-size:13px;" target="_blank">View More</a>
				
			  </td>
			</tr>
			
      	</table>
	</td>
    <?php
	
			 $i++;
			if($i%2==0)
			{
				echo "</tr><tr>";
			
			}
	}
	?>
 </tr>
</table>
</td>
						  </tr>
						 
						 
						  </table> 
                </td>
                </tr>
                 
                                               
            </table>
        </td>
    </tr>
</table>	