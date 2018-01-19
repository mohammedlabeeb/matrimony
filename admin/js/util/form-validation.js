function validateForm(formId,rulesArray,messagesArray)
    {
  
     $(formId).validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,	
        focusInvalid: false,
    
        //Setting validation type like, Required, Minimum or Maximum Length, Data Type etc.
        rules:rulesArray,
        messages:messagesArray,
        
        //All error labels are displayed inside an unordered list with the ID "validationSummary"
        //Additonal container for error messages. The elements given as the "errorContainer" are all shown and hidden when errors occur.
        errorContainer: "#validationSummary",
        
        //But the error labels themselve are added to the element(s) given as errorLabelContainer, here an unordered list.
        errorLabelContainer: "#validationSummary ul",
        
        //Therefore the error labels are also wrapped into li elements (wrapper option).
        wrapper: "li",

        //A custom message display handler. Gets the map of errors as the first argument and and array of errors as the second, 
        //called in the context of the validator object.
        showErrors: function (errorMap, errorList) {
                        var messages = "";
                        $.each(errorList, function (index, value) {
                            var id = $(value.element).attr('id');
                            messages += "<li><a title='click to view field' href='javascript:setFocus(\"#" + id + "\");'><b>[" + $(value.element).attr('id') + "]</b></a> " + value.message + "</li>\n";
                        });
                        messages = "<ul class='error-hint cf'><h4>Please correct following error(s).</h4>" + messages + "</ul>";
                        if(errorList.length>0){
                        //Showing validation summary in list of the same page
	                        $('#validationSummary').html(messages);
	                        $('#validationSummary').show("fast"); 
							$("#success_msg").css("display","none");                         
                        }
                        else
                        {
                        //Showing validation summary in list of the same page
                        	$('#validationSummary').css("display","none");
                        
                          
                        }

                        },
        
        });
    }
 function validateFormTabs(formId,rulesArray,messagesArray,validatorDiv)
    {
  
     $(formId).validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,	
        focusInvalid: false,
    
        //Setting validation type like, Required, Minimum or Maximum Length, Data Type etc.
        rules:rulesArray,
        messages:messagesArray,
        
        //All error labels are displayed inside an unordered list with the ID "validationSummary"
        //Additonal container for error messages. The elements given as the "errorContainer" are all shown and hidden when errors occur.
        errorContainer: validatorDiv,
        
        //But the error labels themselve are added to the element(s) given as errorLabelContainer, here an unordered list.
        errorLabelContainer: validatorDiv+" ul",
        
        //Therefore the error labels are also wrapped into li elements (wrapper option).
        wrapper: "li",

        //A custom message display handler. Gets the map of errors as the first argument and and array of errors as the second, 
        //called in the context of the validator object.
        showErrors: function (errorMap, errorList) {
                        var messages = "";
                        $.each(errorList, function (index, value) {
                            var id = $(value.element).attr('id');
                            messages += "<li><a title='click to view field' href='javascript:setFocus(\"#" + id + "\");'><b>[" + $(value.element).attr('id') + "]</b></a> " + value.message + "</li>\n";
                        });
                        messages = "<ul class='error-hint cf'><h4>Please correct following error(s).</h4>" + messages + "</ul>";
                        if(errorList.length>0){
                        //Showing validation summary in list of the same page
	                        $('#validationSummary').html(messages);
	                        $('#validationSummary').show("fast"); 
							$("#success_msg").css("display","none");                         
                        }
                        else
                        {
                        //Showing validation summary in list of the same page
                        	$('#validationSummary').css("display","none");
                        
                          
                        }

                        },
        
        });
    }
  
    function setFocus(ele)
    {
        $(ele).focus();
    }