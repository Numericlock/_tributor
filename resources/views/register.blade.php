<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
	<script src="js/jquery-2.1.3.js"></script>
	<script src="js/jquery.pjax.js"></script>
	<script src="js/barba.js"></script>
	<script src="js/sha256.js"></script>
    <link rel="icon" href="public/favicon.ico">
	<link rel="stylesheet" href="/css/fonts.css">
	<link rel="stylesheet" href="/css/opening-common.css">
	<link rel="stylesheet" href="/css/wave.css">
    <link rel="stylesheet" href="/css/proedit.css">
    <link rel="stylesheet" href="/css/modal.css">
	<link rel="stylesheet" href="/css/textbox.css">
</head>
<body>
	<div id="barba-wrapper">
		<div class='wave -one'></div>
		<div class='wave -two'></div>
		<div class='wave -three'></div>
		<div class="barba-container">
			<link rel="stylesheet" href="/css/signUp.css">
			<div class="title-wrapper">
				<span class="app-title">-tributor</span>
				<span class="form-title">アカウントの作成</span>
			</div>		
			<div>
				<div class="id_box box">
					<div class="id_inner inner">
						<input id="text" class="text" maxlength="24" type="text">
						<div class="id_string string">ユーザーID</div>
						<div class="id-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
				<div class="input-info-wrapper">
					<span id="id_error">　</span><span id="id_count">0/24</span>
				</div>
			</div>
			<div>
				<div class="mailaddress_box box">
					<div class="mailaddress_inner inner">
						<input id="text2" class="text" type="mailaddress">
						<div class="mailaddress_string string">メールアドレス</div>
						<div class="mail-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
				<div class="input-info-wrapper">
					<span id="mail_error">　</span>
				</div>
			</div>
           	<div class="control-button">
				<a class="no-link" href="/register/password"><button type="button">次へ</button></a>
			</div>
		</div>
	</div>
	<form method="post" id="postForm" name="postForm" action="/register_insert">
		<!-- CSRF保護 -->
       @csrf
	</form>
</body>

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
    //入力時のタイマー管理
    var idTimer;
    var mailTimer;
    var passwordTimer;
    var rePasswordTimer;
    var nameTimer;
    //入力時のテキスト保持（setTimeOutの関数呼び出しで引数送ると変な挙動するため）
    var idStr="";
    var mailStr="";
    var passwordStr="";
    var rePasswordStr="";
    var nameStr="";
    //POST用テキスト保持
    var user_id;
    var user_email;
    var user_password;
    var user_name;
    var next_flag = false;
	var id_flag = false;
	var mail_flag = false;
	var password_flag = false;
	var name_flag = false;
    var base64 ='data:image/png;base64,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';
    
    
    window.onload = function () {
		$('#text').val("");
		$('#text2').val("");
		$('#text3').val("");
		$('#text4').val("");
		$('#text5').val("");
		$('#text6').val("");
		$('#text7').val("");
    };
    function postForm(idVal,emailVal,passwordVal, nameVal) {
        var form = document.postForm;
        var id_request = document.createElement('input');
        var email_request = document.createElement('input');
        var password_request = document.createElement('input');
        var name_request = document.createElement('input');
        var img_request = document.createElement('input'); 

        id_request.type = 'hidden'; //入力フォームが表示されないように
        id_request.name = 'id';
        id_request.value = idVal;
        
        email_request.type = 'hidden'; //入力フォームが表示されないように
        email_request.name = 'email';
        email_request.value = emailVal;
        
        password_request.type = 'hidden'; //入力フォームが表示されないように
        password_request.name = 'password';
        password_request.value = hashHex(passwordVal);
		
        name_request.type = 'hidden'; //入力フォームが表示されないように
        name_request.name = 'name';
        name_request.value = nameVal;
        
        img_request.type = 'hidden'; //入力フォームが表示されないように
        img_request.name = 'base64';
        img_request.value = base64;

        form.appendChild(id_request);
        form.appendChild(email_request);
        form.appendChild(password_request);
        form.appendChild(name_request);
        form.appendChild(img_request); 
        
        form.submit();
        
       
   

    }
    
    function hashHex(str){
        const SHA_OBJ = new jsSHA("SHA-256","TEXT");
        SHA_OBJ.update(str);
        return SHA_OBJ.getHash("HEX");
    }
    
	function is_blank(str){
		// チェックのために、タブ(\t)、スペース(\s)、全角スペース（ ）を削除
		var check_str = str.replace(/[\t\s ]/g, '');
		if(str == ""){
			return true;
			// 名前未入力
		}else if(check_str.length == 0){
			// チェックの文字が長さ0なので、スペース系のみだったと判断。
			return true;
		}
	}
    $('a.no-link').click(function(){
		console.log(next_flag);
		return next_flag;
	})
	//idのチェック
	$("#text").on("input", function() {
        idStr=$(this).val();
        document.getElementById("id_count").innerText = idStr.length+"/24";
        clearTimeout(idTimer);
        idTimer = window.setTimeout(idCheck, 700);
	});

	//mailaddressのチェック
	$("#text2").on("input", function() {
        mailStr=$(this).val();
        clearTimeout(mailTimer);
        mailTimer = window.setTimeout(mailCheck, 700);
	});
    function idCheck(){
		console.log("idcheck");
        var str=idStr;
		if(is_blank(str) == true){
            id_flag = false;
            next_flag = false;
			document.getElementById("id_error").innerText = "入力してクレメンス";	
			$('.id-line').animate({
				width:"100%"
			}, 300);
		}else{
            $.get("/is_diplication",{'user_id' : str},function(data){
				if(data != '0'){
					id_flag = false;
					next_flag = false;
					document.getElementById("id_error").innerText = "登録済みのidです";	
					$('.id-line').animate({
						width:"100%"
					}, 300);
				}else{
					id_flag = true;
					next_flag = false;
					user_id = str;
					nextCheck();
					document.getElementById("id_error").innerText = "　";
					$('.id-line').animate({
						width:"0%"
					}, 300);
                }
            });
		}
    }
	
    function mailCheck(){
		console.log("mailcheck");
        var str=mailStr;
		document.getElementById("mail_error").innerText = "　";
		if(is_blank(str) == true){
            mail_flag = false;
            next_flag = false;
			document.getElementById("mail_error").innerText = "入力してクレメンス";	
			$('.mail-line').animate({
				width:"100%"
			}, 300);
		}else if(!str.match(/^[A-Za-z0-9]+[\w-]+@[\w\.-]+\.\w{2,}$/)){
            mail_flag = false;
            next_flag = false;
            document.getElementById("mail_error").innerText = "正しいメールアドレスを入力してクレメンス";	
            $('.mail-line').animate({
                width:"100%"
            }, 300);
        }else{
            $.get("/is_diplication",{'mailaddress' : str},function(data){
				if(data != '0'){
                    mail_flag = false;
                    next_flag = false;
					document.getElementById("mail_error").innerText = data;	
					$('.mail-line').animate({
						width:"100%"
					}, 300);
				}else{
                    mail_flag = true;
                    next_flag = false;
                    user_email = str;
					nextCheck();
                    document.getElementById("mail_error").innerText = "　";
                    $('.mail-line').animate({
                        width:"0%"
                    }, 300);    
                }
            });
        }
    }
    function nextCheck(){
        console.log("nextcheck")
        console.log(id_flag)
        console.log(mail_flag)
        if(id_flag === true && mail_flag === true){
            next_flag = true;
        }
    }
    
	$('#text').focus(function(){
		$('.id_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.id_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text').change(function() {
		const str = $('#text').val();
		if(str===""){
			const result = $('.id_string').removeClass('keepfocus');
		}else{ 
			const result = $('.id_string').addClass('keepfocus')
		}
	});
    
	$('#text2').focus(function(){
		$('.mailaddress_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.mailaddress_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text2').change(function() {
		const str = $('#text2').val();
		if(str===""){
			const result = $('.mailaddress_string').removeClass('keepfocus2');
		}else{ 
			const result = $('.mailaddress_string').addClass('keepfocus2')
		}
	});
    
	Barba.Pjax.init();

	Barba.Prefetch.init();

// headタグ内の書き換え

Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container, newPageRawHTML) {

 

  var head = document.head;

  var newPageRawHead = newPageRawHTML.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0];

  var newPageHead = document.createElement('head');

  newPageHead.innerHTML = newPageRawHead;

 

  var removeHeadTags = [

    "meta[name='description']",

    "meta[property^='og']",

    "meta[name^='twitter']",

    "link[rel='canonical']"

  ].join(',');

  var headTags = head.querySelectorAll(removeHeadTags)

  for(var i = 0; i < headTags.length; i++ ){

    head.removeChild(headTags[i]);

  }

  var newHeadTags = newPageHead.querySelectorAll(removeHeadTags)

 

  for(var i = 0; i < newHeadTags.length; i++ ){

    head.appendChild(newHeadTags[i]);

  }

 

});

 

// Googleアナリティクスに情報を送る

Barba.Dispatcher.on('initStateChange', function() {

  if (typeof ga === 'function') {

    ga('send', 'pageview', window.location.pathname.replace(/^\/?/, '/') + window.location.search);

  }

});

 

// ページごとの処理

var HomeTransition = Barba.BaseView.extend({

  namespace: 'home',

  onEnter: () => {

    // 読み込みを開始した時の処理

  },

  onEnterCompleted: () => {

    // トランジションを完了した時の処理

  }

});

HomeTransition.init();

 

// 共通アニメーション

var PageTransition = Barba.BaseTransition.extend({

  start: function() {

    Promise

      .all([this.newContainerLoading, this.moveOut()])

      .then(this.moveIn.bind(this));

  },

  moveOut: function() {

    // 遷移前の処理（内容はお好みで）
  //   user_name = $('#text').val();
  //   user_email = $('#text2').val();
    //moveOutAnim();

    return $(this.oldContainer).animate({ left: '-50%' }, 300).promise();

  },

  moveIn: function() {

    var _this = this;

    var $el = $(this.newContainer);

    // 遷移後の処理
	//passwordのチェック
	next_flag = false;
    $('a.no-link').click(function(){
		console.log(next_flag);
		return next_flag;
	})
	  console.log(next_flag+"は？");
	$("#text4").on("input", function() {
        passwordStr=$(this).val();
        clearTimeout(passwordTimer);
        passwordTimer = window.setTimeout(passwordCheck, 700);
        passwordTimer = window.setTimeout(rePasswordCheck, 700);
	});
	$("#text5").on("input", function() {
        rePasswordStr=$(this).val();
        clearTimeout(rePasswordTimer);
        rePasswordTimer = window.setTimeout(rePasswordCheck, 700);
	});

	$("#text7").on("input", function() {
       	nameStr=$(this).val();
        clearTimeout(nameTimer);
        nameTimer = window.setTimeout(nameCheck, 700);
	});
    function passwordCheck(){
        var str=passwordStr;
		if(is_blank(str) == true){
            password_flag = false;
			document.getElementById("password_error").innerText = "入力してクレメンス";	
			$('.password-line').animate({
				width:"100%"
			}, 300);
		}else if(str.length <= 5 ||str.length >= 255){
            password_flag = false;
            document.getElementById("password_error").innerText = "6文字以上でおねがい";	
			$('.password-line').animate({
				width:"100%"
			}, 300);
        }else if(!str.match(/^[A-Za-z0-9]+$/)){
            password_flag = false;
            document.getElementById("password_error").innerText = "半角英数字でおねがい";	
			$('.password-line').animate({
				width:"100%"
			}, 300);
        }else{
            password_flag = false;
			document.getElementById("password_error").innerText = "　";
			$('.password-line').animate({
				width:"0%"
			}, 300);
		}
    }
    function rePasswordCheck(){
        var str=rePasswordStr;
		if(is_blank(str) == true){
            password_flag = false;
			document.getElementById("rePassword_error").innerText = "入力してクレメンス";	
			$('.rePassword-line').animate({
				width:"100%"
			}, 300);
		}else if(passwordStr!==str){
            password_flag = false;
			document.getElementById("rePassword_error").innerText = "1度目の入力と一致しません";	
			$('.rePassword-line').animate({
				width:"100%"
			}, 300);
        }else{
            password_flag = true;
			next_flag = true;
            user_password = str;
			document.getElementById("rePassword_error").innerText = "　";
			$('.rePassword-line').animate({
				width:"0%"
			}, 300);
		}
    }
	  
	function nameCheck(){
		var str = nameStr;
		if(is_blank(str) == true){
            name_flag = false;
			document.getElementById("name_error").innerText = "入力してクレメンス";	
			$('.name-line').animate({
				width:"100%"
			}, 300);
		}else{
			name_flag = true;
			user_name = str;
			document.getElementById("name_error").innerText = "　";
			$('.name-line').animate({
				width:"0%"
			}, 300);
		}
	}
	$('#text3').focus(function(){
		$('.authentication_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.authentication_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text3').change(function() {
		const str = $('#text3').val();
		if(str===""){
			const result = $('.authentication_string').removeClass('keepfocus');
		}else{ 
			const result = $('.authentication_string').addClass('keepfocus')
		}
	});
	$('#text4').focus(function(){
		$('.password_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.password_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text4').change(function() {
		const str = $('#text4').val();
		if(str===""){
			const result = $('.password_string').removeClass('keepfocus');
		}else{ 
			const result = $('.password_string').addClass('keepfocus')
		}
	});	
	$('#text5').focus(function(){
		$('.password2_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.password2_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text5').change(function() {
		const str = $('#text5').val();
		if(str===""){
			const result = $('.password2_string').removeClass('keepfocus2');
		}else{ 
			const result = $('.password2_string').addClass('keepfocus2')
		}
	});

	$('#text6').focus(function(){
		$('.password_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.password_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text6').change(function() {
		const str = $('#text6').val();
		if(str===""){
			const result = $('.password_string').removeClass('keepfocus');
		}else{ 
			const result = $('.password_string').addClass('keepfocus')
		}
	});	
	$('#text7').focus(function(){
		$('.name_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
	}).blur(function(){
		$('.name_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
	});
	
	$('#text7').change(function() {
		const str = $('#text7').val();
		if(str===""){
			const result = $('.name_string').removeClass('keepfocus2');
		}else{ 
			const result = $('.name_string').addClass('keepfocus2')
		}
	});
	  
	  
	$('#homehtml').on('click',function(){
		console.log("フラッグ");
		console.log(id_flag);
		console.log(mail_flag);
		console.log(password_flag);
		console.log(name_flag);
		if(id_flag,mail_flag,password_flag,name_flag===true){
			postForm(user_id, user_email, user_password, user_name);
		}
	});
    window.scrollTo( 0, 0 );
      
      console.log(user_id)
      console.log(user_email)
    $(this.oldContainer).hide();

    $el.css({

      visibility : 'visible',

	  left: '150%'

    });

   // moveInAnim();

 

    $el.animate( { left: '50%' }, 400,function() {

      _this.done();

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


  }

 

});

 

Barba.Pjax.getTransition = function() {

  return PageTransition;

};
 

Barba.BaseView.init()

Barba.Pjax.start();
    
</script>
</html>
