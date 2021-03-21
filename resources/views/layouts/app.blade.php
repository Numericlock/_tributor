<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')/-tributor</title>
	<script src="/js/jquery-2.1.3.js"></script>
	<script src="/js/moment.js"></script>
	<script src="/js/ImageManager.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
    <link rel="icon" href="/favicon.ico">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/plus.css">
	<link rel="stylesheet" href="/css/checkbox.css">
	<link rel="stylesheet" href="/css/textbox.css">
	@yield('cssJs')
</head>

<body>
	<div class="wrapper">
		<div class="nav">
			<a href="/{{ $user->user_id }}"><img class="nav-icon common-user-icon" src="/img/icon_img/{{ $user->user_id }}.png"></a>
			<a href="/home">
				<svg class="nav-icon home-nav-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<polygon class="st0" points="442.531,218 344.828,120.297 256,31.469 167.172,120.297 69.438,218.047 0,287.469 39.984,327.453
							109.406,258.031 207.156,160.281 256,111.438 304.844,160.281 402.531,257.984 472.016,327.453 512,287.469 	" />
						<polygon class="st0" points="85.719,330.375 85.719,480.531 274.75,480.531 274.75,361.547 343.578,361.547 343.578,480.531
							426.281,480.531 426.281,330.328 256.016,160.063 " />
					</g>
				</svg>
			</a>
			<a href="/notice">
				<svg class="nav-icon notice-nav-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<path class="st0" d="M127.75,398h256.5V282.125c0-70.813-57.422-128.25-128.25-128.25c-70.844,0-128.25,57.438-128.25,128.25V398z
							 M201.875,188.625c6.094-3.531,12.563-6.5,19.344-8.813c4.344-1.469,9.063,0.844,10.547,5.188s-0.844,9.063-5.203,10.547
							C220.859,197.5,215.391,200,210.234,203l0,0c-3.984,2.313-9.063,0.969-11.359-3.016C196.563,196,197.906,190.938,201.875,188.625z
							 M147.938,282.125c0-21.906,6.578-42.375,17.844-59.438c2.531-3.813,7.688-4.875,11.531-2.344
							c3.828,2.531,4.875,7.688,2.344,11.516c-9.547,14.453-15.094,31.703-15.094,50.266V369.5c0,4.594-3.719,8.313-8.313,8.313
							s-8.313-3.719-8.313-8.313V282.125z" />
						<path class="st0" d="M404.844,424.656H107.156c-5.25,0-9.5,4.25-9.5,9.5v47.5h316.688v-47.5
							C414.344,428.906,410.094,424.656,404.844,424.656z" />
						<polygon class="st0" points="264.422,87.891 267.656,30.344 244.359,30.344 247.594,87.891 	" />
						<polygon class="st0" points="164.063,110.266 138.094,58.828 117.906,70.469 149.484,118.688 	" />
						<polygon class="st0" points="28.469,168.438 79.922,194.406 88.344,179.844 40.125,148.281 	" />
						<polygon class="st0" points="0,298 57.531,294.766 57.531,277.938 0,274.719 	" />
						<polygon class="st0" points="454.469,277.938 454.453,294.766 512,298 512,274.719 	" />
						<polygon class="st0" points="471.875,148.281 423.656,179.844 432.078,194.406 483.531,168.438 	" />
						<polygon class="st0" points="394.078,70.469 373.922,58.828 347.938,110.281 362.516,118.688 	" />
					</g>
				</svg>
			</a>
			<a href="/search">
				<svg class="nav-icon search-nav-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<path class="st0" d="M449.803,62.197C408.443,20.807,353.85-0.037,299.646-0.006C245.428-0.037,190.85,20.807,149.49,62.197
							C108.1,103.557,87.24,158.15,87.303,212.338c-0.047,37.859,10.359,75.766,30.547,109.359L15.021,424.525
							c-20.016,20.016-20.016,52.453,0,72.469c20,20.016,52.453,20.016,72.453,0L190.318,394.15
							c33.578,20.203,71.5,30.594,109.328,30.547c54.203,0.047,108.797-20.797,150.156-62.188
							c41.375-41.359,62.234-95.938,62.188-150.172C512.053,158.15,491.178,103.557,449.803,62.197z M391.818,304.541
							c-25.547,25.531-58.672,38.125-92.172,38.188c-33.5-0.063-66.609-12.656-92.188-38.188c-25.531-25.578-38.125-58.688-38.188-92.203
							c0.063-33.484,12.656-66.609,38.188-92.172c25.578-25.531,58.688-38.125,92.188-38.188c33.5,0.063,66.625,12.656,92.188,38.188
							c25.531,25.563,38.125,58.688,38.188,92.172C429.959,245.854,417.365,278.963,391.818,304.541z" />
					</g>
				</svg>
			</a>
			<a href="/lists">
				<svg class="nav-icon list-nav-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<path class="st0" d="M392.197,26.581h-4.77v-9.699c0-9.316-7.55-16.882-16.881-16.882c-9.332,0-16.898,7.566-16.898,16.882v9.699
							h-42.576v-9.699c0-9.316-7.558-16.882-16.89-16.882c-9.324,0-16.89,7.566-16.89,16.882v9.699h-42.576v-9.699
							c0-9.316-7.566-16.882-16.89-16.882c-9.332,0-16.89,7.566-16.89,16.882v9.699h-42.584v-9.699c0-9.316-7.566-16.882-16.89-16.882
							c-9.332,0-16.89,7.566-16.89,16.882v9.699h-4.77c-38.501,0.008-69.684,31.199-69.7,69.7v306.59
							c0.016,60.28,48.856,109.12,109.129,109.128h156.354l146.312-146.312V96.281C461.89,57.78,430.699,26.589,392.197,26.581z
							 M429.173,350.021h-31.679c-51.237,0-92.766,41.53-92.766,92.766v33.787l-2.692,2.692l-142.804,0.008
							c-21.149-0.008-40.148-8.525-54.026-22.378c-13.853-13.878-22.37-32.877-22.378-54.025V96.281
							c0.008-10.258,4.114-19.398,10.834-26.142c6.743-6.719,15.883-10.826,26.142-10.834h4.77v18.121c0,9.332,7.558,16.889,16.89,16.889
							c9.324,0,16.89-7.558,16.89-16.889V59.306h42.584v18.121c0,9.332,7.558,16.889,16.89,16.889c9.323,0,16.89-7.558,16.89-16.889
							V59.306h42.576v18.121c0,9.332,7.566,16.889,16.89,16.889c9.332,0,16.89-7.558,16.89-16.889V59.306h42.576v18.121
							c0,9.332,7.566,16.889,16.898,16.889c9.332,0,16.881-7.558,16.881-16.889V59.306h4.77c10.259,0.008,19.398,4.114,26.142,10.834
							c6.718,6.744,10.825,15.883,10.834,26.142V350.021z" />
						<rect x="146.919" y="170.033" class="st0" width="218.17" height="32.725" />
						<rect x="146.919" y="257.294" class="st0" width="218.17" height="32.725" />
						<rect x="146.919" y="344.556" class="st0" width="130.9" height="32.725" />
					</g>
				</svg>
			</a>
			<a href="#">
				<svg class="nav-icon mail-nav-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<path class="st0" d="M490.237,90.753c-13.382-13.412-32.076-21.764-52.532-21.756H74.295C33.258,69.012,0.015,102.247,0,143.284
							v225.432c0.015,41.036,33.258,74.272,74.295,74.286h363.41c20.456,0.008,39.15-8.344,52.532-21.755
							C503.648,407.866,512,389.171,512,368.716V143.284C512,122.829,503.648,104.135,490.237,90.753z M74.295,107.04h363.41
							c8.701,0.008,16.466,3.136,22.714,8.21L256,269.478L51.58,115.25C57.829,110.175,65.594,107.047,74.295,107.04z M38.042,368.716
							V143.284c0.016-5.826,1.486-11.205,3.894-16.05l141.813,129.998L41.55,384.044C39.365,379.393,38.058,374.252,38.042,368.716z
							 M437.705,404.96H74.295c-8.204-0.007-15.581-2.771-21.637-7.319l150.618-121.825l22.818,21.711
							c16.911,15.529,42.902,15.529,59.813,0l22.818-21.711l150.61,121.825C453.279,402.189,445.901,404.953,437.705,404.96z
							 M473.958,368.716c-0.016,5.535-1.322,10.677-3.508,15.328L328.251,257.233l141.805-129.998c2.415,4.844,3.886,10.217,3.901,16.05
							V368.716z" />
					</g>
				</svg>
			</a>
			<div>
				<div class="other-nav-modal">
				</div>
				<div class="other-nav-wrapper">						
					<a href="/logout">
						<button>ログアウト</button>
					</a>
				</div>
				<svg class="nav-icon" onclick="other_nav_open();" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 512 512"  xml:space="preserve">
					<g>
						<circle class="st0" cx="55.091" cy="256" r="55.091"/>
						<circle class="st0" cx="256" cy="256" r="55.091"/>
						<circle class="st0" cx="456.909" cy="256" r="55.091"/>
					</g>
				</svg>
			</div>
			<div>
				<button type="button" id="dotRadius" class="dotRadius" data-toggle="post-modal" >
					<span id="plus"></span>
				</button>
			</div>

		</div>
		@yield('content')
		<div class="list">
			@foreach($lists as $list)
			<a href="/lists/{{ $list->id }}"><img class="common-list-icon" src="/img/list_icon/{{ $list->id }}.png"></a>
			@endforeach
		</div>
	</div>
	<div class="post-modal">
	</div>
	<div id="post-modal_content" class="post-modal-content">
        <div class="post-modal-title">
            <span>投稿</span>
            <svg class="post-modal-closeButton post-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
		<div class="post-modal-parentPost">
			<div class="post-modal-parentPost-icon">
				<img id="parentPost_usericon" src="/img/icon_img/{{ $user->user_id }}.png">
			</div>
			<div class="post-modal-parentPost-content">
				<div class="post-modal-parentPost-user">
					<span id="parentPost_username">にゅーめり</span>
					<span id="parentPost_userid">@numeric</span>
					<span id="parentPost_time">12355134</span>
				</div>
				<div class="post-modal-parentPost-sentence">
					<span id="parentPost_sentence">ばーかぼけかすしね</span>
				</div>
			</div>
		</div>
        <div class="post-modal-textarea">
            <div class="post-modal-textarea-userImage">
                <img src="/img/icon_img/{{ $user->user_id }}.png">
            </div>
			<div class="post-modal-textarea-input">
				<textarea id="textarea" name="post_message" title="今何してる？" aria-label="今何してる？" placeholder="何をトリビュートする？" maxlength="256" wrap="soft"></textarea>
				<div class="post-modal-inputFiles">
					<div class="post-modal-inputFiles-left">
						<img class="input-images" id="preview-0">
						<img class="input-images" id="preview-3">
						
					</div>
					<div class="post-modal-inputFiles-right">
						<img class="input-images" id="preview-1">
						<img class="input-images" id="preview-2">
						
					</div>

					
				</div>
			</div>
			
        </div>
        <div class="counter">
			<div>
				<span class="show-count">0</span><span>/256</span>
			</div>
         </div>
        <div class="post-modal-control">
            <label>
				<input type="file" name="imgFiles[]" id="users_image_file" accept="image/*" onchange="previewFiles()" multiple>
				<svg version="1.1" class="post-modal-control-icon" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
				<g>
					<path class="st0" d="M0,45.178v421.644h512V45.178H0z M471.841,426.662H40.159V85.329h431.682V426.662z" style="fill: rgb(75, 75, 75);"></path>
					<path class="st0" d="M326.128,207.728c-4.148-6.289-11.183-10.077-18.72-10.069c-7.544,0.007-14.57,3.803-18.71,10.1
						l-72.226,109.914l-39.862-45.178c-4.619-5.238-11.426-8.022-18.397-7.52c-6.971,0.486-13.308,4.211-17.142,10.053L74.17,376.96
						h363.659L326.128,207.728z" style="fill: rgb(75, 75, 75);"></path>
					<path class="st0" d="M174.972,230.713c25.102,0,45.453-20.35,45.453-45.461c0-25.102-20.35-45.452-45.453-45.452
						c-25.11,0-45.46,20.35-45.46,45.452C129.511,210.363,149.862,230.713,174.972,230.713z" style="fill: rgb(75, 75, 75);"></path>
				</g>
				</svg>			
			</label>
      <!--      <button type='button'><img class="post-modal-control-icon" src="/img/comment.svg"></button>
            <button type='button'><img class="post-modal-control-icon" src="/img/爆発.svg"></button>
            <button type='button'>
                <svg class="post-modal-control-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"  style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
	-->
            <button class="post-modal-positive-button" id="post-modal_next" type='button'>次へ</button>
        </div>
	</div>
	<div id="post-modal_content_next" class="post-modal-content">
        <div class="post-modal-title">
            <span>リストを選択する</span>
            <svg class="post-modal-closeButton post-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
		<div class="post-modal-list-area">
			@foreach($lists as $list)
				<div class="post-modal-list">
					<a href="#"><img class="post-modal-list-icon" src="/img/list_icon/{{ $list->id }}.png"></a>
					<span>{{ $list->name }}</span>
					<div class="checkbox">
						<div>
							<input class="post-modal-list-checkbox" type="checkbox" id="{{ $list->id }}" name="{{ $list->id }}" value="{{ $list->name }}" />
							<label class="checkbox-label" for="{{ $list->id }}">
								<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>
							</label>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<div class="post-modal-control">
			<button class="post-modal-negative-button" id="post-modal_back" type='button'>戻る</button>
			<div>
				<span id="disclose_status" class="sushiki">非公開</span>
				<input id="cmn-toggle-4" name="disclose" id="disclose" class="cmn-toggle cmn-toggle-round-flat" type="checkbox" checked>
				<label for="cmn-toggle-4"></label>
			</div>
			<button class="post-modal-positive-button" id="post-modal_post" type='button'>投稿</button>
		</div>
	</div>
    
    <div id="post-modal_content" class="post-modal-content">
        <div class="post-modal-title">
            <span>投稿</span>
            <svg class="post-modal-closeButton post-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
        <div class="post-modal-textarea">
            <div class="post-modal-textarea-userImage">
                <img src="/img/2.jpg">
            </div>
            <textarea  id="textarea" name="post_message" title="今何してる？"　aria-label="今何してる？"　placeholder="今何してる？" maxlength="256"></textarea>

        </div>
        <div class="counter">
            <span class="show-count">0</span>/256
         </div>
        <div class="post-modal-control">

            <span>内容が消えてしまいますがよろしいですか？</span>
			<button class="post-modal-negative-button" id="post-modal_back" type='button'>いいえ</button>
			<button class="post-modal-positive-button" id="post-modal_post" type='button'>はい</button>
            
        </div>
	</div>
	<div id="script-reload">

	</div>
	
	<div class="attention-modal">
	</div>
	
	<div class="attention-modal-content">
		<div class="attention-modal-text">
			<span class = "attention-modal-title">破棄しますか？</span>
			<span class = "attention-modal-sentence">書き込み中の内容は完全に失われます。</span>
		</div>
		<div class="attention-modal-button">
			<button class="attention-modal-button-cancel">キャンセル</button>
			<button class="attention-modal-button-destruction">破棄</button>
		</div>
	</div>
	
	<div class="attached-modal">
	</div>
	
	<div class="attached-modal-content">
		<img id="attached_modal_content_img" src="">
		<div onclick="img_slide(this)">
			<svg version="1.1" viewBox="0 0 36 36" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" focusable="false" role="img" width="32" height="32" fill="currentColor">
				<path class="clr-i-outline clr-i-outline-path-1" d="M29.52,22.52,18,10.6,6.48,22.52a1.7,1.7,0,0,0,2.45,2.36L18,15.49l9.08,9.39a1.7,1.7,0,0,0,2.45-2.36Z"/>
			</svg>
		</div>
	</div>

	<script src="/js/post_img_swiper.js"></script><!--投稿の画像と背景をスライドする-->
	<script src="/js/other_nav_modal.js"></script><!--ナビゲーションの三点リードをクリックしたときのモーダルの制御-->
	<script src="/js/attention_modal.js"></script><!--投稿時、なんらかの入力をした後、投稿せずにモーダルを消そうとしたときの処理-->
	<script src="/js/attached_modal.js"></script><!--添付画像をクリック時に画面全体に画像を表示するモーダルの制御　表示した画像の切り替え処理も-->
	<script src="/js/tribute_post.js"></script><!--投稿モーダルの表示から投稿までの処理-->
	<script src="/js/post_input_img.js"></script><!--投稿に画像を添付する際のプレビュー処理と配列処理-->
	<script src="/js/follow.js"></script><!--フォロー、フォロー解除処理-->
	<script src="/js/retribute.js"></script><!--リトリビュート、リトリビュート解除処理-->
	<script src="/js/favorite.js"></script><!--いいね、いいね解除処理-->
	<script>
		// Check for the various File API support.
		if (window.File && window.FileReader && window.FileList && window.Blob) {
		  // Great success! All the File APIs are supported.
		} else {
		  alert('The File APIs are not fully supported in this browser.');
		}
		
		$('.input-images').on('click',function(){
			remove_previewFile(this);
		});

		$('#dotRadius').on('click',function(){
			post_modal_open();
		});

		$('.attached-modal, .attached-modal-close-button').on('click',function(){
			attached_modal_close();
		});	
		
		
		$('.attention-modal, .attention-modal-button-cancel').on('click',function(){
			attention_modal_close();
		});	

		$('.attention-modal-button-destruction').on('click',function(){
			attention_modal_close();
			post_modal_close();
		});
		
		$('.post-modal, .post-modal_cancel').on('click',function(){
			if(is_blank($('#textarea').val()) && !Object.keys(file_array).length &&  !Object.keys(lists_array).length){
				post_modal_close();
			}else{
				attention_modal_open();
			}
		});
        $("#search_text").on("input", function() {
            searchStr = $(this).val();
            clearTimeout(searchTimer);
            searchTimer = window.setTimeout(search_for, 700);
        });
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

        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
</body>
</html>
