function ei_notification() {
	
	var val="N";
	
	if(document.domain=='192.168.1.172') {
		
		Set_Cookie( 'open_notification',val, 1, '/', '', '');
	}
	else {
		
		Set_Cookie( 'open_notification',val, 1, '/', '.matrimonialsindia.com', '');
	}	
}

function setMyVar_notification(val) {
	
	if(document.domain=='192.168.1.172') {
		
		Set_Cookie( 'open_notification',val, 1, '/', '', '');
	}
	else {
		
		Set_Cookie( 'open_notification',val, 1, '/', '.matrimonialsindia.com', '');
	}
	
	if(val=='Y') {
		
		ei_notification();
	}
}

function Set_Cookie( name, value, expires, path, domain, secure ) {
	
	// set time, it's in milliseconds
	var today = new Date();
	today.setTime( today.getTime() );
	
	/*
	if the expires variable is set, make the correct
	expires time, the current script below will set
	it for x number of days, to make it for hours,
	delete * 24, for minutes, delete * 60 * 24
	*/
	if ( expires ) {
		
		expires = expires * 1000 * 60 * 60 * 1;
	}
	var expires_date = new Date( today.getTime() + (expires) );
	
	document.cookie = name + "=" +escape( value ) +
	( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
	( ( path ) ? ";path=" + path : "" ) +
	( ( domain ) ? ";domain=" + domain : "" ) +
	( ( secure ) ? ";secure" : "" );
} 
