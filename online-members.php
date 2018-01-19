<?php 
error_reporting(0);
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
include_once './class/Config.class.php';
$configObj = new Config();
$DatabaseCo = new DatabaseConn();
$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;



	$targetpage = "online-members.php"; 	//your file name  (the name of this file)
	$limit = 12; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
	
	
	
	$sql2="select * from register_view,online_users where online_users.index_id=register_view.index_id and matri_id!='$mid'  LIMIT $start, $limit";
	
		
	$query= "SELECT COUNT(*) as num FROM register_view,online_users where online_users.index_id=register_view.index_id and matri_id!='$mid'";


	
	

$SQL=mysql_query($sql2) or die(mysql_error()); 
$tcount = mysql_num_rows($SQL);


	$tbl_name="register";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 4;

	
	
	
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	
		
/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	include("page-part/pagination.php");

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcuticon" />

<link type="text/css" rel="stylesheet" href="css/mi.css" />
<link type="text/css" rel="stylesheet" href="css/gallary.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />

 	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
<style type="text/css">
.row {
    margin-left: 0px !important;
    margin-right: 0px !important;
}
</style>
</head>
<body>

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><ol class="breadcrumb">
  			<li><a href="#">Home</a></li>
  			<li class="active">Online Members</li>
		</ol>
        <div class="row">
        	<div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title"> Online Members </h3>
            </div>
            <div class="panel-body">
			<!--<strong>Show Me:</strong> <a style="text-decoration:none;" href="online-members.php?Gender=Male">Male Photos</a> | 
<a style="text-decoration:none;" href="online-members.php?Gender=Female">Female Photos</a> | 
<a style="text-decoration:none;" href="online-members.php?Gender=all">All Photos</a><br /><br />-->
				<div class="col-sm-12">
                	<div class="row">
                <?php
				 if($tcount>0)
                    {
				    	 while($fetch = mysql_fetch_array($SQL))	  
					    {
							?>
                    	<div class="col-sm-2">
                         <div class="profile-container unfold">
                           <div class="profile-new">
                            <div class="col-xs-12 thumbnail margin-bottom-zero">
                             <?php
if($fetch['photo1']!="" && $fetch['photo_pswd']=="" && $fetch['photo1_approve']=='APPROVED')
			 {
			?>
			
				    <img src="photos/watermark.php?image=<?php echo $fetch['photo1']; ?>&watermark=watermark.png"></img>
			<?php 
			}
			elseif($fetch['photo_protect']=="Yes")
			{?>
			
				    <img  src="images/protecterView.jpg"></img>
			<?php 
			}
			else
			{ 
									if($fetch['gender']=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png" title="<?php echo $fetch['username']; ?>" alt="<?php echo $fetch['username']; ?>" />
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png" title="<?php echo $fetch['username']; ?>" alt="<?php echo $fetch['username']; ?>" />
                                              <?php }
				   
			 } 
			 ?>
                            </div>
                            <div class="follow">
                              <a class="btn btn-warning col-xs-12">
                               <i class="icon-plus"></i>Online Now&nbsp;!
                              </a>
                            </div>
                            <div class="follow">
                              <button>
                               <i class="icon-plus"></i>Details
                              </button>
                            </div>
                           </div>
                         <ul class="profile-list text-center">
							<li class="first"><i class="icon-user"></i><?php echo $fetch['username'];?></li>
							<li class="second"><i class="icon-list-alt"></i> <?php echo $fetch['gender'];?> &nbsp;/&nbsp;<?php echo floor((time() - strtotime($fetch['birthdate']))/31556926);?></li>
							<li class="third"><i class="icon-time"></i><?php echo $fetch['ocp_name'];?></li>
                             <?php	
                                                      $matid=$_SESSION['user_id'];
                                                      $select="select * from payments where pmatri_id='$matid'";
                                                      $exe=mysql_query($select) or die(mysql_error());
                                                      $fetch123=mysql_fetch_array($exe);

                                                      if($fetch123['chat']=='Yes' && $_SESSION['user_id'])
                                                      {
                                                      ?>
							<li class="fourth"><i class="icon-heart"></i> <a style='color:#B13533; text-decoration:none;' href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $fetch['index_id'];?>','<?php echo $fetch['username'];?>')">Chat Now</a></li>
                            						  <?php
													  }
													  ?>
						</ul>
					   </div>
                        
                        </div>
                        <?php
						$split++; 
						  
									if($split%6==0)
									{
									echo "</div></div><div class='col-sm-12'><div class='row'>";
									}
          		
						 }
						echo "</div></div>";
						
						echo $pagination; 
					}
					else
					{
						echo "<div class='empty_box'></div>";
					}
					?>
                   
                     
                  </div>
              </div>
              
              
              		

</div>
     
	<?php 
	include "page-part/footer.php";
    require_once 'chat.php';
	?>
	</div>
    </div>
 </body>

</html>
