function notSelf(){
	
	if($('#postedby').attr('value')==''){
		$('#conperson').show('slow')
		return true
	}
	else if($('#postedby').attr('value')!='Self'){
		$('#conperson').show('slow')
		return true
	}
	else {
		$('#conperson').hide('slow')
		return false
	}
}

function checkInputs(id,len) {
	var objValue;
	objValue = $(id).attr("value").replace(/\s+$/,"");
	if (objValue.length==0 || objValue.length==null || objValue.length<len) {
		
		return true; 
	}
	
	else { 
		return false; 
	}
}

function validateObject(id,errorId,message,len) {
	
	if (checkInputs(id,len)){
		$(errorId).html(message);
		$(errorId).show('slow')
		return false;
	}
	else {
		$(errorId).hide('slow')
		return true;
	}
}

function validateGender() {
	var registerForm = this.document.registerForm;
	
	if (!registerForm.gender_type[0].checked && !registerForm.gender_type[1].checked) {
		$('#gender_type_error').html('Please select gender');
		$('#gender_type_error').show('slow')
		return false;
	} 
	else if (registerForm.gender_type[0].checked || registerForm.gender_type[1].checked) {
		$('#gender_type_error').hide('slow')
		return true;
	}
}

function validatePassword2(){
	if($(regArr['passwordData2'][0]).attr('value')!=$(regArr['passwordData'][0]).attr('value')) {
		$(regArr['passwordData2'][1]).html(regArr['passwordData2'][2]);
		$(regArr['passwordData2'][1]).show('slow')
		return false;
	}
	else {
		$(regArr['passwordData2'][1]).html('');
		$(regArr['passwordData2'][1]).hide('slow')
		return true
	}
}

function validatecaste(){
	
	if($(regArr['casteData'][0]).attr('value')!='') {
		
		$(regArr['casteData'][1]).html('');
		$(regArr['casteData'][1]).hide('slow')
		return true
	}
	else {
	
		$(regArr['casteData'][1]).html(regArr['casteData'][2]);
		$(regArr['casteData'][1]).show('slow')
		return false;	
	}
}

function validatePassword() {

	var registerForm = this.document.registerForm;
	
	var validate_password =/^([a-zA-Z0-9])+$/;
	
	if((!validate_password.test(registerForm.password.value)) || (registerForm.password.value.length)<6) {
		
		$('#password_error').html('Password should contain atleast 6 charcters with no special chracters');
		$('#password_error').show('slow')
		//registerForm.password.focus();
		return false;
	}	
}

function validateMobile() {

	var registerForm = this.document.registerForm;
	
	if((registerForm.country_code.value=="IN" && (registerForm.mobile_phone.value.length)<10) || (registerForm.mobile_phone.value)=='Mobile No.' ) {
		
		$('#mobile_phone_error').html('Mobile should contain atleast 10 charcter');
		$('#mobile_phone_error').show('slow')
		//registerForm.mobile_phone.focus();
		return false;
	}
	else if ((registerForm.mobile_phone.value.length)<5  || (registerForm.mobile_phone.value)=='Mobile No.' ) {
	
		$('#mobile_phone_error').html('Mobile should contain atleast 5 charcter');
		$('#mobile_phone_error').show('slow')
		//registerForm.mobile_phone.focus();
		return false;	
	}
	else {
	
		$('#mobile_phone_error').hide('slow');
		return true;	
	}
}

function validateTerms() {
	
	var registerForm = this.document.registerForm;
	
	if (!registerForm.terms.checked) {
		$('#terms_error').html('Please select terms & conditions');
		$('#terms_error').show('slow')
		return false;
	}
}


$(document).ready(function (){
	regArr=new Array()
	
	regArr['religionData']=['#religion_code','#religion_code_error','Please select your religion.']
	regArr['casteData']=['#caste_code','#caste_code_error','Please select your Caste.']
	regArr['postedBy']=['#postedby','#postedby_error','Please Select Posted By.']
	regArr['cpData']=['#contact_person','#contact_person_error','Please enter contact person name.']
	regArr['emailData']=['#email','#email_error','Please enter email ID']
	regArr['passwordData']=['#password','#password_error','Please enter password of atleast 6 characters.','6']
	regArr['passwordData2']=['#confirm_password','#confirm_password_error','Please Enter confirm password same as Password.']
	regArr['cnameData']=['#cname','#cname_error','Please enter name.']
	regArr['maritalData']=['#marital_status_code','#marital_status_code_error','Please select marital status.']
	regArr['mobileData']=['#mobile_phone','#mobile_phone_error','Please enter valid mobile number.','10']
	regArr['chatData']=['#chat_type','#chat_type_error','Please Select Chat Type.']
	regArr['chatData1']=['#skype_id']
	regArr['dobData1']=['#dob_date','#dob_error','Please select "DATE" of birth.']
	regArr['dobData2']=['#dob_month','#dob_error','Please select "MONTH" of birth.']
	regArr['dobData3']=['#dob_year','#dob_error','Please select "YEAR" of birth.']
	regArr['heightData']=['#mheight','#mheight_error','Please select your height.']
	regArr['family_statusData']=['#family_status','#family_status_error','Please select your Family status.']
	regArr['family_typeData']=['#family_type','#family_type_error','Please select your Family Type.']
	regArr['cultural_valueData']=['#cultural_value','#family_values_error','Please select your Cultural Value.']
	regArr['countryData']=['#country_code','#country_code_error','Please select your country.']
	regArr['profileCountryData']=['#profile_country_code','#profile_country_code_error','Please select your country.']	
	regArr['mothertongueData']=['#mother_tongue_code','#mother_tongue_code_error','Please select mother tongue.']
	regArr['occupationData']=['#occupation_code','#occupation_code_error','Please select occupation.']
	
	
	$(regArr['postedBy'][0]).blur(function(){validateObject(regArr['postedBy'][0],regArr['postedBy'][1],regArr['postedBy'][2],regArr['postedBy'][3]);})
	$(regArr['cpData'][0]).blur(function(){validateObject(regArr['cpData'][0],regArr['cpData'][1],regArr['cpData'][2],regArr['cpData'][3]);})
	$(regArr['usernameData'][0]).blur(function(){validateObject(regArr['usernameData'][0],regArr['usernameData'][1],regArr['usernameData'][2],regArr['usernameData'][3]);})
	$(regArr['passwordData'][0]).blur(function(){validateObject(regArr['passwordData'][0],regArr['passwordData'][1],regArr['passwordData'][2],regArr['passwordData'][3]);})
	
	
	$(regArr['passwordData2'][0]).blur(function(){
		validatePassword2()
	})
	
	$(regArr['passwordData'][0]).blur(function(){
		validatePassword()
	})
	
	$(regArr['cnameData'][0]).blur(function(){validateObject(regArr['cnameData'][0],regArr['cnameData'][1],regArr['cnameData'][2],regArr['cnameData'][3]);})
	
	$("input[name='gender_type']").bind( "blur", function(){validateGender();});
	
	$(regArr['maritalData'][0]).blur(function(){validateObject(regArr['maritalData'][0],regArr['maritalData'][1],regArr['maritalData'][2]);})
	
	$(regArr['mobileData'][0]).blur(function(){ validateMobile();})
	
	$(regArr['chatData'][0]).blur(function(){validateObject(regArr['chatData'][0],regArr['chatData'][1],regArr['chatData'][2]);})
	
	$(regArr['chatData1'][0]).blur(function(){validateObject(regArr['chatData1'][0]);})
	
	$(regArr['dobData1'][0]).blur(function(){validateObject(regArr['dobData1'][0],regArr['dobData1'][1],regArr['dobData1'][2]);})
	
	$(regArr['dobData2'][0]).blur(function(){validateObject(regArr['dobData2'][0],regArr['dobData2'][1],regArr['dobData2'][2]);})
	
	$(regArr['dobData3'][0]).blur(function(){validateObject(regArr['dobData3'][0],regArr['dobData3'][1],regArr['dobData3'][2]);})
	
	$(regArr['heightData'][0]).blur(function(){validateObject(regArr['heightData'][0],regArr['heightData'][1],regArr['heightData'][2]);})
	
	$(regArr['countryData'][0]).blur(function(){validateObject(regArr['countryData'][0],regArr['countryData'][1],regArr['countryData'][2]);})
	
	$(regArr['profileCountryData'][0]).blur(function(){validateObject(regArr['profileCountryData'][0],regArr['profileCountryData'][1],regArr['profileCountryData'][2]);})
	
	$(regArr['religionData'][0]).blur(function(){validateObject(regArr['religionData'][0],regArr['religionData'][1],regArr['religionData'][2]);})
	
	$(regArr['casteData'][0]).blur(function(){validateObject(regArr['casteData'][0],regArr['casteData'][1],regArr['casteData'][2]);})
	
	$(regArr['mothertongueData'][0]).blur(function(){validateObject(regArr['mothertongueData'][0],regArr['mothertongueData'][1],regArr['mothertongueData'][2]);})
	
	$(regArr['occupationData'][0]).blur(function(){validateObject(regArr['occupationData'][0],regArr['occupationData'][1],regArr['occupationData'][2]);})
	
	$("input[name='terms']").bind( "blur", function(){validateTerms();});
	
	$('#registerForm').submit(function(){
		
		if(validateObject((regArr['usernameData'][0]))==false){
			validateObject(regArr['usernameData'][0],regArr['usernameData'][1],regArr['usernameData'][2])
			$(regArr['usernameData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['passwordData'][0]))==false){
			validateObject(regArr['passwordData'][0],regArr['passwordData'][1],regArr['passwordData'][2])
			$(regArr['passwordData'][0]).focus();
			return false;
		}
		
		if(validatePassword()==false){
			
			validatePassword();
			return false;
		}
		
		if(validatePassword2()==false){
			validatePassword2();
			$(regArr['passwordData2'][0]).focus();
			return false;
		}
		
		if(validateMobile()==false){
			validateMobile();
			$(regArr['mobileData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['countryData'][0]))==false){
			validateObject(regArr['countryData'][0],regArr['countryData'][1],regArr['countryData'][2])
			$(regArr['countryData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['profileCountryData'][0]))==false){
			validateObject(regArr['profileCountryData'][0],regArr['profileCountryData'][1],regArr['profileCountryData'][2])
			$(regArr['profileCountryData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['chatData1'][0]))==true && validateObject((regArr['chatData'][0]))==false){
			validateObject(regArr['chatData'][0],regArr['chatData'][1],regArr['chatData'][2])
			$(regArr['chatData'][0]).focus();
			return false;
		}
		
		/*
		if(validateObject((regArr['mobileData'][0]))==false){
			validateObject(regArr['mobileData'][0],regArr['mobileData'][1],regArr['mobileData'][2], regArr['mobileData'][3])
			$(regArr['mobileData'][0]).focus();
			return false;
		}
		*/
		if(validateObject((regArr['postedBy'][0]))==false){
			validateObject(regArr['postedBy'][0],regArr['postedBy'][1],regArr['postedBy'][2])
			$(regArr['postedBy'][0]).focus();
			return false;
		}
			
		if(notSelf()==true) {
			
			if(validateObject((regArr['cpData'][0]))==false){
				validateObject(regArr['cpData'][0],regArr['cpData'][1],regArr['cpData'][2])
				$(regArr['cpData'][0]).focus();
				return false;
			}
		}
		
		if(validateObject((regArr['cnameData'][0]))==false){
			validateObject(regArr['cnameData'][0],regArr['cnameData'][1],regArr['cnameData'][2])
			$(regArr['cnameData'][0]).focus();
			return false;
		}
		
		if(validateGender()==false){$("input[name='gender_type']")[0].focus(); return false; }
		
		if(validateObject((regArr['maritalData'][0]))==false){
			validateObject(regArr['maritalData'][0],regArr['maritalData'][1],regArr['maritalData'][2])
			$(regArr['maritalData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['dobData1'][0]))==false){
			validateObject(regArr['dobData1'][0],regArr['dobData1'][1],regArr['dobData1'][2])
			$(regArr['dobData1'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['dobData2'][0]))==false){
			validateObject(regArr['dobData2'][0],regArr['dobData2'][1],regArr['dobData2'][2])
			$(regArr['dobData2'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['dobData3'][0]))==false){
			validateObject(regArr['dobData3'][0],regArr['dobData3'][1],regArr['dobData3'][2])
			$(regArr['dobData3'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['religionData'][0]))==false){
			validateObject(regArr['religionData'][0],regArr['religionData'][1],regArr['religionData'][2])
			$(regArr['religionData'][0]).focus();
			return false;
		}
		
		if(validatecaste()==false){
			validatecaste();
			return false;
		}
		
		/*
		if(validateObject((regArr['casteData'][0]))==false){
			validateObject(regArr['casteData'][0],regArr['casteData'][1],regArr['casteData'][2])
			$(regArr['casteData'][0]).focus();
			return false;
		}
		*/
		
		if(validateObject((regArr['mothertongueData'][0]))==false){
			validateObject(regArr['mothertongueData'][0],regArr['mothertongueData'][1],regArr['mothertongueData'][2])
			$(regArr['mothertongueData'][0]).focus();
			return false;
		}
		
		if(validateObject((regArr['heightData'][0]))==false){
			validateObject(regArr['heightData'][0],regArr['heightData'][1],regArr['heightData'][2])
			$(regArr['heightData'][0]).focus();
			return false;
		}
		
		if(validateTerms()==false){$("input[name='terms']")[0].focus(); return false; }
		
	});
})



function event_on_focus(fld_id,val){
		
	if(document.getElementById(fld_id).value==val){
	
		document.getElementById(fld_id).value='';	
		
	}
	
}


function event_on_blur(fld_id,val){
	
	if(document.getElementById(fld_id).value==''){
	
		document.getElementById(fld_id).value=val;	
		
	}
	
}	 