var follow_flag =true;
var follow_remove_flag =true;
function follow(t){
	if(follow_flag ==true){
		follow_flag = false;
		var id = $(t).data('followid');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/follow",        // POST送信先のURL
			dataType: 'json',
			data : {user_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$('#followbutton_'+id).empty();
			$('#followbutton_'+id).append(
			'<button class="follow-remove-button" onclick="follow_remove(this)" data-followid='+id+'>フォロー中</button>'
			);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
		follow_flag = true;
	}
}

function follow_remove(t){
	if(follow_remove_flag ==true){
		follow_remove_flag = false;
		var id = $(t).data('followid');
		$.ajax({
			type:"post",                // method = "POST"
			url:"/follow/remove",        // POST送信先のURL
			dataType: 'json',
			data : {user_id: id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			$('#followbutton_'+id).empty();
			$('#followbutton_'+id).append(
			'<button class="follow-button" onclick="follow(this)" data-followid='+id+'>フォロー</button>'
			);
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
		follow_remove_flag = true;
	}
}