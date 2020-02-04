var mySwiper = new Swiper ('.swiper-container', {
	effect: "slide",
	loop: true,
	pagination: '.swiper-pagination',
	nextButton: '.swiper-button-next',
	prevButton: '.swiper-button-prev',
	onSlideChangeEnd:function (idx) {
		slide_flag = true;
	},
});
var slide_flag = true;
function swiper_prev(t){
	if(slide_flag == true){
		slide_flag = false;
		var parent = $(t).parent().parent().parent().parent().parent();
		var num = Number($(t).parent().data('num'));
		var maxnum = Number($(t).parent().data('maxnum'));
		var id = Number($(t).parent().data('id'));
		num = num-1;
		if(num <= -1){
			num=maxnum-1;
		}
		console.log(num);
		$(t).parent().data('num',num);
		$('#post_'+id).css('background-image', 'url(/img/post_img/'+$(t).parent().data('id')+'_'+ num +'.png)');
	}
}		
function swiper_next(t){
	if(slide_flag == true){
		slide_flag = false;
		var parent = $(t).parent().parent().parent().parent().parent();
		var num = Number($(t).parent().data('num'));
		var maxnum = Number($(t).parent().data('maxnum'));
		var id = Number($(t).parent().data('id'));
		num = num+1;
		if(num >= maxnum){
			num=0;
		}
		console.log(num);
		$(t).parent().data('num',num);
		$('#post_'+id).css('background-image', 'url(/img/post_img/'+$(t).parent().data('id')+'_'+ num +'.png)');
	}
}