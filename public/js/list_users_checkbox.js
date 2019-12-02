$(function(){
	$(".list-modal-addUsers-searchArea-result-user-checkbox-input").change(function() {
			if($(this).prop("checked")==true){
				append_box($(this).val(), $(this).attr("id"));
				list_user_id_array.push($(this).attr("id"));
				console.log(list_user_id_array);
			}else{
				remove_box($(this).attr("id"));
			}
	});
});