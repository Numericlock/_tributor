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
	<link rel="stylesheet" href="/css/login.css">
	<link rel="stylesheet" href="/css/wave.css">
	<link rel="stylesheet" href="/css/textbox.css">
</head>
<body>
    <div id="barba-wrapper">
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
        <div class="barba-container">
            <div class="title-wrapper">
                <span class="app-title">-tributor</span>
                <span class="form-title">ログイン</span>
            </div>		
            <div>
                <div class="id_box box">
                    <div class="id_inner inner">
                        <input id="text" class="text" maxlength="24" type="text">
                        <div class="id_string string">メールアドレスまたはID</div>
                    </div>
                    <i class="fas fa-eye-slash"></i>
                </div>
            </div>
            <div class="control-button">
                <button type="button" id="signUp_button">アカウント作成</button>
                <a href="/login/password"><button type="button">次へ</button></a>
            </div>
        </div>
    </div>
	<form method="post" id="postForm" name="postForm" action="/authentication">
		<!-- CSRF保護 -->
       @csrf
	</form>
</body>
<script>
    //POST用テキスト保持
    var user_id;
    var user_password;
    var password_text;
    
    window.onload = function () {
		$('#text').val("");
		$('#text2').val("");
    };
    $('#signUp_button').on('click',function(){
        window.location.href = '/register'; // 通常の遷移
    });
    
    function hashHex(str){
        const SHA_OBJ = new jsSHA("SHA-256","TEXT");
        SHA_OBJ.update(str);
        return SHA_OBJ.getHash("HEX");
    }
    
    function postForm(idVal, passwordVal, textVal) {

        var form = document.postForm;
        var id_request = document.createElement('input');
        var password_request = document.createElement('input');

        passwordVal = hashHex(passwordVal);
        console.log(passwordVal);
        console.log(textVal);
        passwordVal = passwordVal + textVal;
        console.log(passwordVal);
        passwordVal = hashHex(passwordVal);
        console.log(passwordVal);

        id_request.type = 'hidden'; //入力フォームが表示されないように
        id_request.name = 'id';
        id_request.value = idVal;

        password_request.type = 'hidden'; //入力フォームが表示されないように
        password_request.name = 'password';
        password_request.value = passwordVal;

        form.appendChild(id_request);
        form.appendChild(password_request);
        document.body.appendChild(form);

        form.submit();

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
            user_id = $('#text').val();
            //   user_email = $('#text2').val();
            //moveOutAnim();

            return $(this.oldContainer).animate({ left: '-50%' }, 300).promise();

        },

        moveIn: function() {

            var _this = this;

            var $el = $(this.newContainer);

            // 遷移後の処理
            $('#login').on('click',function(){
                user_password = $('#text2').val();
                password_text = $('.password-text').attr('id');
                // console.log(password_text);
                postForm(user_id, user_password, password_text);
            });

            $('#text2').focus(function(){
                $('.password_box').animate({borderTopColor: '#3be5ae', borderLeftColor: '#3be5ae', borderRightColor: '#3be5ae', borderBottomColor: '#3be5ae'}, 200);
            }).blur(function(){
                $('.password_box').animate({borderTopColor: '#d3d3d3', borderLeftColor: '#d3d3d3', borderRightColor: '#d3d3d3', borderBottomColor: '#d3d3d3'}, 200);
            });

            $('#text2').change(function() {
                const str = $('#text2').val();
                if(str===""){
                    const result = $('.password_string').removeClass('keepfocus2');
                }else{ 
                    const result = $('.password_string').addClass('keepfocus2')
                }
            });

            window.scrollTo( 0, 0 );

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
