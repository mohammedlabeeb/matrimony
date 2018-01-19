/* register form  { */
var loading_img="<img src='http://imgs.bharatmatrimony.com/bmimgs/loading-small-icon.gif' width='20' height='19' border='0'>";
var S_interval;
//calender
var one_day=1000*60*60*24
var one_month=1000*60*60*24*30
var one_year=1000*60*60*24*30*12
MOTHERTONGUE_DOMAIN_MAPPING = {"1":"13","2":"13","3":"10","4":"7","5":"10","6":"10","7":"10","8":"10","9":"10","10":"0","11":"0","12":"10","13":"13","14":"5","15":"10","16":"10","17":"10","18":"10","19":"4","20":"10","21":"5","22":"13","23":"6","24":"11","25":"10","26":"5","27":"13","28":"10","29":"10","30":"10","31":"3","32":"13","33":"6","34":"14","35":"13","36":"13","37":"13","38":"7","39":"10","40":"11","41":"8","42":"14","43":"10","44":"11","45":"9","46":"1","47":"1","48":"2","49":"13","50":"4","51":"15","53":"1","99":"0"};
IDSTARTLETTERHASH = {"7":"B","6":"R","5":"G","8":"P","10":"H","9":"S","4":"K","3":"E","2":"T","1":"M","14":"D","12":"C","13":"A","11":"Y","15":"U"};

function d_return(dval)
{
	if(dval==1){utext="Tamil";}
	if(dval==2){utext="Telugu";}
	if(dval==3){utext="Kerala";}
	if(dval==4){utext="Kannada";}
	if(dval==5){utext="Gujarati";}
	if(dval==6){utext="Marathi";}
	if(dval==7){utext="Bengali";}
	if(dval==8){utext="Punjabi";}
	if(dval==9){utext="Sindhi";}
	if(dval==10){utext="Hindi";}
	if(dval==11){utext="Oriya";}
	if(dval==12){utext="Parsi";}
	if(dval==13){utext="Assamese";}
	if(dval==14){utext="Marwadi";}	
	if(dval==15){utext="Urdu";}
	if(dval==0){utext="Bharat";}
	return utext;
}

function displayage(yr, mon, day, unit, decimal, round){
	today=new Date()
	var pastdate=new Date(yr, mon-1, day)
	var countunit=unit
	var decimals=decimal
	var rounding=round
	finalunit=(countunit=="days")? one_day : (countunit=="months")? one_month : one_year
	decimals=(decimals<=0)? 1 : decimals*10

	if (unit!="years"){
		if (rounding=="rounddown")
			alert (Math.floor((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals+' '+countunit)
		else
			alert (Math.ceil((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals+' '+countunit)
	}else{
		yearspast=today.getFullYear()-yr-1
		tail=(today.getMonth()>mon-1 || today.getMonth()==mon-1 && today.getDate()>=day)? 1 : 0
		pastdate.setFullYear(today.getFullYear())
		pastdate2=new Date(today.getFullYear()-1, mon-1, day)
		tail=(tail==1)? tail+Math.floor((today.getTime()-pastdate.getTime())/(finalunit)*decimals)/decimals : Math.floor((today.getTime()-pastdate2.getTime())/(finalunit)*decimals)/decimals
		var calyear=yearspast+tail;
	}
	return calyear;
}
//calender

var domain_request=false, caste_request=false, more_request=false, def_domain;
function $(elementname) {return document.getElementById(elementname);}


function makeDrequest(mothertongue){
	document.registrationform.TEMP_CASTE_NORMAL.value='';
	if($("#RELIGION").val()>0)	
	{
	$('#SHOW_CASTE').hide();
	$('#SHOW_CASTE_AUTO').show();
	}

}



function populateSelect(objSelect,optlist){	
	objSelect.length=0;
	for(ic=0;ic<optlist.length;ic++){
		var objOption = document.createElement("option");
		objOption.text = optlist[ic].caption;
		objOption.value = optlist[ic].value;
		if(document.all && !window.opera) {objSelect.add(objOption);}
		else{objSelect.add(objOption, null);}
	}
}



function showMoreCaste(){
	if(document.registrationform.CASTE_NORMAL.value=="no"){
		var selbox = $('#CASTE_NORMAL');
		$("#TEMP_CASTE_NORMAL").val("");
		
		$('body div.ac_results').remove();
		var regReqData = {};
		regReqData = {type:"caste",religion:$("#RELIGION").val(),caste:"no",othercaste:"no"};

		$.getJSON('register/ajax_registration.html', regReqData , 
		function(data){
				fnautocomplete("CASTE_NORMAL","TEMP_CASTE_NORMAL",data);
				selbox.append($('<option></option').val("00").html("- Select -"));
				$.each(data, function(index, obj) {selbox.append($('<option></option').val(obj.value).html(obj.caption).css({color:obj.color}));});
				selbox.append($('<option></option').val("999").html("Others"));
				//$("#CASTE_LOADING").html("");
		});
	}	
}

function showMoreCountry(cntryValue){ 
	if(cntryValue==888){
		more_request = createajax();
		var url="register/ajax_registration687c.html?type=country";
		more_request.onreadystatechange = LoadCountry;
		more_request.open('GET/index.html', url, true);
		more_request.send(null);
	}else{
		//$('M_COUNTRYCODE').val(cntryValue);
		document.getElementById('M_COUNTRYCODE').value=cntryValue;
	}
}


function autoComreg1(){
	loadexternalfile("http://"+DOMAINARRAY['domainnameimgs']+"/scripts/jquery.js", "js");
}



/* Matrimony Profile for */
function mprofile(mpvalue){
	//autoComreg1();
	var registrationform = this.document.registrationform;
	document.getElementById("mpage").innerHTML="Date of birth";
	document.getElementById("orage").style.display="block";

	/*if (mpvalue==1 || mpvalue==8 || mpvalue==9){
		document.getElementById("orage").style.display="none";
		
	}else{
		
		document.getElementById("mpage").innerHTML="Age";
	}*/
	
	if(mpvalue==8){
		document.getElementById("mpname").innerHTML="Son's Name";
		registrationform.GENDER[0].checked=true; gen_val="M";
		var c=registrationform.GENDER.length; for(i=0;i<c;i++){registrationform.GENDER[i].disabled=true;}
		loadDOByear();
	}else if(mpvalue==9){
		document.getElementById("mpname").innerHTML="Daughter's Name";
		registrationform.GENDER[1].checked=true; gen_val="F";
		var c=registrationform.GENDER.length; for(i=0;i<c;i++){registrationform.GENDER[i].disabled=true;}
		loadDOByear();
	}else if(mpvalue==10){
		document.getElementById("mpname").innerHTML="Groom's Name";
		registrationform.GENDER[0].checked=true; gen_val="M";
		var c=registrationform.GENDER.length; for(i=0;i<c;i++){registrationform.GENDER[i].disabled=true;}
		loadDOByear();
	}else if(mpvalue==11){
		document.getElementById("mpname").innerHTML="Bride's Name";
		registrationform.GENDER[1].checked=true; gen_val="F";
		var c=registrationform.GENDER.length; for(i=0;i<c;i++){registrationform.GENDER[i].disabled=true;}
		loadDOByear();
	}else{
		document.getElementById("mpname").innerHTML="Name";
		registrationform.GENDER[0].checked=false;
		registrationform.GENDER[1].checked=false;
		gen_val = 0;
		var c=registrationform.GENDER.length; for(i=0;i<c;i++){registrationform.GENDER[i].disabled=false;}
		loadDOByear();
	}
	registrationform.GEN_VAL.value=gen_val;

}
/* ends */


function LoadCountry(){
	if(more_request.readyState == 4){
		if(more_request.status == 200){
			var conlist = eval(more_request.responseText);
			var objSelect = document.getElementById('COUNTRY');
			populateSelect(objSelect,conlist);
			var objSelect2 = document.getElementById('M_COUNTRYCODE');
			populateSelect(objSelect2,conlist);
		}
	}
}

function showMoreCountry2(cntryValue) { 
	if(cntryValue=="no") {
		more_request = createajax();
		var url="register/ajax_registration687c.html?type=country";
		more_request.onreadystatechange = LoadCountry2;
		more_request.open('GET/index.html', url, true);
		more_request.send(null);
	} else {
		//$('COUNTRY').value=cntryValue;
		document.getElementById('COUNTRY').value=cntryValue;
	} 	
}

function LoadCountry2() {
	if (more_request.readyState == 4) {
		if (more_request.status == 200) {
			var conlist = eval(more_request.responseText);			
			var objSelect2 = document.getElementById('M_COUNTRYCODE');
			populateSelect(objSelect2,conlist);
		}
	}
}


/* commom */
function IsEmpty(obj, obj_type) {
	if (obj_type == "text" || obj_type == "password" || obj_type == "textarea" || obj_type == "file")	{
		var objValue;
		objValue = obj.value.replace(/\s+$/,"");
		if (objValue.length == 0) { return true; } else { return false; }
	} else if (obj_type == "select" || obj_type == "select-one") {
		for (i=0; i < obj.length; i++) {
			if (obj.options[i].selected) {
					if(obj.options[i].value==" ") {return true;obj.focus();} else {return false;}
					if(obj.options[i].value == "0") { if(obj.options[i].seletedIndex == "0") {return true;obj.focus();} } else { return false; }
			}
		}
		return true;	
	} else if (obj_type == "radio" || obj_type == "checkbox") {
		if (!obj[0] && obj) {
			if (obj.checked) { return false; } else { return true; }
		} else {
			for (i=0; i < obj.length; i++) { if (obj[i].checked) { return false; } }
			return true;
		}
	} else { return false; }
}

function ValidateEmail(Email) {
	if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(Email))) { return false; }
	return true;
}

function ValidateNo( NumStr, String ) {
	for( var Idx = 0; Idx < NumStr.length; Idx ++ ) {
		 var Char = NumStr.charAt( Idx );
		 var Match = false;
		 for( var Idx1 = 0; Idx1 < String.length; Idx1 ++) { if( Char == String.charAt( Idx1 ) ) { Match = true; } }
		if ( !Match ) { return false; }
 	}
   	return true;
}
/* commom */

/* registrationform Validate */
function validateregistrationform() { 
	var registrationform = this.document.registrationform;
	var x='';
	var y=new Array();

	if(document.getElementById("REGISTERED_BY")){
		var x = document.getElementById("REGISTERED_BY").selectedIndex;
		var y = document.getElementById("REGISTERED_BY").options;

		if (registrationform.REGISTERED_BY.value =="0"){ alert("Please select for whom you are registering the profile."); registrationform.REGISTERED_BY.focus(); return false;}
	}
	
	var reg = /^([^0-9]*)$/;       
	if(reg.test(document.getElementById("NAME").value) == false){alert("You are not allowed to use numeric values"); document.getElementById("NAME").focus(); return false;}
	if(reg.test(document.getElementById("TEMP_CASTE_NORMAL").value) == false){alert("You are not allowed to use numeric values in caste field"); document.getElementById("TEMP_CASTE_NORMAL").focus(); return false;}

	if ((registrationform.NAME.value =="Name") || (IsEmpty(registrationform.NAME,'text'))) {
		if (document.getElementById("REGISTERED_BY") && (y[x].value==8)){
			alert("Please enter the Son's name"); registrationform.NAME.focus(); return false;
		}else if (document.getElementById("REGISTERED_BY") && (y[x].value==9)){
			alert("Please enter the Daughter's name"); registrationform.NAME.focus(); return false;
		}else if (document.getElementById("REGISTERED_BY") && (y[x].value==10)){
			alert("Please enter the groom's name"); registrationform.NAME.focus(); return false;
		}else if(document.getElementById("REGISTERED_BY") && ( y[x].value==11)){
			alert("Please enter the bride's name");registrationform.NAME.focus(); return false;
		}else{
			alert("Please enter the name");registrationform.NAME.focus(); return false;
		}
	}

	if ( !registrationform.GENDER[0].checked && !registrationform.GENDER[1].checked) {alert( "Please select gender" );registrationform.GENDER[0].focus( );	return false;}

	if(registrationform.DOBMONTH.value == "0" && registrationform.DOBDAY.value == "0" && registrationform.DOBYEAR.value == "0"){
		if (document.getElementById("REGISTERED_BY")){
			alert("Please select the date of birth of the prospect");
			registrationform.DOBDAY.focus(); return false;
		}
		/*else{
			alert("Please enter the age or select the date of birth of the prospect");
			registrationform.AGE.value=""; registrationform.AGE.focus(); return false;
		}*/
	}

	if(document.getElementById("DOBDAY").value!=0 && document.getElementById("DOBMONTH").value!=0 && document.getElementById("DOBYEAR").value!=0){
		//var agediff = calculate_age($("DOBYEAR").value,$("DOBMONTH").value,$("DOBDAY").value);
		var agediff = calculate_age(document.getElementById("DOBYEAR").value,document.getElementById("DOBMONTH").value,document.getElementById("DOBDAY").value);
		if (agediff!=document.getElementById("AGE").value){
			alert("The age value does not match with the date-of-birth. Please select the correct date-of-birth.");
			document.getElementById("DOBDAY").focus(); 
			return false;
		}
	}	

	//var isdob = 1;

	if(registrationform.DOBYEAR.value=="0" || registrationform.DOBMONTH.value=="0" || registrationform.DOBDAY.value=="0"){
		if (document.getElementById("REGISTERED_BY")){
			document.getElementById("AGE").value="";
			if (registrationform.DOBDAY.value == "0"){alert("Please select date");registrationform.DOBDAY.focus(); return false;}
			if (registrationform.DOBMONTH.value == "0"){alert("Please select month");registrationform.DOBMONTH.focus(); return false;}
			if (registrationform.DOBYEAR.value=="0"){alert("Please select year"); registrationform.DOBYEAR.focus(); return false;}
		}
		//isdob = 0;
	}	

	/*if((registrationform.DOBDAY.value=="0" || registrationform.DOBMONTH.value=="0" || registrationform.DOBYEAR.value=="0") && isdob==1 && registrationform.AGE.value>0){
		if (registrationform.DOBDAY.value == "0"){alert("Please select date");registrationform.DOBDAY.focus(); return false;}
		if (registrationform.DOBMONTH.value == "0"){alert("Please select month");registrationform.DOBMONTH.focus(); return false;}
		if (registrationform.DOBYEAR.value=="0"){alert("Please select year"); registrationform.DOBYEAR.focus(); return false;}
		return false;
	}*/
	
	if((registrationform.AGE.value == "Age")||(registrationform.AGE.value == "Ag") ||(registrationform.AGE.value == "")){ 
	agesel();
	//if (registrationform.DOBDAY.value == "0"){alert("Please select date");registrationform.DOBDAY.focus(); return false;}
	//if (registrationform.DOBMONTH.value == "0"){alert("Please select month");registrationform.DOBMONTH.focus(); return false;}
	//if (registrationform.DOBYEAR.value=="0"){alert("Please select year"); registrationform.DOBYEAR.focus(); return false;}
	}
	
	var age = parseInt(registrationform.AGE.value);
	var calyear = displayage(registrationform.DOBYEAR.value,registrationform.DOBMONTH.value,registrationform.DOBDAY.value, 'years', 0, 'rounddown')
	
	if ((age<21) && (registrationform.GENDER[0].checked) && (registrationform.AGE.value!="Age")) {alert("Prospect should be 21 years to register");registrationform.DOBDAY.focus();return false;}
	if ((registrationform.AGE.value=="Age") && (calyear < 21) && (registrationform.GENDER[0].checked)) {alert("Prospect should be 21 years to register");registrationform.DOBDAY.focus();return false;}
	if (age < 18 && registrationform.GENDER[1].checked && (registrationform.AGE.value!="Age")) {alert("Prospect should be 18 years to register");registrationform.DOBDAY.focus();return false;}
	if (age=="Age" && calyear < 18 && registrationform.GENDER[1].checked) {alert("Prospect Should be 18 years to Register");registrationform.DOBDAY.focus();return false;}
	if ( age > 70 && calyear > 70) {alert("Maximum age allowed is 70");registrationform.AGE.focus( );return false;}	

	/*if ( !registrationform.GENDER[0].checked && !registrationform.GENDER[1].checked) {alert( "Please select gender" );registrationform.GENDER[0].focus( );	return false;}*/
	if ( registrationform.GENDER[0].checked && registrationform.AGE.value != "" && registrationform.AGE.value < 21) {alert( "You must be atleast 21 yrs old to register" );registrationform.DOBDAY.focus( );return false;}	
	
	if ( registrationform.RELIGION.selectedIndex == 0 ) {alert( "Please select religion" );registrationform.RELIGION.focus( );return false;}
	if (registrationform.MOTHERTONGUE.value == '0') {alert ('Please select mother tongue');registrationform.MOTHERTONGUE.focus();return false;}		
	if ( registrationform.TEMP_CASTE_NORMAL.value == 'Select / Type your Caste' || registrationform.TEMP_CASTE_NORMAL.value == '' ) {
			alert( "Please select / Type Caste" );registrationform.TEMP_CASTE_NORMAL.focus( );return false;
		}
	if ((registrationform.CASTE_NORMAL.value == 'casteselect0')||(registrationform.CASTE_NORMAL.value == '00')) {alert ('Please select caste');registrationform.CASTE_NORMAL.focus();return false;}
	
	/*if (registrationform.TEMP_CASTE_NORMAL.value == ''){
		alert ('Please select caste'); registrationform.TEMP_CASTE_NORMAL.focus(); registrationform.TEMP_CASTE_NORMAL.value = ''; return false;
	}*/

	if (registrationform.COUNTRY.value == '0') {alert ('Please select country');registrationform.COUNTRY.focus();return false;}	
	if(registrationform.MOBILENO.value=="Mobile Number") {
		alert('Please enter mobile number');registrationform.MOBILENO.focus(); return false;
	}	
	
	if ((registrationform.MOBILENO.value!="Mobile Number")|| (registrationform.PHONENO.value!="Landline Number"))
	{
		if (registrationform.MOBILENO.value!="Mobile Number")
		{			
			var Mcncode = registrationform.M_COUNTRYCODE.value;

			var val = registrationform.MOBILENO.value;
			val = val.replace(/-|\+|\s/g, '');
			val = val.replace(/^0{1,}/,"");
			if( !ValidateNo( val, "0123456789" ) ) {alert("Please enter valid mobile number");registrationform.MOBILENO.focus();return false;}
			if(Mcncode == 98) {	// for india
				if(val.match(/^([0-9])\1*$/)!=null){
					alert("Please enter a valid mobile number.");
					registrationform.MOBILENO.focus();
					return false;
				}
				else if(val.match(/^.*?([7-9]{1})([0-9]{9})$/)==null){
					alert("Please enter a valid mobile number.");
					registrationform.MOBILENO.focus();
					return false;
				}
				registrationform.EMAIL.focus();
			}
			else if(Mcncode == 39 || Mcncode == 222) {	// for US and canada
				if(val.substr(0,1)=='1'){ 
					val = val.substr(1);
				}
				if(val.length>=10 && val.length<=12 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}	
			else if(Mcncode == 220) {	// for UAE
				if(val.substr(0,3)=='971'){ 
					val = val.substr(2);
				}
				if(val.length>=9 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}
			else if(Mcncode == 13) {	// for Australia
				if(val.substr(0,2)=='61'){ 
					val = val.replace(/^61/,"");
				}
				if(val.length>=9 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}	
			else if(Mcncode == 189) {	// for singapore 				
				if(val.substr(0,2)== '65'){
					val = val.replace(/^65/,"");
				}
				if(val.length>=8 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}
			else if(Mcncode == 129) {	// for Malaysia
				if(val.substr(0,2)=='60'){ 
					val = val.replace(/^60/,"");
				}
				if(val.length>=9 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}
			else if(Mcncode == 221) {	// for UK 
				if(val.substr(0,2)=='44'){ 
					val = val.replace(/^44/,"");
				}
				if(val.length>=8 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}
			else {	
				if(val.length>=8 && val > 0){
					registrationform.EMAIL.focus();
				}
				else{
					alert("Please enter a valid mobile number.");return false;
				}
			}
		}

		if (registrationform.MOBILENO.value=="" || registrationform.MOBILENO.value=="Mobile Number" )
		{
			if (registrationform.PHONENO.value!="Landline Number")
			{
				if ((registrationform.AREACODE.value=="Area Code")&&(registrationform.AREACODE.value=="STD Code")) { alert("Please enter valid Area/STD code");registrationform.AREACODE.focus();return false; }
				if( !ValidateNo( registrationform.AREACODE.value, "0123456789" ) ) {alert("Please enter valid Area/STD code");registrationform.AREACODE.focus();return false;}
				if (IsEmpty(registrationform.PHONENO,'text')) { alert ('Please enter valid landline number');registrationform.PHONENO.focus();return false; }
				if( !ValidateNo( registrationform.PHONENO.value, "0123456789" ) ) {alert("Please enter valid landline number");registrationform.PHONENO.focus();return false;}
			
				if( ValidateNo( registrationform.PHONENO.value, "0123456789" ) ) 
				{				
					var totlen;
					var stdcode = registrationform.AREACODE.value;

					if(registrationform.COUNTRY.value == 222 || registrationform.COUNTRY.value == 39) {	//us and canada
						var phonereg = new RegExp('^[0-9]+$');				
						stdcode = stdcode.replace(/-|\+|\s/g, '');
						if(stdcode.substr(0,1)=='0' || stdcode.substr(0,1)==0) { var areacode = stdcode.substring(1); } else { var areacode = stdcode; }
						totlen = areacode.length + registrationform.PHONENO.value.length;
						if (totlen!=10) { alert("Please enter valid area code/phone number.");registrationform.AREACODE.focus();return false; }
					}
					else if(registrationform.COUNTRY.value == 98) 
					{	//india
						var indiareg = new RegExp('^[0-9]+$');
						if(stdcode.substr(0,1)=='0' || stdcode.substr(0,1)==0) { var areacode = stdcode.substring(1); } else { var areacode = stdcode; }
						totlen = areacode.length + registrationform.PHONENO.value.length;
						if (totlen!=10) { alert("Please enter valid STD code/phone number.");registrationform.AREACODE.focus();return false; }
					}
					else if (registrationform.COUNTRY.value==220) 
					{ //uae
						if (registrationform.PHONENO.value.length<7) {alert("Please enter valid landline number");registrationform.PHONENO.focus();return false;}
					}
					else if (registrationform.COUNTRY.value==13 || registrationform.COUNTRY.value==189) 
					{ //Aus and singapore
						if (registrationform.PHONENO.value.length<8) {alert("Please enter valid landline number");registrationform.PHONENO.focus();return false;}				
					}else{
						if (registrationform.PHONENO.value.length<6) {alert("Please enter valid landline number");registrationform.PHONENO.focus();return false;}
					}
				}
			}
		}
	}


	var rege = new RegExp(/^([0-9]){6,20}$/);
	if ((registrationform.EMAIL.value == 'E-mail')||(registrationform.EMAIL.value == '')) {alert ('Please enter a valid E-mail ID');registrationform.EMAIL.focus();return false;}
	if (ValidateEmail(registrationform.EMAIL.value) == false) {alert ('Please enter a valid E-mail ID');registrationform.EMAIL.focus();return false;}
	if (registrationform.PASSWD1.value == 'Password' || registrationform.PASSWD1.value == '') {alert ('Please enter password');registrationform.PASSWD1.focus();return false;}
	if ( registrationform.PASSWD1.value.length < 6 ){alert("Password must have a minimum of 6 characters");	registrationform.PASSWD1.focus(); return false;}
	var pwd1=registrationform.PASSWD1.value;
	pwd1=pwd1.toUpperCase();
	var una=registrationform.NAME.value;
	una=una.toUpperCase();
	if (pwd1 == una) {alert("The name and password cannot be the same. Please change the password");registrationform.PASSWD1.focus( );return false;}
	if(rege.test(pwd1)) {alert("Sorry, your password has been rejected.It is recommended that you submit a password with alphanumeric characters.");registrationform.PASSWD1.focus( );return false;}
	tmpPass = registrationform.PASSWD1.value;
	goodPasswd = 1;
	for( var idx=0; idx< tmpPass.length; idx++ ) {
		ch = tmpPass.charAt(idx);
		if( !((ch>='a') && (ch<='z')) && !((ch>='A') && (ch<='Z')) && !((ch>=0) && (ch <=9)) || (ch==' ') ) { goodPasswd = 0;break; }
	}
	if ( goodPasswd ==0 ) {alert("Spaces or special characters are not allowed in the password");registrationform.PASSWD1.focus( );return false;}	

	if (registrationform.AGE.value=="Age") { registrationform.AGE.value=""; }
	
	if (registrationform.MOBILENO.value=="Mobile Number") { registrationform.MOBILENO.value=""; }

	var didval=MOTHERTONGUE_DOMAIN_MAPPING[registrationform.MOTHERTONGUE.value];
	var dstartval = IDSTARTLETTERHASH[didval];
	var dnames=d_return(didval);
	var dnames=dnames.toLowerCase();
						
	if(DOMAINARRAY['domainnameshort'] == "bharat" && dstartval != ""){
		if(dstartval == undefined) { dstartval = "bm"; }
		var regaction="http://profile."+dnames+"matrimony.com/register/campaignregistration.php?rgfm=hbm&lpt="+dstartval;
	}else{
		var regaction="http://profile."+dnames+"matrimony.com/register/campaignregistration.php";
	}
	registrationform.action=regaction;
	registrationform.submit();
}
/* registrationform Validate */

function onTtip(cnyVal){
	if(cnyVal != 98 || cnyVal == 'undefined'){
		document.getElementById("tooltipCNY").style.display = "block"; 
		registrationform.MOBILENO.value = "";
		registrationform.MOBILENO.focus();
	}
	else if (cnyVal == 98){
		document.getElementById("tooltipCNY").style.display = "none"; 
		registrationform.MOBILENO.setAttribute("onFocus","");
		registrationform.MOBILENO.value = "";
		registrationform.MOBILENO.focus();
	}
}

function offTtip(){
	document.getElementById("tooltipCNY").style.display = "none"; 
	registrationform.MOBILENO.setAttribute("onFocus","if(this.value=='Mobile Number') {this.value='';}");
}


var religion_count=0;

function religion_resetRF() {
	document.registrationform.MOTHERTONGUE.value="0";
	if(religion_count==0)
	{
	autoComreg2();
	}
	religion_count++;

}

function autoComreg2(){
	loadexternalfile("http://"+DOMAINARRAY['domainnameimgs']+"/scripts/home-caste-autocomplete.js", "js");
	loadexternalfile("http://"+DOMAINARRAY['domainnameimgs']+"/scripts/jquery.autocomplete.min.js", "js");
	loadexternalfile("http://"+DOMAINARRAY['domainnameimgs']+"/bmstyles/jquery.autocomplete.css", "css");
	
}

var count=0;
function loadexternaljs(){

	if(count==0)
	{
	loadexternalfile("http://"+DOMAINARRAY['domainnameimgs']+"/scripts/jquery.js", "js")
	}
	count++;
}

function loadexternalfile(filename, filetype){
 if (filetype=="js"){
  var fileref=document.createElement('script')
  fileref.setAttribute("type","text/javascript")
  fileref.setAttribute("src", filename)
 }
 else if (filetype=="css"){
  var fileref=document.createElement("link")
  fileref.setAttribute("rel", "stylesheet")
  fileref.setAttribute("type", "text/css")
  fileref.setAttribute("href", filename)
 }
 if (typeof fileref!="undefined")
  document.getElementsByTagName("head")[0].appendChild(fileref)
}

/* Age Validate { */
function ageclk() { document.getElementById("DOBDAY").value="0";document.getElementById("DOBMONTH").value="0";document.getElementById("DOBYEAR").value="0"; }


function chkage(){
	if(document.getElementById("DOBDAY").value!=0 && document.getElementById("DOBMONTH").value!=0 && document.getElementById("DOBYEAR").value!=0 ){
		var agediff = calculate_age(document.getElementById("DOBYEAR").value,document.getElementById("DOBMONTH").value,document.getElementById("DOBDAY").value);
		if (agediff!=document.getElementById("AGE").value){
			alert("The age value does not match with the date-of-birth. Please enter the correct date-of-birth.");
			 return false;
		}
	}
}

function chkage1(){
	if(document.getElementById("DOBDAY").value!=0 && document.getElementById("DOBMONTH").value!=0 && document.getElementById("DOBYEAR").value!=0 ){
		var agediff = calculate_age(document.getElementById("DOBYEAR").value,document.getElementById("DOBMONTH").value,document.getElementById("DOBDAY").value);
		if (agediff!=document.getElementById("AGE").value){
			return false;
		}
	}
}

function agechk() {
	gen_val = "0";
	if($('gendermale').checked) { gen_val = "M"; }
	if($('genderfemale').checked) {	gen_val = "F"; }
	if($("DOBDAY").value!=0 && $("DOBMONTH").value!=0 && $("DOBYEAR").value!=0) {
		if(dob_cal()==true) {
			var calyear = displayage($("DOBYEAR").value,$("DOBMONTH").value,$("DOBDAY").value, 'years', 0, 'rounddown');
			if(gen_val=="M") {
				if(calyear < 21){alert("Sorry! The person needs to be 21 or above to register here.");return false;$("DOBDAY").focus();}
				else if(calyear > 70){alert("Maximum age allowed is 70.");return false;$("DOBDAY").focus();}
				else{alert("");return true;}
			}
			if(gen_val=="F") {
				if(calyear < 18){alert("Sorry! The person needs to be 18 or above to register here.");return false;$("DOBDAY").focus();}
				else if(calyear > 70){alert("Maximum age allowed is 70.");return false;$("DOBDAY").focus();}
			}
		}
	}
	if(!IsEmpty($("AGE"),'text')) {
		$("DOBDAY").value="0";$("DOBMONTH").value="0";$("DOBYEAR").value="0";
		if (!ValidateNo($("AGE").value, "0123456789")) {alert("Please select a valid age");$("DOBDAY").focus();return false;}
		var calyear=$("AGE").value;
		if(gen_val=="M") {
			if(calyear < 21){alert("Sorry! The person needs to be 21 or above to register here.");return false;$("DOBDAY").focus();}
			else if(calyear > 70){alert("Maximum age allowed is 70.");return false;$("DOBDAY").focus();}
		}
		if(gen_val=="F") {
			if(calyear < 18){alert("Sorry! The person needs to be 18 or above to register here.");return false;$("DOBDAY").focus();}
			else if(calyear > 70){alert("Maximum age allowed is 70.");return false;$("DOBDAY").focus();}
		}
	}
}

function dob_cal() {
	if(($("DOBDAY").value!=0)&&($("DOBMONTH").value!=0) &&($("DOBYEAR").value!=0)) {
		var mchk=($("DOBMONTH").value%2), ychk=($("DOBYEAR").value%4);
		if($("DOBMONTH").value==2) {
			if($("DOBDAY").value>=30) {alert("Please select correct date. This month doesn't have 30 or 31");return false;}
			else if($("DOBDAY").value==29) { if(ychk!=0){alert("This is not a leap year. Please select the correct date");return false;} }
		}
		else if(($("DOBMONTH").value<=7)&&(mchk==0)) { if($("DOBDAY").value==31) {alert("Please select correct date. This month doesn't have 31");return false;} }
		else if(($("DOBMONTH").value>=8)&&(mchk==1)) { if($("DOBDAY").value==31) {alert("Please select correct date. This month doesn't have 31");return false;} }
	}
}
/* Age Validate } */

function dateload(){
	var datevar = new Date();
	var curr_year = datevar.getFullYear();
	var i;
	var dobyr = new Array();
	dobyr[1]="Jan";dobyr[2]="Feb";dobyr[3]="Mar";dobyr[4]="Apr";dobyr[5]="May";dobyr[6]="Jun";dobyr[7]="July";dobyr[8]="Aug";dobyr[9]="Sep";dobyr[10]="Oct";dobyr[11]="Nov";dobyr[12]="Dec";
	for (i=1; i<=31; i++) {
		var objOption = document.createElement("option");
		objOption.text = i; objOption.value = i;
		if(document.all && !window.opera) {document.registrationform.DOBDAY.add(objOption);} else {document.registrationform.DOBDAY.add(objOption, null);}
	}
	for (i=1; i<=12; i++) {
		var objOption = document.createElement("option");
		objOption.text = dobyr[i]; objOption.value = i;
		if(document.all && !window.opera) {document.registrationform.DOBMONTH.add(objOption);} else {document.registrationform.DOBMONTH.add(objOption, null);}
	}
	for (i=(curr_year-18); i>=(curr_year-70); i--) {
		var objOption = document.createElement("option");
		objOption.text = i; objOption.value = i;
		if(document.all && !window.opera) {document.registrationform.DOBYEAR.add(objOption);} else {document.registrationform.DOBYEAR.add(objOption, null);}
	}
}

function calchk(){
	var registrationform = this.document.registrationform;
	if((registrationform.DOBDAY.value!=0)&&(registrationform.DOBMONTH.value!=0)){
		var mchk=(registrationform.DOBMONTH.value%2);
		var ychk=(registrationform.DOBYEAR.value%4);			

		if(registrationform.DOBMONTH.value==2)
		{
			if(registrationform.DOBDAY.value>=30){
				alert("Please select correct date. This month doesn't have 30 or 31");
				registrationform.DOBDAY.value=0; registrationform.DOBDAY.focus();
				return false;
			}
			if(registrationform.DOBDAY.value==29){
				if(ychk!=0){
					alert("This is not a leap year. Please select the correct date");
					registrationform.DOBDAY.value=0; registrationform.DOBDAY.focus();
					return false;
				}
			}
		}
		if(((registrationform.DOBMONTH.value<=7)&&(mchk==0))||((registrationform.DOBMONTH.value>=8)&&(mchk==1))){ 	
			if(registrationform.DOBDAY.value==31){
				alert("Please select correct date. This month doesn't have 31");
				registrationform.DOBDAY.value=0; registrationform.DOBDAY.focus();
				return false;
			}				
		}				
	}
}
/* register form  } */

function calculate_age(dobyear,dobmonth,dobday){	
	var diff = '';
	if(dobyear!=0 && dobmonth!=0 && dobday!=0){
		var dateArrVal = new Array();
		dateArrVal = getTodayDate();
		var today = new Date(dateArrVal['year'],dateArrVal['month']-1,dateArrVal['date']);
		var dob = new Date(dobyear,dobmonth-1,dobday);
		var one_year = 1000*60*60*24*365.25;
		diff = today-dob;	
		diff = Math.floor(diff/one_year);
	}
	return diff;	
}

function updateDay(change,formName,yearName,monthName,dayName){
  var form = document.forms[formName];
  var yearSelect = form[yearName];
  var monthSelect = form[monthName];
  var daySelect = form[dayName];
  var year = yearSelect[yearSelect.selectedIndex].value;
  var month = monthSelect[monthSelect.selectedIndex].value;
  var day = daySelect[daySelect.selectedIndex].value;
  if(month>0){
     if(change == 'month' || (change == 'year' && month == 2)){
      var i=31;
      var flag = true;
      while(flag){
       var date = new Date(year,month-1,i);
       if(date.getMonth() == month - 1){
        flag = false;
       }else{
        i=i-1;
       }
      }
      daySelect.length = 0;
      daySelect.length = i;
      var j=1;
	  daySelect[0] = new Option('DD',0);
      while(j <= i){			 
       daySelect[j] = new Option(j,j);		  
       j=j+1;
      }
	  if(day>=i){
		  daySelect.selectedIndex = i;
	  }else if(day > 0 && day<i){
		  daySelect.selectedIndex = day;
	  }else{
		  daySelect.selectedIndex = 0;
	  }
     }
  }
}

function getTodayDate()
{
	var d = new Date();
	var dateArr = new Array();
    dateArr['date'] = d.getDate();
    dateArr['month'] = d.getMonth()+1; //Months are zero based
    dateArr['year'] = d.getFullYear();
	return dateArr;
}



function agesel() { //$("AGE").value="Age"; 
	
	if(document.getElementById("DOBDAY").value!=0 && document.getElementById("DOBMONTH").value!=0 && document.getElementById("DOBYEAR").value!=0){
		//var agediff = calculate_age($("DOBYEAR").value,$("DOBMONTH").value,$("DOBDAY").value);
		var agediff = calculate_age(document.getElementById("DOBYEAR").value,document.getElementById("DOBMONTH").value,document.getElementById("DOBDAY").value);
		document.getElementById("AGE").value = agediff;
		//alert(agediff)
	
	}
}



function loadDOByear()
{
	var currSelYear = document.getElementById("DOBYEAR").value;
	var registrationform = this.document.registrationform;
	pc_val=registrationform.REGISTERED_BY.value;

	if(registrationform.GENDER[0].checked==true){gen_val="M";}
	if(registrationform.GENDER[1].checked==true){gen_val="F";}
	
	var currDate = new Date();
	var currYear = currDate.getFullYear(); 
	var endYear = currYear - 70;
	if(gen_val=="M")
	{
		var startYear = currYear - 21;
	} else {
		var startYear = currYear - 18;
	}


	var newOption = document.getElementById("DOBYEAR").options.length = 0;
	var option = document.createElement("option");
	option.innerHTML = "YYYY";
	option.value = "0";
	var select = document.getElementById("DOBYEAR");
	select.appendChild(option);

	for (var i=startYear;i>=endYear;i--){ 
		option = document.createElement("option");
		option.innerHTML = startYear;
		option.value = i;
		select = document.getElementById("DOBYEAR");
		select.appendChild(option);
		startYear--;
	}

	if(currSelYear != "0") {
		document.getElementById("DOBYEAR").value=currSelYear;
	}

}

function resetForms() {
	document.getElementById("RELIGION").options.selectedIndex=0;
	document.getElementById("MOTHERTONGUE").options.selectedIndex=0;
}

