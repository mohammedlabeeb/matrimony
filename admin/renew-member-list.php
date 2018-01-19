<?php
  include_once 'databaseConn.php';
  include_once './lib/pagination.php';
  include_once './lib/requestHandler.php';
  include_once './class/Location.class.php';
  $DatabaseCo = new DatabaseConn();
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
		
	    switch($ACTION)
	    {
		    case 'DELETE':		
				$SQL_STATEMENT =  "delete from  register where index_id in ".$index_id_val;	
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
 if(isset($_SESSION['search_action']) && $_SESSION['search_action']=='SEARCH')
{
	$search_case = true;
	$search_title = $_SESSION['search_title'];
    $where_clause = $_SESSION['where_clause'];
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
<script type="text/javascript" src="js/util/redirection.js"></script>
<script type="text/javascript" src="js/util/location-validation.js"></script>

<script type="text/javascript">
setPageContext("member","renew-member");
 $(document).ready(function ()
   {
	  
	  $("#search_user").click(function(){
					 	var matri_id = $("#matri_id").val().trim();
					   	var user_name = $("#user_name").val().trim();
					   
					   	var all_app = $("#allappunapp").is(":checked");
					   	var all_featured = $("#allfeaturednonfeatured").is(":checked");
	
					   	var search_title = "";
					   	var where_clause = "";

				   		if(matri_id.length>0){
				   			search_title = "Matri Id : "+matri_id;
				   			where_clause += " matri_id="+matri_id+" ";
				   		}else{
				   			
				   			where_clause += " matri_id!=0 ";
				   		}
					   		
				   		if(user_name.length>0){
				   			search_title += " | User Name Like : "+user_name;
				   			where_clause += " and username like '%"+user_name+"%' ";
				   		}
			   			

						if(where_clause.length>0){
				   			$("#search_title").val(search_title);
				   			$("#where_clause").val(where_clause);
				   			$("#search_data").submit();
						}
			   			
					});
				
               registerRowSelect();
               initLocationDivs();
               
   });
    $(function () {

$("#keyword").keydown(function (e) {
  if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {

    $('#search_user').click();
  }
});
   });
   
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
   function showAdvanceSearch(){
	   ShowDialogFilter(true);
   }
   function approvePaid(index_id)
            {

                    $("#detail_dialog").html("Loder.Please wait...");
                    //id of container full_detail_dialog
                    $.get(
                          "./web-services/user/app_paid.php?index_id="+index_id,
                          function(data){
                              $("#detail_dialog").html(data);
                               ShowDialog(true);
                              
                          }
                      );	

            }
	function ShowDialog(modal)
   {
      $("#overlay").show();
      $("#detail_dialog").fadeIn(300);
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
      $("#detail_dialog").fadeOut(300);

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
      <div class="breadcum-wide"><a href="#" title="Membership Plan">Members</a> / <a href="#" title="Renew Membership">Renew Membership</a></div>
      
      <div class="filter-section" >
					<!--<div id="adv_search" class="adv_search">
						<p class="web_dialog_title" id="dialog_title">Filter Users</p>
						<a href="#" id="btnClose_filter" class="close"><img
							src="img/bgi/close_black.png" alt="Close" /> </a>

						<div class='error-msg' id='validationSummary'></div>
						<form action="" method="post" class="form-data" id="search_data">
							<p class="cf">
								<label class="popup-label">Matri-ID:</label> <input type="text"
									class="textBox" name="matri_id" id="matri_id" />

							</p>
							<p class="cf">
								<label class="popup-label">User Name:</label> <input type="text"
									class="textBox" name="user_name" id="user_name" />
							</p>

							
							<p class="submit-btn cf">

								<input type="button" id="search_user" class="popup-save" value="Search"
									title="Search"  /> 
									<input type="button" id="cancel"
									class="popup-save" value="Cancel" title="Cancel" />
							</p>
							<input type="hidden" name="search_title"  id="search_title" value="" />
							<input type="hidden" name="where_clause"  id="where_clause" value="" />
							<input type="hidden" name="action"  id="filter_action" value="SEARCH" />
						</form>
					</div>-->
                    <div class="nodata-avail ">
            <h1>Renew Membership</h1>
          </div>
					
					<?php /*?><?php
						if($search_case){
							echo "<strong>Search String:</strong> ".$search_title;
							echo "<span style='float:right'><a href='user-list.php?option=clear_search'> <span title='Clear Filter'
							class='floor-plan'>Clear Filter</span> </a></span>";
						}else 
						{
							echo "<span style='float:right'><a href='javascript:showAdvanceSearch();'> <span title='Full Detail'
							class='floor-plan'>Filter User</span> </a></span>";
						} 
					?>	<?php */?>
					
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
	  $today1 = strtotime ('now');
	 $today=date("Y-m-d",$today1);
	    $register_count = getRowCount("select count(r.index_id) from register_view r,payments p where r.matri_id=p.pmatri_id and p.exp_date<'$today'",$DatabaseCo);
	    if($register_count>0){  
	   ?>
	     	
                    <?php
		$current_page =isset($_GET['page'])?$_GET['page']:1;
		$rec_not_found = true;
		$page_size = isset($_COOKIE["register_page_size"])?$_COOKIE["register_page_size"]:10;
		$lim_str = getLimitForSqlState($current_page,$page_size);
		
		$SQL_STATEMENT =  "select * from register_view r,payments p where r.matri_id=p.pmatri_id and p.exp_date<'$today' ORDER BY index_id DESC LIMIT ".$lim_str;
		
	    ?>
      <div class="table-desc cf" style="margin-bottom:20px;">	
	<form method="post" action="" id="action_form">
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
          <img src="../images/nophoto.jpg" alt="User Image" height="150" width="130" />
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
													<label class="title-desc2"><?php echo $DatabaseCo->dbRow->address; ?>
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
									
				 <a class="margin-none" href="javascript:;" onclick="approvePaid(<?php echo $DatabaseCo->dbRow->index_id; ?>);">
		<span title="Renew Membership" class="floor-plan">Renew Membership</span>
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
	        <img src="img/active.png"  alt="paid-img" class="active-img" width="43" height="36"/>
            </span>
	    <?php }
		  if($DatabaseCo->dbRow->status=="Inactive")
		{?> <span class="plan">
	        <img src="img/inactive.png"  alt="paid-img" class="inactive-img" width="95" height="34"/>
            </span>
	    <?php }
	     if($DatabaseCo->dbRow->status=="Paid")
		{?> <span class="plan">
	        <img src="img/paid-img.png"  alt="paid-img" class="paid-img"/>
            </span>
	    <?php }
		
			  if($DatabaseCo->dbRow->fstatus=="Featured"){?>
               <span class="plan">
		<img src="img/featured.png"  alt="featured-img" class="featured-img" width="85" height="35"/>
        </span>
	    <?php } 
         if($DatabaseCo->dbRow->status=="Suspended")
		{?> <span class="plan">
	        <img src="img/suspended.png"  alt="paid-img" class="suspended-img" width="95" height="34"/>
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
		$SQL_STATEMENT_PAGINATION = "select count(index_id) as 'total_rows' from register_view r,payments p where r.matri_id=p.pmatri_id and p.exp_date<'$today'".getWhereClauseForstatus($member_status);		  
	    echo getNewPagination('renew-member-list.php','register_page_size','register','index_id',$page_size,$current_page,$SQL_STATEMENT_PAGINATION);
	  ?>	
      </div>
	 <?php
	  }
	  else
	  {
	 ?>
        <div class="table-desc cf">
          <div class="nodata-avail ">
            <h1>There are no data for Renew Membership.</h1>
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
 
 
 <div id="detail_dialog" class="web_dialog_full_detail" style="height: 530px;width:880px; overflow:hidden;"></div>
 