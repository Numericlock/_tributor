<!DOCTYPE html>
<html lang="ja">
<script>
  //  window.location.href = 'signUp.php'; 
</script>
<head>
	<meta charset="utf-8">
	<title>新規登録</title>
	<script src="public/js/jquery-2.1.3.js"></script>
	<script src="public/js/jquery.pjax.js"></script>
	<script src="public/js/barba.js"></script>
    <link rel="shortcut icon" href="public/favicon.ico">
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
			<div class="title-wrapper">
				<span class="form-title">プロフィール画像と名前を設定</span>
				<span class="form-comment"></span>
			</div>	
			<div>
	<!--			<div class="password_box box">
					<div class="password_inner inner">
						<input id="text6" class="text" type="password">
						<div class="password_string string">パスワード</div>
                        <div class="password-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
                <div class="input-info-wrapper">
					<span id="password_error">　</span>
				</div>
-->
                <img class="profile-image" src="public/img/show.jpg">
			</div>		
			<div>
				<div class="name_box box">
					<div class="name_inner inner">
						<input id="text7" class="text" type="password">
						<div class="name_string string">名前</div>
                        <div class="name-line"></div>
					</div>
					<i class="fas fa-eye-slash"></i>
				</div>
                <div class="input-info-wrapper">
					<span id="name_error">　</span>
				</div>
			</div>
			<div class="control-button">
				<button type="button" id="homehtml">始める</button>
			</div>
			<link rel="stylesheet" href="public/css/signUp_profile.css">
		</div>
	</div>
</body>
<script>
    window.onload = function () {
		$('#text6').val("");
		$('#text7').val("");
    };
	$('#homehtml').on('click',function(){
		window.location.href = 'home.php'; 
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
</script>
</html>
