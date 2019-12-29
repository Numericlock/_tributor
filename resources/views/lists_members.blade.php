@extends('layouts.app')
@section('title', 'リスト')
@section('cssJs')

	<link rel="stylesheet" href="/css/modal.css">
	<link rel="stylesheet" href="/css/verification_modal.css">
<link rel="stylesheet" href="/css/list.css">
	<link rel="stylesheet" href="/css/lists_members.css">
@endsection
@section('content')
<div class="content">
	<div class="content-title">
		 <span>リスト</span>
	</div>
	<div class="content-wrapper">
		<div class="list-member-header">
			<div class="list-icon">
				<img src="../img/list_icon/{{ $current_list->list_id }}.png" onerror="this.src='../img/list_icon/default.png'">


			</div>
			<div class="list-title">

					{{$current_list->name }}
			</div>
			<div class="list-members-num" id="list_members_num" data-num="{{$count }}">
				メンバー{{$count }}人
			</div>
			<div class="list-update-btn">
				<button type="button" id="list_update_button" class="btn-square-small">リストを編集する</button>
			</div>
		</div>
		<div class="lists-users">
			<div class="lists-control-wrapper">

		<!--		<svg class="lists-setting-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 20"><g><path d="M16.783 10c0-1.049.646-1.875 1.617-2.443a8.932 8.932 0 0 0-.692-1.672c-1.089.285-1.97-.141-2.711-.883-.741-.74-.968-1.621-.683-2.711a8.732 8.732 0 0 0-1.672-.691c-.568.97-1.595 1.615-2.642 1.615-1.048 0-2.074-.645-2.643-1.615a8.697 8.697 0 0 0-1.671.691c.285 1.09.059 1.971-.684 2.711-.74.742-1.621 1.168-2.711.883A8.797 8.797 0 0 0 1.6 7.557c.97.568 1.615 1.394 1.615 2.443 0 1.047-.645 2.074-1.615 2.643a8.89 8.89 0 0 0 .691 1.672c1.09-.285 1.971-.059 2.711.682.741.742.969 1.623.684 2.711a8.841 8.841 0 0 0 1.672.693c.568-.973 1.595-1.617 2.643-1.617 1.047 0 2.074.645 2.643 1.617a8.963 8.963 0 0 0 1.672-.693c-.285-1.088-.059-1.969.683-2.711.741-.74 1.622-1.166 2.711-.883a8.811 8.811 0 0 0 .692-1.672c-.973-.569-1.619-1.395-1.619-2.442zM10 13.652a3.652 3.652 0 1 1 0-7.306 3.653 3.653 0 0 1 0 7.306z"/></g></svg> -->
			</div>
			@foreach($list_users as $user)
				<div class="lists-users-wrapper" id="{{ 'user_id_'.$user->users_id }}">
					<div class="lists-users-icon">
						<img src="../img/icon_img/{{ $user->users_id }}.png" onerror="this.src='../img/icon_img/default.png'">

					</div>
					<div class="lists-users-nameId">
						<div class="lists-users-nameId-name">
							<span>{{ $user->users_name }}</span>
						</div>
						<div class="lists-users-nameId-id">
							<span>{{ "@".$user->users_id }}</span>
						</div>
					</div>
					<svg class="lists-users-closeButton" onclick="remove_user(this)" version="1.1" data-userid="{{$user->users_id }}" data-username="{{$user->users_name }}" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
								52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
						</g>
					</svg>
				</div>
			@endforeach
		</div>
	</div>
</div>
<!--リスト作成のmodal部分-->
<div class="modal">
</div>
<div id="list-modal-content" class=modal-content>
	<div class="modal-title">
		<span>リストを作成</span>
		<svg class="modal-closeButton" id="modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 512 512" xml:space="preserve">
			<g>
				<polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
					52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
			</g>
		</svg>
	</div>
	<div class="list-modal-minimumInputs">
		<div class="list-modal-profileImageInput">
			<label>
				<img class="profile-image" id="preview" src="../img/addimg.png"><br>
				<input type="file" id="dotRadius2" accept="image/*"　 stylesheet="display:none"hidden>
			</label>
		</div>
		<div class="list-modal-listNameInput">
			<div class="id_box box">
				<div class="id_inner inner">
					<input id="text" class="text" maxlength="24" type="text" value="{{ $current_list->name }}">
					<div class="listName_string string keepfocus">Listの名前を入力</div>
				</div>
				<i class="fas fa-eye-slash"></i>
			</div>
		</div>
		<div class="list-modal-isPublish">
			
			<span>公開</span>
			@if($current_list->is_publish = 0)
			<input type="checkbox" id="isPublish" value="" />
			@else
			<input type="checkbox" id="isPublish" value="" checked/>
			@endif
			<label class="checkbox-label" for="isPublish">
				<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>
			</label>
		</div>
	</div>
	<div class="list-modal-addUsers">
		<div class="list-modal-addUsers-searchArea">
			<div class="list-modal-addUsers-searchArea-searchBox">
				<div class="search_box box">
					<div class="search_inner inner">
						<input id="search_text" class="text" maxlength="24" type="text">
						<div class="search_string string">ユーザーを検索</div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
			</div>
			<div class="list-modal-addUsers-searchArea-result">
			</div>
		</div>
		<div class="list-modal-addUsers-IntendAdd">
			@foreach($list_users as $user)
			<div id="{{ $user->users_id }}_box" class="list-modal-addUsers-IntendAdd-box">
				<svg class="list-modal-addUsers-IntendAdd-box-close" onclick=remove(this) id="{{ $user->users_id }}_box_remove_button" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/></g></svg>
				<div class="list-modal-addUsers-IntendAdd-users">
					<span class="list-modal-addUsers-IntendAdd-users-name">{{ $user->users_name }}</span>
					<span class="list-modal-addUsers-IntendAdd-users-id">{{ "@".$user->users_id }}</span>
				</div>
			</div>
			@endforeach
			
		</div>
	</div>

	<div class="modal-control">
		<button class="modal-positive-button" id="modal_submit" type='button'>適応</button>
	</div>
</div>
<div class="verification-modal">
</div>
<div class="verification-modal-content">
	<div class="verification-modal-text">
		<span class = "verification-modal-title"></span>
	</div>
	<div class="verification-modal-button">
		<button class="verification-modal-button-cancel">キャンセル</button>
		<button class="verification-modal-button-destruction">削除</button>
	</div>
</div>
<script>
/*\
|*|
|*|  Polyfill which enables the passage of arbitrary arguments to the
|*|  callback functions of JavaScript timers (HTML5 standard syntax).
|*|
|*|  https://developer.mozilla.org/en-US/docs/DOM/window.setInterval
|*|
|*|  Syntax:
|*|  var timeoutID = window.setTimeout(func, delay[, param1, param2, ...]);
|*|  var timeoutID = window.setTimeout(code, delay);
|*|  var intervalID = window.setInterval(func, delay[, param1, param2, ...]);
|*|  var intervalID = window.setInterval(code, delay);
|*|
\*/
	var searchTimer;
	var searchStr;
	var list_user_id_array = [];
	var existing_array =[];
	var list_id=@json($current_list->list_id);
	console.log(list_id);
	@foreach($list_users as $user)
		list_user_id_array.push("{{$user->users_id }}");
		existing_array.push("{{$user->users_id }}");
	@endforeach
	console.log(list_user_id_array);
	console.log(existing_array);
	$(window).resize(is_no_wrap);
	jQuery(function($) {
		is_no_wrap();
	});
	function root(rootDir){
		$.ajax({
		url: rootDir + "index.php",
		cache: false,
		success: function(html){
		html = html.replace(/\{\$root\}/g, rootDir); //footer.htmlの{$root}を置換
		document.write(html);
		}
		});
	}
	function is_no_wrap(){
	  $('.list-title-p').each(function() {
		var $target = $(this);

		// オリジナルの文章を取得する
		var html = $target.data('value');

		// 対象の要素を、高さにautoを指定し非表示で複製する
		var $clone = $target.clone();
		$clone
		  .css({
			display: 'none',
			position : 'absolute',
			overflow : 'visible'
		  })
		  .width($target.width())
		  .height('auto')
		  .html(html);

		// DOMを一旦追加
		$target.after($clone);

		// 指定した高さになるまで、1文字ずつ消去していく
		while((html.length > 0) && ($clone.height() > $target.height())) {
		  html = html.substr(0, html.length - 1);
		  $clone.html(html + '...');
		}

		// 文章を入れ替えて、複製した要素を削除する
		$target.html($clone.html());
		$clone.remove();
	  });
	}
	function postForm(list_name_value, list_icon_value, list_users_id_value, is_publish_value) {
		$.ajax({
			url: 'disclosure_list_insert.php',
			type:'POST',
			dataType: 'json',
			data : {list_name : list_name_value, list_icon : list_icon_value, list_users_id_array : list_users_id_value, is_publish : is_publish_value },
			timeout:3000,
		}).done(function(data) {
			alert("ok");
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			alert("error");
		})

	}
	function remove_user(id){
		var user_id = $(id).data('userid');
		var user_name = $(id).data('username');
		verification_modal(user_name,user_id);
	}
	function verification_modal(name,id){
		$('.verification-modal-title').text(name+"をリストから削除しますか？");
		$('.verification-modal-button-destruction').data('userid',id);
		$('.verification-modal').stop(true, true).fadeIn('500');
		$('.verification-modal-content').show().stop(true, true).animate({
			top: "50%",
			display: "fixed",
			opacity: 1.0
		}, 500);
	}
	$('.verification-modal-button-destruction').on('click',function(){
		remove_user_post($(this).data('userid'));
	});
	function remove_user_post(id){
		$.ajax({
			type:"post",                // method = "POST"
			url:"/lists/member/remove",        // POST送信先のURL
			dataType: 'json',
			data : {user_id: id,list_id: list_id},
			async : false,   // ← asyncをfalseに設定する
			timeout:3000,
		}).done(function(data) {
			console.log("member_remove");
			$('#user_id_'+id).remove();
			var num = $('#list_members_num').data('num');
			num = num-1;
			$('#list_members_num').data('num',num);
			$('#list_members_num').text("メンバー"+num+"人");
		}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log("Server Error. Pleasy try again later.");
			console.log("XMLHttpRequest : " + XMLHttpRequest.status);
			console.log("textStatus     : " + textStatus);
			console.log("errorThrown    : " + errorThrown.message);
		})
	}
	function modal_reset(){
		$('.modal').stop(true, true).fadeOut('500');
		$('#list-modal-content').stop(true, true).animate({
			top: "-1000px",
			left: "50%",
			opacity: 0
		}, 500, function(){
			$('#list-modal-content').hide();
		});
		$('#text').val('');
		$('#search_text').val('');
		searchStr = null;
		list_user_id_array = [];
		list_icon_value = null;
		$("#isPublish").prop('checked', false);
		var target = document.getElementById("modal_submit");
		target.disabled = false;
	}
	function append_box(name, id){
		$(".list-modal-addUsers-IntendAdd").append(
			'<div id="'+id+'_box" class="list-modal-addUsers-IntendAdd-box">'
		+		'<svg class="list-modal-addUsers-IntendAdd-box-close" onclick=remove(this) id="'+id+'_box_remove_button" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/></g></svg>'
		+		'<div class="list-modal-addUsers-IntendAdd-users">'
		+			'<span class="list-modal-addUsers-IntendAdd-users-name">'+name+'</span>'
		+			'<span class="list-modal-addUsers-IntendAdd-users-id">@'+id+'</span>'
		+		'</div>'
		+	'</div>'
		);
	}
	function remove(id){
		var str = $(id).attr("id").slice( 0, -18);
		remove_check(str);
		remove_box(str);
		console.log(str);
	};
	function remove_box(id){
		$("#"+id+"_box").remove();
		//要素を削除する
		var target = id;
		list_user_id_array.some(function(v, i){
			if (v==target) list_user_id_array.splice(i,1);
		});
		console.log(list_user_id_array);

	}
	function remove_check(id){
		$('#'+id).prop('checked', false);
	}

	function search_for(){
		// 各フィールドから値を取得してJSONデータを作成
		var data = {
			str: searchStr
		};
		// 通信実行
		$.ajax({
			type:"post",                // method = "POST"
			url:"/lists/search",        // POST送信先のURL
			data:JSON.stringify(data),  // JSONデータ本体
			contentType: 'application/json', // リクエストの Content-Type
			processData: false,    
			async : false,   // ← asyncをfalseに設定する// レスポンスをJSONとしてパースする
			success: function(json_data) {   // 200 OK時
				// JSON Arrayの先頭が成功フラグ、失敗の場合2番目がエラーメッセージ
				if (!json_data[0]) {    // サーバが失敗を返した場合
					console.log("Transaction error. " + json_data[1]);
					$('.list-modal-addUsers-searchArea-result').empty();
					$('.list-modal-addUsers-searchArea-result').append(
						"<span class='list-modal-addUsers-searchArea-result-empty'>結果が見つかりませんでした。</span>"
						);						
					return;

				}
				$('.list-modal-addUsers-searchArea-result').empty();
				json_data.forEach(function( value ) {
					if(list_user_id_array.indexOf(value.users_id) == -1){
						$('.list-modal-addUsers-searchArea-result').append(
							 '<div class="list-modal-addUsers-searchArea-result-user">'
							+			'<div class="list-modal-addUsers-searchArea-result-user-icon">'
							+				'<img src="/img/2.jpg">'
							+			'</div>'
							+			'<div class="list-modal-addUsers-searchArea-result-user-name">'
							+				'<span title='+value.users_name+'>'+ value.users_name +'</span>'
							+				'<div class="list-modal-addUsers-searchArea-result-user-id">'
							+					'<span title=@'+value.users_id+'>@'+ value.users_id +'</span>'
							+				'</div>'
							+			'</div>'
							+			'<div class="list-modal-addUsers-searchArea-result-user-checkbox">'
							+				'<div class="checkbox">'
							+					'<div>'
							+						'<input type="checkbox" class="list-modal-addUsers-searchArea-result-user-checkbox-input" id='+ value.users_id +' name = '+value.users_id+' value="'+ value.users_name +'" />'
							+						'<label class="checkbox-label" for='+value.users_id+'>'
							+							'<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>'
							+						'</label>'
							+					'</div>'
							+				'</div>'
							+			'</div>'
							+		'</div>'
						);

					}else{
						$('.list-modal-addUsers-searchArea-result').append(
							 '<div class="list-modal-addUsers-searchArea-result-user">'
							+			'<div class="list-modal-addUsers-searchArea-result-user-icon">'
							+				'<img src="/img/2.jpg">'
							+			'</div>'
							+			'<div class="list-modal-addUsers-searchArea-result-user-name">'
							+				'<span title='+value.users_name+'>'+ value.users_name +'</span>'
							+				'<div class="list-modal-addUsers-searchArea-result-user-id">'
							+					'<span title@='+value.users_id+'>@'+ value.users_id +'</span>'
							+				'</div>'
							+			'</div>'
							+			'<div class="list-modal-addUsers-searchArea-result-user-checkbox">'
							+				'<div class="checkbox">'
							+					'<div>'
							+						'<input type="checkbox" class="list-modal-addUsers-searchArea-result-user-checkbox-input" id='+ value.users_id +' name = '+value.users_id+' value="'+ value.users_name +'" checked/>'
							+						'<label class="checkbox-label" for='+value.users_id+'>'
							+							'<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>'
							+						'</label>'
							+					'</div>'
							+				'</div>'
							+			'</div>'
							+		'</div>'
						);


					}

					 console.log( value.users_id );
				});
				$('.list-modal-addUsers-searchArea-result').append('<sc'+'ript src="/js/list_users_checkbox.js"></scr'+'ipt>');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {         // HTTPエラー時
				console.log("XMLHttpRequest : " + XMLHttpRequest.status);
				console.log("textStatus     : " + textStatus);
				console.log("errorThrown    : " + errorThrown.message);
			},
			complete: function() {      // 成功・失敗に関わらず通信が終了した際の処理
			}
		});
	}
	$('.verification-modal, .verification-modal-button-cancel').on('click',function(){
		verification_modal_close();
	});	

	$('.verification-modal-button-destruction').on('click',function(){
		verification_modal_close();
		post_modal_close();
	});


	function verification_modal_close(){
		console.log( $("input[type='file']").val());
		console.log(file_array);
		$('.verification-modal').stop(true, true).fadeOut('500');
		$('.verification-modal-content').stop(true, true).animate({
			opacity: 0,
			display: "none"
		}, 200, function(){
			$('.verification-modal-content').hide();
		});
	}
	$("#search_text").on("input", function() {
  //      document.getElementById("id_count").innerText = idStr.length+"/24";
		searchStr = $(this).val();
		clearTimeout(searchTimer);
		searchTimer = window.setTimeout(search_for, 700);
	});
	$('#modal_submit').on('click',function(){
		console.log($("#isPublish").prop("checked"));

		postForm($('#text').val(), list_icon_value, list_user_id_array, $("#isPublish").prop("checked"));
	});	

	$('.btn-square').on('click', function() {
		$('.modal').stop(true, true).fadeIn('500');
		$('#list-modal-content').show().stop(true, true).animate({
			top: "50%",
			display: "fixed",
			opacity: 1.0
		}, 500);
	});        

	$('.btn-square-small').on('click', function() {

		$('.modal').stop(true, true).fadeIn('500');
		$('#list-modal-content').show().stop(true, true).animate({
			top: "50%",
			display: "fixed",
			opacity: 1.0
		}, 500);
	});

	$('.modal').on('click', function() {
		$('.modal').stop(true, true).fadeOut('500');
		$('#list-modal-content').stop(true, true).animate({
			top: "-1000px",
			left: "50%",
			opacity: 0
		}, 500, function(){
			$('#list-modal-content').hide();
		});
	});

	$('#modal_cancel').on('click',function(){
		$('.modal').stop(true, true).fadeOut('500');
		$('#list-modal-content').stop(true, true).animate({
			top: "-100px",
			opacity: 0
		}, 500, function(){
			$('#list-modal-content').hide();
		});
	});	

	$('#text').focus(function(){
		$('.id_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.id_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});

	$('#text').change(function() {
		const str = $('#text').val();
		if(str===""){
			const result = $('.listName_string').removeClass('keepfocus');
		}else{ 
			const result = $('.listName_string').addClass('keepfocus')
		}
	});
	$('#search_text').focus(function(){
		$('.search_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.search_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});

	$('#search_text').change(function() {
		const str = $('#search_text').val();
		if(str===""){
			const result = $('.search_string').removeClass('keepfocus2');
		}else{
			const result = $('.search_string').addClass('keepfocus2')
		}
	});
</script>
@endsection
