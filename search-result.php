<?php
error_reporting(0);
include_once 'databaseConn.php';
$DatabaseCo = new DatabaseConn();
?>


	
<?php 	
	if($_SESSION['gender123'])
	{
			if($_SESSION['gender123']=='Male')
			{
			 $gender='Female';
			}
			else
			{
			 $gender='Male';		
			}		
	}
	else
	{
	$gender=$_SESSION['gender786'];
	}	
	$t3=$_SESSION['fage'];
	$t4=$_SESSION['tage'];	
	$religion123=$_SESSION['religion123'];
	$caste123=$_SESSION['caste123'];
	$m_tongue123=$_SESSION['m_tongue123'];	
       
	$fromheight=$_SESSION['fromheight'];
	$toheight=$_SESSION['toheight'];
	$mstatus123=$_SESSION['mstatus123'];	
	
	$education123=$_SESSION['education123'];
	$occupation=$_SESSION['occupation'];
	$country123=$_SESSION['country123'];
	$state123=$_SESSION['state123'];
	$city123=$_SESSION['city123'];	
	
	$keyword=$_SESSION['keyword'];
	$mid=$_SESSION['user_id'];
	
	if(empty($_REQUEST)) {
		unset($_SESSION['religion123']);
		unset($_SESSION['caste123']);
		unset($_SESSION['m_tongue123']);
		unset($_SESSION['fromheight']);
		unset($_SESSION['toheight']);
		unset($_SESSION['mstatus123']);
		unset($_SESSION['education123']);
		unset($_SESSION['occupation']);
		unset($_SESSION['country123']);
		unset($_SESSION['state123']);
		unset($_SESSION['city123']);
		unset($_SESSION['manglik']);
		unset($_SESSION['keyword']);
		unset($_SESSION['photo']);
		unset($_SESSION['id_search']);
		unset($_SESSION['f_age']);
		unset($_SESSION['t_age']);
		unset($_SESSION['gender786']);
		unset($_SESSION['gender123']);
	}
    $matri_id = $_REQUEST['profile_id'];
	if(isset($_REQUEST['home_search'])) {
		unset($_SESSION['religion123']);
		unset($_SESSION['caste123']);
		unset($_SESSION['m_tongue123']);
		unset($_SESSION['fromheight']);
		unset($_SESSION['toheight']);
		unset($_SESSION['mstatus123']);
		unset($_SESSION['education123']);
		unset($_SESSION['occupation']);
		unset($_SESSION['country123']);
		unset($_SESSION['state123']);
		unset($_SESSION['city123']);
		unset($_SESSION['manglik']);
		unset($_SESSION['keyword']);
		unset($_SESSION['photo']);
		unset($_SESSION['id_search']);
		
		$gender =  $_REQUEST['gender'];
		
		$t3=$_REQUEST['fage'];
		$t4=$_REQUEST['tage'];
		
		$religion123=($_REQUEST['religion_id'] !=0 ? $_REQUEST['religion_id'] : '');
		$caste123=$_REQUEST['caste_id_search'];
		
		if(isset($_REQUEST['photo'])) { $photo =1; }
	
	}
	
	
	if(!isset($_POST['id_submit'])) {
		$_SESSION['id_search_value'] = "";
	}
		
		include_once 'lib/requestHandler.php';
		include_once './class/Config.class.php';
		$configObj = new Config();	

?>
<!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no"/>
<title><?php echo $configObj->getConfigFname(); ?></title>        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />

 <script src="js/jquery.min.js"></script>  
 <?php include "page-part/head.php";?>	

<script type="text/javascript">
$(document).ready(function() {
	
	var dataString = 'id_search='+ '<?php echo $matri_id;?>'+ '&religion='+ '<?php echo $religion123;?>'+ '&caste=' + '<?php echo $caste123;?>' + '&t3=' + '<?php echo $t3;?>' + '&t4=' + '<?php echo $t4;?>' + '&fromheight=' + '<?php echo $fromheight;?>' + '&toheight=' + '<?php echo $toheight;?>' + '&state=' + '<?php echo $state123;?>' + '&city=' + '<?php echo $city123;?>' + '&keyword=' + '<?php echo $keyword;?>' + '&occupation=' + '<?php echo $occupation;?>' + '&country=' + '<?php echo $country123;?>'+ '&gender=' + '<?php echo $gender;?>' + '&m_status=' + '<?php echo $mstatus123;?>'+ '&m_tongue=' + '<?php echo $m_tongue123;?>'+ '&education=' + '<?php echo $education123;?>' + '&orderby=' + '&searchby=' + '<?php echo $from_where;?>' + '<?php echo $occupation;?>' + '&actionfunction=showData' + '&page=1' + '&photo=' + '<?php echo $photo;?>';
	
	console.log(dataString);
	
	$.ajax({			
	     url:"dbmanupulate2.php",
         type:"POST",
         data:dataString,
        cache: false,
        success: function(response)
		{
		   
		  $(".loader").fadeOut("slow");
		  $('#resultholder').html(response);
		 	
		}
		
	   });
    $('#resultholder').on('click','.page-numbers',function(){
		
		$("#loaderID").css("opacity",1);
	
		
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
	   
	   var dataString = '&actionfunction=showData' + '&page='+$page;
       
	   $.ajax({
	     url:"dbmanupulate2.php",
         type:"POST",
         data:dataString,
        cache: false,
        success: function(response)
		{
			
		   $("#loaderID").css("opacity",0);
		  $('#resultholder').html(response);
		 
		}
		
	   });
	return false;
	});
	
	 
	
}) 

</script>

  <style type="text/css">
   .pagination .current{
  z-index: 2;
  color: #ffffff;
  background-color: #428bca;
  border-color: #428bca;
  cursor: default;
  }
  
  .photo-grid li {
    
    margin-top: 7px !important;
}
  </style>
</head>
<body>		
 <div class="wrapper gradient">  
    <header>
		<?php
		
		
		include "page-part/top-black.php";
		
		?>
					
	</header>
<article style="margin-top:-50px;">
					<div class="inner">
						<div class="inner-content">
						<div class="sidebar">
							<?php include "page-part/check-search-result.php";?> 
						</div>
        <div class="main-area middle gradient-rev">
                             
            <div class="well">
									<h4>Searched result for :</h4>
									<p>
										<span><b>Looking for</b> : <?php echo $gender; ?></span>
										<span><b>Age</b> : <?php echo  $t3; ?> - <?php echo  $t4; ?></span>
										<span><b>Height</b> : <?php echo $fromheight; ?> - <?php echo $toheight; ?></span>
										<span><b>Religion</b> : <?php echo $religion123; ?></span>
										<span><b>Caste</b> : <?php echo $caste123; ?> </span>
										<span><b>Location</b> : <?php echo $city123; ?></span>
									</p>
			</div>
              
            <div class="search-result">
				
                        
                 <div id="loaderID" style="position:fixed;  left:50%; top:50%; z-index:9999; opacity:0">
           <img src="images/loader/712.GIF" /></div>
                   <ul class="result-list" id="resultholder">
				   
				   
				   </ul>
                  
                </div>
                
      		</div>    
         	 <div class="right-side">
								<div class="placeholder-ad large">
									<img src="content/ad-large.jpg" />
								</div>
								<div class="placeholder-ad large">
									<img src="content/placeholder-large.jpg" />
								</div>
								<div class="placeholder-ad small">
									<img src="content/placeholder-small.jpg" />
								</div>
							</div>
        </div>
        
       
        
    </div>
    </div>
   </article>
 <!-----------------------top part end-------------------------->

 
    <?php include "page-part/footer.php";?>
<?php include "popup.php" ;?> 
</div>
</div>
    
 </body>
</html>
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