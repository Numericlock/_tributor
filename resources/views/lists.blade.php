@extends('layouts.app')
@section('title', 'リスト')
@section('cssJs')
	<link rel="stylesheet" href="/css/list.css">
@endsection
@section('content')
		<div class="content">
			<div class="content-title">
				　<span>リスト</span>
			</div>
			<div class="content-wrapper">
				<div class="lists-wrapper">
					@foreach($lists as $list)
						<div class="list-content" data-list="{{ $list->id }}">
							<div class="list-icon">
								<img src="/img/2.jpg">
							</div>
							<div class="list-title">
								<p class="list-title-p" data-value="{{ $list->name }}">{{ $list->name }}</p>
							</div>
							<svg class = "list-angle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 20"><g><path d="M13.25 10L6.109 2.58a.697.697 0 0 1 0-.979.68.68 0 0 1 .969 0l7.83 7.908a.697.697 0 0 1 0 .979l-7.83 7.908a.68.68 0 0 1-.969 0 .697.697 0 0 1 0-.979L13.25 10z"/></g>
							</svg>
						</div>
					@endforeach
				</div>
				<div class="list-create-btn">
					<button type="button" class="btn-square">リストを作成する</button>
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
					<img src="/img/2.jpg">
                </div>
                <div class="list-modal-listNameInput">
                    <div class="id_box box">
                        <div class="id_inner inner">
                            <input id="text" class="text" maxlength="24" type="text">
                            <div class="listName_string string">Listの名前を入力</div>
                        </div>
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>
                <div class="list-modal-isPublish">
                    <span>公開</span>
                    <input type="checkbox" id="isPublish" value="" />
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
					<div id="uncode_area"></div>
                </div>
            </div>
        <div class="modal-control">
            <button class="modal-positive-button" id="modal_submit" type='button'>作成</button>
        </div>
    </div>
	<form method="post" id="postForm" name="showListMember" action="/lists/member">
		<!-- CSRF保護 -->
       @csrf
	</form>
	<div class="attention-modal-content">
	</div>
	<div class="attention-modal">
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
		var list_icon_value ="";

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

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

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
		
        function postForm(nameVal,iconVal,list_userVal,isPublishVal) {
        /*    var form = document.postForm;
            var name_request = document.createElement('input');
            var icon_request = document.createElement('input');
            var list_user_request = document.createElement('input');
            var isPublish_request = document.createElement('input');
            console.log(list_userVal);

            name_request.type = 'hidden'; //入力フォームが表示されないように
            name_request.name = 'name';
            name_request.value = nameVal;

            icon_request.type = 'hidden'; //入力フォームが表示されないように
            icon_request.name = 'icon';
            icon_request.value = iconVal;

            for(var i=0;i<list_user_id_array.length;i++){
                list_user_request.type = 'hidden'; //入力フォームが表示されないように
                list_user_request.name = 'list_user[]';
                list_user_request.value = list_userVal[i];
            }

            isPublish_request.type = 'hidden'; //入力フォームが表示されないように
            isPublish_request.name = 'isPublish';
            isPublish_request.value = isPublishVal;

            form.appendChild(name_request);
            form.appendChild(icon_request);
            form.appendChild(list_user_request);
            form.appendChild(isPublish_request);

            form.submit();
				
*/			console.log("ごみ");
			var publish='0';
			var hidden='0';
			if(isPublishVal === true){
				publish='1';
			}else{
				hidden='1';
			}
			
			var data = {
				name: nameVal,
				//icon: iconVal,
				users: list_user_id_array,
				publish: publish,
				hidden: hidden
			};
			
			// 通信実行
			$.ajax({
				type:"post",                // method = "POST"
				url:"/lists",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				success: function(json_data) {   // 200 OK時
				$('.lists-wrapper').prepend(
					'<div class="list-content" data-list='+ json_data.id +'>'
				+		'<div class="list-icon">'
				+			'<img src="/img/2.jpg">'
				+		'</div>'
				+		'<div class="list-title">'
				+			'<p class="list-title-p" data-value="'+ json_data.name +'">'+ json_data.name +'</p>'
				+		'</div>'
				+		'<svg class = "list-angle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 20"><g><path d="M13.25 10L6.109 2.58a.697.697 0 0 1 0-.979.68.68 0 0 1 .969 0l7.83 7.908a.697.697 0 0 1 0 .979l-7.83 7.908a.68.68 0 0 1-.969 0 .697.697 0 0 1 0-.979L13.25 10z"/></g>'
				+		'</svg>'
				+	'</div>'
					
				);
					modal_reset();
					
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {       // HTTPエラー時
					console.log("Server Error. Pleasy try again later.");
					console.log(data);
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
					//error原因不明　要改善　内容:JSON.parse Error
				},
				complete: function() {      // 成功・失敗に関わらず通信が終了した際の処理
				}
			});

        }

        function show_list_member(list_id) {
				var form = document.showListMember;
				var list_id_request = document.createElement('input');

				list_id_request.type = 'hidden'; //入力フォームが表示されないように
				list_id_request.name = 'list_id';
				list_id_request.value = list_id;

				form.appendChild(list_id_request);
				document.body.appendChild(form);
				form.submit();
        }
        function append_box(name, id){
            $(".list-modal-addUsers-IntendAdd").append(
                '<div id="'+id+'_box" class="list-modal-addUsers-IntendAdd-box">'
			+		'<svg class="list-modal-addUsers-IntendAdd-box-close" id="'+id+'_box_remove_button" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465 52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/></g></svg>'
			+		'<div class="list-modal-addUsers-IntendAdd-users">'
			+			'<span class="list-modal-addUsers-IntendAdd-users-name">'+name+'</span>'
			+			'<span class="list-modal-addUsers-IntendAdd-users-id">@'+id+'</span>'
			+		'</div>'
			+	'</div>'
            );
			$("#uncode_area").empty();
			$("#uncode_area").append(
					'<script>$(".list-modal-addUsers-IntendAdd-box-close").on("click",function(){var str = $(this).attr("id");remove_check(str.slice( 0, -18));remove_box(str.slice( 0, -18));console.log(str.slice( 0, -18));});</sc'+'ript>'
				);
			/*
			<div class="list-modal-addUsers-IntendAdd-box">
				<svg class="list-modal-addUsers-IntendAdd-box-close" id="modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
							52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
					</g>
				</svg>
				<div class="list-modal-addUsers-IntendAdd-users">
					<span class="list-modal-addUsers-IntendAdd-users-name">Numericlock</span>
					<span class="list-modal-addUsers-IntendAdd-users-id">@numericlock</span>
				</div>
			</div>
			*/
        }
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

		function list_content_get(id){
            $.get("list_select.php",{'list-id' : id},function(data){
            });
		}

		$('.list-content').on('click',function(){
			show_list_member($(this).data('list'));
            console.log($(this).data('list'));
		});

        $("#search_text").on("input", function() {
      //      document.getElementById("id_count").innerText = idStr.length+"/24";
            searchStr = $(this).val();
            clearTimeout(searchTimer);
            searchTimer = window.setTimeout(search_for, 700);
        });
		$('#modal_submit').on('click',function(){
            console.log($("#isPublish").prop("checked"));
			var target = document.getElementById("modal_submit");
			target.disabled = true;
            postForm($('#text').val(), list_icon_value, list_user_id_array, $("#isPublish").prop("checked"));
		});

        $('.btn-square').on('click', function() {
			console.log("????");
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

