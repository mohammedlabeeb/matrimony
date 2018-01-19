        <?php
		error_reporting(0);
	  	include_once 'databaseConn.php';
        include_once 'lib/requestHandler.php';
		include_once 'class/Config.class.php';
		$mid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
		$configObj = new Config();
		$DatabaseCo = new DatabaseConn();
                ?>
<!DOCTYPE html>
<html>
<head>
<meta  charset="utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
</head>
<body>		
    
		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

            <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">My Message</li>
            </ol>
            <div class="row">   
                
                <div class="col-xs-12 col-sm-9 col-sm-push-3 col-xs-push-0">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title">My Received Photo Password Request </h3>                
                        </div>
                        <div class="panel-body">
                            <?php
                           $SQL_STATEMENT =  "SELECT * FROM photoprotect_request WHERE ph_receiver_id='$mid' and 	receiver_response='Pending' ORDER BY ph_reqdate DESC";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
							if($num=mysql_num_rows($DatabaseCo->dbResult)>0)
							{
								while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
								{
								?>
								<div class="border_dotted messge" id="load">
									<div class="text-primary title_msg">
									   
										<a href="#" class="delete" title="Remove" id="<?php echo $DatabaseCo->dbRow->ph_reqid; ?>"> <i class="glyphicon glyphicon-trash"></i></a>
									   
									  <a data-toggle="modal" data-target="#myModal1">
									  <b>&nbsp;&nbsp;&nbsp; <?php echo $DatabaseCo->dbRow->ph_requester_id; ?> Sent you a photo password request.
									  </b></a>
										
										 <small class="pull-right">
										 <?php $date1=$DatabaseCo->dbRow->ph_reqdate;									 
										 echo $date2 = date("D d M ,Y  H:i a", (strtotime($date1)));?></small>
									</div>
									
									<div class="msg-detail"><?php echo substr($DatabaseCo->dbRow->ph_msg,0,375)  ?></div><br />
									
								   <p>                                
									 <span style="float:right;"><a data-toggle="modal" data-target="#myModal2" onclick="getPhotoReq('<?php echo $DatabaseCo->dbRow->ph_requester_id; ?>')" style="cursor:pointer;">Send Password</a>
									 </span>
									 </p>
									
								</div> 
								<?php
								 } 
							}
							else
							{
							  echo "No Request Found !!!";	
							}
							?>
                              
                        </div>
                        
                    </div>             
                </div>
                <div class="col-sm-3 col-xs-12 col-sm-pull-9 col-xs-pull-0">
                    <?php require_once 'page-part/left_colum.php';	?>
                </div>       
            </div>      

<!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>
    </div>
</body>
</html>

  
<script type="text/javascript">

function getPhotoReq(frmid)
{
	
	$("#myModal2").html("Please wait...");
	$.get("./web-services/reply_photo_pass.php?frmid="+frmid,
	function(data){
		$("#myModal2").html(data);
	});
}

</script>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script type="text/javascript">


$(function() {
$(".delete").click(function() {
$('#load').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'del_photo_req='+ id ;
	
$.ajax({
   type: "POST",
   url: "AjaxGeneral3.php",
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