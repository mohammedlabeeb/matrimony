<?php
error_reporting(0);
session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  include_once './class/Location.class.php';
  $DatabaseCo = new DatabaseConn();
  function getSuppressString($dComment,$char_limit)
  {
  	$suppressComments = substr($dComment, 0,$char_limit);
  	if(strlen($dComment)>$char_limit)
  		$suppressComments = $suppressComments." ...";
  	return $suppressComments;
  }
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['mes_id']))
	{
		$mes_id_arr = $_POST['mes_id'];
		$mes_id_val = "(";
		foreach($mes_id_arr as $mes_id)
		{
			$mes_id_val .=	$mes_id.",";
		}
		$mes_id_val = substr($mes_id_val, 0, -1);
		$mes_id_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  messages where mes_id in ".$mes_id_val;	
			      break;
		   
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $STATUS_MESSAGE = $statusObj->getStatusMessage();
	}else
	{
	  $statusObj = new Status();
	  $statusObj->setActionSuccess(false);
	  $STATUS_MESSAGE = "Please select value to complete action.";	  
	}
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Inbox</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
<link rel="stylesheet" type="text/css" href="css/my_inbox.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.loader.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript" src="js/util/location.js"></script>
<script type="text/javascript" src="js/jquery.loader.js"></script>
<script type="text/javascript" src="./js/util/jquery.form.js"></script>
<script type="text/javascript" src="js/ajax_form_submission.js"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->

<script type="text/javascript">
setPageContext("messages","inbox");

var refreshRequired = false;
 $(document).ready(function ()
   {
     $("#save" ).button().click(function(){
	});
     $("#cancel" ).button().click(function(e){
		 HideDialog();
         e.preventDefault();
	});
     
      $("#add_locality").click(function (e)
      {
	   
	   	 	ShowDialog(true);
	    	e.preventDefault();
			 refreshRequired = true;
	   
      });

      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
		 if(refreshRequired)
	  		window.location.reload(true);
      });
      $("#btnCloseReply").click(function (e)
    	      {
    	         HideReplyMessageDialog();
    	         e.preventDefault();
				  if(refreshRequired)
	  		window.location.reload(true);
    	      });
      $("#btnCloseFullMessage").click(function (e)
    	      {
    	         HideFullMessageDialog();
    	         e.preventDefault();
    	      });
      registerForm();	 
   });
 function getMessageDetail(mes_id)
 {
 	
 	$("#fullMessage").html("Please wait...");
 	$.get("../admin/web-services/user/get_message_detail.php?mes_id="+mes_id,
 	function(data){
 		$("#fullMessage").html(data);
		ShowFullMessageDialog(true);
		$(".email-textarea").css("width","427px");
 	});
 }
 function openReplyMessage(matri_id){
	 HideFullMessageDialog();
	 ShowReplyMessageDialog();
	 $("#message_reply").html();
     $("#matri_id").val(matri_id);
}
function replyMessage(){
	
	 $.ajax({
    	 url:"../admin/web-services/user/reply_message.php",
    	 type:"POST",
    	 data:{"matri_id":$("#matri_id").val(),"message":$("textarea#message_reply").val()},
    	 success:function(data){
    		 alert(data);
			 refreshRequired = true;
    	 }
     });
}
    //Compose Message 
   function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#dialog").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
            HideDialog();
         });
      }
   }

   function HideDialog()
   {
      $("#overlay").hide();
      $("#dialog").fadeOut(300);
                   
   } 

   //Full Message  
   function ShowFullMessageDialog(modal)
   {
      $("#overlay").show();
      $("#fullMessageDialog").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
        	 HideFullMessageDialog();
         });
      }
   }

   function HideFullMessageDialog()
   {
      $("#overlay").hide();
      $("#fullMessageDialog").fadeOut(300);
                   
   } 
     
   //Reply Message 
   function ShowReplyMessageDialog(modal)
   {
      $("#overlay").show();
      $("#replyDialog").fadeIn(300);

      if (modal)
      {
         $("#overlay").unbind("click");
      }
      else
      {
         $("#overlay").click(function (e)
         {
        	 HideReplyMessageDialog();
         });
      }
   }

   function HideReplyMessageDialog()
   {
      $("#overlay").hide();
      $("#replyDialog").fadeOut(300);
	  
                   
   }          
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
      <div class="breadcum-wide"><a href="#" title="User">Messages</a> / <a href="#" title="Role">Inbox</a></div>
      <div class="listing-section">
    
        <div class="member-list cf">
          <a href="javascript:;" class="button"  title="Compose" id="add_locality"><img src="img/bgi/add-icon.png" alt="Add"/>Compose New Message</a>
          
        </div>
      </div>
      
      
      <div id="overlay" class="web_dialog_overlay"></div>
      <!-- Compose New Message start -->
      <div id="dialog" class="web_dialog">
        <p class="web_dialog_title" id="dialog_title" style="text-align:center; background-color:#191919; color:white;">Compose Message</p>
        <a href="#" id="btnClose" class="close"><img src="img/bgi/close.jpg" width="15" height="12" alt="Close"/></a> <br/>
         <span class="field_marked">All Fields are required.</span>
		 <div class='error-msg' id='validationSummary'></div>
	<form action="../admin/web-services/user/send-sms-email.php" method="post" id="add-form" style="padding:10px;">
	  <p class="cf">
            <label class="popup-label">1. To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
           <select class="comboBox" style="width: 368px;" name="to_id" id="to_id">
			<option value="">Select Person</option>
			<?php
			$SQL_STATEMENT =  "SELECT * FROM register_view";
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
			while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
			{
				?>
			<option
				value="<?php echo $DatabaseCo->dbRow->matri_id;?>">
				<?php echo $DatabaseCo->dbRow->username;?>
				(<?php echo $DatabaseCo->dbRow->status;?>)
			</option>
			<?php
			}
			?>
		</select>
            </p>
          <p class="cf">
            <label class="popup-label">2. Subject:&nbsp;&nbsp;</label>
            <input type="text" calsss="textBox" name="subject" style="width:364px"/>
            </p>
          <p class="cf">
            <label class="popup-label">3. Message:</label>
            <textarea rows="8" cols="50" name="message" id="message"></textarea>
	  </p>
         	  			          	  
          <p class="cf" style="margin-left:88px;">
            <input type="submit" id="save" class="save-btn" value="Send" title="Save"/>
          </p>
		         
        </form>
      </div>
      <!-- Compose New Message End -->
      
      <!-- Reply Message Start -->
      <div id="replyDialog" class="web_dialog">
	    	  <p class="web_dialog_title" id="dialog_title" style="text-align:center; background-color:#191919; color:white;">Reply Message</p>
	        <a href="#" id="btnCloseReply" class="close"><img src="img/bgi/close.jpg" width="15" height="12" alt="Close"/></a> <br/>
	       <div id="reply_area" style="padding: 15px"> 
	     <textarea rows="15" cols="66" id="message_reply"></textarea>
	     <br/><br/>
	     <input type="button" class="save-btn" value="Send" title="Save" id="send_sms_btn" onclick="replyMessage()"/>
	     <input type="hidden" id="matri_id" value="" />
	     
	     </div>
     </div>
     <!-- Reply Message End -->
     <!-- Full Message dialog start -->
      <div id="fullMessageDialog" class="web_dialog">
	    	  <p class="web_dialog_title" id="dialog_title" style="text-align:center; background-color:#191919; color:white;">Full Message</p>
	          <a href="#" id="btnCloseFullMessage" class="close"><img src="img/bgi/close.jpg" width="15" height="12" alt="Close"/></a> <br/>
	          <div id="fullMessage" style="padding: 15px;">
	          </div>
	  </div>      
     <!-- Full Message Dialog End -->
      
 <?php
	if(!empty($STATUS_MESSAGE))
	{	
		if($statusObj->getActionSuccess()){
			echo  "<div class='success-msg cf' id='success_msg'><h3>".$STATUS_MESSAGE."</h3>  </div>";
		}else{
		    echo  "<div class='error-msg' id='validationSummary' style='display:block'><h3>Please Correct Following Errors.</h3><ul ><li>".$STATUS_MESSAGE."</li></ul></div>";		
		}
	}
	 ?>       
      <div class="widecolumn-inner memership-detail">
        <?php

			$SQL_STATEMENT_COUNT = "select count(mes_id) from messages where to_id='admin'";
			$locality_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
    
	    if($locality_count>0){  
	   ?>
	    <div class="nodata-avail ">
            <h1>
            Inbox Messages List
            </h1>
          </div>   
        <div class="cf membership-data">
        <span class="checkbox"><input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></span>
         <a href="javascript:;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
		  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["inbox_page_size"])?$_COOKIE["inbox_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		 
		$SQL_STATEMENT =  "SELECT * FROM messages where to_id='admin' ORDER BY mes_id  DESC LIMIT ".$lim_str;
		$SQL_STATEMENT_PAGINATION = "select count(mes_id) as 'total_rows' from  messages where to_id='admin'";
?>
    
</div>
    <div class="cf">
    	<div class="my-property-outer">
              <form method="post" action="inbox.php" id="action_form">
        	   <div class="cf property-detail-section">
        	   <?php 
        	   
			$DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
			while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
			{ 		
			?>
									<div class="active-property">
										<div id="myinbox" class="container">

											<div class="mycontent">
												<div class="cf email-section" style="display: block;">
													<p class="alignleft check-box">
														<span class="checkbox"><input type="checkbox"
															class="table-checkbox" name="mes_id[]"
															value="<?php  echo $DatabaseCo->dbRow->mes_id;?>">
														
														</span>
													</p>
													<p class="email-detail alignleft">
	<a href="javascript:;" class="email-unread" onclick="getMessageDetail(<?php echo $DatabaseCo->dbRow->mes_id;?>);"> <?php echo $DatabaseCo->dbRow->subject;?></a> 
                 <span class="email-desc" style="width: 730px;"> 
				<?php echo getSuppressString($DatabaseCo->dbRow->message,210);?>
				</span> 
                <span class="form-info">From:

															<?php echo $DatabaseCo->dbRow->from_id;?></span>
													</p>
			<p class="alignright"><?php $a=$DatabaseCo->dbRow->sent_date;
				 echo date('F j, Y, g:i a', (strtotime($a)));?></p>
												</div>
											</div>




										</div>

									</div>

									<?php 
			}
                ?>
			    </div>
      <input  type="hidden" name="action" value="" id="action"/>
            </form>
            </div>
    		<?php 
    		echo getNewPagination('inbox.php','inbox_page_size','messages','mes_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
    		?>
    
    </div>    
        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for  Inbox.</h1>
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
      </div>
  <!-- end content --> 
</div>
</body>
</html>
