$(document).ready(function(){
	$('.placeholder_textbox').each(function(){
		var tAttr = $(this).attr('title');
		if(typeof(tAttr) != 'undefined' && tAttr != false){
			if(tAttr != null && tAttr != ''){
			  $(this).data('placeholder', tAttr);
			  $(this).removeAttr('title');
			  $(this).addClass('default_title_text');
			  $(this).val(tAttr);
			  $(this).focus(function(){
				$(this).removeClass('default_title_text');
				if($(this).val() == $(this).data('placeholder')){
				  $(this).val('');
				}
			  });
			  $(this).blur(function(){
				if($(this).val() == ''){
				  $(this).val($(this).data('placeholder'));
				  $(this).addClass('default_title_text');
				}
			  });
			}
		}    
	});
});