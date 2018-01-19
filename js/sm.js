/**
 * Copyright © 2004-2010 Chat software by www.flashcoms.com
 */

var messengerUrl = 'http://www.matrimonialsindia.com/messenger7/messenger.htm';
var updaterSwfUrl = 'http://www.matrimonialsindia.com/messenger7/swf/updater.swf?build=13677';
var friendListSwfUrl = 'http://www.matrimonialsindia.com/messenger7/swf/friendlist.swf?build=13677';
var messengerSwfUrl = 'http://www.matrimonialsindia.com/messenger7/swf/preloader.swf?build=13677';

var messengerWidth = 680;
var messengerHeight = 560;

function Z5Browser()
{
	this.opera		= /opera/i.test(navigator.userAgent);
	this.ie			= (!this.opera && /msie/i.test(navigator.userAgent));
	this.ie6		= (!this.opera && /msie 6/i.test(navigator.userAgent));
	this.firefox	= /firefox/i.test(navigator.userAgent);
	this.chrome		= /chrome/i.test(navigator.userAgent);
	this.safari		= (!(/chrome/i.test(navigator.userAgent)) && /webkit|safari|khtml/i.test(navigator.userAgent));
}
var browserInfo = new Z5Browser();

function GetUpdater()
{
	var updater = swfobject.getObjectById('z5_updater_swf');
	if(!updater) updater = swfobject.getObjectById('z5_friend_list_swf');
	if(!updater) updater = swfobject.getObjectById('z5_messenger_swf');
	return updater;
}

function trace(txt)
{
	window.console && console.log(txt);
}
function Z5Notification()
{
	this.isInitialized		= false;

	this.position		= 'right';				// notification position [right,left]
	this.divId			= 'z5Notification';		// notification div id
	this.zIndex			= 10000;
	this.width			= "230px";				// notification width
	this.maxHeight		= "600px";				// notifications max height (used with scrolling=true only)

	this.borderColor	= "#909090";				// notification panel border color
	this.borderThickness= "1px";				// notification panel border thickness


	this.fontColor		= '#010101';
	this.fontSize		= '13px';
	this.fontFamily		= 'Tahoma';
	this.linkColor		= '#0085CF';
	this.border			= '1px solid #909090';
	this.headerFontWeight = 'bold';
	this.headerPadding	= '5px 5px 5px 15px';
	this.headerBackgroundColor	= '#D0D0D0';

	this.closeColor		= '#777777';

	this.useScrolling = true;

	this.messagesHeight 	= '90%';
	this.multiPanelMargin 	= ' 10px 0 10px 0';
	this.runMsgrPadding  	= '10px';
	this.msgMargin 			= '0 0 10px 0';
	this.msgPadding  		= '5px 5px 5px 15px';
	this.msgLineHeight 		= '20px';

	this.borderPadding		= '0 0 3px 0';

	this.msgWidth   = '200px';
	this.multipanelWidth   = '200px';
	this.bgColor  = '#fff'; // for all messages

	this.Top = '5'; //px
	this.Right = '10'; //px
	this.Left = '5'; //px


	this.viewAllMode = false;
	this.max = 7; // show messages before hiding
	this.messages = [];
	//this.invitations = new Object();

	this.tplBorderBegin = '<div style="background-color:{bgColor}; padding:{borderPadding};">';
	this.tplBorderEnd	= '</div>';

	this.multiPanelTpl = "<div style='background-color:{bgColor};border:{border}; font-size:{fontSize};font-family:{fontFamily};margin:{multiPanelMargin};padding:{msgPadding};' id='multiPanel'>"
		+ "<div style='float:right;'></div>"
		+ "<div id='counter'>You have <b style='color:{linkColor};'>{count}</b> messages</div>"
		+ "<div style='line-height:{msgLineHeight};'><a style='color:{linkColor};' href='javascript:void(0)' onclick='z5Notification.ViewAll(this)'>{text}</a>&nbsp;&nbsp;"
		+ " <a style='color:{linkColor};' href='javascript:void(0)' onclick='z5Notification.AcceptAll();'>accept all</a>&nbsp;&nbsp;"
		+ " <a style='color:{linkColor};' href='javascript:z5Notification.DeclineAll();'>decline all</a></div>";

	this.tplNewInvitation = this.tplBorderBegin
		+ 'User <b style="color:{linkColor};">{senderName}</b> invites you to chat .<br/>'
        + '<span style="font-size:11px;">Invitation is received at {strTime}</span><br/>'
		+ ' <a style="color:{linkColor};" href="javascript:void(0);" onClick="z5Invitation.InvitationAnswer(\'{invitationID}\', 1)" id="{invitationID}">accept</a>&nbsp;&nbsp;'
		+ ' <a style="color:{linkColor};" href="javascript:void(0);" onClick="z5Invitation.InvitationAnswer(\'{invitationID}\', 0)">decline</a> '
		+ this.tplBorderEnd;

	this.tplAntiBlocker = this.tplBorderBegin +" <a style='color:{linkColor}'"
		+ " href='javascript:void(0);' onClick='z5Invitation.RunMessenger(\"{msgrParams}\", \"{winName}\");'>Run Messenger</a>" + this.tplBorderEnd;


	this.Init = function()
	{
		// create new div
		div = document.createElement('div');
		div.id = this.divId;

		// apply default params
		div.style.width = this.width;
		//if (this.useScrolling) div.style.height = this.maxHeight;


		delta = browserInfo.ie ? 35 : 0;

		div.style.fontSize = this.fontSize;
		div.style.color = this.fontColor;
		div.style.position = browserInfo.ie6 ? 'absolute' : 'fixed';
		div.style.zIndex = this.zIndex;

		if (browserInfo.ie) this.delta = 0;
		else if (browserInfo.firefox || browserInfo.opera || browserInfo.safari) this.delta = 25;
		else if (browserInfo.chrome) this.delta = 10;

		div.innerHTML = '<div id="runMsg"></div><div id="top"></div><div id="messages"></div>';
		document.body.appendChild(div);
		this.container = document.getElementById('messages');
		this.runMsg = document.getElementById('runMsg');
		if (this.useScrolling) this.container.style.height = this.messagesHeight;
		this.popupContainer = document.getElementById(this.divId);

		this.top = document.getElementById('top');
		this.messages = new Array();
		this.blockHiding = false;
		switch (this.position)
		{
			case 'left':
				this.popupContainer.style.top  = this.Top + 'px';
				this.popupContainer.style.left = this.Left + 'px';
				break;
			case 'right':
			default:
				this.popupContainer.style.top   = this.Top + 'px';
				this.popupContainer.style.right = this.Right + 'px';
				break;
		}

		// fix position:fixed; for popup container in ie6  --> recalculate offsets
		if (browserInfo.ie6)
		{
			var htmlEl = document.getElementsByTagName('html')[0];
			htmlEl.onscroll = function()
			{
				delta = document.documentElement.scrollTop;

				if (delta>0)
				{
					currentTopOffset = parseInt(z5Notification.Top);
					z5Notification.popupContainer.style.top = (currentTopOffset + delta) + 'px';
				}
			}
		}

		this.isInitialized	= true;
	}

	/**
	* Show antiblocker panel
	*/
	this.ShowAntiBlocker = function(msgrParams, winName)
	{
		//Init if needed
		if (false===this.isInitialized)
		{
			this.Init();
		}

		if (browserInfo.chrome)
		{
			tplAntiBlocker = this.tplBorderBegin
				+ " Browser has blocked the messenger window. \
					 Please unblock it manually. \
				  " + this.tplBorderEnd;
		}
		else
		{
			tplAntiBlocker = this.tplBorderBegin +" <a style='color:"+this.linkColor+"'"
			+ " href='javascript:void(0);' onClick='z5Invitation.RunMessenger(\""+msgrParams+"\", \""+winName+"\");'>Run Messenger</a>" + this.tplBorderEnd;
		}

		this.Show(null,null,'Messenger Blocked!!!',tplAntiBlocker,true);
	}

	/**
	* Clear antiblocker panel
	*/
	this.ClearAntiBlocker = function()
	{
		try
		{
			document.getElementById('runMsg').innerHTML = '';
		}
		catch (e) {}
	}

	/**
	* Create new invitation panel
	*/
	this.NewInvitation = function(invitationID, senderID, senderName, timestamp)
	{
		// add parameters for template parsing
		this.invitationID = invitationID;
		this.senderName = senderName;

        var d = new Date(timestamp);
        var h = d.getHours();
        var m = d.getMinutes();
        this.strTime = (h < 10 ? "0" + h : h) + ":" + (m < 10 ? "0" + m : m);

		var inv = this.ParseTemplate(this.tplNewInvitation, this);

		this.Show(invitationID, senderID, 'Invitation', inv);
	}

	/**
	* Delete invitation panel by id
	*/
	this.DeleteInvitation = function(invitationID)
	{
		var panel = document.getElementById('msg_' + invitationID);
		if (null!==panel) panel.parentNode.removeChild(panel);
		this.FixHeight();
	}


	/**
	popupId - message Id
	senderId - sender Id
	header - notification header
	content - html message
	priority - if true, notification will be placed at the top of panel
	*/
	this.Show = function(popupId, senderId, header, content, priority)
	{
		//Init if needed
		if (false===this.isInitialized)
		{
			this.Init();
			this.isInitialized = true;
		}

		cont = document.createElement('div');
		cont.id = 'msg_' + popupId;
		cont.style.margin = this.msgMargin;
		// let the div to fill the width cont.style.width = this.msgWidth;
		cont.style.margin = this.msgMargin;
		cont.style.color 		= this.fontColor;
		cont.style.fontFamily 	= this.fontFamily;
		cont.style.fontSize 	= this.fontSize;
		cont.style.backgroundColor  = this.bgColor;
		cont.style.border  			= this.border;
		cont.innerHTML 	= this.ParseTemplate("<div style='padding:{headerPadding};clear:both;background-color:{headerBackgroundColor};'><table><tr><td><div style='font-weight:{headerFontWeight};float:left;'>"+header+"</div></td><td align='right' width='1%'><div style='float:right;font-weight:{headerFontWeight};cursor:pointer;' id='close_"+popupId+"' onclick='z5Notification.Close(this);'><sup style='float:right;color:{closeColor};font-weight:{headerFontWeight};cursor:pointer;font-size:{fontSize};'>x</sup></div></td></tr></table>"
				+ "</div><div style='border-top:{border};padding:{msgPadding};line-height:{msgLineHeight};'>"+content+"</div>",this);

		if (true === priority)
		{
			this.runMsg.innerHTML = '';
			this.runMsg.appendChild(cont);
			if (this.viewAllMode || this.max<(this.messages.length-1)) this.FixHeight();
		}
		else this.container.insertBefore( cont, this.container.firstChild);

		display = 'block';
		this.text = 'view all';

		if(popupId != 'runMsgr')
			this.messages.push({id:popupId, header:header, content:content, sender:senderId});

		if(this.messages.length > this.max)
		{
			if(!this.viewAllMode) this.container.style.display = 'none';
			else this.text = 'hide all';
			document.getElementById('top').innerHTML = this.GetMultiPanel(this.text, this.messages.length);
		}
	}

	this.Close = function(elt)
	{
		if (id = parseInt(elt.id.split('_')[1]))
		{
			z5Invitation.InvitationAnswer(id, 0);
			this.FixHeight();
		}
		else elt.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(elt.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode);
	}

	this.FixHeight = function()
	{
		if (this.messages.length<=this.max) this.popupContainer.style.height = '';
		else this.popupContainer.style.height = this.CalculateMaxHeight();
	}

	this.UpdateView = function()
	{
		if(this.messages.length > this.max)
		{
			this.top.innerHTML = this.GetMultiPanel('hide all', this.messages.length);
		}
		else
		{
			this.top.innerHTML = '';


			this.container.style.height = this.messagesHeight;
			this.container.style.overflowY = '';
			this.viewAllMode = false;
			this.FixHeight();
			this.container.style.display = 'block';
		}
	}

	this.GetMultiPanel = function(text, count)
	{
		this.count = count; this.text = text;
		text = this.ParseTemplate(this.multiPanelTpl,this);
		return text;
	}

	this.FindInArray = function(id)
	{
		for(var i = 0; i < this.messages.length; i++)
			if(this.messages[i].id == id) return i;

		return false;
	}

	this.ClearPanel = function()
	{
		this.top.innerHTML = '';
		this.container.innerHTML = '';
		this.messages = [];
		this.container.style.display = 'block';
		this.viewAllMode = false;
	}

	// view all invitations
	this.ViewAll = function(elt)
	{
		if (!this.viewAllMode){
			this.container.style.display = 'block';

			this.container.style.height    = this.messagesHeight;
			this.container.style.overflowY = browserInfo.ie6 ? 'scroll' : 'auto';

			elt.innerHTML = 'hide  all';
			this.viewAllMode = true;
			//fix
			this.popupContainer.style.height = this.CalculateMaxHeight();
			if (this.max<(this.messages.length-1))
			{

			}
		}
		else
		{
			this.container.style.display = 'none';
			elt.innerHTML = 'view  all';
			this.viewAllMode = false;
			this.popupContainer.style.height = '';
		}
		return false;
	}

	this.CalculateMaxHeight = function()
	{
		screenHeight = browserInfo.ie ? document.documentElement.clientHeight : window.innerHeight;
		return (screenHeight - 2*this.Top - delta)+'px';
	}

	this.AcceptAll = function()
	{
		var temp = [];
		for(var i = 0; i < this.messages.length; i++)
			temp.push(this.messages[i].id);
		for(var i = 0; i < temp.length; i++)
			z5Invitation.InvitationAnswer(temp[i], 1, true);

		this.messages = [];
		this.UpdateView();
	}

	this.DeclineAll = function()
	{
		var temp = [];
		for(var i = 0; i < this.messages.length; i++)
			temp.push(this.messages[i].id);
		for(var i = 0; i < temp.length; i++)
			z5Invitation.InvitationAnswer(temp[i], 0, true);

		this.messages = [];
		this.UpdateView();
	}

	this.CloseInvitation = function(invitationID)
	{
		this.DeleteInvitation(invitationID);

		var index = this.FindInArray(invitationID);
		this.messages.splice(index, 1);
		this.UpdateView();

		delete this.invitations[invitationID];
	}

	this.InvitationDeclineNotification = function(addresseeName)
	{
		notification = 'User <b>' + addresseeName + '</b> declined your invitation';
		this.Show(invitationID, null, 'Notification', notification);
	}

	this.ParseTemplate = function(string,hash)
	{
		var a = '';
		for (h in hash)
		{
			a = typeof hash[h];
			string = string.replace(new RegExp('{'+h+'}','g'),hash[h]);
		}
		return string;
	}

}
var z5Notification = new Z5Notification();
function Z5InvitationManager()
{
	this.invitations = new Object();			// Invitations object (stores received invitation)

	this.Invite = function(invitationID, senderID, senderName, timestamp)
	{
		// don`t accept invitations with the same id
		if(this.invitations[invitationID])
		{
			return false;
		}

		// add invitation to invitations list
		this.invitations[invitationID] = {friendID:senderID, friendName:senderName};

		// show invitation notification
		z5Notification.NewInvitation(invitationID, senderID, senderName, timestamp);
	}

	this.InvitationAnswer = function(invitationID, resultCode, skipUpdateView)
	{
		// don`t process unknown invitation
		if(!this.invitations[invitationID])
		{
			return false;
		}

		// delete notification
		z5Notification.DeleteInvitation(invitationID);

		if(skipUpdateView)
		{
			//console.log('skip update view');
		}
		else
		{
			var index = z5Notification.FindInArray(invitationID);
			z5Notification.messages.splice(index, 1);
			z5Notification.UpdateView();
		}

		var friendData = this.invitations[invitationID];
		var updater = GetUpdater();
		updater.OnInvitationAnswer(invitationID, friendData.friendID, friendData.friendName, resultCode);

		delete this.invitations[invitationID];
	}

	this.SendInvitation = function(data)
	{
		var updater = GetUpdater();

		if(updater)
		{
			updater.CreateInvitation(data);
		}
		else
		{
			setTimeout('CreateInvitation(\'' + data + '\')', 3000);
		}
	}

	this.CloseInvitation = function(data)
	{
		z5Notification.CloseInvitation(data);
	}

	this.RunMessenger = function(msgrParams, winName)
	{
		if(z5messenger.air)
		{
			MGRunMessenger(msgrParams);
			return;
		}

		z5Notification.ClearAntiBlocker();

		if(true == browserInfo.opera)
		{
			// OPERA
			this.OpenPopupOpera(msgrParams, winName);
		}
		else
		{
			// NOT OPERA
			this.OpenPopup(msgrParams, winName);
		}
	}

	this.OpenPopup = function(msgrParams, winName)
	{
		var url = messengerUrl + msgrParams;
		var win = this.OpenMessengerWindow(url, winName);

		try
		{
			if(browserInfo.chrome)
			{
				// if popup blocker is active, we can do this check right now
			    // will work fine if popup is opened by script
				//if(!win.innerWidth) this.OnPopupBlocked(msgrParams, winName);

				// but if window is opened by human manually
				// we should wait some time before checking window size
				setTimeout(function(z5im, pWin, pWinName, pParams )
				{
					  return function()
					  {
						 if (!pWin || !pWin.innerWidth)
						 {
							z5im.OnPopupBlocked(pParams, pWinName);
						 }
					  }
				}(this, win, winName, msgrParams), 5000);
			}
			else
			{
				var name = win.name;
				if(!name) this.OnPopupBlocked(msgrParams, winName);
			}
		}
		catch(e)
		{
			this.OnPopupBlocked(msgrParams, winName);
		}
	}

	this.OpenPopupOpera = function(msgrParams, winName)
	{
		var url = messengerUrl + msgrParams;

		t = window.setTimeout("this.OnPopupBlocked('" + msgrParams + "','" + winName + "')", 1000);

		var win = this.OpenMessengerWindow(url, winName);

		window.clearTimeout(t);
	}

	this.OpenMessengerWindow = function(url, name)
	{
		url = encodeURI(url);// added to fix bug in IE 7 with usernames which have spaces

		//chrome fix height
		if(browserInfo.chrome) z5messenger.msgrHeight += 50;

		var isResizeAble = true;
		var width = messengerWidth;
		var height = messengerHeight;

		var left = Math.round((screen.width - width) / 2);
		var top = Math.round((screen.height - height) / 2);

		var styleStr = 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no';
		styleStr += ',resizable=' + (isResizeAble ? 'yes' : 'no');
		styleStr += ',width=' + width + ',height=' + height;
		styleStr += ',left=' + left + ',top=' + top;
		styleStr += ',screenX=' + left + ',screenY=' + top;

		var win = window.open(url, name, styleStr);
		return win;
	}

	this.OnPopupBlocked = function(msgrParams, winName)
	{
		alert('it seems your browser blocks popup windows. '
				+ 'For proper messenger\'s work please disable popup blocker '
				+ 'and click "Run Messenger" link');

		z5Notification.ShowAntiBlocker(msgrParams, winName);
	}
}
var z5Invitation = new Z5InvitationManager();
function Z5Messenger()
{
	this.uid = '';

	this.flBig = true;
	this.flSmallSize = 59;
	this.flBigSize = 400;
	this.flMinimizedByDef = false;

	this.preloaderLogo = '';
	this.preloaderBgColor = '';
	this.preloaderTxtColor = '';

	this.debug = false;
	this.air = false;
	this.rtmp = '';
	this.langID = '';

	this.flashVersion = '9.0.124'; // required flash player version

	this.StartPresence = function ()
	{
		var flashvars = this.GetUpdaterAndFriendListParams();
		var params = { allowscriptaccess:'always' };
		document.write(this.MakeSwfHolder("z5_updater_swf", "position: absolute;"));
		swfobject.embedSWF(updaterSwfUrl, "z5_updater_swf", "1", "1", this.flashVersion,
			null, flashvars, params);
	}

	this.ShowFriendList = function (width, height, bgColor)
	{
		if(!width) width = 320;
		if(!bgColor) bgColor = 0xededed;

		if(height) this.flBigSize = height;
		else height = this.flBigSize;

		if(this.flMinimizedByDef)
		{
			this.flBig = false;
			height = this.flSmallSize;
		}

		var flashvars = this.GetUpdaterAndFriendListParams();
		flashvars.bgColor = bgColor;
		// NOTE: Do not use wmode=transparent. It has bad side effects.
		var params = { allowscriptaccess:'always' /* , wmode:'transparent' */ };
		document.write(this.MakeSwfHolder("z5_friend_list_swf"));
		swfobject.embedSWF(friendListSwfUrl, "z5_friend_list_swf", width, height, this.flashVersion,
				null, flashvars, params);
	}

	this.ShowMessenger = function ()
	{
		var flashvars = { data:document.location };
		flashvars.langID = this.langID;
		var params = { allowscriptaccess:'always' };
		document.write(this.MakeSwfHolder("z5_messenger_swf"));
		swfobject.embedSWF(messengerSwfUrl, "z5_messenger_swf", "100%", "100%", this.flashVersion,
			null, flashvars, params);
	}

	this.Refresh = function()
	{
		try
		{
			var updater = GetUpdater();
			var res = updater.Refresh();
			if(!res) document.cookie = "z5refresh=true";
		}
		catch(e)
		{
			trace("error: " + e);
		}
	}

	this.GetUpdaterAndFriendListParams = function()
	{
		var needRefresh = document.cookie.indexOf('z5refresh=true') != -1;
		document.cookie = "z5refresh=false";

		return {
			uid:encodeURIComponent(this.uid),
			debug:encodeURIComponent(this.debug),
			air:encodeURIComponent(this.air),
			rtmp:encodeURIComponent(this.rtmp),
			refresh:encodeURIComponent(needRefresh),
			preloaderLogo:encodeURIComponent(this.preloaderLogo),
			preloaderBgColor:encodeURIComponent(this.preloaderBgColor),
			preloaderTxtColor:encodeURIComponent(this.preloaderTxtColor),
			langID:encodeURIComponent(this.langID)
		};
	}

	this.SwitchFriendListSize = function()
	{
		this.flBig = !this.flBig;

		var height = this.flBig ? this.flBigSize : this.flSmallSize;
		var friendListSwf = swfobject.getObjectById("z5_friend_list_swf");
		friendListSwf.height = height;
	}

	this.MakeSwfHolder = function(swfID, style)
	{
		var res = '';

		if(style) res += '<div style="' + style + '">';
		res += '<div id="' + swfID + '">';
		res += '<p>You need to install or upgrade Adobe Flash Player.</p>';
		res += '<p>Version ' + this.flashVersion + ' or higher is required.</p>';
		res += '<p><a href="http://get.adobe.com/flashplayer/">Get Adobe Flash player</a></p>';
		res += '</div>';
		if(style) res += '</div>';
		return res;
	}

	this.SendInvitation = function(userData)
	{
		z5Invitation.SendInvitation(userData);
	}
}
var z5messenger = new Z5Messenger();
if(swfobject == undefined)
{
/* SWFObject v2.1 <http://code.google.com/p/swfobject/> Copyright (c) 2007-2008 Geoff Stearns, Michael Williams, and Bobby van der Sluis This software is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> */
var swfobject=function(){var b="undefined",Q="object",n="Shockwave Flash",p="ShockwaveFlash.ShockwaveFlash",P="application/x-shockwave-flash",m="SWFObjectExprInst",j=window,K=document,T=navigator,o=[],N=[],i=[],d=[],J,Z=null,M=null,l=null,e=false,A=false;var h=function(){var v=typeof K.getElementById!=b&&typeof K.getElementsByTagName!=b&&typeof K.createElement!=b,AC=[0,0,0],x=null;if(typeof T.plugins!=b&&typeof T.plugins[n]==Q){x=T.plugins[n].description;if(x&&!(typeof T.mimeTypes!=b&&T.mimeTypes[P]&&!T.mimeTypes[P].enabledPlugin)){x=x.replace(/^.*\s+(\S+\s+\S+$)/,"$1");AC[0]=parseInt(x.replace(/^(.*)\..*$/,"$1"),10);AC[1]=parseInt(x.replace(/^.*\.(.*)\s.*$/,"$1"),10);AC[2]=/r/.test(x)?parseInt(x.replace(/^.*r(.*)$/,"$1"),10):0}}else{if(typeof j.ActiveXObject!=b){var y=null,AB=false;try{y=new ActiveXObject(p+".7")}catch(t){try{y=new ActiveXObject(p+".6");AC=[6,0,21];y.AllowScriptAccess="always"}catch(t){if(AC[0]==6){AB=true}}if(!AB){try{y=new ActiveXObject(p)}catch(t){}}}if(!AB&&y){try{x=y.GetVariable("$version");if(x){x=x.split(" ")[1].split(",");AC=[parseInt(x[0],10),parseInt(x[1],10),parseInt(x[2],10)]}}catch(t){}}}}var AD=T.userAgent.toLowerCase(),r=T.platform.toLowerCase(),AA=/webkit/.test(AD)?parseFloat(AD.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,q=false,z=r?/win/.test(r):/win/.test(AD),w=r?/mac/.test(r):/mac/.test(AD);/*@cc_on q=true;@if(@_win32)z=true;@elif(@_mac)w=true;@end@*/return{w3cdom:v,pv:AC,webkit:AA,ie:q,win:z,mac:w}}();var L=function(){if(!h.w3cdom){return }f(H);if(h.ie&&h.win){try{K.write("<script id=__ie_ondomload defer=true src=//:><\/script>");J=C("__ie_ondomload");if(J){I(J,"onreadystatechange",S)}}catch(q){}}if(h.webkit&&typeof K.readyState!=b){Z=setInterval(function(){if(/loaded|complete/.test(K.readyState)){E()}},10)}if(typeof K.addEventListener!=b){K.addEventListener("DOMContentLoaded",E,null)}R(E)}();function S(){if(J.readyState=="complete"){J.parentNode.removeChild(J);E()}}function E(){if(e){return }if(h.ie&&h.win){var v=a("span");try{var u=K.getElementsByTagName("body")[0].appendChild(v);u.parentNode.removeChild(u)}catch(w){return }}e=true;if(Z){clearInterval(Z);Z=null}var q=o.length;for(var r=0;r<q;r++){o[r]()}}function f(q){if(e){q()}else{o[o.length]=q}}function R(r){if(typeof j.addEventListener!=b){j.addEventListener("load",r,false)}else{if(typeof K.addEventListener!=b){K.addEventListener("load",r,false)}else{if(typeof j.attachEvent!=b){I(j,"onload",r)}else{if(typeof j.onload=="function"){var q=j.onload;j.onload=function(){q();r()}}else{j.onload=r}}}}}function H(){var t=N.length;for(var q=0;q<t;q++){var u=N[q].id;if(h.pv[0]>0){var r=C(u);if(r){N[q].width=r.getAttribute("width")?r.getAttribute("width"):"0";N[q].height=r.getAttribute("height")?r.getAttribute("height"):"0";if(c(N[q].swfVersion)){if(h.webkit&&h.webkit<312){Y(r)}W(u,true)}else{if(N[q].expressInstall&&!A&&c("6.0.65")&&(h.win||h.mac)){k(N[q])}else{O(r)}}}}else{W(u,true)}}}function Y(t){var q=t.getElementsByTagName(Q)[0];if(q){var w=a("embed"),y=q.attributes;if(y){var v=y.length;for(var u=0;u<v;u++){if(y[u].nodeName=="DATA"){w.setAttribute("src",y[u].nodeValue)}else{w.setAttribute(y[u].nodeName,y[u].nodeValue)}}}var x=q.childNodes;if(x){var z=x.length;for(var r=0;r<z;r++){if(x[r].nodeType==1&&x[r].nodeName=="PARAM"){w.setAttribute(x[r].getAttribute("name"),x[r].getAttribute("value"))}}}t.parentNode.replaceChild(w,t)}}function k(w){A=true;var u=C(w.id);if(u){if(w.altContentId){var y=C(w.altContentId);if(y){M=y;l=w.altContentId}}else{M=G(u)}if(!(/%$/.test(w.width))&&parseInt(w.width,10)<310){w.width="310"}if(!(/%$/.test(w.height))&&parseInt(w.height,10)<137){w.height="137"}K.title=K.title.slice(0,47)+" - Flash Player Installation";var z=h.ie&&h.win?"ActiveX":"PlugIn",q=K.title,r="MMredirectURL="+j.location+"&MMplayerType="+z+"&MMdoctitle="+q,x=w.id;if(h.ie&&h.win&&u.readyState!=4){var t=a("div");x+="SWFObjectNew";t.setAttribute("id",x);u.parentNode.insertBefore(t,u);u.style.display="none";var v=function(){u.parentNode.removeChild(u)};I(j,"onload",v)}U({data:w.expressInstall,id:m,width:w.width,height:w.height},{flashvars:r},x)}}function O(t){if(h.ie&&h.win&&t.readyState!=4){var r=a("div");t.parentNode.insertBefore(r,t);r.parentNode.replaceChild(G(t),r);t.style.display="none";var q=function(){t.parentNode.removeChild(t)};I(j,"onload",q)}else{t.parentNode.replaceChild(G(t),t)}}function G(v){var u=a("div");if(h.win&&h.ie){u.innerHTML=v.innerHTML}else{var r=v.getElementsByTagName(Q)[0];if(r){var w=r.childNodes;if(w){var q=w.length;for(var t=0;t<q;t++){if(!(w[t].nodeType==1&&w[t].nodeName=="PARAM")&&!(w[t].nodeType==8)){u.appendChild(w[t].cloneNode(true))}}}}}return u}function U(AG,AE,t){var q,v=C(t);if(v){if(typeof AG.id==b){AG.id=t}if(h.ie&&h.win){var AF="";for(var AB in AG){if(AG[AB]!=Object.prototype[AB]){if(AB.toLowerCase()=="data"){AE.movie=AG[AB]}else{if(AB.toLowerCase()=="styleclass"){AF+=' class="'+AG[AB]+'"'}else{if(AB.toLowerCase()!="classid"){AF+=" "+AB+'="'+AG[AB]+'"'}}}}}var AD="";for(var AA in AE){if(AE[AA]!=Object.prototype[AA]){AD+='<param name="'+AA+'" value="'+AE[AA]+'" />'}}v.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+AF+">"+AD+"</object>";i[i.length]=AG.id;q=C(AG.id)}else{if(h.webkit&&h.webkit<312){var AC=a("embed");AC.setAttribute("type",P);for(var z in AG){if(AG[z]!=Object.prototype[z]){if(z.toLowerCase()=="data"){AC.setAttribute("src",AG[z])}else{if(z.toLowerCase()=="styleclass"){AC.setAttribute("class",AG[z])}else{if(z.toLowerCase()!="classid"){AC.setAttribute(z,AG[z])}}}}}for(var y in AE){if(AE[y]!=Object.prototype[y]){if(y.toLowerCase()!="movie"){AC.setAttribute(y,AE[y])}}}v.parentNode.replaceChild(AC,v);q=AC}else{var u=a(Q);u.setAttribute("type",P);for(var x in AG){if(AG[x]!=Object.prototype[x]){if(x.toLowerCase()=="styleclass"){u.setAttribute("class",AG[x])}else{if(x.toLowerCase()!="classid"){u.setAttribute(x,AG[x])}}}}for(var w in AE){if(AE[w]!=Object.prototype[w]&&w.toLowerCase()!="movie"){F(u,w,AE[w])}}v.parentNode.replaceChild(u,v);q=u}}}return q}function F(t,q,r){var u=a("param");u.setAttribute("name",q);u.setAttribute("value",r);t.appendChild(u)}function X(r){var q=C(r);if(q&&(q.nodeName=="OBJECT"||q.nodeName=="EMBED")){if(h.ie&&h.win){if(q.readyState==4){B(r)}else{j.attachEvent("onload",function(){B(r)})}}else{q.parentNode.removeChild(q)}}}function B(t){var r=C(t);if(r){for(var q in r){if(typeof r[q]=="function"){r[q]=null}}r.parentNode.removeChild(r)}}function C(t){var q=null;try{q=K.getElementById(t)}catch(r){}return q}function a(q){return K.createElement(q)}function I(t,q,r){t.attachEvent(q,r);d[d.length]=[t,q,r]}function c(t){var r=h.pv,q=t.split(".");q[0]=parseInt(q[0],10);q[1]=parseInt(q[1],10)||0;q[2]=parseInt(q[2],10)||0;return(r[0]>q[0]||(r[0]==q[0]&&r[1]>q[1])||(r[0]==q[0]&&r[1]==q[1]&&r[2]>=q[2]))?true:false}function V(v,r){if(h.ie&&h.mac){return }var u=K.getElementsByTagName("head")[0],t=a("style");t.setAttribute("type","text/css");t.setAttribute("media","screen");if(!(h.ie&&h.win)&&typeof K.createTextNode!=b){t.appendChild(K.createTextNode(v+" {"+r+"}"))}u.appendChild(t);if(h.ie&&h.win&&typeof K.styleSheets!=b&&K.styleSheets.length>0){var q=K.styleSheets[K.styleSheets.length-1];if(typeof q.addRule==Q){q.addRule(v,r)}}}function W(t,q){var r=q?"visible":"hidden";if(e&&C(t)){C(t).style.visibility=r}else{V("#"+t,"visibility:"+r)}}function g(s){var r=/[\\\"<>\.;]/;var q=r.exec(s)!=null;return q?encodeURIComponent(s):s}var D=function(){if(h.ie&&h.win){window.attachEvent("onunload",function(){var w=d.length;for(var v=0;v<w;v++){d[v][0].detachEvent(d[v][1],d[v][2])}var t=i.length;for(var u=0;u<t;u++){X(i[u])}for(var r in h){h[r]=null}h=null;for(var q in swfobject){swfobject[q]=null}swfobject=null})}}();return{registerObject:function(u,q,t){if(!h.w3cdom||!u||!q){return }var r={};r.id=u;r.swfVersion=q;r.expressInstall=t?t:false;N[N.length]=r;W(u,false)},getObjectById:function(v){var q=null;if(h.w3cdom){var t=C(v);if(t){var u=t.getElementsByTagName(Q)[0];if(!u||(u&&typeof t.SetVariable!=b)){q=t}else{if(typeof u.SetVariable!=b){q=u}}}}return q},embedSWF:function(x,AE,AB,AD,q,w,r,z,AC){if(!h.w3cdom||!x||!AE||!AB||!AD||!q){return }AB+="";AD+="";if(c(q)){W(AE,false);var AA={};if(AC&&typeof AC===Q){for(var v in AC){if(AC[v]!=Object.prototype[v]){AA[v]=AC[v]}}}AA.data=x;AA.width=AB;AA.height=AD;var y={};if(z&&typeof z===Q){for(var u in z){if(z[u]!=Object.prototype[u]){y[u]=z[u]}}}if(r&&typeof r===Q){for(var t in r){if(r[t]!=Object.prototype[t]){if(typeof y.flashvars!=b){y.flashvars+="&"+t+"="+r[t]}else{y.flashvars=t+"="+r[t]}}}}f(function(){U(AA,y,AE);if(AA.id==AE){W(AE,true)}})}else{if(w&&!A&&c("6.0.65")&&(h.win||h.mac)){A=true;W(AE,false);f(function(){var AF={};AF.id=AF.altContentId=AE;AF.width=AB;AF.height=AD;AF.expressInstall=w;k(AF)})}}},getFlashPlayerVersion:function(){return{major:h.pv[0],minor:h.pv[1],release:h.pv[2]}},hasFlashPlayerVersion:c,createSWF:function(t,r,q){if(h.w3cdom){return U(t,r,q)}else{return undefined}},removeSWF:function(q){if(h.w3cdom){X(q)}},createCSS:function(r,q){if(h.w3cdom){V(r,q)}},addDomLoadEvent:f,addLoadEvent:R,getQueryParamValue:function(v){var u=K.location.search||K.location.hash;if(v==null){return g(u)}if(u){var t=u.substring(1).split("&");for(var r=0;r<t.length;r++){if(t[r].substring(0,t[r].indexOf("="))==v){return g(t[r].substring((t[r].indexOf("=")+1)))}}}return""},expressInstallCallback:function(){if(A&&M){var q=C(m);if(q){q.parentNode.replaceChild(M,q);if(l){W(l,true);if(h.ie&&h.win){M.style.display="block"}}M=null;l=null;A=false}}}}}();
}
