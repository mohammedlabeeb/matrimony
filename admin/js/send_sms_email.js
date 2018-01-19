var to_user_list = new Array();
function initContactMultipleWidgets()
{
	$("#send_sms_email").click(function(){
		
		$.each($(".table-checkbox:checked"),function(index){
			
			if($(this).attr("owner_id")!="MASTER"){
				if($.inArray($(this).attr("owner_id"),to_user_list)==-1){
					
					to_user_list.push($(this).attr("owner_id"));
				}
			}
		});
		if(to_user_list.length>0){
			ShowDialogEmail(true);   
		}else{
			alert("Please select a List to send SMS/EMail");
		}
	});
	$("#sendSMSEmail").click(function(){
			//posting using ajax

			var data_save = {party_name:"Admin",party_email :$("#admin_email").val(),party_mobile :"0000000000",party_city :$("#admin_city").val(),message_subject:$("textarea#email_content").val(),to_user:to_user_list};
			 $.ajax({ 
				type    : "POST",
				cache   : false,
				url     : "../web-services/contact_multiple.php",
				data    : data_save,
				error   : function (xhr, ajaxOptions, thrownError){
							alert(xhr.status);
				},
				success : function(data) {
						
						if(data.successStatus){
						$("#validationSummary1").removeClass("error-msg cf");
						$("#validationSummary1").addClass("success-msg cf");
						$("#validationSummary1").html("<h3>"+data.responseMessage+"</h3>");
						$("#validationSummary1").show();
						to_user_list = [];				
					}else{
						$("#validationSummary1").removeClass("success-msg cf");
						$("#validationSummary1").addClass("error-msg cf");
						$("#validationSummary1").html(data.responseMessage);
						$("#validationSummary1").show();
						
					}
				}
				});
			//
	});
}
function ShowDialogEmail(modal)
{
   $("#overlay").show();
   $("#send_email").fadeIn(300);
   if (modal)
   {
      $("#overlay").unbind("click");
   }
   else
   {
      $("#overlay").click(function (e)
      {
         HideDialog();
      });
   }
}

function HideDialogEmail()
{
   $("#overlay").hide();
   $("#send_email").fadeOut(300);

} 
$(document).ready(function(){
	$("#btnCloseEmail").click(function(){
		HideDialogEmail();
	});
	$("#cancelEmail").click(function(){
		HideDialogEmail();
	});
	initContactMultipleWidgets();
});