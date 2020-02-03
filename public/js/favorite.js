var favorite_flag =true;
function favorite(t){
	if(favorite_flag ==true){
		favorite_flag = false;
		var id = $(t).data('id');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/favorite",        // POST送信先のURL
			dataType: 'json',
			data : {post_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$(t).attr('class', function(index, classNames) {
				return classNames + ' heart-favorite';
			});
			$(t).attr('class', function(index, classNames) {
				return classNames.replace('heart', '');
			});
			$(t).attr("onclick", "favorite_remove(this)");
			var num = Number($(t).parent().find('span').text());
			num = num + 1;
			$(t).parent().find('span').text(num);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
		favorite_flag = true;
	}
}
function favorite_remove(t){
	if(favorite_flag ==true){
		favorite_flag = false;
		var id = $(t).data('id');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/favorite/remove",        // POST送信先のURL
			dataType: 'json',
			data : {post_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$(t).attr('class', function(index, classNames) {
				return classNames + ' heart';
			});
			$(t).attr('class', function(index, classNames) {
				return classNames.replace('heart-favorite', '');
			});
			$(t).attr("onclick", "favorite(this)");
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
		favorite_flag = true;
	}
}