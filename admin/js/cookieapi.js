/*

	This function set the cookie in client for specified 
	period of time in minutes.
*/

function areCookiesEnabled() {
        var r = false;
        setCookie("testing", "Hello", 1);
        if (getCookie("testing") != null) {
            r = true;
            deleteCookie("testing");
        }
        return r;
    }
function setCookie(c_name,value,exp_duration_minutes)
{
		var exdate=new Date();
		//exdate.setDate(exdate.getDate() + exdays);
		exdate.setTime( exdate.getTime()+(exp_duration_minutes*60*1000) );
		
		//var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		var c_value=escape(value) + ((exp_duration_minutes==null) ? "" : "; expires="+exdate.toGMTString());
		document.cookie=c_name + "=" + c_value;
}

/*

	This function get cookie value from the client(browser) storage(cache-database)
	by cookie name given as argument.
*/

function getCookie(c_name)
{
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
		  {
		  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  x=x.replace(/^\s+|\s+$/g,"");
		  if (x==c_name)
		    {
		    return unescape(y);
		    }
		  }
}

/*

	This function delete cookie value from the client(browser) storage(cache-database).

*/
function deleteCookie(name)
{
   document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
