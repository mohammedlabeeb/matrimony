<?php
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

$plan=$_REQUEST['plan'];
$plan2 = "SELECT * from membership_plan where plan_name='$plan'";
$exe=mysql_query($plan2) or die(mysql_error());
$rr=mysql_fetch_array($exe);


?>


 <p class="cf">
            	<span class="business-title">Duration : </span>
                <span class="business-data">
          <input name="duration" type="text" class="t" readonly="readonly" id="duration" value="<?php echo $rr['plan_duration'] ?>" />
                </span>
            </p>
            
            <p class="cf">
            	<span class="business-title">No of Contacts : </span>
                <span class="business-data">
               <input name="pcontact" type="text" class="t" readonly="readonly" id="pcontact" value="<?php echo $rr['plan_contacts'] ?>" />
                </span>
            </p>
             <p class="cf">
            	<span class="business-title">No of Message : </span>
                <span class="business-data">
              <input name="plan_free_msg" type="text" class="t" readonly="readonly" id="plan_free_msg" value="<?php echo $rr['plan_msg'] ?>" />
                </span>
            </p>
             <p class="cf">
            	<span class="business-title">No of View Profile : </span>
                <span class="business-data">
              <input name="profile" type="text" class="t" readonly="readonly" id="profile" value="<?php echo $rr['profile'] ?>" />
                </span>
            </p>
             <p class="cf">
            	<span class="business-title">Amount : </span>
                <span class="business-data">
              <input name="pamount" type="text" class="t" readonly="readonly" id="pamount" value="<?php echo $rr['plan_amount_type'] ?> <?php echo $rr['plan_amount'] ?>" />
                </span>
            </p>