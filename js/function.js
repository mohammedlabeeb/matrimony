function getXMLHTTP()
{
	var xmlhttp=false;
	try
	{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1)
			{
				xmlhttp=false;
			}
		}
	}
	return xmlhttp;
}
$('.addToblock-link').click(function () {
$('#shortdiv').hide();
});
 
$(function() {
$(".addToblock-link").click(function() {
$('#shortdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist.php",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#shortdiv').fadeOut();
  }
   
 });

return false;
	});
});
$('.addToshort-link').click(function () {
$('#shortdiv').hide();
});

$(function() {
$(".addToshort-link").click(function() {
$('#shortdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'add_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist.php",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#shortdiv').fadeOut();
	
  }
   
 });

return false;
	});
});
$('.addToblock-data').click(function () {
$('#blockdiv').hide();
});
 
$(function() 

{
$(".addToblock-data").click(function() {
$('#blockdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'block_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist.php",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#blockdiv').fadeOut();
  }
   
 });

return false;
	});
});
$('.addToshort-data').click(function () {
$('#blockdiv').hide();
});
 
$(function() {
$(".addToshort-data").click(function() {
$('#blockdiv').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'block_add_id='+ id ;
	
$.ajax({
   type: "POST",
   url: "addshortlist.php",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#blockdiv').fadeOut();
  }
   
 });

return false;
	});
});


function getMessageReply(frmid)
{
	
	$("#myModal1").html("Please wait...");
	$.get("./web-services/compose_message.php?frmid="+frmid,
	function(data){
		$("#myModal1").html(data);
	});
}

function getContactDetail(toid)
{
	$("#myModal2").html("Please wait...");
			$.get("./web-services/contact_detail.php?toid="+toid,
			function(data){
				$("#myModal2").html(data);
			});
}
function sendGratings(frmid)
{
	
	$("#myModal3").html("Please wait...");
	$.get("./web-services/send_gratings.php?frmid="+frmid,
	function(data){
		$("#myModal3").html(data);
	});
}
function ExpressInterest(toid)
{
	
	$("#myModal4").html("Please wait...");
	$.get("./web-services/send_interest.php?frmid="+toid,
	function(data){
		$("#myModal4").html(data);
	});
}
function Getphotos(toid)
{
	
	$("#myModal5").html("Please wait...");
	$.get("./web-services/get_photos.php?frmid="+toid,
	function(data){
		$("#myModal5").html(data);
	});
}
function Gethoro(toid)
{
	
	$("#myModal6").html("Please wait...");
	$.get("./web-services/get_horoscope.php?frmid="+toid,
	function(data){
		$("#myModal6").html(data);
	});
}
function Getvideo(toid)
{
	
	$("#myModal7").html("Please wait...");
	$.get("./web-services/get_video.php?frmid="+toid,
	function(data){
		$("#myModal7").html(data);
	});
}
 