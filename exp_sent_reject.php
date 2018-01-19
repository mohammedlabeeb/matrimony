<?php
error_reporting(0);
		include_once 'databaseConn.php';
		include_once './lib/requestHandler.php';
		require_once('auth.php');
	  	include_once './class/Config.class.php';
		$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		$configObj = new Config();
		$DatabaseCo = new DatabaseConn();
		$DatabaseCoCount = new DatabaseConn();
		
                
        $tbl_name="expressinterest";		//your table name
	// How many adjacent pages should be shown on each side?
        $adjacents = 4;

        $query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "exp_sent_reject.php"; 	//your file name  (the name of this file)
	$limit = 3; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
		
	
    $sql2= "SELECT * FROM expressinterest,register WHERE register.matri_id=expressinterest.ei_receiver and  ei_sender='$mid' AND receiver_response='Reject'";
	
	

$SQL=mysql_query($sql2) or die(mysql_error()); 
$tcount = mysql_num_rows($SQL);

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
<head>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<script src="js/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="js/jquery9.js"></script>
</head>
<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

 	<ol class="breadcrumb">
  		<li><a href="index.php">Home</a></li>
  		<li class="active">My Interests</li>
	</ol>
 	<div class="row">   
      	 
            <div class="col-xs-12 col-sm-9 col-xs-push-0 col-sm-push-3">                
                <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title">Express Interest Send Rejected</h3>                
                </div>
                    <div class="panel-body">                        
                           <?php  
							if($tcount > 0)
                            { 
							                     
									while($DatabaseCo->dbRow = mysql_fetch_object($SQL))
									{
									
									include "page-part/exp-sent.php"; 
									}
							}
							else
							{ ?>
                            <table class="table">
                                <tr>
                                    <td>No Request Found !!!</td>
                                </tr>
                            </table>
                            <?php                             
                            }                       
                            
                            ?>
                                            
                    </div>
            </div>
            </div>
            <div class="col-sm-3 col-sm-pull-9 col-xs-12 col-xs-pull-0">
        	<?php require_once 'page-part/left_colum.php';	?>
         </div>
         </div>
	   
<!-----------------------top part end-------------------------->
<?php include "page-part/footer.php";?>
</div>
</body>
</html>

<script type="text/javascript">
$(function() {


$(".delete").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'delete=' + del_id;
 
 $.ajax({
   type: "POST",
   url: "AjaxGeneral2.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".load").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 

return false;

});

});

</script>
