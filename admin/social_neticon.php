<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();

  $icon_status = "";
  if(isset($_GET['icon_status']))
  {
    $icon_status = $_GET['icon_status'];
    $_SESSION['icon_status'] = $_GET['icon_status'];
  }
  else if(isset($_GET['page']))
  {
      $icon_status = $_SESSION['icon_status'];
  }
  else
  {
      $_SESSION['icon_status'] = "all";
      $icon_status = "all";
  }
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['sid']) && is_array($_POST['sid']))
	{
		$sid_arr = $_POST['sid'];
		$sid_val = "(";
		foreach($sid_arr as $sid)
		{
			$sid_val .=	$sid.",";
		}
		$sid_val = substr($sid_val, 0, -1);
		$sid_val .=")";
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  social_networking_icon where sid in ".$sid_val;	
			      break;
		    case 'APPROVED':
				$SQL_STATEMENT =  "update  social_networking_icon set STATUS='APPROVED' where sid in ".$sid_val;	
			      break;
		    case 'UNAPPROVED':
				$SQL_STATEMENT =  "update  social_networking_icon set STATUS='UNAPPROVED' where sid in ".$sid_val;	
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $STATUS_MESSAGE = $statusObj->getStatusMessage();
	}
	else
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
<title>Admin | Social Networking Icon</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="css/web_dialog.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/cookieapi.js"></script>
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript">
setPageContext("site-settings","social_neticon");
var refreshRequired = false;
 $(document).ready(function ()
   {
     
     $("#approove" ).button().click(function(){
	window.location = "social_neticon.php?icon_status=approved";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "social_neticon.php?icon_status=unapproved";
      });
    $("#all" ).button().click(function(){
	window.location = "social_neticon.php?icon_status=all";
      });
	  

     $("#save" ).button().click(function(){
		 
	
     		$("#validationSummary").attr("class","error-msg");
     	   	$("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
     	   	$("#validationSummary").show();
		$.post(
		      "./web-services/site-setting/add-social-icon.php?action="+$("#update_action").val(),
		      $("#icon-form").serialize(),
		      function(data){
				      if(data.successStatus){
				        $("#validationSummary").attr("class","success-msg cf");
					$("#validationSummary").html("<h3>"+data.responseMessage+"</h3>");
					$("#validationSummary").show();
					refreshRequired = true;
				      }else{

					$("#validationSummary").attr("class","error-msg");
					$("#validationSummary").html("<h3>Please correct following errors.</h3><ul class='error-hint cf'>"+data.responseMessage+"</ul>");
					$("#validationSummary").show();
				      }
			    }
		  );
	});
     
     $("#cancel" ).button().click(function(e){
	 			HideDialog();
        e.preventDefault();
			});
     
      $("#add_icon").click(function (e)
      {
					
		$("#save").val("Save");
		
	 	$("#dialog_title").text("Add New Social Networking Icon");
	 	$("#update_action").val("ADD"); 
         	ShowDialog(true);
         	e.preventDefault();
         	$("#validationSummary").hide();
		$("#icon_name").focus();
		$("#icon_name").val("");
      });
      
      $("#btnClose").click(function (e)
      {
         HideDialog();
         e.preventDefault();
      });
   });
   
	 
   function edit_country(sid,country_name,icon_status)
      {
	 
	 $("#save").val("Update");
	 $("#dialog_title").text("Update Social Networking Icon");
	 $("#update_action").val("UPDATE"); 
	 $("#sid").val(sid); 
	 $("#Country_Name").val(country_name);
		 		
         if(icon_status=='APPROVED'){
	    $("#icon_status1").attr("checked","checked");
	 }else{	
	      $("#icon_status2").attr("checked","checked");
	 }
	 ShowDialog(true);
	 $("#validationSummary").hide();
	 $("#Country_Name").focus();	      
      }

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
      if(refreshRequired)
	  window.location.reload(true);
   } 
        
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
      <div class="breadcum-wide"><a href="#" title="Site Settings">Site Settings</a> / <a href="#" title="Social Networking">Social Networking</a></div>
      <div class="listing-section">
        <div class="member-list cf">
        <a href="social_neticon.php" class="button" title="List all Social Networking">
        <img src="img/bgi/list-icon.png" alt="Add"/>List all Social Networking</a>
         
          <div class="approval alignleft">
          
            <input type="button" title="All Country List"   id="all" value="All (<?php echo getRowCount("select count(sid) from social_networking_icon",$DatabaseCo);?>)"/>
 
          </div>
        </div>
      </div>
      
      
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
     <?php
	 $success= isset($_GET['success']) ? $_GET['success'] :"" ;
	 if(!empty($success))
	 {
	echo  "<div class='success-msg cf' id='success_msg'><h3>Record is updated successfully.</h3></div>";	 
	 }
	 ?>       
      <div class="widecolumn-inner memership-detail">
    <?php
	    
	    $icon_count = getRowCount("select count(sid) from social_networking_icon".getWhereClauseForStatus($icon_status),$DatabaseCo);
	    if($icon_count>0)
		{  
	   ?>
	    <div class="nodata-avail ">
            <h1><?php echo strtoupper($icon_status); ?> Social Networking Icon List</h1>
          </div>   

        <div class="cf membership-data">
 
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('APPROVED');">Approved</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Approved" onclick="submitActionForm('UNAPPROVED');">Unapproved</a>          
	  <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["icon_page_size"])?$_COOKIE["icon_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "SELECT * FROM social_networking_icon ".getWhereClauseForStatus($icon_status)." ORDER BY sid DESC  LIMIT ".$lim_str;
?>



        </div>
        <div class="table-desc cf">
          <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table-data">
            <tr>
              <th  width="3%"> <input type="checkbox" class="table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/></th>
              <th width="7%">Edit</th>
              <th width="10%">Status</th>
              <th width="33%">Icon Name</th>
              <th width="35%">Link</th>
            </tr>
            <form method="post" action="social_neticon.php" id="action_form">
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
                <td><input type="checkbox"  class="table-checkbox" name="sid[]" value="<?php  echo $DatabaseCo->dbRow->sid;?>" /></td>
                <td><a class="edit-btn margin-none" href="add_social_neticon.php?id=<?php  echo $DatabaseCo->dbRow->sid;?>" title="Edit" id="edit_icon">Edit</a></td>
                <td><?php
			$likeDisLikeCss = "";
			if($DatabaseCo->dbRow->status=="APPROVED")
			  $likeDisLikeCss = "like-icon";
			else
			  $likeDisLikeCss = "dislike-icon";
			
		      ?>
                  <a href="#" class="<?php echo $likeDisLikeCss;?>"></a></td>
                <td ><?php echo $DatabaseCo->dbRow->sname;?></td>
                <td ><?php 
				if($DatabaseCo->dbRow->sname=='Twitter')
				{
				?>	
                	<?php echo $DatabaseCo->dbRow->slink;?>
					 <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                 <?php   
				}
				else
				{
				echo $DatabaseCo->dbRow->slink;?></td>
				<?php } ?>
            </tr>
	    <?php
	    $rowCount++;
	      }
	  ?>
              <input  type="hidden" name="action" value="" id="action"/>
            </form>
			
          </table>
          <?php 	
		$SQL_STATEMENT_PAGINATION = "select count(sid) as 'total_rows' from  social_networking_icon".getWhereClauseForStatus($icon_status);		  
	echo getNewPagination('social_neticon.php','icon_page_size','social_networking_icon','sid',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
?>		  
        </div>
		<!-- copy from here -->
		        <?php
	    }
	    else
	    {
	    ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($icon_status); ?> Social Networking Icon. Please add data.</h1>
          <br/>
	  <img src="img/no-data.png" alt="No Data" style="border: 2px solid #ccc;"/>
	  </div>
        </div>
        <?php
	    }
	   ?>
<!-- copy from here  end -->
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
