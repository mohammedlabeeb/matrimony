var story_count;
var story_interval;
var old_story = 0;
var current_story = 0;

$(document).ready(function(){
	story_count = $(".scroller").size();
	$(".scroller:eq("+current_story+")").css('left', '0px');
	story_interval = setInterval(story_rotate,5000); 
	
	$('.scroller').hover(function() {
		clearInterval(story_interval);
	}, function() {
		story_interval = setInterval(story_rotate,5000); 
	});
});

function story_rotate() {
	current_story = (old_story + 1) % story_count; 
	
	$(".scroller:eq(" + old_story + ")")
	.animate({'left': '-290px'},"slow", function() {
	$(this).css('left', '290px');
	});
		
	$(".scroller:eq(" + current_story + ")")
	.animate({'left': '0px'},"slow");  
	old_story = current_story;
}