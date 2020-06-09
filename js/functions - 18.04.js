(function($){
	function mycarousel_initCallback(carousel) {
    $('#mycarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });

    $('#mycarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
};


$(document).ready(function() {
    $("#mycarousel").jcarousel({
        scroll: 1,
        auto: 6,
        initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null,
        wrap: 'circular'
    });
    
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
});
})(jQuery)

