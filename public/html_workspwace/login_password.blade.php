<!DOCTYPE html>
<html lang="ja">
<head>
	<script>
		window.location.href = '/login'; 
	</script>
	<meta charset="utf-8">
	<title>ログイン</title>
	<script src="public/js/jquery-2.1.3.js"></script>
	<script src="public/js/jquery.pjax.js"></script>
	<script src="public/js/barba.js"></script>
	<script src="public/js/sha256.js"></script>
    <link rel="icon" href="public/favicon.ico">
	<link rel="stylesheet" href="/css/fonts.css">
	<link rel="stylesheet" href="/css/opening-common.css">
	<link rel="stylesheet" href="/css/login.css">
	<link rel="stylesheet" href="/css/wave.css">
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
                    <div class="password_box box">
                        <div class="password_inner inner">
                            <input id="text2" class="text" type="password">
                            <div class="password_string string">パスワード</div>
                        </div>
                        <i class="fas fa-eye-slash"></i>
                    </div>
                </div>
                <div class="control-button login-button">
                    <button type="button" id="login">ログイン</button>
                    <input type="hidden" class="password-text" id={{$challenge}}>
                </div>
            </div>
    </div>
</body>
</html>