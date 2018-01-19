<?php
		error_reporting(0);
		include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();			
		$mid=$_SESSION['user_id'];
		
		
$sel="select * from register where (email='$mid' or matri_id='$mid')";
$query=mysql_query($sel)or die(mysql_error());
$row=mysql_fetch_array($query);

$edu=$row['edu_detail'];

if($edu!='')
{	
	$search_array1 = explode(',',$edu);
	foreach ($search_array1 as $value1)
	{
	$d1.="(find_in_set($value1, edu_detail) > 0) or ";
	}
	$d2=rtrim($d1, "or ");
	$f="and ($d2)";	
}


$con=$row['country_id'];
$rel=$row['religion'];
$gen=$row['gender'];
$caste=$row['caste'];
$mat=$row['m_status'];


$tbl_name="register_view";
$adjacents = 3;

	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE gender!='$gen' $f and country_id='$con' and religion='$rel' and caste='$caste' and m_status='$mat'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	

	$targetpage = "two_way.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	

	
	$sql2= "SELECT * FROM register_view WHERE gender!='$gen' $f and country_id='$con' and religion='$rel' and caste='$caste' and m_status='$mat' LIMIT $start, $limit";
	

$SQL=mysql_query($sql2) or die(mysql_error()); 
$tcount = mysql_num_rows($SQL);

	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	

	include("page-part/pagination.php");
	
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<meta name="viewport" content="width=device-width">
<script type="text/JavaScript">

function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}

</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
var win = null;
function newWindow(mypage,myname,w,h,features) {
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  if (winl < 0) winl = 0;
  if (wint < 0) wint = 0;
  var settings = 'height=' + h + ',';
  settings += 'width=' + w + ',';
  settings += 'top=' + wint + ',';
  settings += 'left=' + winl + ',';
  settings += features;
  win = window.open(mypage,myname,settings);
  win.window.focus();
}
//  End -->
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>		
<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?>
 <!-----------------------Menu part end------------------------->
 

 <ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Search</a></li>
  <li class="active">Basic Search </li>
</ol>
 	<div class="row">
    	
        <div class="col-sm-9 col-xs-12 col-sm-push-3 col-xs-push-0">
            <div class="panel panel-success">
        <div class="panel-heading">
     	<i class="glyphicon glyphicon-share"></i> The match is based on the criteria like education,marital status,religon, country for all profiles. 
        </div>
        </div>
        
            <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title"> Your Two Way Matchings </h3>
            </div>
            <div class="panel-body">
         	
        	<table class="table table-hover">
            <div class="row">
			<?php
	if($tcount>0)
	{
            
	while($Row = mysql_fetch_array($SQL))
		{
	    include "./page-part/result.php";
		}
               echo $pagination;
	}
        
	else
	{
		?>
                    <div class="empty_box"></div>
                    <div class="">
             <?php include "page-part/featured-profile.php";?>
             </div>
        <?php	
	}
  ?>
             
             </div>   
			</table>
          
			</div>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12 col-sm-pull-9 col-xs-pull-0">
               <?php require_once './page-part/left_colum.php';?>
        </div>
    </div>
   
 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Photo Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Maysamali Momin</h4>
      </div>
      <div class="modal-body" align="center">
        <img src="photos/myphoto.jpg" class="img-thumbnail" />
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   	

<!-----------------------top part end-------------------------->

	<?php include "page-part/footer.php";?>
    <?php include "popup.php";?>
</div>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.js"></script>
 </body>
</html>