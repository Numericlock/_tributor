var retribute_flag =true;
function retribute(t){
	if(retribute_flag ==true){
		retribute_flag = false;
		var id = $(t).data('id');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/retribute",        // POST送信先のURL
			dataType: 'json',
			data : {post_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$(t).attr('class', function(index, classNames) {
				return classNames + ' diffusion-retribute';
			});
			$(t).attr('class', function(index, classNames) {
				return classNames.replace('diffusion', '');
			});
			$(t).attr("onclick", "retribute_remove(this)");
			var num = Number($(t).parent().find('span').text());
			num = num + 1;
			$(t).parent().find('span').text(num);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
		retribute_flag = true;
	}
}
function retribute_remove(t){
	if(retribute_flag ==true){
		retribute_flag = false;
		var id = $(t).data('id');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/retribute/remove",        // POST送信先のURL
			dataType: 'json',
			data : {post_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$(t).attr('class', function(index, classNames) {
				return classNames + ' diffusion';
			});
			$(t).attr('class', function(index, classNames) {
				return classNames.replace('diffusion-retribute', '');
			});
			$(t).attr("onclick", "retribute(this)");
			var num = Number($(t).parent().find('span').text());
			num = num - 1;
			if(num <= 0){
				num="";
			}
			$(t).parent().find('span').text(num);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
		retribute_flag = true;
	}
}