jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
			effect:'fade',	
			directionNav:true, // Next & Prev navigation
        	directionNavHide:false // Only show on hover			
			});
    });


jQuery.noConflict();
jQuery(document).ready(function(){
    nivoSlider();
});
function nivoSlider() {
    jQuery("#slider").click(function() {
        /*Some action*/
    });
}

