function attention_modal_close(){
	console.log( $("input[type='file']").val());
	console.log(file_array);
	$('.attention-modal').stop(true, true).fadeOut('500');
	$('.attention-modal-content').stop(true, true).animate({
		opacity: 0,
		display: "none"
	}, 200, function(){
		$('.attention-modal-content').hide();
	});
}
function attention_modal_open(){
	$('.attention-modal').stop(true, true).fadeIn('500');
	$('.attention-modal-content').show().stop(true, true).animate({
		display: "flex",
		opacity: 1.0
	}, 200);
}
