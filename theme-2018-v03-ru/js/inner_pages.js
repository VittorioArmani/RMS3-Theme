jQuery(function() {
jQuery('#inner_navigation .preview_page').click(function(){
    if(jQuery(this).hasClass('active')) {
        console.log('click');
        return false;
    } else {
        jQuery('#inner_navigation .active').removeClass('active');
	jQuery('#screenshot_area').load(jQuery(this).attr('title'),function(data, status) {jQuery(this).html(data);});
	jQuery(this).addClass('active');
	return false;
    }
}).hover(
	function(){
            jQuery(this).css({'color': '#000','text-decoration':'none'});
	},
	function(){
            jQuery(this).removeAttr('style');
	});
});
