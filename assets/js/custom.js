$(window).on("resize", function () {
	
}).resize();

$(document).ready(function() {
	
	// Image Popup
	$('.horoscope').magnificPopup({type:'image'});
	
	// Tabs vertical
	$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
	
	//Sticky Sidebar
	$("article .inner-content .sidebar, article .inner-content .right-side").stick_in_parent();
	
	
	//Disable Click
	$( document ).on( "click", ".no-link", function(e) {
		e.preventDefault();
	});
	
	// attach the plugin to all selects
	$('.custom-select').selectik({maxItems: 8, minScrollHeight: 20}, {
			_generateHtml: function(){
				this.$collection = this.$cselect.children();
				var html = '';
				for (var i = 0; i < this.$collection.length; i++){
					var $this = $(this.$collection[i]);
					html += '<li class="'+ ($this.attr('disabled') === 'disabled' ? 'disabled' : '') +'" data-value="'+$this[0].value+'">'+($this.data('selectik') ? $this.data('selectik') : $this[0].text)+'</li>';
				 };
				return html;
			}
		}
	);
	
	// Success Stories
	$('.bxslider').bxSlider({
		mode: 'fade',
		useCSS: false,
		infiniteLoop: true,
		hideControlOnEnd: true,
		auto: true,
		controls: false
	});
	
	// Header size
	$(window).scroll(function(){
        var ScrollTop = parseInt($(window).scrollTop());
        // console.log(ScrollTop);
		if (ScrollTop > 100) {
			// $('header').addClass('resize');
			 $('header .top').addClass('shadow');
		} else {
			// $('header').removeClass('resize');	
			 $('header .top').removeClass('shadow');
		}
		
    });
	
	(function () {
		var $frame = $('#centered');
		var $wrap  = $frame.parent();

		// Call Sly on frame
		$frame.sly({
			horizontal: 1,
			itemNav: 'centered',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 4,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,

			// Buttons
			prev: $wrap.find('.prev'),
			next: $wrap.find('.next')
		});
	}());
	
	// Horizontal Tabs
	$('#horizontalTab').responsiveTabs({
		rotate: false,
		startCollapsed: 'accordion',
		collapsible: 'accordion',
		setHash: true,
		activate: function(e, tab) {
			$('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
		},
		activateState: function(e, state) {
			//console.log(state);
			$('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
		}
	});
	
});

$( window ).load(function() {
	
	// Rounds Effects
	$(".first-round").animate({
		"left": "0px"
    },0, null, function(){
		$(".third-round").animate({
			"left": "232px"
		}, 600);
		$(".second-round").animate({
			"left": "108px"
		}, 300);
		$(".first-round").animate({
			"left": "0px"
		}, 0);
    });
	
	// Preloader
	$("#status").fadeOut();
    $("#preloader").delay(1000).fadeOut("slow");
	
});
