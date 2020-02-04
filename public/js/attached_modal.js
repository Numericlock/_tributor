
function attached_modal_open(t){
	var attached_num = $(t).data("num");
	$('#attached_modal_content_img').attr('src',$(t).attr('src')); 
	$('#attached_modal_content_img').data('num',attached_num); 
	$('.attached-modal').stop(true, true).fadeIn('500');
	$('.attached-modal-content').show().stop(true, true).animate({
		display: "flex",
		opacity: 1.0
	}, 200);	
}

function attached_modal_close(){
	$('.attached-modal').stop(true, true).fadeOut('500');
	$('.attached-modal-content').stop(true, true).animate({
		opacity: 0,
		display: "none"
	}, 200, function(){
		$('.attached-modal-content').hide();
	});
}		
function img_slide(t){
	var img = $(t).parent().find("img");
	var src = img.attr('src'); 
	src = src.slice(0, -4);
	var max_num = img.data('num');
	var num = src.substr(-1, 1);
	if(max_num != 1){
		num = Number(num)+1;
		if(num >= max_num){
			num=0;
		}
		src = src.slice(0, -1);
		src = src + num + ".png";
		console.log(max_num);
		img.attr('src',src);	
	}
}