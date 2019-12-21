@extends('layouts.app')
@section('title', 'リスト')
@section('cssJs')
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/profile.css">
	<link rel="stylesheet" href="/css/proedit.css">
	<link rel="stylesheet" href="/css/modal.css">
@endsection
@section('content')
		
		<div id="timeLine">	
			<div class="content-title">
				　<span>プロフィール</span>
			</div>
            				<button type="button" id="dotRadius2" data-toggle="modal" data-target="#ModalAddCalendar"><span id="plus">プロフィール</span></button>
			<div id="setting">							
				<button type="button" id="dotRadius2" data-toggle="modal" data-target="#ModalAddCalendar"><span id="plus">プロフィール</span></button>
			</div>
			<div class="profile">
				<div class="profile-icon">
					<img src="/img/2.jpg">
				</div>
				<span class="profile-userName">{{ $user->name }}</span>
				<span class="profile-userId">{{ "@".$user->user_id }}</span>
		 		<h4>おっとっととっとってっていっとっとになんでとっとってくれんかったとに</h4>
		 		 <div class="information">
					<span>フォロー中 -114</span>
					<span>フォロワー -514</span>
				</div>
			</div>
		
			<div class="tab-wrapper">
				<button type='button' id="reaction_button">投稿</button>
				<button type='button' id="reply_button">返信</button>
				<button type='button' id="reaction_button">メディア</button>
				<button type='button' id="reply_button">いいね</button>
			</div>

			<div class="users-content">
				<div class="users-information-wrapper">
				<!--	<img src="/img/1.jpg"></img>
				-->
					<div class="users-icon">
						<img src="/img/2.jpg">
					</div>
					<div class="users-information">
						<div class="users-name">
							<span>にゅーめりっくろっく</span>
						</div>
						<div class="information">
							<span><img class="information-icon" src="/img/comment.svg">文章-20分前-<img class="information-icon" src="/img/list2.svg"></span>
						</div>
					</div>
				</div>
				<div class="content">
					<span>くそねむい</span>
				</div>				
				<div class="control">
					<button type='button'>
						<svg class="control-icon comment" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
								l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
								c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
								 M324,300v32H96v-32H324z"/>
						</g>
						</svg>
					</button>
					<button type='button'>
						<svg class="control-icon diffusion" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
							<g>
								<polygon class="st0" points="244.848,49.742 251.894,209.888 260.013,209.888 267.05,49.742 	"/>
								<polygon class="st0" points="244.848,463.321 267.05,463.321 260.013,303.026 251.894,303.026 	"/>
								<path class="st0" d="M255.944,23.611c6.542,0,11.834-5.292,11.834-11.778C267.778,5.292,262.486,0,255.944,0
									c-6.486,0-11.796,5.292-11.796,11.834C244.148,18.32,249.458,23.611,255.944,23.611z"/>
								<path class="st0" d="M255.944,488.379c-6.486,0-11.796,5.301-11.796,11.805c0,6.515,5.31,11.816,11.796,11.816
									c6.542,0,11.834-5.301,11.834-11.816C267.778,493.68,262.486,488.379,255.944,488.379z"/>
								<polygon class="st0" points="217.989,229.467 83.302,143.478 72.215,162.703 213.957,236.495 	"/>
								<polygon class="st0" points="294.581,283.064 428.12,368.998 439.216,349.791 298.649,276.046 	"/>
								<path class="st0" d="M39.01,144.364c1.792,1.018,3.836,1.568,5.889,1.568c4.218,0,8.138-2.268,10.248-5.916
									c1.586-2.726,1.997-5.908,1.185-8.951c-0.821-3.042-2.781-5.59-5.506-7.167c-1.81-1.036-3.835-1.567-5.889-1.567
									c-4.218,0-8.156,2.24-10.266,5.879C31.442,133.856,33.392,141.07,39.01,144.364z"/>
								<path class="st0" d="M471.488,367.588c-1.792-1.026-3.836-1.567-5.908-1.567c-4.19,0-8.119,2.249-10.228,5.889
									c-3.247,5.674-1.316,12.907,4.32,16.154c1.774,1.026,3.818,1.586,5.89,1.586c4.218,0,8.147-2.268,10.266-5.907
									C479.056,378.088,477.124,370.864,471.488,367.588z"/>
								<polygon class="st0" points="217.989,282.662 213.957,275.654 72.215,349.222 83.302,368.428 	"/>
								<polygon class="st0" points="298.649,236.112 440.718,162.115 429.622,142.899 294.581,229.085 	"/>
								<path class="st0" d="M44.899,365.974c-2.053,0-4.097,0.55-5.889,1.586c-5.637,3.239-7.568,10.5-4.34,16.136
									c2.109,3.64,6.038,5.916,10.266,5.916c2.044,0,4.079-0.55,5.889-1.596c5.637-3.266,7.569-10.499,4.322-16.135
									C53.037,368.242,49.117,365.974,44.899,365.974z"/>
								<path class="st0" d="M467.082,145.886c2.081,0,4.106-0.541,5.908-1.586c5.628-3.257,7.569-10.481,4.322-16.127
									c-2.101-3.63-6.029-5.908-10.238-5.908c-2.081,0-4.106,0.551-5.898,1.578c-2.716,1.586-4.685,4.134-5.487,7.186
									c-0.822,3.043-0.401,6.244,1.166,8.969C458.963,143.637,462.874,145.886,467.082,145.886z"/>
								<polygon class="st0" points="166.417,115.48 229.664,216.934 235.198,213.742 179.072,108.182 177.56,107.753 166.8,113.978 	"/>
								<path class="st0" d="M155.918,97.02l12.431-7.205l-8.754-15.118l-1.474-0.411l-10.565,6.094c-0.541,0.327-0.709,0.962-0.411,1.466
									L155.918,97.02z"/>
								<polygon class="st0" points="345.489,396.426 282.262,295.206 276.708,298.407 333.506,404.247 333.805,404.274 334.346,404.153 
									345.116,397.947 	"/>
								<path class="st0" d="M356.025,414.904l-12.449,7.186l8.754,15.118c0.243,0.419,0.634,0.579,0.934,0.579l0.541-0.16l10.546-6.093
									c0.505-0.308,0.7-0.99,0.411-1.474L356.025,414.904z"/>
								<path class="st0" d="M88.761,262.952c0.206,0.206,0.458,0.299,0.775,0.299l119.382-3.985v-6.402l-119.382-4.21l-1.101,1.073
									L88.761,262.952z"/>
								<path class="st0" d="M49.714,249.841v12.206c0,0.607,0.476,1.083,1.092,1.083h17.47v-14.362H50.788
									C50.19,248.768,49.714,249.244,49.714,249.841z"/>
								<polygon class="st0" points="423.463,249.728 422.37,248.655 302.989,252.864 302.989,259.266 422.352,263.252 423.463,262.178 	
									"/>
								<path class="st0" d="M462.211,262.047v-12.206c0-0.495-0.589-1.055-1.083-1.055l-17.507-0.018v14.362h17.507
									C461.716,263.13,462.211,262.654,462.211,262.047z"/>
								<path class="st0" d="M229.664,295.206l-63.247,101.22l0.383,1.521l10.76,6.188c0.178,0.112,0.354,0.139,0.542,0.139l0.97-0.55
									l56.144-105.317L229.664,295.206z"/>
								<path class="st0" d="M147.146,430.061l0.429,1.474l10.546,6.093c0.158,0.094,0.326,0.16,0.504,0.16l0.971-0.579l8.754-15.118
									l-12.431-7.186L147.146,430.061z"/>
								<polygon class="st0" points="282.262,216.934 345.489,115.499 345.116,113.978 334.346,107.753 332.844,108.182 276.708,213.742 	
									"/>
								<polygon class="st0" points="364.761,81.865 364.369,80.38 353.804,74.286 352.32,74.697 343.576,89.816 356.025,97.02 	"/>
								<path class="st0" d="M271.333,300.992l-6.187,1.661l38.86,154.482c0.065,0.028,0.14,0.046,0.233,0.046l10.835-3.508
									L271.333,300.992z"/>
								<path class="st0" d="M308.626,474.651l3.77,14.12c0.066,0.252,0.317,0.401,0.522,0.401l10.639-3.406l-3.78-14.111L308.626,474.651z
									"/>
								<polygon class="st0" points="240.62,211.157 246.826,209.514 207.602,54.764 196.944,58.244 	"/>
								<polygon class="st0" points="203.309,37.292 198.922,22.771 188.424,26.159 192.231,40.27 	"/>
								<path class="st0" d="M287.189,291.818L397.76,406.02c0.084,0.094,0.206,0.14,0.346,0.14l0.401-0.14l7.522-8.38L291.734,287.292
									L287.189,291.818z"/>
								<path class="st0" d="M410.901,419.038l10.378,10.341c0.112,0.121,0.251,0.139,0.345,0.139l0.364-0.158l7.391-8.166l-10.284-10.331
									L410.901,419.038z"/>
								<polygon class="st0" points="224.764,220.312 113.492,105.887 105.98,114.249 220.219,224.838 	"/>
								<polygon class="st0" points="101.034,92.933 90.002,82.546 82.584,90.722 92.914,101.042 	"/>
								<polygon class="st0" points="300.871,271.426 453.942,315.047 454.437,314.655 456.742,303.652 302.532,265.22 	"/>
								<polygon class="st0" points="471.711,319.704 485.925,323.52 486.448,323.128 488.78,312.34 474.688,308.561 	"/>
								<polygon class="st0" points="209.394,246.91 211.054,240.723 57.554,197.252 55.23,208.227 	"/>
								<polygon class="st0" points="40.279,192.222 25.516,188.778 23.21,199.548 37.312,203.336 	"/>
								<polygon class="st0" points="302.55,246.9 457.218,207.574 453.718,196.86 300.889,240.723 	"/>
								<polygon class="st0" points="474.651,203.262 489.173,198.876 485.785,188.386 471.711,192.156 	"/>
								<path class="st0" d="M209.421,265.23L54.8,304.333l3.024,10.639c0.076,0.056,0.168,0.075,0.252,0.075l152.997-43.621
									L209.421,265.23z"/>
								<path class="st0" d="M37.349,308.635l-14.522,4.377l2.706,10.126c0.084,0.214,0.29,0.382,0.542,0.382l14.231-3.789L37.349,308.635z
									"/>
								<polygon class="st0" points="291.716,224.838 406.057,113.427 397.696,105.905 287.208,220.312 	"/>
								<polygon class="st0" points="429.416,89.946 421.242,82.546 410.901,92.858 419.029,100.978 	"/>
								<path class="st0" d="M220.238,287.292L105.924,398.451l7.625,7.569c0.121,0.131,0.298,0.131,0.345,0.131l0.384-0.196
									l110.487-114.137L220.238,287.292z"/>
								<path class="st0" d="M82.602,421.979l7.4,7.382c0.103,0.121,0.262,0.158,0.364,0.158l0.411-0.186l10.303-10.294l-8.092-8.147
									L82.602,421.979z"/>
								<polygon class="st0" points="271.324,211.157 314.674,57.498 303.689,55.155 265.146,209.496 	"/>
								<polygon class="st0" points="323.184,25.478 312.396,23.135 308.598,37.246 319.694,40.241 	"/>
								<polygon class="st0" points="240.648,300.973 197.28,454.381 207.76,457.162 208.264,456.723 246.826,302.653 	"/>
								<polygon class="st0" points="188.834,486.429 199.072,489.154 199.604,488.724 203.393,474.632 192.306,471.655 	"/>
							</g>
						</svg>
					</button>
					<button type='button'>
						<svg class="control-icon heart" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
							<g>
								<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
									c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
									l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
							</g>
						</svg>
					</button>
				</div>
			</div>
			<div class="users-content">
				<div class="users-information-wrapper">
				<!--	<img src="/img/1.jpg"></img>
				-->
					<div class="users-icon">
						<img src="/img/2.jpg">
					</div>
					<div class="users-information">
						<div class="users-name">
							<span>にゅーめりっくろっく</span>
						</div>
						<div class="information">
							<span><img class="information-icon" src="/img/comment.svg">文章-20分前-<img class="information-icon" src="/img/list2.svg"></span>
						</div>
					</div>
				</div>
				<div class="content">
					<span>くそねむい</span>
					<img src="/img/3.jpg">
				</div>				
				<div class="control">
					<button type='button'><img class="control-icon" src="/img/comment.svg"></button>
					<button type='button'><img class="control-icon" src="/img/爆発.svg"></button>
					<button type='button'><img class="control-icon" src="/img/heart.svg"></button>
				</div>
			</div>
			<div class="users-content">
				<div class="users-information-wrapper">
				<!--	<img src="/img/1.jpg"></img>
				-->
					<div class="users-icon">
						<img src="/img/2.jpg">
					</div>
					<div class="users-information">
						<div class="users-name">
							<span>にゅーめりっくろっく</span>
						</div>
						<div class="information">
							<span><img class="information-icon" src="/img/comment.svg">文章-20分前-<img class="information-icon" src="/img/list2.svg"></span>
						</div>
					</div>
				</div>
				<div class="content">
					<span>くそねむい</span>
					<img src="/img/1.jpg">
				</div>				
				<div class="control">
					<button type='button'><img class="control-icon" src="/img/comment.svg"></button>
					<button type='button'><img class="control-icon" src="/img/爆発.svg"></button>
					<button type='button'><img class="control-icon" src="/img/heart.svg"></button>
				</div>
			</div>
		</div>
	<div class="modal2">
	</div>
	
	<div class="modal-content">
		<form class="modal-form" method="POST">
			<div class="modal-title">
				<h1>プロフィール編集</h1>
			</div>
s
			<h4>プロフィール画像変更</h4>
			<label>
			<input type="file" id="modal_next" accept="image/*" style="display:none;">
				<div class="c-icon">
					<img src="/img/2.jpg">			        			
				</div>	
			</label>
	
			<div class="modal-text-area">
				<textarea class="message-area" id="textarea" name="post_message" title="今何してる？"　aria-label="今何してる？"　placeholder="今何してる？"></textarea>
			</div>
			<div class="modal-icon-area">
				<button type='button'><img class="control-icon" src="/img/comment.svg"></button>
				<button type='button'><img class="control-icon" src="/img/爆発.svg"></button>
				<button type='button'>
					<svg class="control-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"  style="enable-background:new 0 0 512 512;" xml:space="preserve">
						<g>
							<path class="st0" d="M494.951,81.411c-8.782-19.97-22.202-37.857-40.19-52.147l-7.81,9.818l7.806-9.818
								C429.524,9.162,400.535-0.027,372.48,0c-29.128,0.008-57.267,9.731-80.169,26.77c-14.65,10.904-27.137,24.888-36.317,41.262
								c-9.18-16.374-21.668-30.358-36.318-41.262C196.779,9.731,168.64,0.008,139.517,0c-28.06-0.027-57.044,9.162-82.277,29.264
								c-17.992,14.29-31.408,32.178-40.194,52.147c-8.794,19.979-13.004,41.996-13,64.82c0.04,49.014,19.226,101.802,55.124,148.402
								c31.464,40.788,71.147,80.169,105.976,115.916c17.41,17.861,33.6,34.794,46.853,50.336c13.262,15.515,23.544,29.728,29.185,41.41
								l-0.017-0.035c1.987,4.113,5.12,6.484,7.43,7.718c1.19,0.639,2.24,1.041,3.181,1.339l1.409,0.367l0.853,0.158
								c0.407,0.053,0.669,0.132,1.956,0.158c1.238-0.018,1.518-0.105,1.925-0.149c1.204-0.193,1.847-0.385,2.822-0.709
								c1.375-0.481,3.032-1.208,4.87-2.573c1.816-1.339,3.833-3.422,5.211-6.274c5.64-11.683,15.918-25.903,29.176-41.41
								c19.883-23.321,46.351-49.732,73.676-77.789c27.334-28.09,55.547-57.862,79.153-88.464c35.897-46.6,55.088-99.378,55.127-148.393
								C507.955,123.416,503.746,101.39,494.951,81.411z M432.954,279.317c-29.998,38.924-69.059,77.806-104.076,113.72
								c-17.516,17.975-34.024,35.214-47.97,51.561c-9.757,11.464-18.171,22.421-24.91,33.105c-6.738-10.684-15.152-21.641-24.909-33.105
								c-20.92-24.503-47.624-51.089-74.791-79.005c-27.16-27.898-54.765-57.092-77.255-86.277
								c-32.979-42.732-49.948-90.696-49.908-133.087c0-19.751,3.636-38.268,10.878-54.712c7.25-16.442,18.062-30.847,32.842-42.617
								c20.885-16.574,43.988-23.776,66.662-23.803c23.497-0.008,46.525,7.903,65.178,21.8c18.658,13.905,32.869,33.63,39.174,57.328
								c1.462,5.496,6.441,9.328,12.125,9.328c5.683,0,10.663-3.833,12.124-9.328c6.305-23.698,20.516-43.423,39.179-57.328
								C325.95,33,348.979,25.09,372.48,25.098c22.674,0.027,45.777,7.229,66.661,23.803l0,0c14.782,11.77,25.593,26.175,32.848,42.626
								c7.237,16.435,10.877,34.952,10.877,54.712C482.905,188.621,465.937,236.585,432.954,279.317z"/>
						</g>
					</svg>
				</button>
			</div>
		</form>
	</div>
    
    <div class="modal-content2">
        <input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>
        <canvas id='cvs' width='300' height='400'></canvas><br>
        <button id="modal_back" onclick='crop_img()'>CROP</button><br>
        <canvas id='out' width='200' height='200' style="display:none"></canvas>
	</div>
			
	

	<script>
        
        
		
        $('#dotRadius2').on('click',function(){
			$('.modal2').stop(true, true).fadeIn('500');
			$('.modal-content').show().stop(true, true).animate({
				top: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);

		});	
		$('.modal2').on('click',function(){
			$('.modal2').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});			

		$('#modal_cancel').on('click',function(){
			$('.modal2').stop(true, true).fadeOut('500');
			$('.modal-content').stop(true, true).animate({
				top: "-100px",
				opacity: 0
			}, 500, function(){
				$('.modal-content').hide();
			});
		});	
		$('#modal_next').on('change',function(){
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

		/*$(function() {
		  var $textarea = $('#textarea');
		  var lineHeight = parseInt($textarea.css('lineHeight'));
		  $textarea.on('input', function(e) {
			var lines = ($(this).val() + '\n').match(/\n/g).length;
			$(this).height(lineHeight * lines);
		  });
		});
		*/
		$(function(){
			var elements = document.getElementsByName('disclose') ;
			var radioval = $(this).val();
			var str = document.getElementById("introduction").innerHTML;
			var strReplace = str.replace(/\r?\n/g, "<br>");	
			console.log(strReplace);
			document.getElementById("introduction").innerHTML=strReplace;
			if(elements[0].checked == true){
				$('#discloseSettingArea').slideUp();
				$("#disclose").prop("checked", true);
				console.log(elements[0].checked);
				document.getElementById("disclose_status").innerHTML="非公開";
				
				$('#disclose_status').css('color','#a61a37');
			}else{
				$('#discloseSettingArea').slideDown();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
			}
		});
		$( 'input[name="disclose"]:checkbox' ).change( function() {
			var elements = document.getElementsByName('disclose') ;
			var radioval = $(this).val();
			if(elements[0].checked == false){
				$('#discloseSettingArea').slideDown();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
				$('#disclose_change').stop(true, true).fadeIn('500');
			}else{
				//$(".cmn-toggle-small").prop("checked", true);
				$('#discloseSettingArea').slideUp();
				document.getElementById("disclose_status").innerHTML="非公開";
				$('#disclose_status').css('color','#a61a37');
				$('#disclose_change').stop(true, true).fadeIn('500');
			}
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
        scaling( scl )
    }
    function load_img( _url ){  // 画像の読み込み
        img.src = ( _url ? _url : '/img/1.jpg' )
    }
    load_img()
    function scaling( _v ) {        // スライダーが変った
        v = parseInt( _v ) * 0.01
        draw_canvas( ix, iy )       // 画像更新
    }

    function draw_canvas( _x, _y ){     // 画像更新
    	console.log(_x);
    	console.log(_y);
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る
         if( _x <= 100*v ){
			_x=101*v;
        }
        if(_x >= img.width-100*v){
			_x = img.width-101*v;
        }
        if( _y <= 100*v ){
			_y=101*v;
        }
        if( _y >= img.height-101*v){
			_y=img.height-101*v;
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
    function crop_img(){                // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img, 0, 0, img.width, img.height,(ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,)
        
     var base64 = out.toDataURL("image/png").replace("image/png", "image/octet-stream");
      console.log(base64);
        
    }

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
         if( ix <= 100 ){
			ix=101;
        }
        if(ix >= img.width-100*v){
			ix = img.width-101*v;
        }
        if( iy <= 100*v ){
			iy=101*v;
        }
        if( iy >= img.height-101*v){
			iy=img.height-101*v;
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
        scaling( scl )
        return false // イベントを伝搬しない
    }

	</script>
@endsection

