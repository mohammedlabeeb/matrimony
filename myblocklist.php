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

		$tbl_name="block_profile";		//your table name

	// How many adjacent pages should be shown on each side?

	$adjacents = 3;

	

	$query = "SELECT COUNT(*) as num FROM $tbl_name where block_by='$mid'";

	$total_pages = mysql_fetch_array(mysql_query($query));

	$total_pages = $total_pages['num'];

	

	/* Setup vars for query. */

	$targetpage = "myblocklist.php"; 	//your file name  (the name of this file)

	$limit = 5; 								//how many items to show per page

	$page = $_GET['page'];

	if($page) 

		$start = ($page - 1) * $limit; 			//first item to display on this page

	else

		$start = 0;								//if no page var is given, set start to 0

	

	/* Get data. */

	$SQL = mysql_query("SELECT * from register_view JOIN block_profile ON block_profile.block_to=

	 register_view.matri_id where block_by='$mid' LIMIT $start, $limit");

	

	$tcount = mysql_num_rows($SQL);

	

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

<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $configObj->getConfigFname(); ?></title>

<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />

<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  

<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" 

rel="shortcut icon" />

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<link type="text/css" rel="stylesheet" href="css/newstyle.css" />

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

	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->



 	<ol class="breadcrumb">

  		<li><a href="index.php">Home</a></li>

  		<li class="active">Block Listed Members </li>

	</ol>

 	<div class="row">   

      

        

           <div class="col-xs-12 col-sm-9 col-xs-push-0 col-sm-push-3">

               

		<div class="panel panel-success"><div class="panel-heading">

     	<i class="glyphicon glyphicon-share"></i>You recently Blocklisted members listed here.</div></div>    

          <div class="panel panel-warning">

                <div class="panel-heading">

                  <h3 class="panel-title">My Block List Profiles</h3>                

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
        <div class="row">
        <?php
	 		include "page-part/result.php";
		?>
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

          <div class="col-sm-3 col-xs-12 col-sm-pull-9 col-xs-pull-0">

        <?php require_once 'page-part/left_colum.php';	?>

         </div>

        

          </div>

      

	

<!-----------------------top part end-------------------------->

<?php include "page-part/footer.php";?>



<?php include "popup.php" ;?>  



</div>

    



</body>

</html>



