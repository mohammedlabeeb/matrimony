
var agelimit_arr_bride = new Array('18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55');

var agelimit_arr_groom = new Array('21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55');


var religionarr = new Array('Hindu', 'Sikh', 'Christian', 'Muslim', 'Jain', 'Buddhist', 'Atheist', 'Bahai', 'Jew', 'Other Religion');

var religionarr_value = new Array('100001', '100002', '100003', '100004', '100005', '100006', '100007', '100008', '100009', '100011');

var mothertongue = new Array('Arabic', 'Assamese', 'Bengali', 'Bhojpuri', 'Bodo', 'Dogri', 'English', 'French', 'Garhwali', 'German', 'Gujarati', 'Himachali', 'Haryanvi', 'Hindi', 'Kannada', 'Kashmiri', 'Konkani', 'Kumaoni', 'Malayalam', 'Maithili', 'Manipuri', 'Marathi', 'Nepali', 'Oriya', 'Parsi', 'Portugese', 'Punjabi', 'Rajasthani', 'Romanian', 'Russian', 'Sindhi', 'Sinhala', 'Spanish', 'Tamil', 'Telugu', 'Urdu', 'Others');

var mothertongue_value = new Array('11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47');

//it is showing cast according to religion.Jashvindra

function dynshowHint(str,sitename,geturl,element_name,images_basepath) {

    $('#'+element_name).html('<img src="'+images_basepath+'/loading.gif" alt="Loading ...">');
    var url=sitename+geturl;
    url=url+"&q="+str;
    url=url+"&sid="+Math.random();
    $.ajax({
    type: "POST",
    url: url,
    success: function(cast){
        //alert(cast);
        
        var split_result = cast.split('||');
        
        if(split_result[0]=='display_city') {
	        
	        //alert(split_result[1]);
	        
	        $('#'+element_name).html(split_result[1]);
        }
        else {
        
			$('#'+element_name).html('<select class="w" name="caste_code" id="caste_code">'+cast+'</select>');
  	 	}
       
        }
    });
}

function dynshowHintSearch(str,sitename,geturl,element_name,images_basepath) {

	$('#'+element_name).html('<img src="'+images_basepath+'/loading.gif" alt="Loading ...">');
	
	var url=sitename+geturl;
	
	url=url+"&q="+str;    
	
	var selValues='';
	
	var selO='';
	
	var selO = document.getElementById("religion_code_id");
 
    for(i=0; i < selO.length ; i++){
	    
        if(selO.options[i].selected==true){
	        
           selValues =selValues + selO.options[i].value+',';
           
        }
    }
     
   url = url + "&selected_ids="+selValues;    
	
	url = url + "&sid="+Math.random();       
   
	//alert(url);
	
	$.ajax({
		
	    type: "POST",
	    url: url,
	    success: function(cast){
	        
	      $('#'+element_name).html(cast);   	   
	     // $('#'+element_name).trigger("liszt:updated"); 
	      $('#caste_code_div').trigger("liszt:updated"); 
	      
        }
    });
}

function addOption_list_caste_code() {

	for(i=document.frmsmartsearch.temp_caste_code.options.length-1;i>=0;i--) {

		var temp_caste_code = document.frmsmartsearch.temp_caste_code;

		if(document.frmsmartsearch.temp_caste_code[i].selected) {

			addOption_caste_code(document.frmsmartsearch.temp_caste_code1, document.frmsmartsearch.temp_caste_code[i].text, document.frmsmartsearch.temp_caste_code[i].value);

			//removeOption(outboundtour,i);
		}
	}
}

function addOption_caste_code(selectbox,text,value ) {

	if((document.getElementById("caste_code").value).indexOf(value)=="-1") {

		var optn = document.createElement("OPTION");

		optn.text = text;
		optn.value = value;
		selectbox.options.add(optn);
		document.getElementById("caste_code").value = value + '^' + document.getElementById("caste_code").value;
	}
}

function remove_list_caste_code()
{
	for(i=document.frmsmartsearch.temp_caste_code1.options.length-1;i>=0;i--) {

		var temp_caste_code1 = document.frmsmartsearch.temp_caste_code1;

		if(document.frmsmartsearch.temp_caste_code1[i].selected) {
			var str = document.getElementById("caste_code").value
			document.getElementById("caste_code").value = str.replace(document.frmsmartsearch.temp_caste_code1[i].value + '^', "");
			temp_caste_code1.remove(i);
		}
	}
}


function addSelectOptions(selectName,optionText,optionValue, selcode) {

	var createdOption = document.createElement("option");
	
	createdOption.text = optionText;

	createdOption.value = optionValue;

	if(optionValue==selcode) {

		createdOption.selected='selected';
	}

	selectName.options.add(createdOption);
}

function agelimit(genderType, age1_selected, age2_selected) {
	
	document.forms.topsearch.age1.length = 0;
	
	document.forms.topsearch.age2.length = 0;
	
	if(typeof(age2_selected)==='undefined') age2_selected = '35';
	
	if (genderType=='F') {
		
		if(typeof(age1_selected)==='undefined') age1_selected = 18;
		
		for (var i=0; i < agelimit_arr_bride.length;++i) {
	
			Array.prototype.in_array = function(p_val) {
	
				for(var i = 0, l = this.length; i < l; i++) {
	
					if(this[i] == p_val) {
	
						return true;
					}
				}
				return false;
			}
	
			addSelectOptions(document.forms.topsearch.age1, agelimit_arr_bride[i], agelimit_arr_bride[i], age1_selected);
			addSelectOptions(document.forms.topsearch.age2, agelimit_arr_bride[i], agelimit_arr_bride[i], age2_selected);
		}
	}
	
	else {
		
		if(typeof(age1_selected)==='undefined') age1_selected = 21;
		
		for (var i=0; i < agelimit_arr_groom.length;++i) {
	
			Array.prototype.in_array = function(p_val) {
	
				for(var i = 0, l = this.length; i < l; i++) {
	
					if(this[i] == p_val) {
	
						return true;
					}
				}
				return false;
			}
	
			addSelectOptions(document.forms.topsearch.age1, agelimit_arr_groom[i], agelimit_arr_groom[i], age1_selected);
			addSelectOptions(document.forms.topsearch.age2, agelimit_arr_groom[i], agelimit_arr_groom[i], age2_selected);
		}
	}
}

function religionfunc() {

	for (var i=0; i < religionarr.length;++i) {

		Array.prototype.in_array = function(p_val) {

			for(var i = 0, l = this.length; i < l; i++) {

				if(this[i] == p_val) {

					return true;
				}
			}
			return false;
		}

		addSelectOptions(document.forms.topsearch.religion_code, religionarr[i], religionarr_value[i]);
	}
}



function mother_tongue() {

	for (var i=0; i < mothertongue.length;++i) {

		Array.prototype.in_array = function(p_val) {

			for(var i = 0, l = this.length; i < l; i++) {

				if(this[i] == p_val) {

					return true;
				}
			}
			return false;
		}

		addSelectOptions(document.forms.topsearch.mother_tongue_code, mothertongue[i], mothertongue_value[i], '');
	}
}

// <<<< Pop Up Open Win >>>>>
var pop='';
function openwin(nm,width,height) {

	var name=nm;
	var NewWIN1='';

		if (pop && !pop.closed) {
		pop.close();
    }
    pop=eval("window.open('"+name+"','NewWIN1','chrome[4],top=5,left=5,toolbar=no,width="+width+",height="+height+",directories=no,menubar=no,SCROLLBARS=yes')");
    if (!pop.opener) popUpWin.opener = self;
}


// This function is for when member searches the party and he not logged in or a guest member.somesh
function chk_login(chk2) {
   if (chk2.username.value.length == 0) {
      alert("E-mail ID can't be left blank");
      chk2.username.focus();
      return false;
   }
   if (chk2.username.value.indexOf('@') == -1) {
      alert("Error in Email ID");
      chk2.username.focus();
      return false;
   }
   if (chk2.username.value.indexOf('.') == -1) {
      alert("Error in Email ID");
      chk2.username.focus();
      return false;
   }
   if (chk2.username.value.indexOf('@') !=  chk2.username.value.lastIndexOf('@')) {
      alert("Please Specify One Email ID only");
      chk2.username.focus();
      return false;
   }

   if (chk2.pass_word.value.length==0) {
      alert("Enter Your Password ");
      chk2.pass_word.focus();
      return false;
   }
}