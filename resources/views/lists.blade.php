@extends('layouts.app')
@section('title', 'リスト')
@section('cssJs')
	<link rel="stylesheet" href="/css/list.css">

    <link rel="stylesheet" href="/css/proedit.css">
    <link rel="stylesheet" href="/css/modal.css">
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
								<img src="/img/list_icon/{{ $list->id }}.png" onerror="this.src='img/list_icon/default.png'">
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
					<label>
                        <img class="profile-image" id="preview" src="../img/addimg.png"><br>
                        <input type="file" id="dotRadius2" accept="image/*"　 stylesheet="display:none"hidden>
                    </label>
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
                </div>
            </div>

        <div class="modal-control">
            <button class="modal-positive-button" id="modal_submit" type='button'>作成</button>
        </div>
    </div>

    <div class="modal2">
	</div>
	<div class="modal-content3">
	<input id='scal' type='range' value='' min='10' max='400'  style='width: 300px;'><br>
<canvas id='cvs' width='300' height='400'></canvas><br>
<button id="crop_img">CROP</button><br>
<canvas id='out' width='200' height='200' style="display:none"></canvas>
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
			console.log("wwwwwwwwww");
			var publish='0';
			if(isPublishVal === true){
				publish='1';
			}
			
			var data = {
				name: nameVal,
				icon: base64,
				users: list_user_id_array,
				publish: publish
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
                    $('.modal').stop(true, true).fadeOut('500');
			        $('#list-modal-content').stop(true, true).animate({
                        top: "-100px",
				        opacity: 0
			         }, 500, function(){
                    $('#list-modal-content').hide();
			         });
				$('.lists-wrapper').prepend(
					'<div class="list-content" data-list='+ json_data.id +'>'
				+		'<div class="list-icon">'
				+			'<img id="preview2" src="/img/2.jpg">'
				+		'</div>'
				+		'<div class="list-title">'
				+			'<p class="list-title-p" data-value="'+ json_data.name +'">'+ json_data.name +'</p>'
				+		'</div>'
				+		'<svg class = "list-angle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 20 20"><g><path d="M13.25 10L6.109 2.58a.697.697 0 0 1 0-.979.68.68 0 0 1 .969 0l7.83 7.908a.697.697 0 0 1 0 .979l-7.83 7.908a.68.68 0 0 1-.969 0 .697.697 0 0 1 0-.979L13.25 10z"/></g>'
				+		'</svg>'
				+	'</div>'
					
				);
                    
                    document.getElementById("preview2").src = base64;
                    modal_reset();
                    document.getElementById("preview").src="../img/addimg.png";
                    $('.list-modal-addUsers-searchArea-result').empty();
                     $('.list-modal-addUsers-IntendAdd').empty();
                    
					
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
								+				'<img src="/img/icon_img/'+value.users_id+'.png">'
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
								+						'<input type="checkbox" onchange="checkbox_change(this)"  class="list-modal-addUsers-searchArea-result-user-checkbox-input" id='+ value.users_id +' name = '+value.users_id+' value="'+ value.users_name +'" />'
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
								+				'<img src="/img/icon_img/'+value.users_id+'.png">'
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
								+						'<input type="checkbox" onchange="checkbox_change(this)" class="list-modal-addUsers-searchArea-result-user-checkbox-input" id='+ value.users_id +' name = '+value.users_id+' value="'+ value.users_name +'" checked/>'
								+						'<label class="checkbox-label" for='+value.users_id+'>'
								+							'<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>'
								+						'</label>'
								+					'</div>'
								+				'</div>'
								+			'</div>'
								+		'</div>'
							);


						}
					});
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
		
		function checkbox_change(id){
			if($(id).prop("checked")==true){
				append_box($(id).val(), $(id).attr("id"));
				list_user_id_array.push($(id).attr("id"));
				console.log(list_user_id_array);
			}else{
				remove_box($(id).attr("id"));
			}
		}
		
		$('.list-content').on('click',function(){
			window.location.href='lists/'+($(this).data('list'));
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
        
            $('#dotRadius2').on('change',function(e){
            
             var reader = new FileReader();
             var file = e.target.files[0];

                reader.onload = function(e){
                console.log(e.target.result);
                load_img(e.target.result);
                };
                reader.readAsDataURL(file);

                
			$('.modal2').stop(true, true).fadeIn('500');
			$('.modal-content3').show().stop(true, true).animate({
				top: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);

		});	
		$('.modal2').on('click',function(){
			$('.modal2').stop(true, true).fadeOut('500');
			$('.modal-content3').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('.modal-content3').hide();
			});
		});			

		$('#modal_cancel').on('click',function(){
			$('.modal2').stop(true, true).fadeOut('500');
			$('.modal-content3').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content3').hide();
			});
		});	
		$('#modal_next').on('click',function(){
			$('.modal-content2').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('.modal-content').stop(true, true).animate({
				left: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});	
		$('#modal_back').on('click',function(){
			$('.modal-content').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('.modal-content2').stop(true, true).animate({
				left: "120%",
				opacity: 0
			}, 500, function(){
				$('.modal-content2').hide();
			});
		});
    var base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAgAElEQVR4Xu2dCbCVZRnH31vRQgtSsZQQJQZomQUYRYSQRSSkRbQwZBqIKDExjGNqozaDTqPjmsM4mo0LqbRoklpBG21kStBCShSGmRFLtFBm2HKb30v/w3u+e84931m+73zL887cueee+y3v97zP/3v25+3p7e3tdTYSocDOnTvdn//8Z/eb3/zGX3/Xrl1u//79/vOBAwfcb3/721j3HTVqlHvWs57ljx08eLAbMmSI/3zkkUf6v4cPHx7rOnZQ8xToMYA0T7TwjP/+979u+/btHgh79uxxO3bs8J8BR5pjxIgRHiyACcAMGjTIjRkzJs0pFPJeBpAmlxUJsHXrVrdt2zb3q1/9yu3du7fJK6R7+LBhw9zYsWM9WI466ij3vOc9L90J5PxuBpAGC/j3v//dAwIwAIrdu3fneslf+tKXerAAmnHjxrmBAwfm+nmSnrwBpAaFUZk2btzoQZG2qpT0gkevj2oGWCZNmuTVMxvVFDCA/J8eGNAPPPCA/9m3b18p+QTjf/LkyW7ixIlu6NChpaRB9KFLDRDsiU2bNrnvfe97hZcUzXI70mTKlClu/PjxpbZbSgeQf/3rX27z5s1ehdqyZUuzfFPK4wEJPxMmTHBPe9rTSkWD0gAEYCAp1q5dW4lFlGqlO/Cwhx12mJs1a5aXLGUBSuEBQkBu/fr17lvf+pYBowMg4RIAZcaMGW7q1KluwIABHbpqNi9TWID84x//8BLj61//unviiSeySf2cz+oFL3iBmzlzppcoivTn/JH6TL9wAAEYSAt+nnzyyaKtVyaf57nPfa6XKNOnTy8cUAoFEEBx7733GjC6BCOAMmfOHC9RijIKARCSAW+//Xb3+OOPF2Vdcv0cr3jFK9z8+fPdyJEjc/0cTD7XACEN5Etf+pLbsGFD7heiiA9wwgknuNmzZ+c6nSW3AMEAX7NmjRngGUcWhvzcuXN9KkseR+4AQg3F6tWrfVq5jfxQgATJefPmOZIl8zRyBRAM8Pvuuy9P9LW5BhQguPjud7/be7zyMnIBEGyNG264wWfX2sg/BY455hi3YMGCXNgmmQcIoLj++uvN1sg/LqqegGj84sWL3RFHHJHpJ8s0QEylyjTvtD25PKhcmQSIqVRt816uLpBllStzADGVKle83bHJZlXlyhRAqOa75ZZbHJ1CbJSPAs94xjPcokWL3Gtf+9rMPHxmAELW7V133ZUZwthEukeBU045JTP5XJkACOki69at696K2J0zRwHiJaTSd3t0FSCoUqtWrXL3339/t+lg988gBaZNm+aj790cXQMIJbAE/6wuvJvLn/1702Fl4cKFXSvx7QpAKGpauXKle+SRR7K/QjbDrlPgVa96lQ8qdqNqMXWAAI4rr7zSaje6znb5msDo0aPdsmXLUgdJqgBBrbr66qtNcuSLNzMzWyTJ0qVLU1W3UgMIBvl1111nNkdm2C2fE8EmIVaS1kgNIAQAzVuV1rIW+z5UKr7vfe9L5SFTAYjFOVJZy1LdJK04SeIAsQh5qfg21YdNI+KeKEDIrbrppptSJZrdrDwUIF0e92+SuVuJAeShhx7ysQ5LPCwPw3bjSUlwXL58ud+vMYmRCEDYo+/iiy+2KsAkVsyu2YcCpMpfeOGFiWzT0HGAIDGuuOIKi3UYI6dKAWIkH/3oRzt+z44DxDxWHV8ju2BMCiTh2eooQLA7rr322piPY4cZBTpLAYz2s88+u6P2SMcAYnZHZxfbrtYaBTptj3QEIGZ3tLaYdlYyFOikPdIRgJjdkcxC21Vbp0Cn7JG2AUKv3EsvvdTiHa2vpZ2ZAAWwRz7xiU+44cOHt3X1tgHyyU9+0gESG0aBrFFg3LhxPojYzmgLIGxBwMY1NowCWaXA6aef7o477riWp9cyQOh+eMEFF9h2Zy2T3k5MgwLsT3LJJZe0XInYMkCsviON5bV7dIIC7dSPtAQQ9gS87LLLOjF3u4ZRIHEKYLCTq9XK5j1NA4SYB4mIO3fuTPzB7AZGgU5RgI1FzzvvvKYv1zRA2Gr5C1/4QtM3shOMAt2mwKmnnuomT57c1DSaAggtez7+8Y+bYd4Uie3grFCAfdwxDQYMGBB7Sk0BxDa0iU1XOzCjFKDZA0Z73BEbICY94pLUjssyBXD7EtyOK0ViA8SkR+Nl7+3tdT09Pf5APjPCv+v9LzwOJ4iO0x3Dv2vdQ/fDWxPeu/GMy3lEM1IkFkBMesRjJJj36U9/uj/43//+t//MdyHTw8R8T5/ZgQMHOvTiZz7zmf6Nxvf/+c9//Ll0ofznP//poP2BAwf8T1jfD2i4tgDD/3TvWiCL9wTlOKoZKRILICY94jGOpAYgEOPC8DAzAGBhDj/8cPeSl7zEDRo0yNdQP//5z3fPec5zPGBoQABzP/XUUx4cTz75pPvLX/7iQbJ//373+9//3rvXn3jiCX+cJEZ0dppHvFmX86i4UqQhQHiTnXvuudaAIQYfiTH1pofhAQc+eGoURowY4bNLAQbf64fjePvzN+dKMkj68Bup8qc//cnt3r3b/fKXv3QPP/ywo0iNcwAhYOEz6yVJFlXVYjxCaQ550Yte5FNQ6r1kKuptb4PXjcU94vMMzC0pAHMiLd74xjc6dnFFUggIgEFAEGPXkgICilQnpAoDQDz22GNuw4YNjjJnJA3XRg2TtOL61nKp/7WLExfpV4LwNiLugXi30ZgCMClv+mc/+9nu+OOPd29961u9nQGjS5rUuwpML4aWZJENE5UE4XGPP/64u+222zxguDf3kVrXeMblPmLIkCFuxYoV/UqRfgHywx/+0N16663lpmITTw9zku8zY8YM3+1PahOXkOGMxICBNcK3vOwWAUJACc+t5cXiRfaDH/zASxRUMIBiIx4FzjrrrH47M/YLEDa6Yd9yG4coEDJxaJTTLAA7Y8qUKW7kyJFV3iWAI9UI5kUV+utf/+olM+oRqhPfwegACINeXi4Z8ni7+E6gkxcLsElqPProo+473/mO27Ztm/vb3/5WMeTl4TKVqy8nH3vssW7JkiV1WbwuQDAAUa+MqNW0k/dIxjEuWmwNcnxe97rXeVsjatbxN56nPXv2uF27dnlvFL8BiQACcPjhWACCmsYPAMH7NWzYMC+duBeqgbYj43gZmoAFLxeS5Oc//7nbt2+fBxReMeapeZmX69Ca8nK5/PLLvSpca9QFiHVlr/1SARgwJECBoceMGePe8pa3uKOPPtozod7oUo+QDpQHYExTmownimIzmFZSQC8hMXo0oMj/AQRSCqCMHTvWSys+h+fI67V37163ceNG9/3vf9+7iQU6A0jtNe2vS3xdgJDSjgFoo5oCYmqB4x3veIdvVAYDS7rIzkBC0OH+pz/9qQcGUgQ1iqGAobxNoSEe2iACozxkMDlxkyOOOMJNmjTJoSJwvLxn8pChAVAS/Y1vfMPfL3Qf87e5gA+tKy85Gs7FliC/+93vvI/YRl8KICH4Qd2ZM2eOZ1AxZRjJRtWhHRI7+WJfAKgogEIXryROGEuR+hQ18JFUAAL1C5sHCYZaFsZWmDkBRuaAs0XqWyO/f1nXnPwsYiPRUVOCWJ+r+mwCs6KvkhH6tre9zTMmTCepAVNv377d3XXXXd7OgEklXaR+cSySROpaGBgUKCRh5JEKDX3NDjWNawOSmTNnusGDB1cmrqAjUuyzn/1sZW9I5itpUlYw1Hruen20+gAE4p1//vled7XRlwJICUTy3LlzvcEsFUkqDvbGnXfe6e0NmB0gKM9KjCkDP7Q1QrUqtBXCfC4BMQoujiEYefLJJ1f6QEmaIL3QCAAJRrvOtbWtpgD2HDGRhhIEty7u3TKPkHGVtiFDGjF80kknedUKWwCGU5Lhjh07HM4NUkE4T8E/qVKSBlHDWrSO2gVyKYeBQdkvtUA0fvx4d+KJJ3qQCCAcj1MANWvt2rXeDgqfT+phmddbz06XHlz04egjQehzhXFX5iHmUmYt7lYGzIQ7F8OcZEMNGB+J8bWvfc3bHHiuwoCeDPtOu1eVgyVDHtXvDW94g7dJALLUPn4TQPzyl7/sfvGLX3jgKr8L6abIezjnMq7/29/+dm9X9guQiy66yBOzzCNkZNkHinegWuG1Co1dPFT33Xef+/GPf+wNcoZsCYEjCXoiWWBwOQC414tf/GLHQuPhUqyE77FXtmzZ4m0jVC3OY66SIGEGchJzzcM1azV2qJIgRHbPOeecPDxLonNUPEE6PwwIQ5FCgvSA8WRHwKTf/e53vfRAlZEKJLVL8Y56SYntPIgMeXnWZMgD4NmzZ1eALFUPu/Luu+92mzZt8l4wJJ3OaWceRTkXel5zzTVVTeaqAEJw6TOf+UxRnret54BYAAPmQnqg13/oQx9yL3/5yyvuWkCCO5edfImOc7xAJYAozYPJJJGVIPDKrkAqoGqRLIk9wtzD4Ob999/v1qxZ420Rng3gS0pK8rVFuJyfzDZuBGE1qgBi9sdBssgGkYcKG2TChAnuAx/4QCVlQ2rLunXrHCUBHCtpofQORbDlck2CdyTtuHbowqX25IMf/KCvRdHgWBwJeNlwRUsChddIYo55umbUDqkCiNkfB5dSNoiSAFGp3v/+97vXv/71lcRAmItMA14q6m7PG1nJhPJYyU2blAEsSce8uZcMcz6/5z3vcVOnTq2oUcwPNfqee+7x+VoKbMpo1995YuhOzzVqh1QAQmpCK53nOj3BLFwvTEjkMwG4ZcuW+dyn0EWK6xSdnszZWkZuNKeq088m0EUj7roPi7106VLvjpZthFv629/+tvdohQFKSc5OzzFv12MdCXMoebECENvK4NBShvEH1BZ0UqrPSDnX/8jCRVVBp5ftkSVmAJzMHZ2avC153Zg/mb4EDkOnQlI2UpZoEncu4ZYJFYDceOON3k1p45CaBTNhf+AbJ/4RVgWSRkIl369//etKxWCn4xztrIViI6Sg4NHS3JGIOBQohMPBoBqUpKVdO8+S9rmopfPnz/e3rQAE966V1h5cCqlL6OaoJ1SdkV6itzBMRrT85ptv9jUdMJe8VlnJkmUeyjhm/iQ2SkrgwVq1apXbunWrdyzIBZ0lgKcNivB+YdqJBwiitl66bzcn2q17h8E9IuaLFi1yo0ePrgCEty4ucQz0MAqtrNtuzbvWfQkcomYNHTq08m9cwXfccYePh0iChLGfLM2/G3PhhXHttdcezJAGILj8qKqyUa1eIRV4m5x22mneXSqjFqbCZsMbJG9VmIiYBTrKcAfgZ5xxhp+/pBvz//znP+9+9KMfVerjDSDVq8YGoJQ0eIBQ8I/RZuMQQMRMEAmjTZuv8D0RaAqRiH+Qzq6RFfWK+Uhdolx34cKFvgrR69T/772Fg4GKQwHc1Ktq7l+8eLEj+dMDhP0+WGwb1RSAmYign3nmmV6SiPHQ27/61a96dymfNWS7ZIGO8rYRw0FFxBMnqcJvan5o8IA0kWpomb2HVg7Hxjvf+c6DAFm5cmWloCYLi5uFOSiaju5O1wvp8DAXoCB1HCmiIJvezll5EzMP9QBGggggClwCEHLIeJawJj4r8+82D5DsuWDBgoMAoXsJGZ42DlIgdHkiOdDhSd3QWxkVC+b6yle+4hlMaedZox/PQZcVJAgJjAxF2lGxiKarVakBo3r1WG/2Nex56qmnevFyJJFIlzWGaWY+Ko+lruLDH/6we9nLXlap+wYgGLhf/OIXK1WDWUwXh+mxQZYvX15lQxHkXL16tffEyQunuEkzNCrysaimeLJ6HnvssV5r0NB3qdVFhEAhKhZZvEoN5637k5/8xDs2YMKsdjLkGegkjwsfoGgQByHI+bOf/awKIPLSFZnxm3k2Gjn0PPjgg72W4l5NNgXOlM2LkU4rUdklAILKQZjsj3/8Y1W6eDMLkMaxNM8mC1nFU9yTORPDIQtANpRJkL6rgWbVc8899/RSDWfjEAWiaRd0L6G2QglsAIcqQlQsel5pJJWx2+raYJBjaNLQIWwLRN8BAoV/+MMfKk3wVAAWVkq2et+inMceIj233XZbb9lr0GstqNQNmIxC/o985CO+s6GMWaLRvFjWr19feQvrf9F4SJJltzA0Kh/qXwhQPpOFzFuQVqVh2yDsJ4x0MijCmnRlMReFwdt9DmpDej796U/3WpJiNSmlSqllD5IDRgMoMsZhQOwQarxp9dlf3UdSAGEOKpJSx/hQ+qFeUROCJ0sDB4Nc1KiKChxq/u0yVZHOJ2mx56qrruol8c5GXztE+20AClr90C0krOGmxhtdnk4hevum7S5VVaAaMEiaAGpKhF/zmtdUgQDVkDQTzVmp+urrlfb8s8x3PpK+YsWKXuvB23eZwjcxzD9u3DifsoGapcgzzEXvXYJuZEKr9jutRZdkUoRcMQ6Y/aijjvLGOcmKYb0KwMB2Qupxvvp6Wbp731Ujg7vnYx/7WK91UazN0tLpAQRqCkbbxIkTK2W1/B+XKWoWMQX1v00LIGHqSGj/YHPQfYU3IOn6AjTxD4KbBDnVYVHnSVqmNfc83McnKy5btqwXwtnoSwF1/VCtOeoKPVzD1HEYTI0Q+J3mkOcprEcBEKRJ0KIII122Bc/ABjtID35rSAoZQPquHEFiA0gdjlZcQF4iGA2G482M8av2PgAE/f/BBx/0bUfR8aN6fFLuXxnYPILa96AW4JKmzDY04nkJkpBKgiUZyGHcI8wCMBvkEEN4gCxZsqQ3q5HgNN/G0XtFbRCYCN2ewik1ruYcMRdqKrlNqC98FsNGPVihKhTaEI2eVZ41zlevrahbmdoPMlBpUaQSWz0HTbU/97nP+c0+w3nz2eyP2tQn+6DnjDPO6G20OPb/QxSgERveLFQYBQ55wSBhsEfQ8QEKTBy29pQUiQbi6sVOdMcQDLIlVJyliD/HAo43v/nNfmdd0mNC6UK8gy4mSLm07aQ88w7qqgGkyRWE8chveu973+uLkFRDoTc83iw6F9ISqJ6XSOcoC7hRnERveAEkdMkqZ4x4B42rAa3sCc4j21jlwUqdiQYymyRBaQ43gLSw1PIcocbQ7QS7REyqNzt9sujVC0iUzBhmzSpKL7dwf0mCgCFsrMBnAKYGdbhx6VwCOOTm1XXVXILMXdy6ApgBJN7CG0Di0anqKDGZthqYPn26T+UIt2OGUfXmRq0hzqSu7xynYB7MH+5ZWGs6tVQw1DziMRjiRHupXSAZkWMllbR5KDEacq6kBgpELTx66U7xADEjvfl11xsaQxyXKsmML3zhCyuBwnAXJ3Z3YtsBEgTZBpo2QZJCYaOHem91qW5yOWM44p9ny+lXv/rVPo09jIdwPOB4+OGHfUkt903Ki9Y85fJ1hjfSLQ7S3KJJHVLfXohIKvyb3vQmn6vF98pxgln5DMPyFqdhG318AQ2tXpEqAkm9WSAt+AGAo0aN8nUpFG8htcK9z5WsiDuXzol0fMRzheNA0iWLbYmao366R1scpAV6h65ZxRlgQEpa2UyTOIT2DwnVI4DCDwxLV0ZsAmIm+o2nCcBwfVqcokIBCoBA0zdsDRpI8FkuXIFVrmbOp9cVsQ4AGapckkRWORp/0T1ALNUkPsEUMwhdqOqoiLoFA2OTHHfccRUjOvRQSY3ShjaSLkgY1DLZD1wTEAA09GA+hy5dzVj2BMfjGMC9zA/SSeCR5ypMphRYmnvy8h3tU00sWbG5hYfx5KaVKgU4NGBoIu1Es5EEYTyDz4pgh/sL6phaYKrneVIEHxBRIUiGLq1Ew9QRQMf/NU/N22ySeGvukxUt3T0esUJG1z4cekvLhSsAkNhIMHHatGk+aCcjOryTIuJ6m4fSRdeJgihMA+F4/g848FRh25BCoi4leNG0/bTmJ0O/kd3THEWKe7RPd7eCqeYWWKoKIFEaOcwKKFCxMNTxMKnVp5hadoLOD71W4Rs9KjGiNo/AEwYPAQOuZLxlGOZ0bcfWASDqeyXJZ9Ij/nr7gikruY1PMI4MU0ZgZgKFgOKVr3ylrxkh01dVfgrmcZ6MYzF2KH2i9oKKoCSpdE4tUIXxF6QHxjmqFu5dvGbYI8oL0zwsUBhvzX3JrTVtiEes8CgYDBcrUgJpQQIj3ib0fakzYQpKCBAMcjxXMC6f8TzB2Egj5V0pU5h7oKJh1+DV4ocAZZh9GxrfAi+qFjEXKkVpKoFE0fXlaGj+qct3hm/aYG1/+i58mPqh5ELZETA+jMt+hQQJUavUUic8Now5AAZsBJiWH/ahRwWCaQGUvFpicL3huZ5AggqHtEJCIbGInvNdKJHE/LJviIlwL5o00HcA4Ai4chbIljHPVl8+8G1/rHFcbYAoWg4Tw6Rq8kw84oQTTvDVejBsqHKFhjwAId6xefNm/yZXYBCpIeNbcYr+mFMBScVc+Fv2DmW19NxlTtEsYal0ir0gSb75zW96o16gANgquY02fSifvOj7xL5xnLUe7UsYvZXlJoXZ+EzuE12/YUrlUSk+AYPBjOj7vLUpTqJzIZIiahgLfIpRNDKcdQ+pSYqLIA1Qv1DzSHX3fvuensr9whQUzt22bZv3eGHQh+5qPks9tEDiQX6otB615tV9ASIdX/YETI+9MWvWLG+Mh29rHQsD8nYmkk2ah5oiKKgoUITqmyRH+F10NgIR34f7DIaGO0DBNiFAieeFCLBS4uVY0HUx3tn4B5CgcqkvFlKSIUlSdglSaV5t2x/UliCyIXiTIDne9a53+Rwo6fmyGwAINSAwHsCgLl2MJ1VGNoHe2gKVgNGfihW6h6MeNNXKC3z8xmEASPhNoBIAhLYRQEbdojwYkIRBxLD7SdkBUrX9gW2gU5sd8CChTlE9yBuFN7WGVCr628JwtNOh1FapJ9LtQ2kTGuFhfKM/ZgzjHfJYhaBRS1EF/7gHOVzYSMcee6xPcFSkXyoXc3vooYe8GkgJrlLxyw6K8PmrNtCxLdj6sgaSg3RywIHXiBG+iZEaVOqhUhF7wGOk/4uRw6tG1ajwWlE1KHqe3L6hZ0yGfhhYDF2+JDUCahIojz766EoZbnht4iVsAoT0Cx0HBhTnqrZgK+MmnqExy1tfyYJy2aKikE/Fb3mSpNeTGIjrlL68ZOHKTtA1pYaFqSGtMl09A17f6x7h83AvuXPZAIhqQ4z4MDeM4wE1Hja2k8MNzeBZsEfCwKZUxDIFGKs28SzjNtC8ldXNJczIBSgE/U4++WSvosAsYcwAdy2bX5I1S/GTPFehPdEqGDp9nqQUwJg8ebI7/vjjfXOHUBqiXiEJAQkqIs+DaslLAMOf51KNeycA3+lnTOJ60K1qG2hucs4553hjs2xDuruKigALnUGo82YoBoIej/FNlR4/gCOaVxVKkG7TkbkxZwDAgsP0pE4gSXANy2sF0+OKpoaELv8AQ543qW+SoGWRIEjdFStW+CX0exTy4cYbb/TR1rKM0PgNdXxUKnraHn744VVNn2E0pAYuUoDC+cq1ymJfMZY1DHAyX6LwNL6j4YTiHpImuKVx1mC8AwyBQvzQKFZTJL7BCzh//vxqgPD2oFN5WYaKjZT/BLOjitDOBwaKMgaeKvYDIQEw/J88SrI7skI/2Q3MDzAAcJgeVzXqIxWQSorkWFRLHA6AhM9Kmy9jDcnpp5/uY0pVEoRdbtnttkwj1KlRR1BBaMCAOsKQXUFsg5621JKH0exQxQprQrJAQ6lYsiEkKZAq1NDTgZGAooCNhEFtJNIOUMLGE1lSHZOmLS+Nyy+/3Jc2VwGEPy666CKfJlGmwRuSmgki5KeddppD/wwNbly4d999t08hV4segScqPbJkxIZpJlKZ5JnC+OZFQFGXYiSyO1CxkCIkVSJ51JMrdDEXmT/ImDjvvPMqj1ixQfgGFass27GFaR4wCZvNEFzTmxYGQy1hNyaMcnUgCUGRdUYJ7YZQCvA9Wcg0vmP/Qj0zv3H9sj0bbuxo7CZLL4CkaI8WAV00qgCCu68sO95qsfmNO3fevHk+OzeMJ/A2peGzMmDl8cq7N0fuXwq8eDHI9avUFaQlW1yr+YMkUBkAQoo72RM1AYKbF3dvGYYWG12TvrY0WghVEfRx8pXojIjXSpFmqVd5pxHPj7uXoiAMUiVC6vluuukmn6ovY10ZxXl/7v7mzzNec801VVtmV0mQstkhEIQG1IhUUsWVawXzkBrOzlHYINRwqIw2TypWPWZQEiXPG0oRBUT5zYsBxwRB5CwGQZMAatT+6GOkl80OwQgluozBiiSRegUgSCMheKaAIN6fsElDEguU5jXVH5jERjYopUIyrDak2OuWW27xyYwy0IuuYkXtj5oAIXHtyiuvTHOtunIvFhuPFTUexD0kIQAJnjykBzYIqhXHKihYlHoJGfA8F+olsZGwhJeIOnEfgqPa56ToALngggsqiak1bRC+5G1x/vnn+7ycIg/UCLJceXuSrRtm4BIUxJODkQoDKchWlGo7XgLaAx6mJ+sXNZMSXqlfvAjYBx6XL6koRR9hekn4rH1sEP5JsGjdunWFoUmtLFskhjogqt8tDwwzkALO8+stW7Q3pxI1laSJsY56Qa292p7yMkC9wptFYVXePXeNmJnNWZV/1xAgRIwvueSSRtfM9f9RJ2AK6iWwRZR6EuYk5foB+5m8goIyygEFMSC8eaGrG/c2QVK8WTqnqDShQYMyCxoChAMuvvhi/+Yo4mCx6QTCW4OtncNsVToTkriJcV7Uofwz5WvxnKgYCxcu9NsrSGKiWuKowN3N56JJUq0vPXjPPvvsmstdU8XiSIiCoVqUEZa48sZE72a3WlJM+J88VGybRkZBUZlBdmY0CREpesopp/gOKXJYQAPq7Mlgxh4Ly4eLwhc8B8+NJlFr1AUIBCF5sQiGqfKSxBwwANmsqBRkt+oZyTvipcBWzkXWuWVbKTNAdgep8NTCIFH5juMw1KEJqmcRAcKzkpyoHYujIKkLEA7E3YvbN+8jBAjeGYjYK9gAAAfcSURBVN6WeLAACNWDDBYftermm2/2QcIivBgarZtSSzhO7l6kKp+VxEhTCrZWKKq6TZrRkiVL6pKqX4Cgbtx6662N6JzZ/0fVKoAigGCUwgzUgCiNgqj5DTfc4HvZFlmCiC7aDkGtf1CvKBTCgSFpS1Yv+Wi8NIqodp511lk+/b/e6Bcg+MpRs/JciitdW13QeSbqPdhTECOdzwqE4bW5+uqrKxttZhb5bU6MF4Ii6ZIifEf/r0WLFlWSF7kNa49NRpfIogEE7YHS2v5Ux34BAoHonUSwKK9Db0sVEAkg1GYDEG0NAKMgQS677LKquo+8Pnd/8w4BogAp3xEwPfPMMz1A9D2JmnfccYd39RYNIKeeeqpvZtHfaAgQGOrcc8/NZTQ1XFA+y52LDYLXIsz75/+PPvqo+9SnPlXZ/LKI4OCZ5LVT21HVxlCzvmzZsspGocrBQoI88MADhWpLSsyDWF8jx0NDgEDQe++91+fl5HmEUXEYgyxe0rzDLZvJwcK9zSja2zK6dlI5w0pBbA+iydhloesbV28RnDUhDUjzJ3Og0YgFEMQstgjVZnkbYeWgAmPYJUiRsNxUvXbz+IytrEn4wpBDgozl0MWrl4R24y2K44K97Ymch5uvtmSkhyflWYpoYeW6lVgVYEI3sBinKMzQH3hCKakXiSSq6l4UNCyS2zuu9PDqqPpiNXoL5VGKiAG0+FIntPj8X7aJIull6CIYur9lk0Tzs/R3dCu5RnyS9f83Iz2aAkhRbJGsL6DNL1kKNCM9mgZIHqVIsuS2q+eJAjgfcOPHsT30XLFVLJ2Q97hInhbU5tpZCsSJe0Tv2DRA0ONJhScdw4ZRIC8UqNWQIc7cmwYIF6VmAlFlwyiQBwrglLnwwgt955pmR0sA4SZ0vCCAZMMokHUKEBDEOG9ltAwQ+iXRBaIsgbVWiGvndJ8CuHVJKdHOYc3OqGWAcKOybZnQLHHt+O5TINzKoJXZtAUQbkjIXvvbtTIBO8cokBQF6Bq5fPnyti7fNkAAx6WXXlqKCry2KG0np0oBDHM24qSLfTujbYBw86L10WqHoHZuNihQr89Vs7PrCECIjVxxxRXukUceafb+drxRoOMUYPsCtjHoxOgIQJgIXVAIIJahTWUnCG/XSIYChx12mI95aAu1du/SMYAwEZo9s7+0DaNANyiA3UEDOFo6dWp0FCBmj3RqWew6rVCgU3ZHeO+OA8TskVaW1s5plwKdtDsSBYjZI+0utZ3fLAU6bXckDhDZIytXrrT4SLOrbcc3RQFq6AkGdtLuSAUg3IRWMWwGacMokAQFMMoXL17cb2fEdu/bcRskOqGidYlvl+B2fuco0F9X9k7dJXGAmGerU0tl1wkpkITHqhaFUwEIN0bVQuWyYRRolwLTpk1z8+bNa/cysc5PDSC4f6+77jq3ZcuWWBOzg4wCtSgwceJE32A7rZEaQHgg+vzSPd1yttJa3mLdh1jH0qVLG/bT7eRTpwoQJk7rIDbmKeqGLJ1cHLvWIQqMHj3aN9ZutTKwVVqmDhCBhBiJSZJWl61c5yE5cOemDQ6o3BWASN1iNyezScrF7M0+LTYHu+822qag2evGPb5rAGGCGO6rVq2y7ihxV6tkx6XprapH2q4CRJOyisSScX6Mx00rztFoKpkACJO0iHujpSrP/9OIkMelZmYAwoQJJNKQrkh7UcRdCDvO+c17iHH0t+ts2nTKFEB4eLb6uv766610N21O6PL9SFnHU8VOu1kamQMIxKFrIx6uou2Ll6WFz9JcjjnmGLdgwQI3cODALE3LzyWTABGV8rztW+ZWOoMTwnWLMT5jxowMzu7glDINEFO5Mss3bU8sqypV9MEyDxBTudrmxcxdIMsqVS4BYipX5ni8pQnlQaXKNUCYPL2AV69e7Xbs2NHSItlJ3aHAmDFjfA1HK5vYdGfGObFB6hGHrRfWrFlj7uBuck+Me7M/x9y5c92kSZNiHJ29Q3Jhg9QjG+5g0lQ2bNiQPcrajBw7O82ePTuT7tu4y5NrgOgh2TPx9ttvtxqTuKue8HFsmDl//nw3cuTIhO+U/OULARCRiS2qiZ3YtnDJM06tO7AP+Zw5c9yUKVO6M4EE7loogEAfKhYBCj8GlAQ4psYlAQbBvunTp3elqCnJpywcQEQsgIIhT5awbcmQDAthgM+cOdNLjG5U+yXzVNVXLSxA9JgHDhxw69ev9xJl//79adC08PcgCo7EmDp1qhswYEChn7fwANHq0VEFibJ27VoDSossDTBmzZrlJUa3SmBbnHrLp5UGICFQNm/e7DZu3Gj18DHZZvz48Y6fCRMmlAYYIk3pABLyBCrXpk2bvGTZuXNnTHYpx2GjRo3ykgJgdGo7szxSrtQACRds165dvqKRn3379uVxLdue85AhQ9zkyZMdnUSGDh3a9vWKcAEDSI1V3L59u1fBKNgqumQZMWKEGzt2rE8FQWrYKJkXq90FJ51l69atHizbtm1zu3fvbveSXT2fZEESBwHFuHHjcp0GkgYhTYI0SWW2uxZY+L13794mr5Du4cOGDfNgECiIXdiITwEDSHxa1TySDiyoZABnz549Pg2fz2mrZqhKgwcP9mrS8OHD3aBBgzwobLRHAQNIe/Tr92xAAlhIpmTgCFCwkgAmtS1xBkyvSDUgwJhmsC8ffwMIG8lQ4H9rpp7KQ6m/+gAAAABJRU5ErkJggg==';
    const cvs = document.getElementById( 'cvs' )
    const cw = cvs.width
    const ch = cvs.height
    const out = document.getElementById( 'out' )
    const oh = out.height
    const ow = out.width
    
    

    let ix = 0    // 中心座標
    let iy = 0
    let v = 1.0   // 拡大縮小率
    const img  = new Image()
    img.onload = function( _ev ){   // 画像が読み込まれた
        ix = img.width  / 2
        iy = img.height / 2
        let scl = parseInt( cw / img.width * 100 )
        document.getElementById( 'scal' ).value = scl
         if(img.width>=img.height){
       	    document.getElementById( 'scal' ).min = (100/iy)*100
        }else{
        	document.getElementById( 'scal' ).min = (100/ix)*100
        }
        scaling( scl )
    }
    function load_img( _url ){  // 画像の読み込み
        img.src = (_url);
    }
    
    function scaling( _v ) {        // スライダーが変った

        v = parseInt( _v ) * 0.01        	  
        draw_canvas( ix, iy )  
        console.log(v);
             
    }
      
      $("input[type=range]").on("input",function(){
          var val = $(this).val();
          $(this).attr("value",val);
        v = parseInt(val) * 0.01        	  
        draw_canvas( ix, iy )  
        console.log(v);
          
          });

    function draw_canvas( _x, _y ){     // 画像更新
    	console.log(_x);
    	console.log(_y);
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る

       	  if( _x <= 100/v){
              _x=100/v+1;
       	 }
      	  if(_x >= img.width-(100/v)){
				_x = img.width-(100/v+1 );
      	  }

        if( _y <= 100/v){
			_y=(100/v+1);
        }
        if( _y >= img.height-(100/v )){
			_y=img.height-(100/v+1);
        }



              ctx.drawImage( img,
      	      0, 0, img.width, img.height,
     	       (cw/2)-_x*v, (ch/2)-_y*v, img.width*v, img.height*v,
        )
        ctx.strokeStyle = 'rgba(200, 0, 0, 0.8)'
        ctx.beginPath();
        ctx.arc( 150,200,100, 0*Math.PI/180,360*Math.PI/180);
        ctx.stroke();
        ctx.closePath();
    }
     
    $('#crop_img').on('click',function(){
        $('.modal2').stop(true, true).fadeOut('500');
        $('.modal-content3').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content3').hide();
			});
        
        // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img, 0, 0, img.width, img.height,(ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,)
               
      base64 = out.toDataURL("public/img/png").replace("public/img/png", "public/img/octet-stream");
        console.log(base64);
    document.getElementById("preview").src = base64;
        
    $('#dotRadius2').val('');
 
   
    });

    let mouse_down = false      // canvas ドラッグ中フラグ
    let sx = 0                  // canvas ドラッグ開始位置
    let sy = 0
    cvs.ontouchstart =
    cvs.onmousedown = function ( _ev ){     // canvas ドラッグ開始位置
        mouse_down = true
        sx = _ev.pageX
        sy = _ev.pageY
        return false // イベントを伝搬しない
    }
    cvs.ontouchend =
    cvs.onmouseout =
    cvs.onmouseup = function ( _ev ){       // canvas ドラッグ終了位置
        if ( mouse_down == false ) return
 		ix += (sx-_ev.pageX)/v;
 		iy += (sy-_ev.pageY)/v;
       
		if( ix <= 100/v ){
			ix=(100/v+1);
   
        if(ix >= img.width-(100/v)){
			ix = img.width-(100*v+1);
        }
        if( iy <= 100/v ){
			iy=(100/v+1);
        }
        if( iy >= img.height-(101/v)){
			iy=img.height-(100/v+1);
        }
        }
        mouse_down = false
        draw_canvas(ix ,iy )
        return false // イベントを伝搬しない
    
    }
    cvs.ontouchmove =
    cvs.onmousemove = function ( _ev ){     // canvas ドラッグ中
        if ( mouse_down == false ) return
        draw_canvas( ix + (sx-_ev.pageX)/v, iy + (sy-_ev.pageY)/v )
        return false // イベントを伝搬しない
    }
    cvs.onmousewheel = function ( _ev ){    // canvas ホイールで拡大縮小
        let scl = parseInt( parseInt( document.getElementById( 'scal' ).value ) + _ev.wheelDelta * 0.05 )
        if ( scl < 10  ) scl = 10
        if ( scl > 400 ) scl = 400
        document.getElementById( 'scal' ).value = scl

        scaling( scl)
        return false // イベントを伝搬しない
    }
    </script>
@endsection

