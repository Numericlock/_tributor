<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
	<script src="public/js/jquery-2.1.3.js"></script>
	<script src="public/js/jquery.pjax.js"></script>
	<script src="public/js/barba.js"></script>
	<script src="public/js/sha256.js"></script>
    <link rel="icon" href="public/favicon.ico">
	<link rel="stylesheet" href="public/css/fonts.css">
	<link rel="stylesheet" href="public/css/opening-common.css">
	<link rel="stylesheet" href="public/css/wave.css">
</head>
<body>
	<div id="barba-wrapper">
		<div class='wave -one'></div>
		<div class='wave -two'></div>
		<div class='wave -three'></div>
		<div class="barba-container">
			<link rel="stylesheet" href="public/css/signUp.css">
			<div class="title-wrapper">
				<span class="app-title">-tributor</span>
				<span class="form-title">アカウントの作成</span>
			</div>		
			<div>
				<div class="id_box box">
					<div class="id_inner inner">
						<input id="text" class="text" maxlength="24" type="text">
						<div class="id_string string">ユーザー名</div>
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
				<a class="no-link" href="signUp_password.php"><button type="button">次へ</button></a>
			</div>
		</div>
	</div>
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
    var globalTimer;
    var idTimer;
    var mailTimer;
    var passwordTimer;
    var rePasswordTimer;
    //入力時のテキスト保持（setTimeOutの関数呼び出しで引数送ると変な挙動するため）
    var idStr="";
    var mailStr="";
    var passwordStr="";
    var rePasswordStr="";
    //POST用テキスト保持
    var user_id;
    var user_email;
    var user_password;
    var next_flag = false;
	var id_flag = false;
	var mail_flag = false;
	var password_flag = false;
    
    
    window.onload = function () {
		$('#text').val("");
		$('#text2').val("");
		$('#text3').val("");
		$('#text4').val("");
		$('#text5').val("");
    };
    function postForm(idVal,emailVal,passwordVal) {

        var form = document.createElement('form');
        var id_request = document.createElement('input');
        var email_request = document.createElement('input');
        var password_request = document.createElement('input');

        form.method = 'POST';
        form.action = 'signUp_insert.php';

        id_request.type = 'hidden'; //入力フォームが表示されないように
        id_request.name = 'id';
        id_request.value = idVal;
        
        email_request.type = 'hidden'; //入力フォームが表示されないように
        email_request.name = 'email';
        email_request.value = emailVal;
        
        password_request.type = 'hidden'; //入力フォームが表示されないように
        password_request.name = 'password';
        password_request.value = hashHex(passwordVal);

        form.appendChild(id_request);
        form.appendChild(email_request);
        form.appendChild(password_request);
        document.body.appendChild(form);

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
		return next_flag;
	})
	//idのチェック
	$("#text").on("input", function() {
        idStr=$(this).val();
        document.getElementById("id_count").innerText = idStr.length+"/24";
        clearTimeout(idTimer);
        clearTimeout(globalTimer);
        idTimer = window.setTimeout(idCheck, 700);
        globalTimer = window.setTimeout(nextCheck, 800);
	});

	//mailaddressのチェック
	$("#text2").on("input", function() {
        mailStr=$(this).val();
        clearTimeout(mailTimer);
        clearTimeout(globalTimer);
        mailTimer = window.setTimeout(mailCheck, 700);
        globalTimer = window.setTimeout(nextCheck, 800);
	});
    function idCheck(){
        var str=idStr;
		if(is_blank(str) == true){
            id_flag = false;
            next_flag = false;
			document.getElementById("id_error").innerText = "入力してクレメンス";	
			$('.id-line').animate({
				width:"100%"
			}, 300);
		}else{
            id_flag = true;
            next_flag = false;
            user_id = str;
			document.getElementById("id_error").innerText = "　";
			$('.id-line').animate({
				width:"0%"
			}, 300);
		}
    }
    function mailCheck(){
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
            $.get("is_duplication.php",{'mailaddress' : str},function(data){
				if(data != '0'){
                    mail_flag = false;
                    next_flag = false;
					document.getElementById("mail_error").innerText = "登録済みのメールアドレスです";	
					$('.mail-line').animate({
						width:"100%"
					}, 300);
				}else{
                    mail_flag = true;
                    next_flag = false;
                    user_email = str;
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
        if(id_flag == true && mail_flag == true){
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
            user_password = str;
			document.getElementById("rePassword_error").innerText = "　";
			$('.rePassword-line').animate({
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
	$('#homehtml').on('click',function(){
		postForm(user_id, user_email, user_password);
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

  }

 

});

 

Barba.Pjax.getTransition = function() {

  return PageTransition;

};
 

Barba.BaseView.init()

Barba.Pjax.start();
    
</script>
</html>
