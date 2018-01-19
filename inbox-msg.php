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
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
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
                
                <div class="col-xs-12 col-sm-9 col-xs-push-0 col-sm-push-3">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title">My Inbox</h3>                
                        </div>
                        <div class="panel-body">
                            <?php
                            $SQL_STATEMENT =  "SELECT * FROM messages WHERE to_id='$mid' ORDER BY sent_date DESC";
                            $DatabaseCo->dbResult=$DatabaseCo->getSelectQueryResult($SQL_STATEMENT);
                            while($DatabaseCo->dbRow = mysql_fetch_object($DatabaseCo->dbResult))
                            {
                            ?>
                            <div class="border_dotted messge" id="load">
                                <div class="text-primary title_msg">
                                   
                                    <a href="#" class="delete" title="Remove" id="<?php echo $DatabaseCo->dbRow->mes_id; ?>"> <i class="glyphicon glyphicon-trash"></i></a>
                                   
                                  <a data-toggle="modal" data-target="#myModal1" onclick="getfullMessage('<?php echo $DatabaseCo->dbRow->mes_id; ?>')" style="cursor:pointer;">  <b>&nbsp;&nbsp;&nbsp; <?php echo $DatabaseCo->dbRow->subject; ?>
                                  </b></a>
                                    
                                     <small class="pull-right">
                                     <?php $date1=$DatabaseCo->dbRow->sent_date;									 
									 echo $date2 = date("D d M ,Y  H:i a", (strtotime($date1)));?></small>
                                </div>
                                
                                <div class="msg-detail"><?php echo substr($DatabaseCo->dbRow->message,0,375)  ?></div><br />
                                
                               <p>From : <?php echo $DatabaseCo->dbRow->from_id; ?>
                                
                                 <span style="float:right;"><a data-toggle="modal" data-target="#myModal2" onclick="getMessageReply('<?php echo $DatabaseCo->dbRow->from_id; ?>')" style="cursor:pointer;">Reply</a>
                                 </span>
                                 </p>
                                
                            </div> 
                            <?php } ?>
                              
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
function getfullMessage(id)
{
	
	$("#myModal1").html("Please wait...");
	$.get("./web-services/get_message_detail.php?id="+id,
	function(data){
		$("#myModal1").html(data);
	});
}

function getMessageReply(frmid)
{
	
	$("#myModal2").html("Please wait...");
	$.get("./web-services/compose_message.php?frmid="+frmid,
	function(data){
		$("#myModal2").html(data);
	});
}

</script>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script type="text/javascript">


$(function() {
$(".delete").click(function() {
$('#load').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'inbox_mes_id='+ id ;
	
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