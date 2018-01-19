<?php
include_once 'databaseConn.php';
include_once 'lib/requestHandler.php';
$DatabaseCo = new DatabaseConn();
include_once './class/Config.class.php';
$configObj = new Config();
require_once("BusinessLogic/class.events.php");

$id=$_POST['event_id'];
$ob=new event();
$events=$ob->get_event_by_id($id);
$event=mysql_fetch_array($events);

$_SESSION['id']=$id;

    $address = $event['venue']; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
     
    $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
     
    $output= json_decode($geocode);
     
    $lat = $output->results[0]->geometry->location->lat;
    $long = $output->results[0]->geometry->location->lng;
     
    $address.'Lat: '.$lat.'Long: '.$long;
     
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $configObj->getConfigFname(); ?></title>
<meta name="viewport" content="width=device-width,initial-width=1,maximum-width=1,user-scalable=no" />        
<meta name="keyword" content="<?php echo $configObj->getConfigKeyword(); ?>" />
<meta name="description" content="<?php echo $configObj->getConfigDescription(); ?>" />  
<link type="image/x-icon" href="images/<?php echo $configObj->getConfigFevicon(); ?>" rel="shortcuticon" />
<script type="text/javascript" src="js/AC_RunActiveContent.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="css/newstyle.css" />
<link href="css/ticket.css" type="text/css" rel="stylesheet" />
<script src="http://maps.googleapis.com/maps/api/js?v=3.7&sensor=false&language=en"></script>
<style type="text/css">
#map {
border: 2px solid black;
height: 520px;
width: 400px;
}
.yellow
{
    font-family: Georgia,"Times New Roman",Times,serif;
    font-size: 17px;
    font-style: italic;
    font-weight: normal;	
}

</style>

<script type="text/javascript">
$(document).ready(function() {		
	$(".form-control").change(function(){		
		var ValOne = $('#ValOne').val();
		var totalTotal1 = ((ValOne * <?php echo $event['ticket']; ?>));
		
		var Valthree = $('#Valthree').val();
		var totalTotal2 = ((Valthree * <?php echo $event['ticket']; ?>));
		//alert(totalTotal);
			var totalTotal=(totalTotal1 + totalTotal2 );		
		$('#Total').text(totalTotal);
	});
	
		
});

function check_number()
{

	 if( document.check.ValOne.value == "" && document.check.Valthree.value == "" )
   {
     alert("Please select how many tickets you would like to buy");
     document.check.ValOne.focus() ;
     return false;
   }	
	
}
</script>
<script type="text/javascript">
var simpleGoogleMapsApiExample = simpleGoogleMapsApiExample || {};
 
simpleGoogleMapsApiExample.map = function (mapDiv, latitude, longitude, accuracy) {
"use strict";
 
var createMap = function (mapDiv, coordinates) {
var mapOptions = {
center: coordinates,
mapTypeId: google.maps.MapTypeId.ROADMAP,
zoom: 15
};
 
return new google.maps.Map(mapDiv, mapOptions);
};
 
var addMarker = function (map, coordinates) {
var markerOptions = {
clickable: false,
map: map,
position: coordinates
};
 
return new google.maps.Marker(markerOptions);
};
 
var addCircle = function (map, coordinates, accuracy) {
var circleOptions = {
center: coordinates,
clickable: false,
fillColor: "blue",
fillOpacity: 0.15,
map: map,
radius: accuracy,
strokeColor: "blue",
strokeOpacity: 0.3,
strokeWeight: 2
};
 
return new google.maps.Circle(circleOptions);
};
 
var infoWindowVisible = (function () {
var currentlyVisible = false;
 
return function (visible) {
if (visible !== undefined) {
currentlyVisible = visible;
}
 
return currentlyVisible;
};
}());
 
var addInfoWindowListeners = function (map, marker, infoWindow) {
google.maps.event.addListener(marker, "click", function () {
if (infoWindowVisible()) {
infoWindow.close();
infoWindowVisible(false);
} else {
infoWindow.open(map, marker);
infoWindowVisible(true);
}
});
 
google.maps.event.addListener(infoWindow, "closeclick", function () {
infoWindowVisible(false);
});
};
 
var addInfoWindow = function (map, marker, address) {
var infoWindowOptions = {
content: address,
maxWidth: 200
};
var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
 
addInfoWindowListeners(map, marker, infoWindow);
 
return infoWindow;
};
 
var initialize = function (mapDiv, latitude, longitude, accuracy) {
var coordinates = new google.maps.LatLng(latitude, longitude);
var map = createMap(mapDiv, coordinates);
var marker = addMarker(map, coordinates);
var geocoder = new google.maps.Geocoder();
 
addCircle(map, coordinates, accuracy);
 
geocoder.geocode({
location: coordinates
}, function (results, status) {
if (status === google.maps.GeocoderStatus.OK && results[0]) {
marker.setClickable(true);
addInfoWindow(map, marker, results[0].formatted_address);
}
});
};
 
initialize(mapDiv, latitude, longitude, accuracy);
};
 
$(document).ready(function () {
"use strict";
 
simpleGoogleMapsApiExample.map($("#map")[0],<?php echo $lat;?>,<?php echo $long;?>, 70);
});
</script>
</head>
<body>

		<?php include "page-part/top-black.php";?>		
<div class="container">	
    <?php include "page-part/header.php";?>
	<?php include "page-part/menu.php";?><ol class="breadcrumb">
  			<li><a href="index.php">Home</a></li>
  			<li>Events</li>
            <li class="active">Events Details</li>
		</ol>
           <div class="panel panel-success">
             <div class="panel-heading">
                 <h3 class="panel-title"><?php echo $event['name']; ?></h3>
             </div>
             <div class="panel-body">
             	<div class="col-xs-12">
                	<div class="row">
                    	<div class="col-sm-4 col-xs-12 padding-left-right-zero-small">
                        	<img src="events-list/<?php echo $event['image']; ?>" class="col-xs-12 col-sm-8 col-sm-offset-2 col-xs-offset-0 thumbnail img-responsive" />
                        </div>
                        <div class="col-sm-6 padding-left-right-zero-small col-xs-12">
                            	 <form method="post" action="checkout.php" name="check" id="check">
                                	<div class="col-sm-12 thumbnail bg-green padding-left-right-zero-small">
                                	<label class="col-sm-4 col-xs-5 padding-left-right-zero-small">Male Tickets - &#8377; <?php echo $event['ticket']; ?></label>
                                    <label class="col-sm-1 col-sm-offset-5 col-xs-3 col-xs-offset-0">Qty:-</label>
                                    <div class="col-sm-2 col-xs-4 pull-right text-center">
                                      <select class="form-control" id="ValOne" name="ValOne">
                                    	  <option value="">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                       </select>
                                    </div>
                                    <div class="clearfix"></div>
                                   </div>
                                   <div class="col-sm-12 thumbnail bg-green padding-left-right-zero-small">
                                	<label class="col-sm-4 col-xs-5 padding-left-right-zero-small">Female Tickets - &#8377; <?php echo $event['ticket']; ?></label>
                                    <label class="col-sm-1 col-sm-offset-5 col-xs-3 col-xs-offset-0">Qty:-</label>
                                    <div class="col-sm-2 col-xs-4 pull-right text-center">
                                      <select class="form-control" id="Valthree" name="Valthree">
                                    	  	<option value="">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                       </select>
                                    </div>
                                    <div class="clearfix"></div>
                                   </div>
                                   <div class="col-sm-12">
                                     <a href="event.php" class="btn btn-danger">Back</a>
                                     <label class="pull-right">Total&nbsp;&nbsp;&#8377; <span class="badge" id="Total"></span></label>
                                     <hr class="visible-xs">
                                   </div>
                     
                       <button type="submit" class="btn btn-warning pull-right" onclick="return check_number()">Book Your Place Now</button>
                                </form>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col-xs-12">
                	<div class="row">
                   	  <div class="col-sm-7 col-xs-12">
                      	<div class="row">
                        	<h3 class="text-success col-sm-4 col-xs-12 margin-bottom-zero margin-top-zero text-center">
                              Venue :
                            </h3>
                            <h3 class="col-sm-8 col-xs-12 margin-bottom-zero margin-top-zero line-break">
                              <?php echo $event['venue']; ?>
                            </h3>
                        </div>
                        <hr />
                        <div class="row">
                        	<h3 class="text-success col-sm-4 col-xs-12 margin-bottom-zero margin-top-zero text-center">
                              Date :
                            </h3>
                            <h3 class="col-sm-8 col-xs-12 margin-bottom-zero margin-top-zero line-break">
                               <?php echo $event['event_date']; ?>
                            </h3>
                        </div>
                        <hr />
                        <div class="row">
                        	<h3 class="text-success col-sm-4 col-xs-12 margin-bottom-zero margin-top-zero text-center">
                             Limited :
                             </br>
                             
                            </h3>
                            <h3 class="col-sm-8 col-xs-12 margin-bottom-zero margin-top-zero line-break">
                               Up to <?php echo $event['limited']; ?> Peoples
                            </h3>
                        </div>
                        
                         <hr />
                        <div class="row">
                        	<h3 class="text-success col-sm-4 col-xs-12 margin-bottom-zero margin-top-zero text-center">
                             Time :
                             </br>
                             <span>(Please arrive on time)</span>
                            </h3>
                            <h3 class="col-sm-8 col-xs-12 margin-bottom-zero margin-top-zero line-break">
                               <?php echo $event['event_time']; ?>
                            </h3>
                        </div>
                        
                      </div>
                      <div class="col-sm-5" >
                      	   <div style="width:100%; height:200px;" id="map"></div>
                      </div>
                    </div>
                </div>
                <div class="col-sm-12">
                	<div class="row">
                      <h3 class="col-sm-10 col-sm-offset-2">Description :-</h3>
                      <span class="col-xs-12"> <?php echo $event['description']; ?>

Please see our FAQ page for more information, however you can email us at <a href="mailto:<?php echo $configObj->getconfigContact(); ?>"><?php echo $configObj->getconfigContact(); ?></a> 
                      </span>
                    </div>
                </div>
             </div>   
               
          </div>

  <?php include "page-part/footer.php";?>
</div>
 </body>
</html>
