var prev_form_id = "";	
function registerFormWithId(form_id){
	    var options = { 
	      
	   beforeSubmit:  showRequestSecond, 
	   success:       showResponseSecond,
	   dataType:  'json',
	   formId :form_id,
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
	    $(form_id).ajaxForm(options); 
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
function showRequestSecond(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
        $("#validationSummary2").attr("class","error-msg");
        $("#validationSummary2").html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
        $("#validationSummary2").show();
        
        
        $(options.formId).prev().attr("class","error-msg");
        $(options.formId).prev().html("<img src='img/ajax-loader.gif' alt='loading'/> <b>Please wait...</b>");
        $(options.formId).prev().show();
        prev_form_id = options.formId; 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
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
function showResponseSecond(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 

        if(responseText.successStatus){
          $("#validationSummary2").attr("class","success-msg cf");
          $("#validationSummary2").html("<h3>"+responseText.responseMessage+"</h3>");
          $("#validationSummary2").show();
	      $("#max_basic_id").val(responseText.maxId);
	      
	      $(prev_form_id).prev().attr("class","success-msg cf");
	      $(prev_form_id).prev().html("<h3>"+responseText.responseMessage+"</h3>");
	      $(prev_form_id).prev().show();
          
        }else{
          $("#validationSummary2").attr("class","error-msg");
          $("#validationSummary2").html("<h3>Please correct following errors.</h3><ul class='error-hint cf'>"+responseText.responseMessage+"</ul>");
          $("#validationSummary2").show();

	      $(prev_form_id).prev().attr("class","error-msg");
	      $(prev_form_id).prev().html("<h3>Please correct following errors.</h3><ul class='error-hint cf'>"+responseText.responseMessage+"</ul>");
	      $(prev_form_id).prev().show();
        }

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