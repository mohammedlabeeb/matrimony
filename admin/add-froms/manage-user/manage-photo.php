<?php

	include_once '../../databaseConn.php';

	include_once '../../lib/requestHandler.php';
	

	
	$DatabaseCo = new DatabaseConn();

	$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;

	$user_id = isset($_GET['index_id']) ? $_GET['index_id'] :"" ;

    $page_title = "Add New Member";

    $save_btn_text = "Save";    

    $photo1 = "";

    $photo2 = "";

    $photo3 = "";

    $photo4 = "";

    $photo5 = "";
	
	$photo6 = ""; 


	$ACTION_MODE = "ADD";

	if(!empty($user_id))
	{		

		$getRowCountSQL = "SELECT count(index_id) as 'TOTAL_USER' FROM  register where index_id=".$user_id;

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

		    		$photo1 = $DatabaseCo->dbRow->photo1;

                    $photo2 = $DatabaseCo->dbRow->photo2;

                    $photo3 = $DatabaseCo->dbRow->photo3;

                    $photo4 = $DatabaseCo->dbRow->photo4;

                    $photo5 = $DatabaseCo->dbRow->photo5;

                    $photo6 = $DatabaseCo->dbRow->photo6;
                    
	  }

	  $ACTION_MODE = "UPDATE";

	  $page_title = "Update Member ".$user_id;

	  $save_btn_text = "Update";

  } 

?>

<span class="field_marked">* Fields are required.</span>

<div class='error-msg' id='validationSummary'></div>

  <form action="./web-services/edit-user/manage-photo.php?action=<?php echo $ACTION_MODE;?>&user_id=<?php echo $user_id;?>"  method="post" enctype="multipart/form-data"  class="form-data" id="add-form" name="MatriForm">

                <p class="cf">

            <label> Member Photo 1:</label>

            <input type="file" class="input-textbox" name="image_file1" id="Role_Icon1" /><br><br>
			 </p>  
          <p class="submit-btn cf">
          <?php if($photo1!='')
		  {?>
            <img src="../photos/<?php echo $photo1;?>" width="120" height="160">
          <?php
		  }
		  ?>
<input type="hidden" name="photo1" id="photo1" value="<?php echo $photo1; ?>" />
           
          </p>  
          <p class="cf">
          <label> Member Photo 2:</label>

            <input type="file" class="input-textbox" name="image_file2" id="Role_Icon2" /><br><br>
			 </p>  
          <p class="submit-btn cf">
           <?php if($photo2!='')
		  {?>
            <img src="../photos/<?php echo $photo2;?>" width="120" height="160">
          <?php
		  }
		  ?>
<input type="hidden" name="photo2" id="photo2" value="<?php echo $photo2; ?>" />
          

          </p>  
          <p class="cf">
          <label> Member Photo 3:</label>

            <input type="file" class="input-textbox" name="image_file3" id="Role_Icon3" /><br><br>
			 </p>  
          <p class="submit-btn cf">
            <?php if($photo3!='')
		  {?>
            <img src="../photos/<?php echo $photo3;?>" width="120" height="160">
          <?php
		  }
		  ?>
<input type="hidden" name="photo3" id="photo3" value="<?php echo $photo3; ?>" />
            
          </p>  
          <p class="cf">
          <label> Member Photo 4:</label>

            <input type="file" class="input-textbox" name="image_file4" id="Role_Icon4" /><br><br>
			 </p>  
          <p class="submit-btn cf">
            <?php if($photo4!='')
		  {?>
            <img src="../photos/<?php echo $photo4;?>" width="120" height="160">
          <?php
		  }
		  ?>

         <input type="hidden" name="photo4" id="photo4" value="<?php echo $photo4; ?>" />      

          </p>  
          <p class="cf">
          <label> Member Photo 5:</label>

            <input type="file" class="input-textbox" name="image_file5" id="Role_Icon5" /><br><br>
			 </p>  
          <p class="submit-btn cf">
           <?php if($photo5!='')
		  {?>
            <img src="../photos/<?php echo $photo5;?>" width="120" height="160">
          <?php
		  }
		  ?>
<input type="hidden" name="photo5" id="photo5" value="<?php echo $photo5; ?>" />
            

          </p>  
          <p class="cf">
          <label> Member Photo 6:</label>

            <input type="file" class="input-textbox" name="image_file6" id="Role_Icon6" /><br><br>
			 </p>  
          <p class="submit-btn cf">
            <?php if($photo6!='')
		  {?>
            <img src="../photos/<?php echo $photo6;?>" width="120" height="160">
          <?php
		  }
		  ?>
	 <input type="hidden" name="photo6" id="photo6" value="<?php echo $photo6; ?>" />
       

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
    