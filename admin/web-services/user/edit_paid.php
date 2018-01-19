<?php
ob_start();
include_once '../../databaseConn.php';
include_once '../../class/Location.class.php';
include_once '../../lib/requestHandler.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$index_id = isset($_GET['index_id'])?$_GET['index_id']:0;



	if($index_id!=0)
	{
		$DatabaseCo = new DatabaseConn(); 
		$SQL_STATEMENT = "select * from register_view where index_id=".$index_id;
		$DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
                { 
                    			
    
?>
<script>
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//fuction to return the xml http object
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
	}
	
	
	
function getCurrencyCode(strURL)
{		
	var req = getXMLHTTP();		
	if (req) 
	{
		//function to be called when state is changed
		req.onreadystatechange = function()
		{
			//when state is completed i.e 4
			if (req.readyState == 4) 
			{			
				// only if http status is "OK"
				if (req.status == 200)
				{						
					document.getElementById('plandiv').innerHTML=req.responseText;					
				} 
				
				else 
				{
					alert("There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		 }			
		 req.open("GET", strURL, true);
		 req.send(null);
	}			
}
</script>   
<link rel="stylesheet" type="text/css" href="css/styles.css" />
    
       <p class="web_dialog_title" id="dialog_title">Edit Plan</p>
        <a href="#" id="btnClose" class="close" ><img src="img/bgi/close_black.png" alt="Close"/></a>
        <div class="dialog-box" style="height:510px; width:880px;">
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
           <img src="../photos/<?php echo $DatabaseCo->dbRow->photo1;?>" alt="User Image" height="150" width="130" />
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
                <li class="second"><img src="img/cellphone.png" alt="" title="" /> : <?php echo $DatabaseCo->dbRow->mobile;?></li>
                <li class="first"><img src="img/contact.png" alt="" title="" /> :<?php echo $DatabaseCo->dbRow->phone;?></li>
                <li class="first"><img src="img/address.png" alt="" title=""  class="user-img"/> <span class="user-label">: <?php echo $DatabaseCo->dbRow->email;?></span></li>
                <li class="third"><b>City:</b> <?php echo $DatabaseCo->dbRow->city_name;?>&nbsp;&nbsp;&nbsp;<b>State:</b> <?php echo $DatabaseCo->dbRow->state_name;?>&nbsp;&nbsp;&nbsp;<b>Country:</b> <?php echo $DatabaseCo->dbRow->country_name;?> </li>
                 
             </ul>
            </div>
            
       </div>
       <form  action="edit_paid_part.php" method="post" name="frm" >
       <div class="dialog-box-second cf">
        <h3 class="title"></h3>
        <div class="business-desc cf">
         <div class="business-deail">
         <?php
		 $matri=$DatabaseCo->dbRow->matri_id;
		 $select=mysql_query("select * from payments where pmatri_id='$matri'");
		 $exe=mysql_fetch_array($select);
		 
		 ?>
         	<p class="cf">
            	<span class="business-title">Current Plan</span>
                <span class="business-data">
               <?php echo $exe['p_plan'];?>
                </span>
            </p>
          	 <p class="cf">
            	<span class="business-title">Plan Expiry Date</span>
                <span class="business-data">
               <?php echo $exe['exp_date'];?>
                </span>
            </p>
           
         
            <p class="cf">
            	<span class="business-title">Update Plan : </span>
                <span class="business-data">
               <?php
$plan = mysql_query("SELECT * from membership_plan");
?>
<select name="plan" class="t" onChange="getCurrencyCode('findpay.php?plan='+this.value)" >
<option value="">Select Plan</option>
<?php
while($row = mysql_fetch_array($plan))
{?> 
<option value="<?php echo $row['plan_name'];?>"><?php echo $row['plan_name'];?></option>
<?php
} ?>
</select>
                </span>
            </p>
            
             
             <p class="cf">
            	<span class="business-title">&nbsp;</span>
                <span class="business-data">
               &nbsp;
                </span>
            </p>
              <p class="submit-btn cf">
            	
                <span class="business">
               <input name="submit" type="submit" value="Submit" class="save-btn" title="Submit" />
               <input name="mid" type="hidden" id="mid" value="<?php echo $DatabaseCo->dbRow->matri_id;?>" />
               <input name="expdate" type="hidden" id="expdate" value="<?php echo $exe['exp_date'];?>" />
     
                </span>
            </p>
          </div>
          
          <div class="business-deail" id="plandiv" style="float:right;">
          	             
             
          </div>
          
        </div>
       
     
       
       </div>
        </form>
       <a href="#" class="close-btn close"></a> 
     </div>
 <script type="text/javascript">
     $("#btnClose").click(function (e){
            HideDialog();
            e.preventDefault();            
    });
    
 </script>  
 
<?php  
     }
}else{
    echo "<h1>Invalid User ID.</h1>";
}
?>
