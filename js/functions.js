
//	function mycarousel_initCallback(carousel) {
//    $('#mycarousel-next').bind('click', function() {
//        carousel.next();
//        return false;
//    });
//
//    $('#mycarousel-prev').bind('click', function() {
//        carousel.prev();
//        return false;
//    });
//};


$(document).ready(function() {
  //  $("#mycarousel").jcarousel({
//        scroll: 1,
//        auto: 6,
//        initCallback: mycarousel_initCallback,
//        // This tells jCarousel NOT to autobuild prev/next buttons
//        buttonNextHTML: null,
//        buttonPrevHTML: null,
//        wrap: 'circular'
//    });
    
    $('.blink').focus(function(){
    	if($(this).val() == $(this).attr('title')){
    		$(this).val("");
    	}
    });
    
    $('.blink').blur(function(){
    	if($(this).val()==""){
    		$(this).val($(this).attr('title'));
    	}
    });
    
    $(window).load(function() {
		$('.ui-tabs-panel').each(function() {
	    	var counter=0;
	    	$(this).find('table:odd').after('<div class="cl">&nbsp;</div>');
	    	counter++;
	    });
    });
});
(function($) {
 $(function() {
  var prev = 0;
var $window = $(window);
var nav = $('.signin-form');

$window.on('scroll', function(){
  var scrollTop = $window.scrollTop();
  //nav.toggleClass('hidden', scrollTop > prev);
 // nav.hide();
  prev = scrollTop;
});
$('ui-tabs .ui-tabs-anchor').click(function(e){
    e.preventDefault();
    });
 });
})(jQuery);