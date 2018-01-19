
function setPageContext(activeMainMenuLink, activeSubMenuLink)
{
    if (areCookiesEnabled()) {
        setCookie("activeMain", activeMainMenuLink, 5);
        setCookie("activeSub", activeSubMenuLink, 5);
    } else {
        alert("Please enable cookie from your browser settings.");
    }
}

$(document).ready(function()
{
    //$(".accordion li:first").addClass("active");
    //$(".accordion li.active .sub-nav").css('display','block');
    /*
     check cookie if cookie is set for active menu
     */

    var activeMain = getCookie("activeMain");
    var activeSub = getCookie("activeSub");
    if (activeMain != null) {
        $("#" + activeMain).addClass("active");
        $(".accordion li.active .sub-nav").css('display', 'block');
    }

    if (activeSub != null) {
        $("#" + activeSub).addClass("active-open");
    }


    $(".accordion li h3").click(function()
    {
        //$("ul.accordion li").css("overflow","hidden");
        if ($(this).parent('li').hasClass('active'))
        {
        }
        else if ($(this).parent('li').not('.active'))
        {
            if ($(".accordion li").hasClass('active'))
            {
                $(".accordion li.active .sub-nav").slideUp(500);
                $(".accordion li").removeClass("active");
            }
            $(this).parent('li').addClass("active");
            $(".accordion li.active .sub-nav").slideDown(500);
        }
    });

    $(".main-navigation li.pending-action .number").click(function() {
        if ($(".popup-box").is(":hidden")) {
            $(".popup-box").slideDown('slow');
        }
        else {
            $(".popup-box").slideUp('slow');
        }
    });
    var box = $('.popup-box');
    var pending_action = $('.main-navigation li.pending-action .number');

    pending_action.click(function() {
        box.show();
        return false;
    });

    $(document).click(function() {
        box.hide();
    });

    box.click(function(e) {
        e.stopPropagation();
    });


});
