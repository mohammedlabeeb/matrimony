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

	if(isset($_POST['submit']))
	{
		$_SESSION['mid'] = $_POST['mid'];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['pmode'] = $_POST['pmode'];
		$_SESSION['activedt'] = $_POST['activedt'];
		$_SESSION['plan'] = $_POST['plan'];
		$_SESSION['video'] = $_POST['video'];
		$_SESSION['chat'] = $_POST['chat'];
		$_SESSION['bankdet'] = $_POST['bankdet'];
		$_SESSION['duration'] = $_POST['duration'];
		$_SESSION['pcontact'] = $_POST['pcontact'];
		$_SESSION['plan_free_msg'] = $_POST['plan_free_msg'];
		$_SESSION['profile'] = $_POST['profile'];
		$_SESSION['pamount'] = $_POST['pamount'];
		header("location:paid_approved_process.php?id=$index_id");
	}

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
    
       <p class="web_dialog_title" id="dialog_title">Approve Active to Paid</p>
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
       <form  action="paid_approved_process.php" method="post" name="frm" >
       <div class="dialog-box-second cf">
        <h3 class="title"></h3>
        <div class="business-desc cf">
         <div class="business-deail">
          	<p class="cf">
            	<span class="business-title">Payment Mode : </span>
                <span class="business-data">
                <select name="pmode" class="t" id="pmode">
                	<option value="Cash">Cash</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="DD">DD</option>
                    <option value="Money Order">Money Order</option>
                    <option value="Funds Transfer">Funds Transfer</option>
                    <option value="Other">Other</option>
         		</select>
                </span>
            </p>
            <p class="cf">
            	<span class="business-title">Activation Date : </span>
                <span class="business-data">
                <?php $today1 = strtotime ('now');
				$today=date("Y-m-d",$today1); ?>
                <input name="activedt" type="text" class="t" id="activedt" value="<?php echo $today; ?>" />
                </span>
            </p>
            <p class="cf">
            	<span class="business-title">Plan : </span>
                <span class="business-data">
               <?php
$plan = mysql_query("SELECT * from membership_plan");
?>
<select name="plan" class="t" onChange="getCurrencyCode('findpay.php?plan='+this.value)" >
<option value="0">Select Plan</option>
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
            	<span class="business-title">Allow Video : </span>
                <span class="business-data">
               <input name="video" type="radio" value="Yes"  checked="checked"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
               <input name="video" type="radio" value="No" />&nbsp;&nbsp;No
                </span>
            </p>
             <p class="cf">
            	<span class="business-title">Allow Chat : </span>
                <span class="business-data">
               <input name="chat" type="radio" value="Yes"  checked="checked"/>&nbsp;&nbsp;Yes&nbsp;&nbsp;
               <input name="chat" type="radio" value="No" />&nbsp;&nbsp;No
                </span>
            </p>
             <p class="cf">
            	<span class="business-title">Bank Details : </span>
                <span class="business-data">
                <textarea name="bankdet" cols="30" rows="4" class="forminput" id="bankdet"></textarea>
                </span>
            </p>
              <p class="submit-btn cf">
            	
                <span class="business">
               <input name="submit" type="submit" value="Submit" class="save-btn" title="Submit" />
               <input name="mid" type="hidden" id="mid" value="<?php echo $DatabaseCo->dbRow->matri_id;?>" />
               <input name="name" type="hidden" id="name" value="<?php echo $DatabaseCo->dbRow->username;?>" />
               <input name="email" type="hidden" id="email" value="<?php echo $DatabaseCo->dbRow->email;?>" />
               <input name="address" type="hidden" id="address" value="<?php echo $DatabaseCo->dbRow->address;?>" />
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
