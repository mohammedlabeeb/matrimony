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

		$tbl_name="shortlist";//your table name

	// How many adjacent pages should be shown on each side?

	$adjacents = 3;

	

	$query = "SELECT COUNT(*) as num FROM $tbl_name where from_id='$mid'";

	$total_pages = mysql_fetch_array(mysql_query($query));

	$total_pages = $total_pages['num'];

	

	/* Setup vars for query. */

	$targetpage = "myshortlist.php"; 	//your file name  (the name of this file)

	$limit = 5; 								//how many items to show per page

	$page = $_GET['page'];

	if($page) 

		$start = ($page - 1) * $limit; 			//first item to display on this page

	else

		$start = 0;								//if no page var is given, set start to 0

	

	/* Get data. */

	$SQL = mysql_query("SELECT * from register_view JOIN shortlist ON shortlist.to_id=register_view.matri_id where from_id='$mid' LIMIT $start, $limit");

	

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

<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<?php include "page-part/head.php";?>

 <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

<script src="js/bootstrap.min.js"></script>

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

<div class="wrapper gradient">  
    <header>
		<?php
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
	<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						
						<?php include('page-part/accountsidebar.php'); ?>
						<div class="main-area gradient-rev">

		<div class="panel panel-success"><div class="panel-heading">

     	<i class="glyphicon glyphicon-share"></i> &nbsp; You recently Shortlisted members listed here.</div></div> 

        <div class="panel panel-warning">

                <div class="panel-heading">

                  <h3 class="panel-title">My Short List Profiles</h3>                

                </div>

                    <div class="panel-body">

                        <?php

	if ($tcount==0)

	{

	?>

                      No shortlisted Profiles

     <?php

	}

	else

	{

		while($Row = mysql_fetch_array($SQL))

		{

	      ?>
		  <div class="search-result">
				
                        
                 
                   <ul class="result-list" id="resultholder">
				   
				    <?php
		    include "page-part/result.php";
			?>
				   </ul>
                  
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
          </div>

                 

          </div>  
</article>		  



<!-----------------------top part end-------------------------->

<?php include "page-part/footer.php";?>



</div>

 <?php include "popup.php" ;?>  



</body>

</html>



