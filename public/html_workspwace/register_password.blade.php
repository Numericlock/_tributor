<!DOCTYPE html>
<html lang="ja">
<script>
    window.location.href = '/register'; 
</script>
<head>
	<meta charset="utf-8">
	<title>新規登録</title>
	<script src="public/js/jquery-2.1.3.js"></script>
	<script src="public/js/jquery.pjax.js"></script>
	<script src="public/js/barba.js"></script>
    <link rel="icon" href="public/favicon.ico">
	<link rel="stylesheet" href="/css/fonts.css">
	<link rel="stylesheet" href="/css/opening-common.css">
	<link rel="stylesheet" href="/css/wave.css">
</head>
<body>
	<div id="barba-wrapper">
		<div class='wave -one'></div>
		<div class='wave -two'></div>
		<div class='wave -three'></div>
		<div class="barba-container">
			<div class="title-wrapper">
				<span class="form-title">パスワードを入力</span>
				<span class="form-comment">6文字以上の英数字にしてください</span>
			</div>	
			<div>
				<div class="password_box box">
					<div class="password_inner inner">
						<input id="text4" class="text" type="password">
						<div class="password_string string">パスワード</div>
                        <div class="password-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
                <div class="input-info-wrapper">
					<span id="password_error">　</span>
				</div>
			</div>		
			<div>
				<div class="password2_box box">
					<div class="password2_inner inner">
						<input id="text5" class="text" type="password">
						<div class="password2_string string">確認用パスワード</div>
                        <div class="rePassword-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
                <div class="input-info-wrapper">
					<span id="rePassword_error">　</span>
				</div>
			</div>
			<div class="control-button">
				<button type="button" id="homehtml">次へ</button>
			</div>
			<link rel="stylesheet" href="/css/signUp_password.css">
		</div>
	</div>
</body>
<script>
    window.onload = function () {
		$('#text4').val("");
		$('#text5').val("");
    };
	$('#homehtml').on('click',function(){
		window.location.href = 'home.php'; 
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
</script>
</html>
