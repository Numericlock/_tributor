@extends('layouts.app')
@section('title', 'スレッド')
@section('cssJs')
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/users_modal.css">
@endsection
@section('content')
		<div class="content">
			<div class="content-title">
				　<span>スレッド</span>
			</div>
			<div class="modal">
			</div>
			<div id="lists-add-modal-content" class=modal-content>
				<div class="modal-title">
					<span id="modal-title">リストを作成</span>
					<svg class="modal-closeButton" id="modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
								52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
						</g>
					</svg>
				</div>
				<div class="lists-add-modal-list-wrapper">
					@foreach($lists as $list)
					<div class="lists-add-modal-list">
						<div class="lists-add-modal-list-icon">
							<img src="/img/2.jpg">
						</div>					
						<div class="lists-add-modal-list-name">
							<span>{{ $list->name }}</span>
						</div>					
						<div class="lists-add-modal-list-checkbox">
							<div>
								<input class="add-modal-list-checkbox" type="checkbox" id="add-list-id-{{ $list->id }}" data-listid="{{ $list->id }}" name="add-list-id-{{ $list->id }}" value="add-list-id-{{ $list->id }}" />
								<label class="checkbox-label" for="add-list-id-{{ $list->id }}">
									<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>
								</label>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="modal-control">
					<button class="modal-positive-button" id="add_modal_submit" type='button'>適応</button>
				</div>
			</div>
            @foreach($userIds as $userId)
            <div id="{{ $userId->users_id }}" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" data-modalid="{{ $userId->users_id }}">
                <div class="users-modal">
                    <div class="users-modal-top-wrapper" >
                        <div class="users-modal-icon">
                            <img src="/img/2.jpg">
                        </div>
                        <div class="users-modal-button">
                        	<div class="users-modal-button-follow" id="followbutton_{{ $userId->users_id }}">
								@if($userId->users_id === $user->user_id )
								@elseif($userId->is_canceled === 1)
									<button class="follow-button" onclick="follow(this)" data-followid="{{ $userId->users_id }}">フォロー</button>
								@elseif ($userId->subject_user_id === $user->user_id )
									<button class="follow-remove-button" onclick="follow_remove(this)" data-followid="{{ $userId->users_id }}">フォロー中</button>
								@else
									<button class="follow-button" onclick="follow(this)" data-followid="{{ $userId->users_id }}">フォロー</button>
								@endif
							</div>
							<button class="follow-button" onclick="show_list_add_modal(this)" data-followid="{{ $userId->users_id }}" data-followname="{{ $userId->users_name }}">リストに追加</button>
                        </div>
                    </div>
                    <div class="users-modal-middle-wrapper">
                        <span class="users-modal-name">{{ $userId->users_name }}</span>
						<div>
                        <span class="users-modal-id">{{ "@".$userId->users_id }}</span>
							@if($userId->users_followed_count === 1)
								<span class="followed-span">フォローされています</span>
							@endif
						</div>
                    </div>
                    <div class="users-modal-bottom-wrapper">
                        <div class="users-modal-introduction">
                        </div>
                    </div>
                    <div class="users-modal-end-wrapper">
                        <div class="users-modal-follow">
                            <span>フォロー数/{{ $userId->subject_count }}</span>
                        </div>
                        <div class="users-modal-follower">
                            <span>フォロワー数/{{ $userId->followed_count }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach ($posts as $post)

				@if($post->attached_count > 0)
					<div class="users-content" id="{{ 'post_'.$post->posts_id }}" style="background-image:url(/img/post_img/{{$post->posts_id.'_0.png'}});">
                        
				@else
					<div class="users-content" id="{{ 'post_'.$post->posts_id }}">
                        
				@endif
                
                <div class="users-information-link">
                    <a href="/{{ $post->users_id }}/{{ $post->posts_id }}">aaaa</a>
				<div class="users-information-wrapper">
                    
                    
				<!--	<img src="/img/1.jpg"></img>
				-->
					<div class="users-icon users-content-modal-open" onclick="users_href(this)" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">
						<img src="/img/icon_img/{{ $post->users_id }}.png">
					</div>
					<div class="users-information">
                        
						<div class="users-name users-content-modal-open" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">
							<span>{{ $post->users_name }}</span>
						</div>
						<div class="information">
							<span><img class="information-icon" src="/img/comment.svg">{{$post->updated_at}}-<img class="information-icon" src="/img/list2.svg"></span>
						</div>
					</div>
				</div>
				<div class="users-content-sentence">
					<span>{{$post->content_text}}</span>
					@if($post->attached_count > 0)
						<img src="/img/post_img/{{$post->posts_id.'_0.png'}}">
					@endif
				</div>	
                </div>
				
				<div class="control">
					<button type='button'>
						<svg class="control-icon comment" data-id="{{ $post->id }}" data-content="{{ $post->content_text }}" data-userid="{{ $post->users_id }}" data-username="{{ $post->users_name }}" data-time="{{$post->updated_at}}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
								l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
								c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
								 M324,300v32H96v-32H324z"/>
						</g>
						</svg>
						{{ $post->comment_count }} /
						{{ $post->attached_count }}
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
						<svg class="control-icon heart" data-id="{{ $post->id }}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
							<g>
								<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
									c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
									l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
							</g>
						</svg>
						{{ $post->favorite_count }}
					</button>
				</div>
			</div>
            @endforeach            
            @foreach ($posts2 as $post)
				@if($post->attached_count > 0)
					<div class="users-content" id="{{ 'post_'.$post->posts_id }}" style="background-image:url(/img/post_img/{{$post->posts_id.'_0.png'}});">
                        
				@else
					<div class="users-content" id="{{ 'post_'.$post->posts_id }}">
                        
				@endif
                
                <div class="users-information-link">
                    <a href="/{{ $post->users_id }}/{{ $post->posts_id }}">aaaa</a>
				<div class="users-information-wrapper">
                    
                    
				<!--	<img src="/img/1.jpg"></img>
				-->
					<div class="users-icon users-content-modal-open" onclick="users_href(this)" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">
						<img src="/img/icon_img/{{ $post->users_id }}.png">
					</div>
					<div class="users-information">
                        
						<div class="users-name users-content-modal-open" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">
							<span>{{ $post->users_name }}</span>
						</div>
						<div class="information">
							<span><img class="information-icon" src="/img/comment.svg">{{$post->updated_at}}-<img class="information-icon" src="/img/list2.svg"></span>
						</div>
					</div>
				</div>
				<div class="users-content-sentence">
					<span>{{$post->content_text}}</span>
					@if($post->attached_count > 0)
						<img src="/img/post_img/{{$post->posts_id.'_0.png'}}">
					@endif
				</div>	
                </div>
				
				<div class="control">
					<button type='button'>
						<svg class="control-icon comment" data-id="{{ $post->id }}" data-content="{{ $post->content_text }}" data-userid="{{ $post->users_id }}" data-username="{{ $post->users_name }}" data-time="{{$post->updated_at}}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
								l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
								c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
								 M324,300v32H96v-32H324z"/>
						</g>
						</svg>
						{{ $post->comment_count }} /
						{{ $post->attached_count }}
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
						<svg class="control-icon heart" data-id="{{ $post->id }}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 512 512" xml:space="preserve">
							<g>
								<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
									c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
									l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
							</g>
						</svg>
						{{ $post->favorite_count }}
					</button>
				</div>
			</div>
            @endforeach
			
		</div>
	<script>
		var posts_num =25;
		var users_modal_timer;
		var users_modal_timer_close;
		var users_modal_timer_close_comp;
        var user_id = @json($user->user_id);

        var post_users = @json($userIds);
		var post_users_ids =[];
		
		var base_checked_array = [];
		var checked_array = [];
		var notchecked_array = [];
		@foreach($userIds as $userId)
			post_users_ids.push("{{ $userId->users_id }}");
		@endforeach
		console.log(post_users_ids);
		console.log(@json($posts));
		
		function users_href(id){
			var user_id = $(id).data('modalid');
			window.location.href = "/"+user_id;
		}
		function users_content_modal_open(over){
			clearTimeout(users_modal_timer);
			clearTimeout(users_modal_timer_close);
			var id = "#"+$(over).data("modalid");
			var height =  $(id).height();
			var off = $(over).offset();	
			users_modal_timer = setTimeout(function(){
				$(id).css('display','none');
				if($(window).height()-$(over).get(0).getBoundingClientRect().top > height+65){
					$(id).css('top',off.top+65);	
				}else if($(over).get(0).getBoundingClientRect().top < height){
					$(id).css('top',off.top+65);
				}else{
					$(id).css('top',off.top-(height+10));
				}
				$(id).css('left',off.left);
				$(id).fadeIn('fast');	
				
			},600);
		}
		function users_content_modal_close(over){
			clearTimeout(users_modal_timer);
			var id="#"+$(over).data("modalid");
			users_modal_timer_close = setTimeout(function(){
				$(id).fadeOut('fast');
			},300);
		}
		
		function users_content_modal_close_reset(){
			clearTimeout(users_modal_timer_close);
		}
		
		function users_content_modal_close_comp(over){
			clearTimeout(users_modal_timer);
			var id="#"+$(over).data("modalid");
			users_modal_timer_close_comp = setTimeout(function(){
				$(id).fadeOut('fast');
			},300);
		}
		function show_list_add_modal(user){
			var user_name = $(user).data("followname");
			var user_id = $(user).data("followid");
			base_checked_array = [];
			checked_array_array=[];
			$('.add-modal-list-checkbox').prop("checked",false);
			$.ajax('/lists/add_user',{
				type: 'get',
				data: { user_id:  user_id},
				dataType: 'json'
			}).done(function(data) {
				data.forEach(function(value ){
					var id='#add-list-id-'+value.list_id;
					base_checked_array.push(value.list_id);
					checked_array.push(value.list_id);
					$(id).prop("checked",true);
				});
				$('#modal-title').text(user_name + "をリストに追加");
				$('#add_modal_submit').data('userid', user_id);
				$('.modal').stop(true, true).fadeIn('500');
				$('#lists-add-modal-content').show().stop(true, true).animate({
					top: "50%",
					display: "fixed",
					opacity: 1.0
				}, 500);
			}).fail(function() {
				window.alert('正しい結果を得られませんでした。');
			});
		}
		$(".add-modal-list-checkbox").change(function() {
				if($(this).prop("checked")==true){
					checked_array.push($(this).data("listid"));
				}else{
					var target = $(this).data("listid");
					checked_array.some(function(v, i){
						if (v==target) checked_array.splice(i,1);
					});
				}
				console.log(checked_array);
		});
        $('#add_modal_submit').on('click', function() {
			for(var i =0;base_checked_array.length>i; i++){
				var id =base_checked_array[i];
				if(checked_array.indexOf(id) == -1){
					notchecked_array.push(id);
				}else{
					checked_array.some(function(v, i){
						if (v == id) checked_array.splice(i,1);
					});
				}
			}
			// 通信実行
			var data = {
				checked: checked_array,
				notchecked: notchecked_array,
				user_id: $('#add_modal_submit').data('userid')
			};
			console.log(data);
			$.ajax({
				type:"post",                // method = "POST"
				url:"/lists/add_user",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				timeout:3000,
			}).done(function(data) {
				console.log("user_add_lists");
				base_checked_array = [];
				checked_array = [];
				notchecked_array = [];
				add_modal_close()
			}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log("Server Error. Pleasy try again later.");
				console.log("XMLHttpRequest : " + XMLHttpRequest.status);
				console.log("textStatus     : " + textStatus);
				console.log("errorThrown    : " + errorThrown.message);
			})
		});
		
        $('.modal, #modal_cancel').on('click', function() {
			add_modal_close();
        });
		function add_modal_close(){
			$('.modal').stop(true, true).fadeOut('500');
			$('#lists-add-modal-content').stop(true, true).animate({
				top: "-1000px",
				left: "50%",
				opacity: 0
			}, 500, function(){
				$('#lists-add-modal-content').hide();
			});
		}
		
		function get_posts(){
			var data = {
				num: posts_num
			};
			
			$.ajax({
				type:"post",                // method = "POST"
				url:"/get_posts",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				success: function(json_data) { // 200 OK時
					posts_num = posts_num+25;
					json_data.forEach(function( value ) {
						if(post_users_ids.indexOf(value.users_id)==-1){
							post_users_ids.push(value.users_id);
							console.log(post_users_ids);
							var append_text = 	
								'<div id="'+ value.users_id +'" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" data-modalid="'+ value.users_id +'">'
								+	'<div class="users-modal">'
								+		'<div class="users-modal-top-wrapper">'
								+			'<div class="users-modal-icon">'
								+				'<img src="/img/'+value.users_id+'.png">'
								+			'</div>'
								+			'<div class="users-modal-button">'
								+				'<div class="users-modal-button-follow" id="followbutton_'+ value.users_id +'">';
							if(value.users_id === user_id){
							}else if(value.is_canceled === 1){
								append_text = append_text + '<button class="follow-button" onclick="follow(this)" data-followid="'+ value.users_id +'">フォロー</button>';
							}else if(value.subject_user_id === user_id){
								append_text = append_text +	'<button class="follow-remove-button" onclick="follow_remove(this)" data-followid="'+ value.users_id +'">フォロー中</button>' 
							}else{
								append_text = append_text +	'<button class="follow-button" onclick="follow(this)" data-followid="'+ value.users_id +'">フォロー</button>'
							}
							append_text = append_text +
												'</div>'				
								+				'<button class="follow-button" onclick="show_list_add_modal(this)" data-followid="'+ value.users_id +'" data-followname="'+ value.users_name +'">リストに追加</button>'
								+			'</div>'
								+		'</div>'
								+		'<div class="users-modal-middle-wrapper">'
								+			'<span class="users-modal-name">'+ value.users_name +'</span>'
								+			'<div>'
								+			'<span class="users-modal-id">@'+ value.users_id +'</span>'
								+			'</div>'
								+		'</div>'
								+		'<div class="users-modal-bottom-wrapper">'
								+			'<div class="users-modal-introduction">'
								+			'</div>'
								+		'</div>'
								+		'<div class="users-modal-end-wrapper">'
								+			'<div class="users-modal-follow">'
								+				'<span>フォロー数/'+ value.subject_count +'</span>'
								+			'</div>'
								+			'<div class="users-modal-follower">'
								+				'<span>フォロワー数/'+ value.followed_count +'</span>'
								+			'</div>'
								+		'</div>'
								+	'</div>'
								+'</div>';
							$('.content').append(
								append_text
							);
						}
						$('.content').append(
									'<div class="users-content">'
									+	'<div class="users-information-wrapper">'
									+'	<!--	<img src="/img/1.jpg"></img>'
									+'	-->'
									+		'<div class="users-icon users-content-modal-open" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="'+ value.users_id +'">'
									+			'<img src="/img/2.jpg">'
									+		'</div>'
									+		'<div class="users-information users-content-modal-open" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="'+ value.users_id +'">'
									+			'<div class="users-name">'
									+				'<span>'+ value.users_name +'</span>'
									+			'</div>'
									+			'<div class="information">'
									+				'<span><img class="information-icon" src="/img/comment.svg">'+ value.created_at +'-<img class="information-icon" src="/img/list2.svg"></span>'
									+			'</div>'
									+		'</div>'
									+	'</div>'
									+	'<div class="users-content-sentence">'
									+		'<span>'+ value.content_text +'</span>'
									+	'</div>'
									+	'<div class="control">'
									+		'<button type="button">'
									+			'<svg class="control-icon comment" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" xml:space="preserve">'
									+			'<g>'
									+				'<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192'
									+				'	l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576'
									+				'	c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z'
									+				'	 M324,300v32H96v-32H324z"/>'
									+			'</g>'
									+			'</svg>'
									+'		</button>'
									+'		<button type="button">'
									+'			<svg class="control-icon diffusion" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"'
									+'				 viewBox="0 0 512 512" xml:space="preserve">'
									+'				<g>'
									+'					<polygon class="st0" points="244.848,49.742 251.894,209.888 260.013,209.888 267.05,49.742 	"/>'
									+'					<polygon class="st0" points="244.848,463.321 267.05,463.321 260.013,303.026 251.894,303.026 	"/>'
									+'					<path class="st0" d="M255.944,23.611c6.542,0,11.834-5.292,11.834-11.778C267.778,5.292,262.486,0,255.944,0'
									+'						c-6.486,0-11.796,5.292-11.796,11.834C244.148,18.32,249.458,23.611,255.944,23.611z"/>'
									+'					<path class="st0" d="M255.944,488.379c-6.486,0-11.796,5.301-11.796,11.805c0,6.515,5.31,11.816,11.796,11.816'
									+'						c6.542,0,11.834-5.301,11.834-11.816C267.778,493.68,262.486,488.379,255.944,488.379z"/>'
									+'					<polygon class="st0" points="217.989,229.467 83.302,143.478 72.215,162.703 213.957,236.495 	"/>'
									+'					<polygon class="st0" points="294.581,283.064 428.12,368.998 439.216,349.791 298.649,276.046 	"/>'
									+'					<path class="st0" d="M39.01,144.364c1.792,1.018,3.836,1.568,5.889,1.568c4.218,0,8.138-2.268,10.248-5.916'
									+'						c1.586-2.726,1.997-5.908,1.185-8.951c-0.821-3.042-2.781-5.59-5.506-7.167c-1.81-1.036-3.835-1.567-5.889-1.567'
									+'						c-4.218,0-8.156,2.24-10.266,5.879C31.442,133.856,33.392,141.07,39.01,144.364z"/>'
									+'					<path class="st0" d="M471.488,367.588c-1.792-1.026-3.836-1.567-5.908-1.567c-4.19,0-8.119,2.249-10.228,5.889'
									+'						c-3.247,5.674-1.316,12.907,4.32,16.154c1.774,1.026,3.818,1.586,5.89,1.586c4.218,0,8.147-2.268,10.266-5.907'
									+'						C479.056,378.088,477.124,370.864,471.488,367.588z"/>'
									+'					<polygon class="st0" points="217.989,282.662 213.957,275.654 72.215,349.222 83.302,368.428 	"/>'
									+'					<polygon class="st0" points="298.649,236.112 440.718,162.115 429.622,142.899 294.581,229.085 	"/>'
									+'					<path class="st0" d="M44.899,365.974c-2.053,0-4.097,0.55-5.889,1.586c-5.637,3.239-7.568,10.5-4.34,16.136'
									+'						c2.109,3.64,6.038,5.916,10.266,5.916c2.044,0,4.079-0.55,5.889-1.596c5.637-3.266,7.569-10.499,4.322-16.135'
									+'						C53.037,368.242,49.117,365.974,44.899,365.974z"/>'
									+'					<path class="st0" d="M467.082,145.886c2.081,0,4.106-0.541,5.908-1.586c5.628-3.257,7.569-10.481,4.322-16.127'
									+'						c-2.101-3.63-6.029-5.908-10.238-5.908c-2.081,0-4.106,0.551-5.898,1.578c-2.716,1.586-4.685,4.134-5.487,7.186'
									+'						c-0.822,3.043-0.401,6.244,1.166,8.969C458.963,143.637,462.874,145.886,467.082,145.886z"/>'
									+'					<polygon class="st0" points="166.417,115.48 229.664,216.934 235.198,213.742 179.072,108.182 177.56,107.753 166.8,113.978 	"/>'
									+'					<path class="st0" d="M155.918,97.02l12.431-7.205l-8.754-15.118l-1.474-0.411l-10.565,6.094c-0.541,0.327-0.709,0.962-0.411,1.466'
									+'						L155.918,97.02z"/>'
									+'					<polygon class="st0" points="345.489,396.426 282.262,295.206 276.708,298.407 333.506,404.247 333.805,404.274 334.346,404.153 '
									+'						345.116,397.947 	"/>'
									+'					<path class="st0" d="M356.025,414.904l-12.449,7.186l8.754,15.118c0.243,0.419,0.634,0.579,0.934,0.579l0.541-0.16l10.546-6.093'
									+'						c0.505-0.308,0.7-0.99,0.411-1.474L356.025,414.904z"/>'
									+'					<path class="st0" d="M88.761,262.952c0.206,0.206,0.458,0.299,0.775,0.299l119.382-3.985v-6.402l-119.382-4.21l-1.101,1.073'
									+'						L88.761,262.952z"/>'
									+'					<path class="st0" d="M49.714,249.841v12.206c0,0.607,0.476,1.083,1.092,1.083h17.47v-14.362H50.788'
									+'						C50.19,248.768,49.714,249.244,49.714,249.841z"/>'
									+'					<polygon class="st0" points="423.463,249.728 422.37,248.655 302.989,252.864 302.989,259.266 422.352,263.252 423.463,262.178 	'
									+'						"/>'
									+'					<path class="st0" d="M462.211,262.047v-12.206c0-0.495-0.589-1.055-1.083-1.055l-17.507-0.018v14.362h17.507'
									+'						C461.716,263.13,462.211,262.654,462.211,262.047z"/>'
									+'					<path class="st0" d="M229.664,295.206l-63.247,101.22l0.383,1.521l10.76,6.188c0.178,0.112,0.354,0.139,0.542,0.139l0.97-0.55'
									+'						l56.144-105.317L229.664,295.206z"/>'
									+'					<path class="st0" d="M147.146,430.061l0.429,1.474l10.546,6.093c0.158,0.094,0.326,0.16,0.504,0.16l0.971-0.579l8.754-15.118'
									+'						l-12.431-7.186L147.146,430.061z"/>'
									+'					<polygon class="st0" points="282.262,216.934 345.489,115.499 345.116,113.978 334.346,107.753 332.844,108.182 276.708,213.742 	'
									+'						"/>'
									+'					<polygon class="st0" points="364.761,81.865 364.369,80.38 353.804,74.286 352.32,74.697 343.576,89.816 356.025,97.02 	"/>'
									+'					<path class="st0" d="M271.333,300.992l-6.187,1.661l38.86,154.482c0.065,0.028,0.14,0.046,0.233,0.046l10.835-3.508'
									+'						L271.333,300.992z"/>'
									+'					<path class="st0" d="M308.626,474.651l3.77,14.12c0.066,0.252,0.317,0.401,0.522,0.401l10.639-3.406l-3.78-14.111L308.626,474.651z'
									+'						"/>'
									+'					<polygon class="st0" points="240.62,211.157 246.826,209.514 207.602,54.764 196.944,58.244 	"/>'
									+'					<polygon class="st0" points="203.309,37.292 198.922,22.771 188.424,26.159 192.231,40.27 	"/>'
									+'					<path class="st0" d="M287.189,291.818L397.76,406.02c0.084,0.094,0.206,0.14,0.346,0.14l0.401-0.14l7.522-8.38L291.734,287.292'
									+'						L287.189,291.818z"/>'
									+'					<path class="st0" d="M410.901,419.038l10.378,10.341c0.112,0.121,0.251,0.139,0.345,0.139l0.364-0.158l7.391-8.166l-10.284-10.331'
									+'						L410.901,419.038z"/>'
									+'					<polygon class="st0" points="224.764,220.312 113.492,105.887 105.98,114.249 220.219,224.838 	"/>'
									+'					<polygon class="st0" points="101.034,92.933 90.002,82.546 82.584,90.722 92.914,101.042 	"/>'
									+'					<polygon class="st0" points="300.871,271.426 453.942,315.047 454.437,314.655 456.742,303.652 302.532,265.22 	"/>'
									+'					<polygon class="st0" points="471.711,319.704 485.925,323.52 486.448,323.128 488.78,312.34 474.688,308.561 	"/>'
									+'					<polygon class="st0" points="209.394,246.91 211.054,240.723 57.554,197.252 55.23,208.227 	"/>'
									+'					<polygon class="st0" points="40.279,192.222 25.516,188.778 23.21,199.548 37.312,203.336 	"/>'
									+'					<polygon class="st0" points="302.55,246.9 457.218,207.574 453.718,196.86 300.889,240.723 	"/>'
									+'					<polygon class="st0" points="474.651,203.262 489.173,198.876 485.785,188.386 471.711,192.156 	"/>'
									+'					<path class="st0" d="M209.421,265.23L54.8,304.333l3.024,10.639c0.076,0.056,0.168,0.075,0.252,0.075l152.997-43.621'
									+'						L209.421,265.23z"/>'
									+'					<path class="st0" d="M37.349,308.635l-14.522,4.377l2.706,10.126c0.084,0.214,0.29,0.382,0.542,0.382l14.231-3.789L37.349,308.635z'
									+'						"/>'
									+'					<polygon class="st0" points="291.716,224.838 406.057,113.427 397.696,105.905 287.208,220.312 	"/>'
									+'					<polygon class="st0" points="429.416,89.946 421.242,82.546 410.901,92.858 419.029,100.978 	"/>'
									+'					<path class="st0" d="M220.238,287.292L105.924,398.451l7.625,7.569c0.121,0.131,0.298,0.131,0.345,0.131l0.384-0.196'
									+'						l110.487-114.137L220.238,287.292z"/>'
									+'					<path class="st0" d="M82.602,421.979l7.4,7.382c0.103,0.121,0.262,0.158,0.364,0.158l0.411-0.186l10.303-10.294l-8.092-8.147'
									+'						L82.602,421.979z"/>'
									+'					<polygon class="st0" points="271.324,211.157 314.674,57.498 303.689,55.155 265.146,209.496 	"/>'
									+'					<polygon class="st0" points="323.184,25.478 312.396,23.135 308.598,37.246 319.694,40.241 	"/>'
									+'					<polygon class="st0" points="240.648,300.973 197.28,454.381 207.76,457.162 208.264,456.723 246.826,302.653 	"/>'
									+'					<polygon class="st0" points="188.834,486.429 199.072,489.154 199.604,488.724 203.393,474.632 192.306,471.655 	"/>'
									+'				</g>'
									+'			</svg>'
									+'		</button>'
									+'		<button type="button">'
									+'			<svg class="control-icon heart" data-id="'+ value.id +'" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"'
									+'				 viewBox="0 0 512 512" xml:space="preserve">'
									+'				<g>'
									+'					<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391'
									+'						c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547'
									+'						l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>'
									+'				</g>'
									+'			</svg>'
									+'		</button>'
									+'	</div>'
									+'</div>'
						); 
					});
					$('#script-reload').empty();
					$('#script-reload').append(
						'<scr'+'ipt>'
						+'$(".heart").on("click",function(){'
						+'	console.log(favorite_flag);'
						+'	favorite_flag = false;'
						+'});	'
						+'</scr'+'ipt>'
					);
					bottomPos = $(document).height() - $(window).height() - 1;    //画面下位置を取得
					get_flag = true;
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
        

		var get_flag = true;
		var favorite_flag =true;
		var follow_flag =true;
		var follow_remove_flag =true;
		var bottomPos = $(document).height() - $(window).height() - 1;    //画面下位置を取得
		
		$(window).scroll(function () {
			if ($(this).scrollTop() >= bottomPos && get_flag ==true ) {
				console.log("bottomPos");
				get_flag = false;
				get_posts();
			}
		});
        

		function follow(button){
			console.log($(button).data('followid')+"wwwwwwwww");
			console.log(follow_flag);
			if(follow_flag ==true){
				follow_flag = false;
				var id = $(button).data('followid');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/follow",        // POST送信先のURL
					dataType: 'json',
					data : {user_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					console.log("follow");
					$('#followbutton_'+id).empty();
					$('#followbutton_'+id).append(
					'<button class="follow-remove-button" onclick="follow_remove(this)" data-followid='+id+'>フォロー中</button>'
					);
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				follow_flag = true;
			}
		}
		
		function follow_remove(button){
			console.log($(button).data('followid')+"wwwwwwwww");
			console.log(follow_remove_flag);
			if(follow_remove_flag ==true){
				follow_remove_flag = false;
				var id = $(button).data('followid');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/follow/remove",        // POST送信先のURL
					dataType: 'json',
					data : {user_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					console.log("follow_remove");
					$('#followbutton_'+id).empty();
					$('#followbutton_'+id).append(
					'<button class="follow-button" onclick="follow(this)" data-followid='+id+'>フォロー</button>'
					);
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				follow_remove_flag = true;
			}
		}
		
		$('.heart').on('click',function(){
			console.log(favorite_flag);
			if(favorite_flag ==true){
				favorite_flag = false;
				console.log($(this).data('id'));
				favorite_postForm($(this).data('id'));   
				favorite_flag = true;
			}
		});	
		function favorite_postForm(id){
			console.log(id+"ID");
			// 通信実行
			$.ajax({
				type:"post",                // method = "POST"
				url:"/favorite",        // POST送信先のURL
				dataType: 'json',
				data : {post_id: id},
                async : false,   // ← asyncをfalseに設定する
				timeout:3000,
			}).done(function(data) {
				console.log("favo");
			}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log("Server Error. Pleasy try again later.");
				console.log("XMLHttpRequest : " + XMLHttpRequest.status);
				console.log("textStatus     : " + textStatus);
				console.log("errorThrown    : " + errorThrown.message);
			})
		};
	</script>
@endsection
