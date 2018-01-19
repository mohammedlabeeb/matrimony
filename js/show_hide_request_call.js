var common={
	hideShow:function(options){
		if(typeof options.hide == "string"){
			if(options.jQuery && options.jQuery==true){
				jQuery('#'+options.hide).slideUp('slow');
			}
			else{
				document.getElementById(options.hide).style.display='none';
			}
		}
		
		if(typeof options.show == "string"){
			if(options.jQuery && options.jQuery==true){
				jQuery('#'+options.show).slideUp('slow');
			}
			else{
				document.getElementById(options.show).style.display='';
			}
		}
		
		
		
		if(typeof options.hide == "object"){
			if(options.hide.length > 0){
				for(i=0; i<options.hide.length; i++){
					if(options.jQuery && options.jQuery==true){
						jQuery('#'+options.hide[i]).slideUp('slow');
					}
					else{
						document.getElementById(options.hide[i]).style.display='none';
					}
				}	
			}	
		}
		
		if(typeof options.show == "object"){
			if(options.show.length > 0){
				for(i=0; i<options.show.length; i++){
					
					if(options.jQuery && options.jQuery==true){
						jQuery('#'+options.show[i]).slidedown('slow');
					}
					else{
						document.getElementById(options.show[i]).style.display='';
					}
				}	
			}
		}
	}
} 
