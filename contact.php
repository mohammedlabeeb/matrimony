<?php

	  	include_once 'databaseConn.php';
		include_once 'lib/requestHandler.php';
		include_once './lib/pagination.php';
		$DatabaseCo = new DatabaseConn();
		include_once './class/Config.class.php';
		$configObj = new Config();
		
		
		if(isset($_POST['enquiry2']))
	{
	  $name=trim(ucwords($_POST['name']));
	  $from=$_POST['email'];	  
	  $mobile=$_POST['mobile'];
	  $city=$_POST['city'];
	  $description=$_POST['description'];
	  $to =  $configObj->getConfigTo();
	 
	  $subject=$from;
	  $message="$name - $mobile - $city - $description";
	  
	    $headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From:'.$from."\r\n";		
		 mail($to,$subject, $message, $headers);	
		echo "<script>window.location='thanks-for-enquiry.php'</script>";
}
		
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no">        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword();?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription();?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon();?>" rel="shortcut icon" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/componant-v101.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/validation/validationEngine.jquery.css" type="text/css"/>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popup/jquery.reveal.js" type="text/javascript"></script>
<script src="js/validation/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="js/validation/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

	<script>
		jQuery(document).ready(function()
		{
			jQuery("#adformSearch").validationEngine();
		});
	</script>
<style>
      #map_canvas {
        margin-top:5px;
        height: 240px;
        background-color: #CCC;
        border: 2px solid #eee ;
      }
	  @media(max-width:321px)
	  {
		  #map_canvas 
		  {
              margin-top:5px;
              height: 200px;
              background-color: #CCC;
              border: 2px solid #eee ;
      }
		  
	  }
	  
    </style>
   

</head>
<body>		

        <?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><!-----------------------Menu part end------------------------->
     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li class="active">Contact</li>
    </ol>
 		<div class="row">
    		
                <div class="col-sm-9 col-sm-push-3 col-xs-12 col-xs-push-0">
                <div class="panel panel-warning">
                  <div class="panel-heading">
                    <h3 class="panel-title">Contact Us</h3>
                  </div>
                  <div class="panel-body">
                      <div class="col-sm-6">
                      <form name="adformSearch" id="adformSearch" class="form-horizontal" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Name <font class="text-danger">*&nbsp;</font> :</label>
                              <div class="col-sm-8">
                              <input type="text"  name="name" id="name" class="form-control" data-validation-engine="validate[required]"><font id="nameId"></font>           
                              </div>
                                      </div>             

                      <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Email <font class="text-danger">*&nbsp;</font>:</label>
                              <div class="col-sm-8">
                              <input type="text" class="form-control" name="email" id="email" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="linkId"></font>

                              </div>
                                      </div>                

                      <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Mobile <font class="text-danger">*&nbsp;</font> :</label>
                              <div class="col-sm-8">
                              <input type="text" class="form-control" name="mobile" id="mobile" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="contactId"></font> 

                              </div>
                                      </div>                

                      <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">City <font class="text-danger">*&nbsp;</font>:</label>
                              <div class="col-sm-8">
                              <input type="text" class="form-control" name="city" id="city" data-validation-engine="validate[required]" />  <font style="color:#F00;float:right"  id="phoneId"></font>

                              </div>
                                      </div>                

                      <div class="form-group">
                              <label for="inputEmail3" class="col-sm-4 control-label">Message <font class="text-danger">*&nbsp;</font>:</label>
                              <div class="col-sm-8">
                              <textarea name="description" id="description" rows="4" class="form-control" cols="40" data-validation-engine="validate[required]"></textarea>
                      <font style="color:#F00;float:right"  id="imageId"></font>  

                              </div>
                                      </div>       

                                      <div>&nbsp;</div>
                                      <div class="form-group">
                              <div class="col-sm-offset-5 col-sm-7">
                              <button type="submit" name="enquiry2" class="btn btn-success"> Submit </button>
                              </div>
                                      </div>
                                      </form>
                      </div>
                      <div class="col-sm-6">                    
                          <div style="border:#C73232 10px solid;padding:10px;">
                              <div>
                            
                                <?php
								 $res2=mysql_query("select * from cms_pages where cms_id='9'");
								  $row2 = mysql_fetch_array($res2);
								  echo htmlspecialchars_decode($row2['cms_content']);?>
                              </div>
                          </div>
                          <div class="sr-only">&nbsp;</div>
                          <div>
                              <div id="map_canvas"></div>
                          </div>

                      </div>
                  </div>
                </div>
          </div>
          <div class="col-sm-3 col-sm-pull-9 col-xs-12 col-xs-pull-0">      
         		 <?php include 'advertise/add_single.php'; ?>
         	</div>
      </div>	

        <!-----------------------top part end-------------------------->
        <?php include "page-part/footer.php";?>

</div>
 </body>
</html>
<?php
	$address = htmlspecialchars_decode($row2['cms_content']); // Google HQ
    $prepAddr = str_replace(' ','+',$address);
     
    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
     
    $output= json_decode($geocode);
     
    $lat = $output->results[0]->geometry->location->lat;
    $long = $output->results[0]->geometry->location->lng;
     

?>
    
 <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(<?php echo $lat;?>,<?php echo $long;?>),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>