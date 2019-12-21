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
    var base64;
    
    
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
     
    $('#crop_img').on('click',function(){                // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img, 0, 0, img.width, img.height,(ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,)
               
      base64 = out.toDataURL("public/img/png").replace("public/img/png", "public/img/octet-stream");
    document.getElementById("preview").src = base64;
 
   
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
 		iy += (sy-_ev.pageY)/v
       
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
