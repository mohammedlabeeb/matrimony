<?php
error_reporting(0);
		include_once 'databaseConn.php';
		include_once 'auth.php';
		include_once './lib/requestHandler.php';
		include_once './lib/pagination.php';
		include_once './class/Config.class.php';
		$DatabaseCo = new DatabaseConn();
		$configObj = new Config();
		
		$mid = $_SESSION['user_id'];
		
$sel="select * from register where (email='$mid' or matri_id='$mid')";
$query=mysql_query($sel)or die(mysql_error());
$row=mysql_fetch_array($query);

$edu=$row['education'];
$hei=$row['height'];
$con=$row['country_id'];
$rel=$row['religion'];
$e=$row['birthdate'];
$gen=$row['gender'];
$caste=$row['caste'];
$mat=$row['m_status'];

$current_date = date('Y-m-d'); //today is 2011-10-04
$diff_in_mill_seconds = strtotime($current_date) - strtotime($e);
$age = floor($diff_in_mill_seconds / (365.2425 *60*60*24)) + 1;
$age;

			
		$tbl_name="register_view";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	/* Setup vars for query. */
	$targetpage = "looking-for-me.php"; 	//your file name  (the name of this file)
	$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$SQL = mysql_query("select * from register where part_country_living='$con' AND part_height<='$hei' AND part_religion='$rel' AND part_edu='$edu' AND gender!='$gen' AND part_caste='$caste' AND part_frm_age<=$age LIMIT $start, $limit");
	
	$tcount = mysql_num_rows($SQL);
	
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;	
	
	
 include("page-part/pagination.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-width=1,user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 
rel="shortcut icon" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
</head>
<body>		

	<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->

 	<ol class="breadcrumb">
  		<li><a href="index.php">Home</a></li>
  		<li class="active">Looking for Me</li>
	</ol>
 	<div class="row">   
      
        
           <div class="col-xs-12 col-sm-9 col-xs-push-0 col-sm-push-3">
		<div class="panel panel-success">
        <div class="panel-heading">
     	<i class="glyphicon glyphicon-share"></i> The members, who looking for me, are listed here.
        </div>
        </div>    
          <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Looking for Me</h3>                
                </div>
                    <div class="panel-body"> 
                        <?php
	if ($tcount==0)
	{
	?>			<div class="col-lg-12 col-sm-12">
                		  
                        <img src="images/no_Data.jpg" class="col-xs-12 img-responsive" />
                      
                        </div>
     <?php
	}
	else
	{
		while($Row = mysql_fetch_array($SQL))
		{
	?>
                     
              <table class="table table-hover">
                   <?php    include "./page-part/result.php";   ?>
                                               
               </table>         
                       
                                    	
                         
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

