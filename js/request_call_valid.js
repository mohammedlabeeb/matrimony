function request_call_valid(frm) {
	
	if ((frm.yourname.value).length==0) {
	    
	    alert("Please Enter Your Name.");
	    frm.yourname.focus();
		return false;
	}
	
	if(frm.check_login.value=="N") {
		
		if ((frm.email_address.value).length==0) {
		    
		    alert("Please Enter Your E-mail Address.");
		    frm.email_address.focus();
			return false;
		}
	      	
	   	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	   		
		if(reg.test(frm.email_address.value) == false) {
	
			alert("Invalid Email Address.");
			frm.email_address.focus();
			return false;
		}
			
		if (frm.email_address.value.indexOf('@') != frm.email_address.value.lastIndexOf('@')) {
			
			alert("Please Specify One E-mail address only.");
		    frm.email_address.focus();
		    return false;
		}
		
		if ((frm.country1.value).length==0) {
		    
		    alert("Please Select Your Country.");
		    frm.country1.focus();
			return false;
		}
		
		
		if ((frm.mobile_phone.value).length==0) {
		    
		    alert("Please Enter Your Mobile Phone.");
		    frm.mobile_phone.focus();
			return false;
		}
		
		//Indian Member Case
		if ((frm.mobile_phone.value.length<10 || frm.mobile_phone.value.length>10) && frm.country1.options[frm.country1.selectedIndex].value=="IN^91") {
		
		   alert("Mobile Number Should be 10 Digits.");
		   frm.mobile_phone.focus();
		   return false;
	    }
	
	    //foreign Member Case
		if ((frm.mobile_phone.value.length<3) && frm.country1.options[frm.country1.selectedIndex].value!="IN^91") {
	
			alert("Mobile Number Should be at least 3 Digits.");
			frm.mobile_phone.focus();
			return false;
		}
	}
	else {
	
		if ((frm.mobile_phone.value).length==0) {
			    
		    alert("Please Enter Your Mobile Phone.");
		    frm.mobile_phone.focus();
			return false;
		}
		
		//Indian Member Case
		if ((frm.mobile_phone.value.length<10 || frm.mobile_phone.value.length>10) && frm.country1.value=="IN") {
		
		   alert("Mobile Number Should be 10 Digits.");
		   frm.mobile_phone.focus();
		   return false;
	    }
	
	    //foreign Member Case
		if ((frm.mobile_phone.value.length<3) && frm.country1.value!="IN") {
	
			alert("Mobile Number Should be at least 3 Digits.");
			frm.mobile_phone.focus();
			return false;
		}
	}
	 
}

function get_country_code(id1){
	
	var myarray = id1.split("^"); 
	
	document.getElementById("phccode").value=myarray[1];	
}
