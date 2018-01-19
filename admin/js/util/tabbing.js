function loadTab(containerID,URL,USER_ID_APPENDFIELD,tab_no)
{
    if(tab_no!=1){
        if($(USER_ID_APPENDFIELD).val()=="")
        {
            
             $(containerID).html("<h1><b>First Add Basic detail</b></h1>");
            return false;
        }
    }
    //Loading Progress
    var loadingText = "<div class='loadinContainer'><img src='./img/ajax-request-loader.gif' alt='Loading' /> <span class='loadingText'>Loading.Please Wait.</span></div>";
      $(containerID).html(loadingText);
     var compleURL = URL+""+$(USER_ID_APPENDFIELD).val();
    $.get(compleURL, function(data) {
    //Loading Progress stop
            $(containerID).html(data);

    });
    
    
}
function registerForActiveTab()
{
    
     $("#custom-tabs li a").click(function(){
     $("#custom-tabs li a").removeClass("active");
        $(this).addClass("active");
     });

}
function setActiveTab(activeContainer)
{
    $(activeContainer).addClass("active");
}