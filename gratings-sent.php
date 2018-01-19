<?php
error_reporting(0);
include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
	$mid = $_SESSION['user_id'];	
	$tbl_name="gratings";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	$query = mysql_query("SELECT COUNT(*) as num FROM $tbl_name where sender='$mid'");
	$total_pages = mysql_fetch_array($query);
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "gratings-sent.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;
		
	$SQL= mysql_query("SELECT * from register_view JOIN gratings ON gratings.receiver=register_view.matri_id where  gratings.sender='$mid' LIMIT $start, $limit");
			
	$tcount = mysql_num_rows($SQL);

        /* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;	
 include("page-part/pagination.php");
	
?>
<!DOCTYPE html>
<html>
<head>
<meta  charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width">
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>

<script type="text/javascript">

$(function() {
$(".deleteBox-icon").click(function() {
$('#load').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("grating_id");
var string = 'grating_id='+ id ;	
$.ajax({
   type: "POST",
   url: "AjaxGeneral2.php",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#load').fadeOut();
  }
   
 });

return false;
	});
});
</script>

</head>

<body>		

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
 

 	<ol class="breadcrumb">
  		<li><a href="index.php">Home</a></li>
  		<li class="active">Greeting Message Sent </li>
	</ol>
 	<div class="row">   
      	
           <div class="col-xs-12 col-sm-9 col-xs-push-0 col-sm-push-3">
		<div class="panel panel-warning"><div class="panel-heading">
     	<i class="glyphicon glyphicon-share"></i>You recently Sent the Greeting Message to the members listed here.
        </div></div>    
          <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title">My Greeting Sent </h3>                
                </div>
                    <div class="panel-body"> 
                        <?php
	if ($tcount==0)
	{
	?>			<div class="empty_box"></div>
     <div class="">
             <?php include "page-part/featured-profile.php";?>
             </div>
         <?php
	}
	else
	{
		while($Row = mysql_fetch_array($SQL))
		{
	?>
                        
                                    	
          <div class="col-sm-12 margin-bottom-header" id="load">                		  
            <div class="modal-content" style="box-shadow:none;">
              <div class="modal-header">
                 <a href="#" grating_id="<?php echo $Row['g_id']; ?>" class="deleteBox-icon" title="Remove" style="float:right;"><img src="images/close-hover.png"></a>
                
              </div>
              <div class="modal-body">
                <div class="col-sm-4 col-xs-12 text-center padding-left-right-zero-small">
                   <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-xs-offset-0 text-center thumbnail margin-bottom-zero ">
                     <b class="text-danger"><?php echo $Row['receiver']; ?>-<span><?php echo $Row['username']; ?></span>
                     </b>
                   </div>
                  <?php
			if($Row['photo1']!="" && $Row['photo_pswd']=="" && $Row['photo1_approve']!="UNAPPROVED")
			 {
			?>
			
				    <img src="photos/watermark.php?image=<?php echo $Row['photo1']; ?>&watermark=watermark.png" class="img-thumbnail" width="185px" height="220px" ></img>
			<?php 
			}
			elseif($Row['photo_protect']=="Yes")
			{?>
			
				    <img  src="images/protecterView.jpg" class="img-thumbnail" width="185px" height="220px" ></img>
			<?php 
			}
			else
			{ 
									if($Row['gender']=='Male')
                                                  {
                                                  ?>
                                    
                                    <img  src="./images/default-photo/male-200.png" class="img-thumbnail" width="185px" height="220px"  title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                                              <?php   }else{ ?>
                                    <img  src="./images/default-photo/female-200.png" class="img-thumbnail" width="185px" height="220px" title="<?php echo $Row['username']; ?>" alt="<?php echo $Row['username']; ?>" />
                                              <?php }
				   
			 } 
			 ?>
                </div>
                <div class="col-sm-8 col-xs-12 padding-left-right-zero-small">
                	<div class="col-xs-12 padding-left-right-zero-small"><b class="text-primary col-sm-3 col-xs-12 ">Message:</b>
                      <span class="col-sm-9 col-xs-12"><?php echo $Row['message']; ?></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 margin-top-10px padding-left-right-zero-small"><b class="text-primary col-sm-3 col-xs-12 ">Song:</b>
                      <span class="col-sm-9 col-xs-12"><audio controls>
	<source src="gratingsong/<?php echo $Row['song']; ?>" type="audio/ogg" />
	<source src="gratingsong/<?php echo $Row['song']; ?>" type="audio/mpeg" />
	<a href="gratingsong/<?php echo $Row['song']; ?>"><?php echo $Row['song']; ?></a>
</audio></span>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 margin-top-10px padding-left-right-zero-small"><b class="text-primary col-sm-3 col-xs-12">Sent On:</b>
                      <span class="col-sm-9 col-xs-12"><?php			
				    $date1=$Row['date'];
				    echo $date2 = date("d F Y , H:i a", (strtotime($date1)));
				    ?></span>
                    </div>
                 </div>
                 <a target="_blank" href="memprofile.php?PMid=<?php echo $Row['receiver']; ?>">
                 <button class="btn btn-success col-sm-4 col-xs-12 col-sm-push-2" style="margin-top:30px;">View Full Profile</button></a>
                <div class="clearfix"></div>
                
              </div>
              
              
         </div>

                        </div> 
        <?php
		}
		?>
        				<?php  echo $pagination;?>  
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

