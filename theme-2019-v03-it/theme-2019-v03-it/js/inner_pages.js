$(function() {
$('#inner_navigation .preview_page').click(function(){
    if($(this).hasClass('active')) {
        console.log('click');
        return false;
    } else {
        $('#inner_navigation .active').removeClass('active');
	$('#screenshot_area').load($(this).attr('title'),function(data, status) {$(this).html(data);});
	$(this).addClass('active');
	return false;
    }
}).hover(
	function(){
            $(this).css({'color': '#000','text-decoration':'none'});
	},
	function(){
            $(this).removeAttr('style');
	});
})(jQuery);
