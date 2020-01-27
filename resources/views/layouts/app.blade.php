<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')/-tributor</title>
	<script src="/js/jquery-2.1.3.js"></script>
	<script src="/js/moment.js"></script>
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
				<button type="button" id="dotRadius" class="dotRadius" data-toggle="post-modal" >
					<span id="plus"></span>
				</button>
			</div>
			<a href="/logout">
				<span>ログアウト</span>
			</a>
			<svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 512 512"  xml:space="preserve">
			<g>
				<circle class="st0" cx="55.091" cy="256" r="55.091"/>
				<circle class="st0" cx="256" cy="256" r="55.091"/>
				<circle class="st0" cx="456.909" cy="256" r="55.091"/>
			</g>
			</svg>

		</div>
		@yield('content')
		<div class="list">
			@foreach($lists as $list)
			<a href="/lists/{{ $list->id }}"><img class="common-list-icon" src="/img/list_icon/{{ $list->id }}.png"></a>
			@endforeach
			<a href="#">
				<svg class="edit-list-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
					<g>
						<path class="st0" d="M504.16,183.326l-17.24-17.233c-10.453-10.461-27.415-10.452-37.868,0l-16.127,16.136l55.1,55.099
							l16.135-16.126C514.613,210.741,514.613,193.787,504.16,183.326z" />
						<path class="st0" d="M18.474,178.378H64.86c10.199,0,18.474-8.274,18.474-18.49c0-10.208-8.275-18.482-18.474-18.482H18.474
							C8.274,141.406,0,149.68,0,159.888C0,170.104,8.274,178.378,18.474,178.378z" />
						<rect x="22.83" y="197.722" class="st0" width="34.583" height="116.557" />
						<path class="st0" d="M83.334,352.113c0-10.208-8.275-18.491-18.474-18.491H18.474C8.274,333.622,0,341.905,0,352.113
							c0,10.207,8.274,18.482,18.474,18.482H64.86C75.059,370.595,83.334,362.32,83.334,352.113z" />
						<rect x="139.594" y="150.44" class="st0" width="155.624" height="25.937" />
						<rect x="139.594" y="245.543" class="st0" width="155.624" height="25.938" />
						<rect x="139.594" y="340.647" class="st0" width="95.104" height="25.937" />
						<path class="st0" d="M57.413,71.556c0.008-3.977,3.242-7.211,7.215-7.219h263.645c8.82,0.008,16.638,3.52,22.434,9.287
							c5.767,5.8,9.283,13.619,9.292,22.434v132.194l34.583-34.583V96.058c-0.013-36.627-29.682-66.296-66.309-66.304H64.628
							c-23.096,0.017-41.785,18.71-41.798,41.802v50.507h34.583V71.556z" />
						<path class="st0" d="M359.998,415.943c-0.009,8.814-3.525,16.633-9.292,22.424c-5.796,5.775-13.614,9.288-22.434,9.296H64.628
							c-3.973-0.008-7.206-3.242-7.215-7.218v-50.507H22.83v50.507c0.013,23.092,18.702,41.785,41.798,41.801h263.645
							c36.627-0.008,66.296-29.677,66.309-66.303v-58.274l-34.583,34.583V415.943z" />
						<polygon class="st0" points="281.81,333.344 281.81,388.443 336.911,388.443 472.997,252.357 417.897,197.257 	" />
					</g>
				</svg>
			</a>
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
            <button type='button'><img class="post-modal-control-icon" src="/img/comment.svg"></button>
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


	<script>
			function start_alert() {
    alert("touchstart!!");
}	

		var mySwiper = new Swiper ('.swiper-container', {
			effect: "slide",
			loop: true,
			pagination: '.swiper-pagination',
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			onSlideChangeEnd:function (idx) {
				slide_flag = true;
			},
		});
		var slide_flag = true;
		function swiper_prev(t){
			if(slide_flag == true){
				slide_flag = false;
				var parent = $(t).parent().parent().parent().parent().parent();
				var num = Number($(t).parent().data('num'));
				var maxnum = Number($(t).parent().data('maxnum'));
				num = num-1;
				if(num <= -1){
					num=maxnum-1;
				}
				console.log(num);
				$(t).parent().data('num',num);
				parent.css('background-image', 'url(/img/post_img/'+$(t).parent().data('id')+'_'+ num +'.png)');
			}
		}		
		function swiper_next(t){
			if(slide_flag == true){
				slide_flag = false;
				var parent = $(t).parent().parent().parent().parent().parent();
				var num = Number($(t).parent().data('num'));
				var maxnum = Number($(t).parent().data('maxnum'));
				num = num+1;
				if(num >= maxnum){
					num=0;
				}
				console.log(num);
				$(t).parent().data('num',num);
				parent.css('background-image', 'url(/img/post_img/'+$(t).parent().data('id')+'_'+ num +'.png)');
			}
		}

		// Check for the various File API support.
		if (window.File && window.FileReader && window.FileList && window.Blob) {
		  // Great success! All the File APIs are supported.
		} else {
		  alert('The File APIs are not fully supported in this browser.');
		}
		var file_array = [];
		var reader_array  = [];
		var preview_array = [];
        var files = [];
		var parent_post_id = null;
		function previewFiles() {
			if(file_array.length<4){
				var input_file_length = document.querySelector('input[type=file]').files.length;
				var file_length = document.querySelector('input[type=file]').files.length + file_array.length;
				for(var i=0; i<input_file_length; i++){
					file_array.push(document.querySelector('input[type=file]').files[i]);
					reader_array.push(new FileReader());
				}
				create_imgArea(file_length);
			}
		}
		$('.input-images').on('click',function(){
			var id=$(this).attr("id").substr(8,1)
			file_array.splice(id,1);
			preview_array.splice(id,1);
			create_imgArea(file_array.length);
		});
		function create_imgArea(length){
			//なぜかfor文回せない。
			reader_array  = [];
			preview_array = [];
			for(var i=0; i<length; i++){
				preview_array.push(document.querySelector('img[id="preview-' + i + '"]'));
			}
			for(var i=0; i<length; i++){
				reader_array.push(new FileReader());
				reader_array[i].readAsDataURL(file_array[i]);
			}
			if(length>0){
				reader_array[0].addEventListener("load", function () {
					preview_array[0].src = reader_array[0].result;
                    files[0] = reader_array[0].result;
				}, false);
			}

			if(length>1){
				reader_array[1].addEventListener("load", function () {
					preview_array[1].src = reader_array[1].result;
                    files[1] = reader_array[1].result;
				}, false);
			}

			if(length>2){
				reader_array[2].addEventListener("load", function () {
					preview_array[2].src = reader_array[2].result;
                    files[2] = reader_array[2].result;
				}, false);
			}

			if(length>3){
				reader_array[3].addEventListener("load", function () {
					preview_array[3].src = reader_array[3].result;
                    files[3] = reader_array[3].result;
				}, false);
			}
			switch(length){
				case 0:
					$("#preview-0, #preview-1, #preview-2, #preview-3").css({
						'display':'none'
					});
					break;
				case 1:
					$(".post-modal-inputFiles-left").css({
						'display':'block',
						'width':'100%'
					});
					$(".post-modal-inputFiles-right").css({
						'display':'none'
					});
					$("#preview-0").css({
						'display':'block',
						'width':'100%',
						'height':'300px',
						'object-fit':'cover'
					});
					$("#preview-1, #preview-2, #preview-3").css({
						'display':'none'
					});
					break;
				case 2:
					$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
						'display':'block',
						'width':'50%',
					});
					$("#preview-0,#preview-1").css({
						'display':'block',
						'width':'100%',
						'height':'300px',
						'object-fit':'cover'
					});
					$("#preview-2, #preview-3").css({
						'display':'none'
					});
					break;
				case 3:
					$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
						'display':'block',
						'width':'50%',
					});
					$("#preview-0").css({
						'display':'block',
						'width':'100%',
						'height':'300px',
						'object-fit':'cover'
					});
					$("#preview-1,#preview-2").css({
						'display':'block',
						'width':'100%',
						'height':'150px',
						'object-fit':'cover'
					});
					$("#preview-3").css({
						'display':'none'
					});

					break;
				case 4:
					$(".post-modal-inputFiles-left,.post-modal-inputFiles-right").css({
						'display':'block',
						'width':'50%',
					});
					$("#preview-0,#preview-1,#preview-2,#preview-3").css({
						'display':'block',
						'width':'100%',
						'height':'150px',
						'object-fit':'cover'
					});
					break;
			}
		}
		

		$('#dotRadius').on('click',function(){
			post_modal_open();
		});
		function comment(t){
			var id = $(t).data("id");
			var content = $(t).data("content");
			var user_id = $(t).data("userid");
			var user_name = $(t).data("username");
			var time = $(t).data("time");
			//var post = $('#post_'+id).clone();
			//post.css("background","white");
			$('#parentPost_usericon').attr('src', 'img/icon_img/'+user_id+'.png');
			$('#parentPost_username').text(user_name);
			$('#parentPost_userid').text(user_id);
			$('#parentPost_time').text(time);
			$('#parentPost_sentence').text(content);
			//$('.post-modal-textarea').before(post);
			$('.post-modal-parentPost').css("display","flex");
			parent_post_id = id;
			post_modal_open();
		}
		
		function post_modal_open(){
			$('.post-modal').stop(true, true).fadeIn('500');
			$('#post-modal_content').show().stop(true, true).animate({
				top: "50%",
				
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#post-modal_content_next').show().stop(true, true).animate({
				left: "120%",
				top:"50%",
				display: "fixed",
				opacity: 0
			}, 500, function(){
				$('#post-modal_content_next').hide();
			});
		}
		function img_slide(t){
			var img = $(t).parent().find("img");
			var src = img.attr('src'); 
			src = src.slice(0, -4);
			var max_num = img.data('num');
			var num = src.substr(-1, 1);
			if(max_num != 1){
				num = Number(num)+1;
				if(num >= max_num){
					num=0;
				}
				src = src.slice(0, -1);
				src = src + num + ".png";
				console.log(max_num);
				img.attr('src',src);	
			}
		}
		var attached_num;
		function attached_modal_open(t){
			attached_num = $(t).data("num");
			$('#attached_modal_content_img').attr('src',$(t).attr('src')); 
			$('.attached-modal').stop(true, true).fadeIn('500');
			$('.attached-modal-content').show().stop(true, true).animate({
				display: "flex",
				opacity: 1.0
			}, 200);	
		}
		
		function attached_modal_close(){
			$('.attached-modal').stop(true, true).fadeOut('500');
			$('.attached-modal-content').stop(true, true).animate({
				opacity: 0,
				display: "none"
			}, 200, function(){
				$('.attached-modal-content').hide();
			});
		}
		$('.attached-modal, .attached-modal-close-button').on('click',function(){
			attached_modal_close();
		});	
		
		$('.post-modal, .post-modal_cancel').on('click',function(){
			if(is_blank($('#textarea').val()) && !Object.keys(file_array).length &&  !Object.keys(lists_array).length){
				console.log(!Object.keys(file_array).length);
				console.log(!Object.keys(lists_array).length);
				console.log(is_blank($('#textarea').val()));
				post_modal_close();
			}else{
				$('.attention-modal').stop(true, true).fadeIn('500');
				$('.attention-modal-content').show().stop(true, true).animate({
					display: "flex",
					opacity: 1.0
				}, 200);
			}
		});
		
		
		$('.attention-modal, .attention-modal-button-cancel').on('click',function(){
			attention_modal_close();
		});	
		
		$('.attention-modal-button-destruction').on('click',function(){
			attention_modal_close();
			post_modal_close();
		});

		
		function attention_modal_close(){
			console.log( $("input[type='file']").val());
			console.log(file_array);
			$('.attention-modal').stop(true, true).fadeOut('500');
			$('.attention-modal-content').stop(true, true).animate({
				opacity: 0,
				display: "none"
			}, 200, function(){
				$('.attention-modal-content').hide();
			});
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
		function post_modal_close(){
			$('.post-modal').stop(true, true).fadeOut('500');
			$('#post-modal_content').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('#post-modal_content').hide();
			
				$('#textarea').val("");
				$('.show-count').text("0");
				lists_array=[];
				file_array=[];
				reader_array  = [];
				preview_array = [];
				imgFiles=[];
				parent_post_id=null;
				$('.post-modal-list-checkbox').prop('checked',false);
				$("#preview-0, #preview-1, #preview-2, #preview-3").css({
					'display':'none'
				});
				$('#textarea').height('50px');
				$('.post-modal-parentPost').css("display","none");
				
			});
			$('.post-modal').stop(true, true).fadeOut('500');
			$('#post-modal_content_next').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('#post-modal_content_next').hide();
			});
		}

		$('#post-modal_next').on('click',function(){
            var count = $('#textarea').val().length;
            if(count != 0 || Object.keys(file_array).length){
			$('#post-modal_content_next').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#post-modal_content').stop(true, true).animate({
				left: "-100px",
				opacity: 0
			}, 500, function(){
				$('#post-modal_content').hide();
			});
            }
		});
		$('#post-modal_back').on('click',function(){
			$('#post-modal_content').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#post-modal_content_next').stop(true, true).animate({
				left: "120%",
				opacity: 0
			}, 500, function(){
				$('#post-modal_content_next').hide();
			});
		});
		$(function() {

			const sampleTextarea = document.querySelector('#textarea');
			sampleTextarea.addEventListener('input', () => {
			  sampleTextarea.style.height = "20px";
			  sampleTextarea.style.height = sampleTextarea.scrollHeight + 5 +"px";
			})

			$('#textarea').on('input',function(){
				var count = $(this).val().length;
				$('.show-count').text(count);
			});
		
		});
		$( 'input[name="disclose"]:checkbox' ).change( function() {
			var elements = document.getElementsByName('disclose') ;
			var radioval = $(this).val();
			if(elements[0].checked == false){
				$('.post-modal-list-area').slideUp();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
			}else{
				//$(".cmn-toggle-small").prop("checked", true);
				$('.post-modal-list-area').slideDown();
				document.getElementById("disclose_status").innerHTML="非公開";
				$('#disclose_status').css('color','#a61a37');
			}
		});
		var textarea;
		var lists_array=[];


		$(".post-modal-list-checkbox").change(function() {
				if($(this).prop("checked")==true){
					lists_array.push($(this).attr("id"));
				}else{
					var target = $(this).attr("id");
					lists_array.some(function(v, i){
						if (v==target) lists_array.splice(i,1);
					});
				}
		});
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
		function tribute_postForm(){
			/*var files = [];
			for(var i=0;i<preview_array.length;i++){
				files.push(reader_array[i].result);
                console.log(reader_array[i].result);
			}
            */
			console.log(files);
            console.log(file_array);
			console.log(lists_array);
			console.log(parent_post_id);
			var data = {
				content_text: $('#textarea').val(),
				parent_post_id:parent_post_id,
				lists:lists_array,
				filetati:files
			};
			// 通信実行
			$.ajax({
				type:"post",                // method = "POST"
				url:"/post",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				success: function(json_data){
					if(post_users_ids.indexOf(json_data.users_id)==-1){
						post_users_ids.push(json_data.users_id);
						var append_text = 	
							'<div id="'+ json_data.users_id +'" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" data-modalid="'+ json_data.users_id +'">'
							+	'<div class="users-modal">'
							+		'<div class="users-modal-top-wrapper">'
							+			'<div class="users-modal-icon">'
							+				'<img src="/img/2.jpg">'
							+			'</div>'
							+			'<div class="users-modal-button">'
							+				'<div class="users-modal-button-follow" id="followbutton_'+ json_data.users_id +'">';
						if(json_data.users_id === user_id){
						}else if(json_data.is_canceled === 1){
							append_text = append_text + '<button class="follow-button" onclick="follow(this)" data-followid="'+ json_data.users_id +'">フォロー</button>';
						}else if(json_data.subject_user_id === user_id){
							append_text = append_text +	'<button class="follow-remove-button" onclick="follow_remove(this)" data-followid="'+ json_data.users_id +'">フォロー中</button>' 
						}else{
							append_text = append_text +	'<button class="follow-button" onclick="follow(this)" data-followid="'+ json_data.users_id +'">フォロー</button>'
						}
						append_text = append_text +
											'</div>'				
							+				'<button class="follow-button" onclick="show_list_add_modal(this)" data-followid="'+ json_data.users_id +'" data-followname="'+ json_data.users_name +'">リストに追加</button>'
							+			'</div>'
							+		'</div>'
							+		'<div class="users-modal-middle-wrapper">'
							+			'<span class="users-modal-name">'+ json_data.users_name +'</span>'
							+			'<div>'
							+			'<span class="users-modal-id">@'+ json_data.users_id +'</span>'
							+			'</div>'
							+		'</div>'
							+		'<div class="users-modal-bottom-wrapper">'
							+			'<div class="users-modal-introduction">'
							+			'</div>'
							+		'</div>'
							+		'<div class="users-modal-end-wrapper">'
							+			'<div class="users-modal-follow">'
							+				'<span>フォロー数/'+ json_data.subject_count +'</span>'
							+			'</div>'
							+			'<div class="users-modal-follower">'
							+				'<span>フォロワー数/'+ json_data.followed_count +'</span>'
							+			'</div>'
							+		'</div>'
							+	'</div>'
							+'</div>';
						$('.content').append(
							append_text
						);
					}
					append_text = dom_post(json_data.posts_id, json_data.users_id, json_data.users_name, json_data.content_text, json_data.updated_at, json_data.share_at, json_data.post_at, json_data.id, json_data.users2_name, json_data.attached_count, json_data.comment_count, json_data.retribute_count, json_data.favorite_count, json_data.is_favorite, json_data.is_retribute);
					$('.content').prepend(
						append_text
					);
					bottomPos = $(document).height() - $(window).height() - 1;    //画面下位置を取得
					get_flag = true;
					post_modal_close();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {       // HTTPエラー時
					console.log("Server Error. Pleasy try again later.");
					console.log(data);
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				},
				complete: function() {      // 成功・失敗に関わらず通信が終了した際の処理

				}
			});
		};
		function dom_post(posts_id, users_id, users_name, content_text, updated_at, share_at, post_at, id, users2_name, attached_count, comment_count, retribute_count, favorite_count, is_favorite, is_retribute){
					var append_text;
					if(attached_count > 0){
						append_text = '<div class="users-content" id="'+ posts_id +'" style="background-image:url(/img/post_img/'+ posts_id +'_0.png);">';
					}else{
						append_text = '<div class="users-content" id="'+ posts_id +'">';
					}
					append_text = append_text +
							'<div class="content-information">'
							+	'<span>';								
								if(share_at == post_at){
									append_text = append_text +
									'<svg class="retribute-icon"  onclick="retribute(this)"  data-id="' + id + '"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">'
								+	'<g>'
								+		'<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152'
								+			'c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093'
								+			'c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557'
								+			'H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2'
								+			'c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0'
								+			'c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007'
								+			'C384.97,28.713,374.203,17.934,360.909,17.934z"/>'
								+	'</g>'
									+'</svg>'+users2_name+"さんがリトリビュート";
								}
					append_text = append_text +
								'</span>'
							+'</div>'
							+'<div class="users-content-wrapper">'
							+	'<div class="users-icon users-content-modal-open">'
							+		'<img src="img/icon_img/'+ users_id +'.png" onclick="users_href(this)" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="'+ users_id +'">'
							+	'</div>'
							+	'<div class="users-information-wrapper">'
							+		'<div class="users-information">'
							+			'<div class="users-content-modal-open">'
+											'<span class="users-information-name" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="'+ users_id +'">'+ users_name +'</span>'
+											'<span class="users-information-id" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="'+ users_id +'"> @'+ users_id +'</span>'
+										'</div>'
+										'<div class="information">'
+											'<span>';
											if(attached_count > 0){
												append_text = append_text +
												'<svg class="information-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">'
												+	'<g>'
												+		'<path class="st0" d="M0,45.178v421.644h512V45.178H0z M471.841,426.662H40.159V85.329h431.682V426.662z"></path>'
												+		'<path class="st0" d="M326.128,207.728c-4.148-6.289-11.183-10.077-18.72-10.069c-7.544,0.007-14.57,3.803-18.71,10.1'
												+		'l-72.226,109.914l-39.862-45.178c-4.619-5.238-11.426-8.022-18.397-7.52c-6.971,0.486-13.308,4.211-17.142,10.053L74.17,376.96'
												+		'h363.659L326.128,207.728z"></path>'
												+		'<path class="st0" d="M174.972,230.713c25.102,0,45.453-20.35,45.453-45.461c0-25.102-20.35-45.452-45.453-45.452'
												+		'c-25.11,0-45.46,20.35-45.46,45.452C129.511,210.363,149.862,230.713,174.972,230.713z" ></path>'
												+	'</g>'
												+'</svg>';
											}else{
												append_text = append_text +
												'<svg class="information-icon" onclick="comment(this)" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">'
												+'<g>'
												+	'<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192'
												+		'l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576'
												+		'c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z'
												+		 'M324,300v32H96v-32H324z"/>'
												+'</g>'
												+'</svg>';
											}
											var date = new Date() ;
											var timestamp = Math.floor( (date.getTime() - Date.parse(post_at))/1000) ;
											if(0 >= timestamp){
												append_text = append_text + " 今";
											}else if(60 >= timestamp){
												append_text = append_text + " " + timestamp + "秒前";
											}else if(3600 >= timestamp){
												append_text = append_text + " " + Math.floor(timestamp/60) + "分前";	 
											}else if(86400 >= timestamp){
												append_text = append_text + " " + Math.floor(timestamp/3600) + "時間前";	 	 
											}else{
												var date = moment(post_at);
												date = date.format('M月DD日');
												append_text = append_text + " " + date;;	 
											}
											append_text = append_text +
											'</span>'
									+	'</div>'
									+'</div>'
									+'<div class="users-content-sentence">'
									+	'<div class="users-information-link">'
									+		'<span>'+ content_text +'</span>'
									+		'<a href="/'+ users_id +'/'+ posts_id +'">aaaa</a>'
									+	'</div>';
										if(attached_count > 1){
										append_text = append_text +
										'<div class="swiper-container" data-id="'+ posts_id +'"  data-num="0"  data-maxnum="'+ attached_count +'">'
											+'<div class="swiper-wrapper">';
											for (var i = 0; attached_count > i ; i++){
												append_text = append_text +
												'<div class="swiper-slide" style="margin:0 auto;">'
												+	'<img src="/img/post_img/'+ posts_id +'_'+ i +'.png" onclick="attached_modal_open(this)" data-num="'+ attached_count +'" >'
												+'</div>';
											}
											append_text = append_text +
											'</div>'
										+	'<div class="swiper-pagination"></div>'
										+	'<div class="swiper-button-prev" onclick="swiper_prev(this);"></div>'
										+	'<div class="swiper-button-next" onclick="swiper_next(this);"></div>'
										+'</div>';
										}else if(attached_count == 1){
											append_text = append_text + '<img src="/img/post_img/'+ posts_id +'_0.png" onclick="attached_modal_open(this)" data-num="'+ attached_count +'" >';
										}
									append_text = append_text +
									'</div>'
									+'<div class="control">'
									+	'<button type="button">'
									+		'<svg class="control-icon comment" onclick="comment(this)" data-id="'+ id +'" data-content="'+ content_text +'" data-userid="'+ users_id +'" data-username="'+ users_name +'" data-time="'+ updated_at +'" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">'
									+		'<g>'
									+			'<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192'
									+				'l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576'
									+				'c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z'
									+				 'M324,300v32H96v-32H324z"/>'
									+		'</g>'
									+		'</svg>'
									+		'<span>';
											if(comment_count > 0){
												append_text = append_text + comment_count;
											}
											append_text = append_text +
											'</span>'
										+'</button>'
										+'<button type="button">';
											if(is_retribute == 0){
											append_text = append_text +
											'<svg class="control-icon diffusion"  onclick="retribute(this)"  data-id="'+ id +'"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">'
											+	'<g>'
											+		'<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152'
											+			'c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093'
											+			'c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557'
											+			'H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2'
											+			'c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0'
											+			'c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007'
											+			'C384.97,28.713,374.203,17.934,360.909,17.934z"/>'
											+	'</g>'
											+'</svg>';
											}else{
											append_text = append_text +
											'<svg class="control-icon diffusion-retribute"  onclick="retribute_remove(this)"  data-id="'+ id +'"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">'
											+	'<g>'
											+		'<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152'
											+			'c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093'
											+			'c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557'
											+			'H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2'
											+			'c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0'
											+			'c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007'
											+			'C384.97,28.713,374.203,17.934,360.909,17.934z"/>'
											+	'</g>'
											+'</svg>'
											+'<span>';
											}
											if(retribute_count > 0){
												append_text = append_text + retribute_count;
											}
											append_text = append_text +
											'</span>'
										+'</button>'
										+'<button type="button">';
											if(is_favorite == 0){
											append_text = append_text +
											'<svg class="control-icon heart" onclick="favorite(this)" data-id="'+ id +'" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">'
											+	'<g>'
											+		'<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391'
											+			'c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547'
											+			'l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>'
											+	'</g>'
											+'</svg>';
											}else{
											append_text = append_text +
											'<svg class="control-icon heart-favorite" onclick="favorite_remove(this)" data-id="'+ id +'" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">'
											+	'<g>'
											+		'<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391'
											+			'c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547'
											+			'l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>'
											+	'</g>'
											+'</svg>'
											+'<span>';
											}
											if(favorite_count > 0){
												append_text = append_text + favorite_count;
											}
											append_text = append_text +
											'</span>'
						+				'</button>'
						+			'</div>'
						+		'</div>'
						+	'</div>'
						+'</div>'
					+'<scr'+'ipt>'
					+'mySwiper = new Swiper (".swiper-container", {'
					+			'effect: "slide",'
					+			'loop: true,'
					+			'pagination: ".swiper-pagination",'
					+			'nextButton: ".swiper-button-next",'
					+			'prevButton: ".swiper-button-prev",'
					+			'onSlideChangeEnd:function (idx) {'
					+				'slide_flag = true;'
					+			'},'
					+		'});'
					+'</scr'+'ipt>';
			return append_text;
		}
        $("#search_text").on("input", function() {
            searchStr = $(this).val();
            clearTimeout(searchTimer);
            searchTimer = window.setTimeout(search_for, 700);
        });
		$('#post-modal_post').on('click',function(){
			console.log($('input[name="disclose"]:checkbox').prop('checked'));
            if(lists_array != "" || $('input[name="disclose"]:checkbox').prop('checked') == false){
				tribute_postForm();
            }else{
                alert("リストが選択されていません")
            }
		});
	</script>
</body>
</html>
