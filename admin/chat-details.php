<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  require_once("../BusinessLogic/class.weddingplanner.php");
	require_once("../BusinessLogic/class.wpcategory.php");

  $chat_status = "";
  if(isset($_GET['chat_status']))
  {
    $chat_status = $_GET['chat_status'];
    $_SESSION['chat_status'] = $_GET['chat_status'];
  }
  else if(isset($_GET['page']))
  {
      $chat_status = $_SESSION['chat_status'];
  }
  else
  {
      $_SESSION['chat_status'] = "all";
      $chat_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['id']))
	{
		$id_arr = $_POST['id'];
		$id_val = "(";
		foreach($id_arr as $id)
		{
			$id_val .=	$id.",";
		}
		$id_val = substr($id_val, 0, -1);
		$id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from chat where id in ".$id_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update chat set status='APPROVED' where id in ".$id_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update chat set status='UNAPPROVED' where id in ".$id_val;	
			      break;
		 	
			     
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $status_MESSAGE = $statusObj->getstatusMessage();
	}
	else
	{
	  $statusObj = new status();
	  $statusObj->setActionSuccess(false);
	  $status_MESSAGE = "Please select value to complete action.";	  
	}
 }
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Chat </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="./css/web_dialog.css" />
<link rel="stylesheet" type="text/css" href="css/snap_shot.css" />
<link rel="stylesheet" type="text/css" href="css/tool_tips.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript">
setPageContext("activity","chat");
 $(document).ready(function ()
   {
      $("#approove" ).button().click(function(){
	window.location = "email-chat.php?chat_status=approved";
      });
	 
     $("#unapproove" ).button().click(function(){
	window.location = "email-chat.php?chat_status=unapproved";
      });
	  
    $("#all" ).button().click(function(){
	window.location = "email-chat.php?chat_status=all";
      });
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
      <div class="breadcum-wide"><a href="#" title="Chat">Chat</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Chat"  onclick="window.location='chat-details.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Chat</a>
       
         
        </div>
      </div>
      <?php
	if(!empty($status_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$status_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$status_MESSAGE."</li></ul></div>";	
		}
	}
      ?> 
      
      <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>      
      
      
      <div class="widecolumn-inner memership-detail">
	<?php
	    
	  $chat_count = getRowCount("select count(id) from chat".getWhereClauseForstatus($chat_status),$DatabaseCo);
	    if($chat_count>0){  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php echo strtoupper($chat_status); ?> Chat List</h1>
          </div>  	
        <div class="cf membership-data">
	  
    
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	
     
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["chat_page_size"])?$_COOKIE["chat_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
	
		$SQL_STATEMENT =  "SELECT * from chat  ORDER BY id DESC LIMIT ".$lim_str;
		
	    ?>
        
        </div>
	
	 
	
	<form method="post" action="chat-details.php" id="action_form">
	 
	<!-- MEMBERSHIP PLAN-1 START -->
        <div class="plan-desc">
          
          <div class="table-desc">
            <table width="100%"  cellpadding="0" cellspacing="0" border="1" class="table-data">
              <tr>
                <th  width="3%">
             <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
             
              <th width="8%">Sender</th>
              <th width="8%">Receiver</th>
             <th width="36%">Message</th>
              <th width="14%">Sent Date</th>
              </tr>
              <?php						
		$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
		$rowCount=0;
		while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
		{
			if($rowCount%2!=0)
					$cssClass="odd";
			else
					$cssClass="even";
			$rec_not_found = false;			
        	?>	
              <tr class="<?php echo $cssClass;?>">
                <td><input type="checkbox"  class="table-checkbox" name="id[]" value="<?php  echo $DatabaseCo->dbRow->id;?>" /></td>
                
                <td ><?php echo $DatabaseCo->dbRow->from;?></td>
                <td ><?php echo $DatabaseCo->dbRow->to;?></td>
                <td ><?php echo (substr($DatabaseCo->dbRow->message,0,300));?></td>
                <td ><?php $a=$DatabaseCo->dbRow->sent;
				 echo date('F j, Y, g:i a', (strtotime($a)));?></td>
                

            </tr>
	      <?php
	$rowCount++;
	      }
	 ?>
	    
            </table>
          </div>
        </div>
	<!-- MEMBERSHIP PLAN-1 END -->
	
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
  <?php 
		$SQL_STATEMENT_PAGINATION = "select count(id) as 'total_rows' from chat".getWhereClauseForstatus($chat_status);		  
	    echo getNewPagination('chat-details.php','chat_page_size','chat','id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($chat_status); ?> Chat. Please add data.</h1>
         <br/>
	  <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
	  </div>
        </div>
	 
	 <?php
	  }
	 ?>

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
