<?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';

	

	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    

    $save_btn_text = "Save";
    

    $email = "";

    $password = "";

   


	$ACTION_MODE = "ADD";

	if(!empty($user_id))
	{

		$getRowCountSQL = "SELECT count(index_id) as 'TOTAL_USER' FROM   register where index_id=".$user_id;

		$rowCount = getRowCount($getRowCountSQL,$DatabaseCo);

		if($rowCount==1)

			$ACTION = "UPDATE";

	}	

  

  if($ACTION == "UPDATE")

  {

	 $SQL_STATEMENT2 = "SELECT * FROM register_view where index_id=".$user_id;

	  $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT2);

					  

	  while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))

	  {

			
			 $email = $DatabaseCo->dbRow->email;

			 $password = $DatabaseCo->dbRow->password;

			 
  

	  }

	  $ACTION_MODE = "UPDATE";

	  $save_btn_text = "Update";

  }

?>     

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/account-info.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post"   class="form-data" id="add-form">

		<p class="cf">

	      <label><font id="star">*</font> 1. Email :</label>

	     <input type="text" id="email" class="input-textbox" name="email" value="<?php echo $email;?>"/>
	      

	      </p>		

		<p class="cf">

	      <label><font id="star">*</font> 2. Confirm Email:</label>

	      <input type="text" id="conf_email" class="input-textbox" name="conf_email" value="<?php echo $email;?>"/>

	      

	      </p>

	    <p class="cf">

	      <label>3. Password:</label>

	  <input type="password" id="password"  class="input-textbox"  name="password"/>
<font id="star">&nbsp;(Leave blank if you do not want to change)</font>
				</p>

	  
	

	  <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />

	  

	  <input type="hidden" id="action" value="<?php echo $ACTION_MODE;?>"/>

	  

          <p class="submit-btn cf">

            <input type="submit"  class="save-btn" value="<?php echo $save_btn_text;?>" title="Save" id="add_basic_save"/>

            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>

          </p>

        </form>

	<script type="text/javascript" src="./js/util/location-validation.js"></script>

	<script type="text/javascript" >

		registerForm();

	</script>