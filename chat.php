<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />

<!--<script type="text/javascript" src="js/chat.js"></script>

--><?php

//session_start();

$_SESSION['chatuser'] = $_SESSION['uid'];

$_SESSION['chatuser_name'] = $_SESSION['uname']; 

$chat_user=$_SESSION['chatuser'];//; Must be already set



if($_SESSION['uid'])

{

$select="select * from register where index_id='$chat_user'";

$exe=mysql_query($select) or die(mysql_error());

$fetch=mysql_fetch_array($exe);

if($fetch['photo1']=='')

{

if($fetch['gender']=='Male'){
	 $a="male_small.png";
	 } 

else{
	$a= "female_small.png";
	}

	

}

else

{

	$a=$fetch['photo1'];	

}

//$abc=$_SESSION['and'];

}

?>

<script type="text/javascript">

var windowFocus = true;

var username="me";

var chatHeartbeatCount = 0;

var minChatHeartbeat = 1000;

var maxChatHeartbeat = 33000;

var chatHeartbeatTime = minChatHeartbeat;

var originalTitle;

var blinkOrder = 0;



var chatboxFocus = new Array();

var newMessages = new Array();

var newMessagesWin = new Array();

var chatBoxes = new Array();



$(document).ready(function(){



	originalTitle = document.title;

	startChatSession();



	$([window, document]).blur(function(){

		windowFocus = false;

	}).focus(function(){

		windowFocus = true;

		document.title = originalTitle;

	});

});



function restructureChatBoxes() {

	align = 0;

	for (x in chatBoxes) {

		chatboxtitle = chatBoxes[x];



		if ($("#chatbox_"+chatboxtitle).css('display') != 'none') {

			if (align == 0) {

				$("#chatbox_"+chatboxtitle).css('right', '320px');

			} else {

				width = (align)*(225+7)+20;

				$("#chatbox_"+chatboxtitle).css('right', '570px');

			}

			align++;

		}

	}

}



function chatWith(chatuser,chatname) {



	createChatBox(chatuser,chatname);

	$("#chatbox_"+chatuser+" .chatboxtextarea").focus();

}



function createChatBox(chatboxtitle,chatname,minimizeChatBox) {

//alert(chatname);

	if ($("#chatbox_"+chatboxtitle).length > 0) 

	{

	

		if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {

			$("#chatbox_"+chatboxtitle).css('display','block');

			restructureChatBoxes();

		}

		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();

		return;

	}

 

	$(" <div />" ).attr("id","chatbox_"+chatboxtitle)

	.addClass("chatbox")

	.html('<div style="cursor:pointer" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')"><div class="chatboxhead"><div class="chatboxtitle">'+chatname+'</div><div class="chatboxoptions">- <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')"> X </a></div><br clear="all"/></div></div><div class="chatboxcontent"></div><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+chatname+'\');"></textarea></div>')

	.appendTo($( "body" ));

	//		   alert('sw');

	$("#chatbox_"+chatboxtitle).css('bottom', '0px');

	

	chatBoxeslength = 0;



	for (x in chatBoxes) {

		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {

			chatBoxeslength++;

		}

	}



	if (chatBoxeslength == 0) {

		$("#chatbox_"+chatboxtitle).css('right', '320px');

	} else {

		width = (chatBoxeslength)*(230+8)+20;

		$("#chatbox_"+chatboxtitle).css('right', '570px');

	}

	

	chatBoxes.push(chatboxtitle);



	if (minimizeChatBox == 1) {

		minimizedChatBoxes = new Array();



		if ($.cookie('chatbox_minimized')) {

			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);

		}

		minimize = 0;

		for (j=0;j<minimizedChatBoxes.length;j++) {

			if (minimizedChatBoxes[j] == chatboxtitle) {

				minimize = 1;

			}

		}



		if (minimize == 1) {

			$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');

			$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');

		}

	}



	chatboxFocus[chatboxtitle] = false;



	$("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){

		chatboxFocus[chatboxtitle] = false;

		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');

	}).focus(function(){

		chatboxFocus[chatboxtitle] = true;

		newMessages[chatboxtitle] = false;

		$('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');

		$("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');

	});



	$("#chatbox_"+chatboxtitle).click(function() {

		if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {

			$("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();

		}

	});



	$("#chatbox_"+chatboxtitle).show();

}





function chatHeartbeat(){



	var itemsfound = 0;

	

	if (windowFocus == false) {

 

		var blinkNumber = 0;

		var titleChanged = 0;

		for (x in newMessagesWin) {

			if (newMessagesWin[x] == true) {

				++blinkNumber;

				if (blinkNumber >= blinkOrder) {

					document.title = x+' says...';

					titleChanged = 1;

					break;	

				}

			}

		}

		

		if (titleChanged == 0) {

			document.title = originalTitle;

			blinkOrder = 0;

		} else {

			++blinkOrder;

		}



	} else {

		for (x in newMessagesWin) {

			newMessagesWin[x] = false;

		}

	}



	for (x in newMessages) {

		if (newMessages[x] == true) {

			if (chatboxFocus[x] == false) {

				//FIXME: add toggle all or none policy, otherwise it looks funny

				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');

			}

		}

	}

	

	$.ajax({

	  url: "chat/chat.php?action=chatheartbeat",

	  cache: false,

	  dataType: "json",

	  success: function(data) {

//alert('sw');

		$.each(data.items, function(i,item){

			if (item)	{ // fix strange ie bug



				chatboxtitle = item.f;

				cuser=item.u;

				image=item.ph;

				

					



				if ($("#chatbox_"+chatboxtitle).length <= 0) {

				//alert(item.u);

					createChatBox(chatboxtitle,cuser);

				}

				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {

				//alert('er');

					$("#chatbox_"+chatboxtitle).css('display','block');

					restructureChatBoxes();

				}

				

				if (item.s == 1) {

				//alert('ser');

					item.f = username;

					var dolor=item.f

				}



				if (item.s == 2) {

				//alert('user');

					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');

				} else {//alert('cuser');

					newMessages[chatboxtitle] = true;

					newMessagesWin[item.u] = true;

															

					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chat_image"><img src="photos/'+item.ph+'" height=20px width=26px>&nbsp;</span><span class="chatboxmessagefrom">'+item.u+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');

				}



				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);

				itemsfound += 1;

			}

		});



		chatHeartbeatCount++;



		if (itemsfound > 0) {

			chatHeartbeatTime = minChatHeartbeat;

			chatHeartbeatCount = 1;

		} else if (chatHeartbeatCount >= 10) {

			chatHeartbeatTime *= 2;

			chatHeartbeatCount = 1;

			if (chatHeartbeatTime > maxChatHeartbeat) {

				chatHeartbeatTime = maxChatHeartbeat;

			}

		}

		

		setTimeout('chatHeartbeat();',chatHeartbeatTime);

	}});

}



function closeChatBox(chatboxtitle) {

	$('#chatbox_'+chatboxtitle).css('display','none');

	restructureChatBoxes();



	$.post("chat/chat.php?action=closechat", { chatbox: chatboxtitle} , function(data){	

	});



}



function toggleChatBoxGrowth(chatboxtitle) {

	if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  

		

		var minimizedChatBoxes = new Array();

		

		if ($.cookie('chatbox_minimized')) {

			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);

		}



		var newCookie = '';



		for (i=0;i<minimizedChatBoxes.length;i++) {

			if (minimizedChatBoxes[i] != chatboxtitle) {

				newCookie += chatboxtitle+'|';

			}

		}



		newCookie = newCookie.slice(0, -1)





		$.cookie('chatbox_minimized', newCookie);

		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');

		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');

		$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);

	} else {

		

		var newCookie = chatboxtitle;



		if ($.cookie('chatbox_minimized')) {

			newCookie += '|'+$.cookie('chatbox_minimized');

		}





		$.cookie('chatbox_minimized',newCookie);

		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');

		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');

	}

	

}



function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle,chatname) {

	 

	if(event.keyCode == 13 && event.shiftKey == 0)  {

	

		message = $(chatboxtextarea).val();

		message = message.replace(/^\s+|\s+$/g,"");

		$(chatboxtextarea).val('');

		$(chatboxtextarea).focus();

		$(chatboxtextarea).css('height','44px');

		if (message != '') {

		$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chat_image"><img src="photos/<?php echo $a;?>" height=20px width=26px>&nbsp;</span><span class="chatboxmessagefrom">'+'me'+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');

			$.post("chat/chat.php?action=sendchat", {to: chatboxtitle, message: message} , function(data){

				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");

				//$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+username+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');

				$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);

			});

		}

		chatHeartbeatTime = minChatHeartbeat;

		chatHeartbeatCount = 1;



		return false;

	}



	var adjustedHeight = chatboxtextarea.clientHeight;

	var maxHeight = 94;



	if (maxHeight > adjustedHeight) {

		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);

		if (maxHeight)

			adjustedHeight = Math.min(maxHeight, adjustedHeight);

		if (adjustedHeight > chatboxtextarea.clientHeight)

			$(chatboxtextarea).css('height',adjustedHeight+8 +'px');

	} else {

		$(chatboxtextarea).css('overflow','auto');

	}

	 

}



function startChatSession(){ 



	$.ajax({

	  url: "chat/chat.php?action=startchatsession",

	  cache: false,

	  dataType: "json",

	  async: false,

	  success: function(data) {



		username = data.username;

//alert(username);

		$.each(data.items, function(i,item){

			if (item)	{ // fix strange ie bug

	chatusername='';

	

	$.ajax({

	  url: "chat/chat.php?action=chatname&usw="+item.f,

	  cache: false,

	  dataType: "json",

	  async: false,

	  success: function(data) {//alert(data.unm);

					chatusername=data.unm;

					//alert(chatusername);

					}

				});

				

				//alert(chatusername);

				chatboxtitle = item.f;

  chatname=item.u;

				if ($("#chatbox_"+chatboxtitle).length <= 0) {//alert(chatboxtitle+"__");

				

				createChatBox(chatboxtitle,chatusername,1);

				}

				if (item.s == 1) {//alert('w');

					chatname = item.u;

				}



				if (item.s == 2) {//alert('a');

					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');

				} else {//alert('s');

					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+chatname+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');

				}

			}

		});

		

		for (i=0;i<chatBoxes.length;i++) {

			chatboxtitle = chatBoxes[i];

			$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);

			setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug

		}

	

	setTimeout('chatHeartbeat();',chatHeartbeatTime);

		

	}});

}



/**

 * Cookie plugin

 *

 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)

 * Dual licensed under the MIT and GPL licenses:

 * http://www.opensource.org/licenses/mit-license.php

 * http://www.gnu.org/licenses/gpl.html

 *

 */



jQuery.cookie = function(name, value, options) {

    if (typeof value != 'undefined') { // name and value given, set cookie

        options = options || {};

        if (value === null) {

            value = '';

            options.expires = -1;

        }

        var expires = '';

        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {

            var date;

            if (typeof options.expires == 'number') {

                date = new Date();

                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));

            } else {

                date = options.expires;

            }

            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE

        }

        // CAUTION: Needed to parenthesize options.path and options.domain

        // in the following expressions, otherwise they evaluate to undefined

        // in the packed version for some reason...

        var path = options.path ? '; path=' + (options.path) : '';

        var domain = options.domain ? '; domain=' + (options.domain) : '';

        var secure = options.secure ? '; secure' : '';

        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');

    } else { // only name given, get cookie

        var cookieValue = null;

        if (document.cookie && document.cookie != '') {

            var cookies = document.cookie.split(';');

            for (var i = 0; i < cookies.length; i++) {

                var cookie = jQuery.trim(cookies[i]);

                // Does this cookie string begin with the name we want?

                if (cookie.substring(0, name.length + 1) == (name + '=')) {

                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));

                    break;

                }

            }

        }

        return cookieValue;

    }

};

</script>

