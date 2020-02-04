function other_nav_open(){
	$('.other-nav-modal').stop(true, true).fadeIn();
	$('.other-nav-wrapper').css('display','flex');
}		
function other_nav_close(){
	$('.other-nav-modal').stop(true, true).fadeOut();
	$('.other-nav-wrapper').css('display','none');
}
$('.other-nav-modal').on('click',function(){
	other_nav_close();
});