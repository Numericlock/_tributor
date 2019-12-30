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

