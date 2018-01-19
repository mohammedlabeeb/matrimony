<?php
include_once 'databaseConn.php';
include_once './lib/requestHandler.php';
include_once './lib/page.class.php';
$DatabaseCo = new DatabaseConn();
$pageSetting = new Page("Submit","db-checkup.php","Submit");
$ACTION = isset($_GET['action']) ? $_GET['action'] :"" ;
$id = isset($_GET['id']) ? $_GET['id'] :"" ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Database Checkup</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/jquery.validate.js"></script>
<script type="text/javascript" src="js/util/form-validation.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<script type="text/javascript">
setPageContext("database-operation","checkup");

	$(document).ready(function()
	 {
	    var formId = "#add_newsletter";
	    var rules = {
               
               
				query:{ required: true},
				
				
				
				
            };
	    var messages = {
				
               
				query:{required:"Mysql query is required."},
				
				
	
		};
            validateForm(formId,rules,messages);	
           
	    
});

</script>

</head>
<body>
<div id="wrapper">
  <?php
	require_once('./page-part/header.php');
?>
  <!-- start content -->
  <div id="container" class="cf">
    <?php
	require_once('./page-part/left-menu.php');
?>
    <div class="widecolumn alignleft">
      <div class="breadcum-wide"><a title="Database Checkup">Database Checkup</a></div>
      <div class="listing-section">
        <div class="member-list cf">
         
          <a href="javascript:;" class="button" title="Database Checkup"  onclick="window.location='db-checkup.php'"><img src="img/bgi/add-icon.png" alt="Add"/>Database Checkup</a>
        </div>
      </div>
      <div class="widecolumn-inner">
        <h4><?php echo $pageSetting->getFormTitle();?></h4>
		<span class="field_marked">All Fields are required.</span>
       <?php
					if(!empty($STATUS_MESSAGE))
					{	
						if($save)
						{
							echo  "<div class='success-msg cf' id='success_msg'><h4>".$STATUS_MESSAGE."</h4>    
</div>";
						echo "<div class='error-msg' id='validationSummary'></div>";							
						}

						else
						{
						echo  "<div class='error-msg' id='validationSummary' style='display:block'><h4>Please Correct Following Errors.</h4><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";	
						}
							
					}
					else
					{
						echo "<div class='error-msg' id='validationSummary'></div>";						
					}
				?>	
        <form action="sqldb_result.php" method="post" class="form-data" id="add_newsletter" >
          
          
  
          
          <p class="cf"> <span class="tinyBox">Type your MySQL query:<br />
</span>
            <textarea  name="query" id="query" style="height:150px;margin-left: 28px;width: 720px; font-size:17px;" ><?php echo $content;?></textarea>
          </p>
          
          
          
          <p class="submit-btn cf">
            <input type="submit"  class="save-btn" value="<?php echo $pageSetting->getActionBtnName(); ?>" title="<?php echo $pageSetting->getActionBtnName(); ?>" />
            <input type="reset" class="save-btn" value="Cancel" title="Cancel"/>
          </p>
          <input type="hidden" name="action" value="<?php echo $ACTION;?>" />
          <input type="hidden" name="id" value="<?php echo $id;?>" />	  
        </form>
      </div>
      <?php
	require_once('./page-part/footer.php');
?>
    </div>
  </div>
  <!-- end content --> 
</div>
</body>
</html>
