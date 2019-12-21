<!DOCTYPE html>
<html lang="ja">
<script>
    window.location.href = '/register'; 
</script>
<head>
	<meta charset="utf-8">
	<title>新規登録</title>
	<script src="/js/jquery-2.1.3.js"></script>
	<script src="/js/jquery.pjax.js"></script>
	<script src="/js/barba.js"></script>
    <link rel="shortcut icon" href="/favicon.ico">
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
                <img class="profile-image" id="preview"><br>
                <input type="file" id="dotRadius2" accept="image/*">
                
			</div>		
			<div>
				<div class="name_box box">
					<div class="name_inner inner">
						<input id="text7" class="text" type="text">
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
			<link rel="stylesheet" href="/css/signUp_profile.css">
            <div class="modal2">
	
	</div>
	<div class="modal-content3">
	<input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>
<canvas id='cvs' width='300' height='400'></canvas><br>
<button id="crop_img">CROP</button><br>
<canvas id='out' width='200' height='200' style="display:none"></canvas>
	</div>
            


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
