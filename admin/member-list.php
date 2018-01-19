<?php
  session_start();
  include_once 'databaseConn.php';
  include_once './lib/pagination1.php';
  include_once './lib/requestHandler.php';
  $DatabaseCo = new DatabaseConn();
  include_once '../class/Config.class.php';
  $configObj = new Config();
 
  
  $search_case = false;
  $member_status = "";
  if(isset($_GET['member_status']))
  {
    $member_status = $_GET['member_status'];
    $_SESSION['member_status'] = $_GET['member_status'];
  }
  else if(isset($_GET['page']))
  {
      $member_status = $_SESSION['member_status'];
  }
  else
  {
      $_SESSION['member_status'] = "all";
      $member_status = "all";
  }
   if(isset($_GET['option']) && $_GET['option']=='clear_search')
  {
	unset($_SESSION['search_title']);
	unset($_SESSION['where_clause']);
	unset($_SESSION['search_action']);
	$search_case = false;
  }
  $search_title = "";
  $where_clause = "";
  
  $isPostBack = ($_SERVER["REQUEST_METHOD"]==="POST");
  if($isPostBack)
  {     
 	$ACTION = isset($_POST['action']) ? $_POST['action'] :"" ;
	if(isset($_POST['index_id']))
	{
		$index_id_arr = $_POST['index_id'];
		$index_id_val = "(";
		foreach($index_id_arr as $index_id)
		{
			$index_id_val .=	$index_id.",";
		}
		$index_id_val = substr($index_id_val, 0, -1);
		$index_id_val .=")";
				
		$website =  $configObj->getConfigName();
		$webfriendlyname =  $configObj->getConfigFname();
		$from = $configObj->getConfigFrom();
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				
$result45 = mysql_query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Delete Member'");
$rowcs5 = mysql_fetch_array($result45);

$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("webfriendlyname" =>$webfriendlyname);

$email_template = strtr($email_template, $trans);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";
		
		foreach($index_id_arr as $index_id)
		{
 $select=mysql_query("select email,photo1,photo2,photo3,photo4,photo5,photo6,matri_id  from register where index_id =".$index_id);
		    
	   $row = mysql_fetch_array($select);
	   		   
		is_file(unlink("../photos/".$row['photo1']));
		is_file(unlink("../photos_big/".$row['photo1']));
		is_file(unlink("../photos/".$row['photo2']));
		is_file(unlink("../photos_big/".$row['photo2']));
		is_file(unlink("../photos/".$row['photo3']));
		is_file(unlink("../photos_big/".$row['photo3']));
		is_file(unlink("../photos/".$row['photo4']));
		is_file(unlink("../photos_big/".$row['photo4']));
		is_file(unlink("../photos/".$row['photo5']));
		is_file(unlink("../photos_big/".$row['photo5']));
		is_file(unlink("../photos/".$row['photo6']));
		is_file(unlink("../photos_big/".$row['photo6']));   
		   
		   $email = $row['email'];
		   mail($email, $subject, $email_template, $headers);
	   
	 		$del_membership = mysql_query("delete from  payments where pmatri_id ='".$row['matri_id']."'");	   	
		}
      
	   	
	   		$SQL_STATEMENT =  "delete from  register where index_id in ".$index_id_val;
			      break;	  
				  
				  
				  
		    case 'Active':
				$SQL_STATEMENT =  "update register set status='Active',fstatus='' where index_id in ".$index_id_val;
					
$result45 = mysql_query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Active Member'");
$rowcs5 = mysql_fetch_array($result45);

$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website);
$email_template = strtr($email_template, $trans);


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";

      $select=mysql_query("select email from register where index_id in ".$index_id_val);
		    
	   while ($row = mysql_fetch_array($select))
	   {
       $email = $row['email'];
	   mail($email, $subject, $email_template, $headers);
	   }
		 		  break;
  
				  
		    case 'Inactive':
				$SQL_STATEMENT =  "update  register set status='Inactive',fstatus='' where index_id in ".$index_id_val;	
			      break;
		 				
			case 'Suspended':
				$SQL_STATEMENT =  "update  register set status='Suspended',fstatus='' where index_id in ".$index_id_val;
				
$result45 = mysql_query("SELECT * FROM email_templates where EMAIL_TEMPLATE_NAME = 'Suspend Member'");
$rowcs5 = mysql_fetch_array($result45);

$subject = $rowcs5['EMAIL_SUBJECT'];	
$message = $rowcs5['EMAIL_CONTENT'];
$email_template = htmlspecialchars_decode($message,ENT_QUOTES);

$trans = array("webfriendlyname" =>$webfriendlyname,"website"=>$website);
$email_template = strtr($email_template, $trans);


	$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";

      $select=mysql_query("select email from register_view where index_id in ".$index_id_val);
		    
	   while ($row = mysql_fetch_array($select))
	   {
       $email = $row['email'];
	   mail($email, $subject, $email_template, $headers);
	   }		
			      break;
	    }
	
	  $statusObj = handle_post_request("UPDATE",$SQL_STATEMENT,$DatabaseCo);
	  $status_MESSAGE = $statusObj->getstatusMessage();
	}
	else if($ACTION=='SEARCH')
	{
		$search_case = true;
		$search_title = isset($_POST['search_title'])?$_POST['search_title']:"";
		$where_clause = isset($_POST['where_clause'])?$_POST['where_clause']:"";
		$_SESSION['search_title'] = $search_title;
		$_SESSION['where_clause'] = stripslashes($where_clause);
		$_SESSION['search_action'] = 'SEARCH';
		
	}
	else
	{
	  $statusObj = new status();
	  $statusObj->setActionSuccess(false);
	  $status_MESSAGE = "Please select value to complete action.";	  
	}
 }
 if(isset($_SESSION['search_action']) && $_SESSION['search_action']=='SEARCH')
{
	$search_case = true;
	$search_title = $_SESSION['search_title'];
    $where_clause =stripslashes($_SESSION['where_clause']);
}  
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin | Manage Members </title>
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
<script type="text/javascript" src="js/util/redirection2.js"></script>
<!--[if IE ]>
<link rel="stylesheet" type="text/css" href="css/ie.css">
<![endif]-->
<!--[if IE 9 ]>
<link rel="stylesheet" type="text/css" href="css/ie9.css">
<![endif]-->
<script type="text/javascript">
setPageContext("member","all-members");
 $(document).ready(function ()
   {
      $("#approove" ).button().click(function(){
	window.location = "member-list.php?member_status=Active";
      });
	  $("#paid" ).button().click(function(){
	window.location = "member-list.php?member_status=Paid";
      });
	  $("#featured" ).button().click(function(){
	window.location = "member-list.php?member_status=Featured";
      });
     $("#unapproove" ).button().click(function(){
	window.location = "member-list.php?member_status=Inactive";
      });
	   $("#suspended" ).button().click(function(){
	window.location = "member-list.php?member_status=Suspended";
      });
    $("#all" ).button().click(function(){
	window.location = "member-list.php?member_status=all";
      });
	  
	   $("#btnClose_filter").click(function(){
			HideDialogFilter();
		});
	$("#cancelFilter").click(function(){
		HideDialogFilter();
	});
	$("#search_user").click(function(){
	 	
	 				
						var keyword = $("#keyword").val().trim();
					 				  
	
					   	var search_title = "";
					   	var where_clause = "";

				   		
						
						if(keyword.length>0)
						{
				   			search_title = "Keyword Like : "+keyword;
				   			where_clause += " (email like '%"+keyword+"%' or username like '%"+keyword+"%' or matri_id like '%"+keyword+"%')";
				   		}
			
			$("#search_title").val(search_title);
			$("#where_clause").val(where_clause);
			$("#search_data").submit();
			
	});
	
   });
   
    $(function () {

$("#keyword").keydown(function (e) {
  if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

    $('#search_user').click();
  }
});
   });
   function getUserFullDetail(index_id)
            {

                    $("#full_detail_dialog").html("Loder.Please wait...");
                    //id of container full_detail_dialog
                    $.get(
                          "./web-services/user/get_user_detail.php?index_id="+index_id,
                          function(data){
                              $("#full_detail_dialog").html(data);
                               ShowDialog(true);
                              
                          }
                      );	

            }
			
	function showAdvanceSearch()
   {
	   ShowDialogFilter(true);
   }
   function ShowDialogFilter(modal)
   {
      $("#overlay").show();
      $("#adv_search").fadeIn(300);
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

   function HideDialogFilter()
   {
      $("#overlay").hide();
      $("#adv_search").fadeOut(300);

   } 		
	function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#full_detail_dialog").fadeIn(300);
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
      $("#full_detail_dialog").fadeOut(300);

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
      <div class="breadcum-wide"><a href="#" title="Members">Members</a> / <a href="#" title="Members List">Members List</a></div>
      <div class="listing-section">
        <div class="member-list cf">
          <a href="javascript:;"  class="button" title="List All Members"  onclick="window.location='member-list.php?page=1'"><img src="img/bgi/list-icon.png" alt=""/>List All Members</a>
          <a href="javascript:;"   class="button"  title="Add New Member"  onclick="window.location='add-member.php?action=ADD'"><img src="img/bgi/add-icon.png" alt=""/>Add New Member</a>
          <?php 
						$SQL_STATEMENT_APP = "";
						$SQL_STATEMENT_UNAPP = "";
						$SQL_STATEMENT_ALL = "";
						
						if($search_case)
						{						
		$SQL_STATEMENT_APP = "select count(index_id) from register_view where status='Active' and ".$where_clause;
		$SQL_STATEMENT_UNAPP =  "select count(index_id) from register_view where status='Inactive' and ".$where_clause;
		$SQL_STATEMENT_PAID =  "select count(index_id) from register_view where status='Paid' and ".$where_clause;
		$SQL_STATEMENT_FEATU =  "select count(index_id) from register_view where fstatus='Featured' and ".$where_clause;
		$SQL_STATEMENT_SUSP =  "select count(index_id) from register_view where status='Suspended' and ".$where_clause;
		$SQL_STATEMENT_ALL = "select count(index_id) from register_view where".$where_clause;							
						}
						else
						{
							$SQL_STATEMENT_APP = "select count(index_id) from register_view where status='Active'";
							$SQL_STATEMENT_UNAPP = "select count(index_id) from register_view where status='Inactive'";
							$SQL_STATEMENT_PAID =  "select count(index_id) from register_view where status='Paid'";
							$SQL_STATEMENT_FEATU =  "select count(index_id) from register_view where fstatus='Featured'";
							$SQL_STATEMENT_SUSP =  "select count(index_id) from register_view where status='Suspended'";
							$SQL_STATEMENT_ALL = "select count(index_id) from register_view";
						}
						
					?>
          
          <div class="approval alignleft">
	   <input type="button" title="Active Member List" id="approove" value="Active (<?php echo getRowCount($SQL_STATEMENT_APP,$DatabaseCo);?>)"/>
            
       <input type="button" title="Paid Member List"  id="paid" value="Paid (<?php echo getRowCount($SQL_STATEMENT_PAID,$DatabaseCo);?>)"/>
            
       <input type="button" title="Featured Member List"  id="featured" value="Featured (<?php echo getRowCount($SQL_STATEMENT_FEATU,$DatabaseCo);?>)"/>
            
       <input type="button" title="Inactive Member List"  id="unapproove" value="Inactive (<?php echo getRowCount($SQL_STATEMENT_UNAPP,$DatabaseCo);?>)"/>
            
       <input type="button" title="Suspended Member List"  id="suspended" value="Suspended (<?php echo getRowCount($SQL_STATEMENT_SUSP,$DatabaseCo);?>)"/>
            
       <input type="button" title="All Member List"   id="all" value="All (<?php echo getRowCount($SQL_STATEMENT_ALL,$DatabaseCo);?>)"/>
          </div>
        </div>
      </div>
      
      <div class="filter-section">
	<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter Profile</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a> <br />
	    	<form action="" method="post" class="form-data" id="search_data">
	   
       	 <h4 style="color:red; margin-left:30px;">
			You can search for email, username or matri-id.
		 </h4> <br /><br />

         
          <p class="cf">
		
		<label class="filter-label">Keyword :</label>
		<input type="text" class="textBox" name="keyword" id="keyword" />
	     </p>        

    <p class="submit-btn cf">

								<input type="button" id="search_user" class="popup-save" value="Search"
									title="Search"  /> 
									<input type="button" id="cancelFilter"
									class="popup-save" value="Cancel" title="Cancel" />
							</p>
	     <input type="hidden" name="search_title"  id="search_title" value="" />
		<input type="hidden" name="where_clause"  id="where_clause" value="" />
		<input type="hidden" name="action"  id="filter_action" value="SEARCH" />
	     </form>  
		   
	    </div>
			<?php
						if($search_case){
							echo "<strong>Search String:</strong> ".$search_title;
					?><span style='float:right'><a href='member-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span><?php
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Filter Profile'
							class='floor-plan'>Filter Profile</span> </a></span>";
						} 
					?>		    
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
	     if($search_case)
		{
						$where_member_status = getWhereClauseForStatus($member_status);
						
						if(empty($where_member_status))
							$where_member_status = " where ";
						else 
							$where_member_status .= " and ";
		$SQL_STATEMENT_COUNT = "select count(index_id) from register_view ".$where_member_status." ".$where_clause;
		}
		else
		{
		
	    $SQL_STATEMENT_COUNT = "select count(index_id) from register_view".getWhereClauseForstatus($member_status);
		}
		$register_count = getRowCount($SQL_STATEMENT_COUNT, $DatabaseCo);
		
	    if($register_count>0)
		{  
	   ?>
	   <div class="nodata-avail ">
            <h1><?php 
			if($search_case)
				echo strtoupper($member_status)." Filtered ";
			else
				echo strtoupper($member_status); 
			
		?> Members List</h1>
          </div>  	
        <div class="cf membership-data">
	  <div style="position: relative;top:8px;left:13px;">
        <input type="checkbox" class="alignleft table-checkbox"  onclick="checkUncheck(this,'.table-checkbox');"/>
        <span class="alignleft"><b>&nbsp;&nbsp;Check All</b></span>
	</div>
    
	  <a href="javascript:;" style="margin-left:25px;"  class="alignleft delete-btn" title="Delete" onclick="submitActionForm('DELETE');">Delete</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Active" onclick="submitActionForm('Active');">Active</a>
	<a href="javascript:;"  class="alignleft delete-btn" title="Inactive" onclick="submitActionForm('Inactive');">Inactive</a>
   
    <a href="javascript:;"  class="alignleft delete-btn" title="Suspended" onclick="submitActionForm('Suspended');">Suspended</a>
	
    
	  
            <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["register_page_size"])?$_COOKIE["register_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		if($search_case)
		{
				$where_member_status = getWhereClauseForstatus($member_status);
				
				if(empty($where_member_status))
					$where_member_status = " where ";
				else 
					$where_member_status .= " and ";
		$SQL_STATEMENT = "SELECT * FROM register_view ".$where_member_status." ".$where_clause."  ORDER BY index_id DESC LIMIT " . $lim_str;
		$SQL_STATEMENT_PAGINATION = "select count(index_id) as 'total_rows' from  register_view ".$where_member_status." ".$where_clause. "";
		}
		else
		{
		$SQL_STATEMENT =  "SELECT * FROM register_view ".getWhereClauseForstatus($member_status)." ORDER BY index_id DESC LIMIT ".$lim_str;
		$SQL_STATEMENT_PAGINATION = "select count(index_id) as 'total_rows' from register".getWhereClauseForstatus($member_status);	
		}
		
	    ?>
        
        </div>
	
	 
	 <div class="table-desc cf" style="margin-bottom:20px;">
	<form method="post" action="member-list.php" id="action_form">
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
	<!-- MEMBERSHIP PLAN-1 START -->
        <div id="dialog<?php echo $DatabaseCo->dbRow->index_id; ?>"
								class="cf dialog">
								<div class="profile-img">
								 <?php
			if($DatabaseCo->dbRow->photo1=='')
			{
				?>
          <img src="../images/nophoto.jpg" alt="User Image" height="150" width="130" border="1" />
          <?php
		  }else
          {?>
           <img src="../photos/watermark.php?image=<?php echo $DatabaseCo->dbRow->photo1; ?>&watermark=watermark.png" alt="User Image" height="150" width="130" />
           <?php
          }
          ?>
								</div>
								<div class="profile-content">

		<input type="checkbox" class="table-checkbox" name="index_id[]" value="<?php echo $DatabaseCo->dbRow->index_id; ?>"  /> <label><span class="title"><?php echo $DatabaseCo->dbRow->username; ?>
        <input type="hidden" name="email[]" value="<?php echo $DatabaseCo->dbRow->email; ?>" />
									</span> </label>

									<div class="profile-section">
										<p class="cf" style="height:12px;">
											
										</p>

										<div class="property-detail cf">
											<div class="first-detail-small">
			<label class="detail-desc2 cf"> <label class="title-label">Email:</label>
													<label class="title-desc2"><?php echo $DatabaseCo->dbRow->email; ?>
												</label> </label> <label class="detail-desc2 cf"> <label
													class="title-label">Matri-Id:</label> <label
										class="title-desc2"><?php echo $DatabaseCo->dbRow->matri_id; ?>
												</label> </label> <label class="detail-desc2 cf"> <label
													class="title-label">Registered On:</label> <label
										class="title-desc2">
                                        <?php $a=$DatabaseCo->dbRow->reg_date;
				 							echo date('F j, Y', (strtotime($a)));?> </label> </label>
                                             <label class="detail-desc2 cf"> <label
													class="title-label">Last Login:</label> <label
										class="title-desc2"><?php 				
				           $date1=$DatabaseCo->dbRow->last_login;
			               if($date1=="0000-00-00 00:00:00")
			                  {
				              echo "Never";
			                  }
			                  else
			                  {
			                  echo $date2 = date("l, d M Y", (strtotime($date1)));
			                  }
							?>
												</label> </label> <label class="detail-desc2 cf"> <label
													class="title-label">Religion:</label> <label
											class="title-desc2"> <?php echo $DatabaseCo->dbRow->religion_name; ?>
												</label> </label>                                                
                                                
                                                 <label
													class="title-label">Mother Toungue:</label> <label
											class="title-desc2"> <?php $B=mysql_fetch_array(mysql_query("SELECT GROUP_CONCAT( DISTINCT ' ', mtongue_name, ''SEPARATOR ', ' ) AS mtongue_name FROM register a INNER JOIN mothertongue b ON FIND_IN_SET(b.mtongue_id,a.m_tongue) >0 WHERE a.index_id = '".$DatabaseCo->dbRow->index_id."'  GROUP BY a.m_tongue")); echo $B['mtongue_name']; ?>
												</label> </label>
                                                

											</div>

											<div class="second-detail-small">
												
														
												<label class="detail-desc2 cf"> <label class="title-label">Address:</label>
													<label class="title-desc2" style="word-break:break-all;"><?php echo $DatabaseCo->dbRow->address; ?>
												</label> </label>
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">Country:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->country_name; ?>
												</label> </label>
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">State:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->state_name; ?>
												</label> </label> 
                                                
                                                 <label class="detail-desc2 cf"> <label
													class="title-label">City:</label> <label
													class="title-desc2"><?php echo $DatabaseCo->dbRow->city_name;?>
												</label> </label>
                                                
                                                <label class="detail-desc2 cf"> <label
													class="title-label">Caste:</label> <label
											class="title-desc2"> <?php echo $DatabaseCo->dbRow->caste_name; ?>
												</label> </label>
                                               
											</div>

										</div>


									</div>

								</div>
								<p class="clear"></p>
								<div class="profile-button cf">
									
				<a href="add-member.php?action=UPDATE&index_id=<?php echo $DatabaseCo->dbRow->index_id; ?>" title="Edit"> <span title="Edit" class="floor-plan">Edit</span>
									</a>
                <a href="javascript:;" onclick="getUserFullDetail(<?php echo $DatabaseCo->dbRow->index_id; ?>);">
										<span title="Full Detail" class="floor-plan">Full Detail</span>
									</a>

								</div>
								<span class="approve_feature"> <span><b>Approval:</b> <?php
								$likeDisLikeCss = "";
								if($DatabaseCo->dbRow->status=='Active' || $DatabaseCo->dbRow->status=='Paid')
								$likeDisLikeCss = "approved";
								else
								$likeDisLikeCss = "unapproved";
								?> <span class="<?php echo $likeDisLikeCss; ?>">&nbsp;</span> </span>

<?php if($DatabaseCo->dbRow->status=="Active")
		{?> <span class="plan">
	        <img src="img/active.png"  alt="paid-img" title="Active" class="active-img" width="43" height="36"/>
            </span>
	    <?php }
		  if($DatabaseCo->dbRow->status=="Inactive")
		{?> <span class="plan">
	        <img src="img/inactive.png"  alt="paid-img" title="Inactive" class="inactive-img" width="95" height="34"/>
            </span>
	    <?php }
	     if($DatabaseCo->dbRow->status=="Paid")
		{?> <span class="plan">
	        <img src="img/paid-img.png"  alt="paid-img" class="paid-img" title="Paid"/>
            </span>
	    <?php }
		
			  if($DatabaseCo->dbRow->fstatus=="Featured"){?>
               <span class="plan">
		<img src="img/featured.png"  alt="featured-img" class="featured-img" width="85" height="35" title="Featured"/>
        </span>
	    <?php } 
         if($DatabaseCo->dbRow->status=="Suspended")
		{?> <span class="plan">
	        <img src="img/suspended.png"  alt="paid-img" class="suspended-img" width="95" height="34" title="Suspended"/>
            </span>
	    <?php }?>
							</div>
	<!-- MEMBERSHIP PLAN-1 END -->
	<?php
	$rowCount++;
	      }
	 ?>
	 <input  type="hidden" name="action" value="" id="action"/>
	</form>
   
  <?php 
			  
	    echo getNewPagination('member-list.php?member_status='.$member_status,'register_page_size','register','index_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
     </div>
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for <?php echo strtoupper($member_status); ?> Members. Please add data.</h1>
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
 <div id="full_detail_dialog" class="web_dialog_full_detail"></div>