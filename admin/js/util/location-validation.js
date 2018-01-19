	function countryList(data){
	    $.each(data,function(index,val){
		 
		  $('#country_id').append($('<option>', { 
		      value: val.country_id,
		      text : val.country_name 
		  }));
		  
	      });
	    
	}
	function stateList(data){
	    $('#state_id').empty();
	    $('#state_id').append($('<option>', { 
				      value: "",
				      text : "Select State" 
				  }));	      
	    $.each(data,function(index,val){
				  $('#state_id').append($('<option>', { 
				      value: val.state_id,
				      text : val.state_name 
				  }));
		  
	    });
   if(data.length==0)
      $("#state_loader").html("<b>No states in this country.</b>");
    else
      $("#state_loader").html("<b>States  are loaded.</b>");
		
    $("#state_loader").fadeOut(2000);
	}
	
	function cityList(data){
	    $('#city_id').empty();
	    $('#city_id').append($('<option>', { 
				      value: "",
				      text : "Select City" 
				  }));	      
	    $.each(data,function(index,val){
				  $('#city_id').append($('<option>', { 
				      value: val.city_id,
				      text : val.city_name 
				  }));
		  
	    });
	if(data.length==0)
	    $("#city_loader").html("<b>No cities in this state.</b>");
	  else
	    $("#city_loader").html("<b>Cities are loaded.</b>");
	   $("#city_loader").fadeOut(2000);  
	}
	function localityList(data){
	    $('#locality_id').empty();
	    $('#locality_id').append($('<option>', { 
				      value: "",
				      text : "Select Locality" 
				  }));	      
	    $.each(data,function(index,val){
				  $('#locality_id').append($('<option>', { 
				      value: val.locality_id,
				      text : val.locality_name 
				  }));
		  
	    });
	if(data.length==0)
	    $("#locality_loader").html("<b>No locality in this City.</b>");
	  else
	    $("#locality_loader").html("<b>Localities are loaded.</b>");
	   $("#locality_loader").fadeOut(2000);  
	}	
	function registerForm(){
	    var options = { 
	      
	   beforeSubmit:  showRequest, 
	   success:       showResponse,
	   dataType:  'json',
	   
	   // other available options:
	    //target: targetDiv  // target element(s) to be updated with server response 
	   //url:       url         // override for form's 'action' attribute 
	   //type:      type        // 'get' or 'post', override for form's 'method' attribute 
	   //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
	   //clearForm: true        // clear all form fields after successful submit 
	   //resetForm: true        // reset the form after successful submit 
    
	   // $.ajax options can be used here too, for example: 
	   //timeout:   3000 
	       };
	    $('#add-form').ajaxForm(options); 
        }
      function initLocationDivs(){
        getCountries();
        $("#country_id").change(function(){
                var country_id = $(this).val();
                $("#state_loader").attr("class","error-msg");
                   $("#state_loader").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
                   $("#state_loader").show();
                           $('#state_id').empty();
                           
                           getStateList(country_id);
                           
           });
        $("#state_id").change(function(){
                var state_id = $(this).val();
                $("#city_loader").attr("class","error-msg");
                $("#city_loader").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
                $("#city_loader").show();
                $('#city_id').empty();		
                getCityList(state_id);
        });
        $("#city_id").change(function(){
                var city_id = $(this).val();
                $("#locality_loader").attr("class","error-msg");
                $("#locality_loader").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
                $("#locality_loader").show();
                $('#locality_id').empty();		
                getLocalityList(city_id);
        });	
        var action = $("#action").val();
        if(action=="UPDATE")
        {
                $.loader({className:"blue-with-image",content:""});
                var city_id_val = $("#city_id_val").val();
                var state_id_val = $("#state_id_val").val();
                var country_id_val = $("#country_id_val").val();
                var locality_id_val = $("#locality_id_val").val();
		
                $("#country_id").val(country_id_val);
                getStateList(country_id_val);
                getCityList(state_id_val);
                getLocalityList(city_id_val);
                $("#state_id").val(state_id_val);
                $("#city_id").val(city_id_val);
		        $("#locality_id").val(locality_id_val);
                $.loader('close');
                
        }
      }
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
        $("#validationSummary").attr("class","error-msg");
        $("#validationSummary").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
        $("#validationSummary").show();

 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 

        if(responseText.successStatus){
          $("#validationSummary").attr("class","success-msg cf");
          $("#validationSummary").html("<h3>"+responseText.responseMessage+"</h3>");
          $("#validationSummary").show();
	  $("#max_basic_id").val(responseText.maxId);
          
        }else{
          $("#validationSummary").attr("class","error-msg");
          $("#validationSummary").html("<h3>Please correct following errors.</h3><ul class='error-hint cf'>"+responseText.responseMessage+"</ul>");
	  
          $("#validationSummary").show();
        }

}                