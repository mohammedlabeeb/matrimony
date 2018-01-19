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
    $SQL_STATEMENT = "select * from register_view,payment_view where register_view.index_id=payment_view.index_id and register_view.index_id=".$index_id;
    $DatabaseCo->dbResult = $DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
    while ($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult)) 
                { 
                    			
    
?>   
<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<link rel="stylesheet" type="text/css" href="../../css/web_dialog.css" />
<link rel="stylesheet" type="text/css" href="../../css/snap_shot.css" />
<link rel="stylesheet" type="text/css" href="../../css/tool_tips.css" />

    <div id="full_detail_dialog" class="web_dialog_full_detail" style="overflow:hidden;"></div>
       <p class="web_dialog_title" id="dialog_title"><b>Invoice Detail</b></p>
     
        <div class="dialog-box">
        <div class="dialog-box-first cf">
       		<span class="user-image">
            <?php
			
			if($DatabaseCo->dbRow->photo1=='')
			{
				?>
          <img src="../../../images/nophoto.jpg" alt="User Image" height="150" width="130" />
          <?php
		  }else
          {?>
           <img src="../../../photos/<?php echo $DatabaseCo->dbRow->photo1;?>" alt="User Image" height="150" width="130" />
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
			  $likeDisLikeCss = "../../img/bgi/like-icon.png";
			else
			  $likeDisLikeCss = "../../bgi/dislike-icon.png";
		      ?>
                <img src="<?php echo $likeDisLikeCss;?>" title="Status"></span>
             </p>
             <p class="cf user-title">
             	<span class="builder-title"><img src="../../img/builder.png" alt="" title="">&nbsp;&nbsp;&nbsp;
				<?php echo $DatabaseCo->dbRow->status;?> (<?php echo $DatabaseCo->dbRow->p_plan;?>)</span>
             </p>
             <ul class="cf user-deails">
             	<li class="first"><img src="../../img/mail.png" alt="" title="" /> : <?php echo $DatabaseCo->dbRow->username;?></li>
                <li><img src="../../img/cellphone.png" alt="" title="" /> : <?php echo $DatabaseCo->dbRow->mobile;?></li>
                <li class="second"><img src="../../img/contact.png" alt="" title="" /> :<?php echo $DatabaseCo->dbRow->phone;?></li>
                <li class="first"><img src="../../img/address.png" alt="" title=""  class="user-img"/> <span class="user-label">: <?php echo $DatabaseCo->dbRow->email;?></span></li>
                <li class="third"><b>City:</b> <?php echo $DatabaseCo->dbRow->city_name;?>&nbsp;&nbsp;&nbsp;<b>State:</b> <?php echo $DatabaseCo->dbRow->state_name;?>&nbsp;&nbsp;&nbsp;<b>Country:</b> <?php echo $DatabaseCo->dbRow->country_name;?> </li>
                 
             </ul>
            </div>
            
       </div>
       <div class="dialog-box-second cf">
               
        
        <h3 class="title">Billing Information</h3>
        <div class="business-desc cf">
          <div class="business-deail">
          <p class="cf">
            	<span class="business-title">Bill To :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->username;?><br>
                <?php echo $DatabaseCo->dbRow->email;?><br>
                <?php echo $DatabaseCo->dbRow->paddress;?>
																							</span>
            </p>
          	<p class="cf">
            	<span class="business-title">Customer ID :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->matri_id;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Item :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->p_plan;?> Membership for <?php echo $DatabaseCo->dbRow->plan_duration;?> Days</span>
            </p>
            

          </div>
          <div class="business-deail">
          	
           <p class="cf">
            	<span class="business-title">Payment mode :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->paymode;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Activated On :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->pactive_dt;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Membership Expiry :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->exp_date;?></span>
            </p>
            <p class="cf">
            	<span class="business-title">Total Amount :</span>
                <span class="business-data"><?php echo $DatabaseCo->dbRow->p_amount;?></span>
            </p>
          </div>
        </div>
         <div align="center">
        
	<img src="../../img/print.png" onClick="window.print()" style=" text-align:center; cursor:pointer;" ><br>

    <span>Print Invoice </span>

         </div>
        
       </div>
       <a href="#" class="close-btn close"></a> 
     </div>
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
