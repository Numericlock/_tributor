@extends('layouts.app')
@section('title', 'ホーム')
@section('cssJs')
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/home_nav_icon.css">
	<link rel="stylesheet" href="/css/users_modal.css">
@endsection
@section('content')
		<div class="content-wrapper">
			<div class="content-title">
				 <span>ホーム</span>
			</div>
			<div class="content" id="content" >
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
								<img src="/img/icon_img/{{$userId->users_id}}.png">
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
					<div class="content-information">
						<span>								
							@if($post->users2_id == $user->user_id)
							@elseif($post->share_at == $post->post_at)
							<svg class="retribute-icon"  onclick="retribute(this)"  data-id="{{ $post->id }}"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">
								<g>
									<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152
										c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093
										c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557
										H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2
										c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0
										c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007
										C384.97,28.713,374.203,17.934,360.909,17.934z"/>
								</g>
							</svg>	
							{{$post->users2_name."さんがリトリビュート"}}
							@endif
						</span>
					</div> 
					<div class="users-content-wrapper">
						<div class="users-icon users-content-modal-open">
							<img src="img/icon_img/{{ $post->users_id }}.png" onclick="users_href(this)" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">
						</div>
						<div class="users-information-wrapper">
							<div class="users-information">
								<div class="users-content-modal-open">

									<span class="users-information-name" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">{{ $post->users_name }}</span>
									<span class="users-information-id" onmouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" data-modalid="{{ $post->users_id }}">{{ "@".$post->users_id }}</span>
								</div>
								<div class="information">
									<span>
										@if($post->attached_count > 0)
										<svg class="information-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
											<g>
												<path class="st0" d="M0,45.178v421.644h512V45.178H0z M471.841,426.662H40.159V85.329h431.682V426.662z"></path>
												<path class="st0" d="M326.128,207.728c-4.148-6.289-11.183-10.077-18.72-10.069c-7.544,0.007-14.57,3.803-18.71,10.1
												l-72.226,109.914l-39.862-45.178c-4.619-5.238-11.426-8.022-18.397-7.52c-6.971,0.486-13.308,4.211-17.142,10.053L74.17,376.96
												h363.659L326.128,207.728z"></path>
												<path class="st0" d="M174.972,230.713c25.102,0,45.453-20.35,45.453-45.461c0-25.102-20.35-45.452-45.453-45.452
												c-25.11,0-45.46,20.35-45.46,45.452C129.511,210.363,149.862,230.713,174.972,230.713z" ></path>
											</g>
										</svg>	
										@else
											<svg class="information-icon" onclick="comment(this)" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 viewBox="0 0 512 512" xml:space="preserve">
											<g>
												<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
													l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
													c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
													 M324,300v32H96v-32H324z"/>
											</g>
											</svg>
										@endif
										@if( 60 >= strtotime('now')-strtotime($post->updated_at))
											{{(strtotime('now')-strtotime($post->updated_at))."秒前"}}
										@elseif(3600 >= strtotime('now')-strtotime($post->updated_at))
											{{floor((strtotime('now')-strtotime($post->updated_at))/60)."分前"}}
										@elseif(86400 >= strtotime('now')-strtotime($post->updated_at))
											{{floor((strtotime('now')-strtotime($post->updated_at))/3600)."時間前"}}
										@else
											{{date('n月d日', strtotime($post->updated_at))}}
										@endif
									</span>
								</div>
							</div>
							<div class="users-content-sentence">
								<div class="users-information-link">
									<span>{{$post->content_text}}</span>
									<a href="/{{ $post->users_id }}/{{ $post->posts_id }}">aaaa</a>
								</div>
								@if($post->attached_count > 1)
									<!--<img src="/img/post_img/{{$post->posts_id.'_0.png'}}" onclick="attached_modal_open(this)" data-num="{{ $post->attached_count }}" >-->
								<div class="swiper-container" data-id="{{ $post->posts_id }}"  data-num="0"  data-maxnum="{{ $post->attached_count }}">
									<!-- Additional required wrapper -->
									<div class="swiper-wrapper">
										<!-- Slides -->
										@for ($i = 0; $post->attached_count > $i ; $i++)
										<div class="swiper-slide" style="margin:0 auto;">
											<img src="/img/post_img/{{$post->posts_id.'_'.$i.'.png'}}" onclick="attached_modal_open(this)" data-num="{{ $post->attached_count }}" >
										</div>
										@endfor
									</div>
									<!-- If we need pagination -->
									<div class="swiper-pagination"></div>

									<!-- If we need navigation buttons -->
									<div class="swiper-button-prev" onclick="swiper_prev(this);" data-id="{{ $post->posts_id }}"  data-num="0"  data-maxnum="{{ $post->attached_count }}"></div>
									<div class="swiper-button-next" onclick="swiper_next(this);"></div>
								</div>
								@elseif($post->attached_count == 1)
									<img src="/img/post_img/{{$post->posts_id.'_0.png'}}" onclick="attached_modal_open(this)" data-num="{{ $post->attached_count }}" >
								@endif
							</div>	


							<div class="control">
								<button type='button'>
									<svg class="control-icon comment" onclick="comment(this)" data-id="{{ $post->id }}" data-content="{{ $post->content_text }}" data-userid="{{ $post->users_id }}" data-username="{{ $post->users_name }}" data-time="{{$post->updated_at}}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 512 512" xml:space="preserve">
									<g>
										<path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
											l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
											c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
											 M324,300v32H96v-32H324z"/>
									</g>
									</svg>
									<span>{{ $post->comment_count >0 }}</span>
								</button>
								<button type='button'>
									@if($post->is_retribute == 0)
									<svg class="control-icon diffusion"  onclick="retribute(this)"  data-id="{{ $post->id }}"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">
										<g>
											<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152
												c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093
												c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557
												H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2
												c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0
												c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007
												C384.97,28.713,374.203,17.934,360.909,17.934z"/>
										</g>
									</svg>
									
									@else
									<svg class="control-icon diffusion-retribute"  onclick="retribute_remove(this)"  data-id="{{ $post->id }}"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve">
										<g>
											<path id="Loop" d="M360.909,17.934H24.061C10.767,17.934,0,28.713,0,41.995V258.54c0,13.293,10.767,24.061,24.061,24.061h60.152
												c7.711,0,12.03-5.45,12.03-12.03c0-6.581-4.09-12.187-12.03-12.187H38.738c-8.036,0-14.557-6.52-14.557-14.557V57.093
												c0-8.036,6.52-14.557,14.557-14.557l307.627-0.373c8.036,0,14.557,6.52,14.557,14.557v187.107c0,8.036-6.52,14.557-14.557,14.557
												H209.556l62.413-63.303c4.692-4.752,4.692-12.439,0-17.191c-4.704-4.74-12.319-4.74-17.011,0l-83.009,84.2
												c-4.692,4.74-4.692,12.439,0,17.191c0,0,0,0,0.012,0l82.997,84.2c4.692,4.74,12.319,4.74,17.011,0
												c4.692-4.752,4.692-12.439,0-17.179l-62.774-63.688h151.714c13.293,0,24.061-10.767,24.061-24.061V42.007
												C384.97,28.713,374.203,17.934,360.909,17.934z"/>
										</g>
									</svg>
									@endif
									<span>{{ $post->retribute_count > 0 }}</span>
								</button>
								<button type='button'>
									@if($post->is_favorite == 0)
									<svg class="control-icon heart" onclick="favorite(this)" data-id="{{ $post->id }}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 512 512" xml:space="preserve">
										<g>
											<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
												c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
												l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
										</g>
									</svg>
									@else
									<svg class="control-icon heart-favorite" onclick="favorite_remove(this)" data-id="{{ $post->id }}" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 512 512" xml:space="preserve">
										<g>
											<path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
												c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
												l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
										</g>
									</svg>
									@endif
									<span>{{ $post->favorite_count > 0 }} </span>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	<script>
		var last_post_at =@json($last_post->post_at);
		var start_post_at = @json($start_post->post_at);
		console.log(start_post_at);
		console.log(last_post_at);
		var users_modal_timer;
		var users_modal_timer_close;
		var users_modal_timer_close_comp;
        var user_id = @json($user->user_id);
		
		var page_height = 0;
		var past_posts_height = 0;

        var post_users = @json($userIds);
        var posts=  @json($posts);
        var past_posts=  [];
        var latest_posts=  [];
		var post_users_ids =[];
		
		var base_checked_array = [];
		var checked_array = [];
		var notchecked_array = [];
		@foreach($userIds as $userId)
			post_users_ids.push("{{ $userId->users_id }}");
		@endforeach
		console.log(post_users_ids);
		var active_flag = false;
		// ウィンドウがアクティブになった際に実行する関数
		function play() {
				// 実行させる処理を記述
			console.log("active");
			get_latest_posts();
		}

		// ウィンドウがアクティブでなくなった際に実行する関数
		function pause() {
				// 実行させる処理を記述
			console.log("deactive");
		}
		var loaded_count = 0;
		var load_count = 0;
		var imagesLoadListener = (function() {

			var imageCollector = function(expectedCount, completeFn) {
				var receivedCount = 0;
				return function() {
					receivedCount++;
					if(receivedCount === expectedCount) {
						completeFn();
					}
				};
			};

			var imagesLoadListener = function(element, callback) {
				var images = element.querySelectorAll('img');
				if(images === null) {
					callback();
					return;
				}

				//画像の数だけloadListenerが呼ばれたらcallbackが呼ばれる;
				var loadListener = imageCollector(images.length, callback);
				Array.prototype.forEach.call(images, function(img) {
					if(img.complete) {
						loadListener();
					}else {
						img.onload = loadListener;
					}
				});
			};

			return imagesLoadListener;
		})();
		
	/*	imagesLoadListener(document.body, function() {
				posts.forEach(function(value ){
					value.height = $('#post_'+value.id).outerHeight();
					page_height= page_height+ value.height;
					console.log($(window).height()*4);
					if(page_height > ($(window).height()*4)){
						$('#post_'+value.id).remove();
						$('#content').css('padding-top',0);
						$('#content').css('padding-bottom',page_height - $(window).height()*2);
					}
				});
				load_count=0;
				bottomPos = $('#content').height();
				get_flag = true;
				console.log(page_height);
				console.log($('#content').height());
		});
	*/
		// ウィンドウをフォーカスしたら指定した関数を実行
		window.addEventListener('focus', play);

		// ウィンドウからフォーカスが外れたら指定した関数を実行
		window.addEventListener('blur', pause);
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

		function get_latest_posts(){
			var data = {
				num: start_post_at
			};
			$.ajax({
				type:"post",                // method = "POST"
				url:"/get_latest_posts",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				success: function(json_data) { // 200 OK時
					console.log(json_data);
					console.log($('.users_content').height());
					last_post_at = last_post_at+25;
					json_data.forEach(function( value ) {
						start_post_at = value.post_at;
						if(post_users_ids.indexOf(value.users_id)==-1){
							post_users_ids.push(value.users_id);
							console.log(post_users_ids);
							var append_text = 	
								'<div id="'+ value.users_id +'" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" data-modalid="'+ value.users_id +'">'
								+	'<div class="users-modal">'
								+		'<div class="users-modal-top-wrapper">'
								+			'<div class="users-modal-icon">'
								+				'<img src="/img/2.jpg">'
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
						append_text = dom_post(value.posts_id, value.users_id, value.users_name, value.content_text, value.updated_at, value.share_at, value.post_at, value.id, value.users2_name, value.attached_count, value.comment_count, value.retribute_count, value.favorite_count, value.is_favorite, value.is_retribute);
						prependAdd(append_text);
					});
					imagesLoadListener(document.body, function() {
							past_posts.forEach(function(value ){
								value.height = $('#post_'+value.id).outerHeight();
								page_height = page_height+ value.height;
								posts.push(value);
								console.log(value.height);
								console.log(document.body.getBoundingClientRect().height);
							});
							past_posts = [];
							load_count=0;
							get_flag = true;
							console.log(page_height);
							console.log($('#content').height());
					});

				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {       // HTTPエラー時
					console.log("Server Error. Pleasy try again later.");
					console.log(data);
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				},
				complete: function() {      // 成功・失敗に関わらず通信が終了した際の処理
                get_flag = true;
				bottomPos = $(document).height() - $(window).height() - 1;    
				}
			});
		};
		function get_posts(){
			var data = {
				num: last_post_at
			};
			$.ajax({
				type:"post",                // method = "POST"
				url:"/get_posts",        // POST送信先のURL
				data:JSON.stringify(data),  // JSONデータ本体
				contentType: 'application/json', // リクエストの Content-Type
                processData: false,         // レスポンスをJSONとしてパースする
                async : false,   // ← asyncをfalseに設定する
				success: function(json_data) { // 200 OK時
					json_data.forEach(function( value ) {
						past_posts.push(value);
						last_post_at = value.post_at;
						if(post_users_ids.indexOf(value.users_id)==-1){
							post_users_ids.push(value.users_id);
							console.log(post_users_ids);
							var append_text = 	
								'<div id="'+ value.users_id +'" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" data-modalid="'+ value.users_id +'">'
								+	'<div class="users-modal">'
								+		'<div class="users-modal-top-wrapper">'
								+			'<div class="users-modal-icon">'
								+				'<img src="/img/2.jpg">'
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
						append_text = dom_post(value.posts_id, value.users_id, value.users_name, value.content_text, value.updated_at, value.share_at, value.post_at, value.id, value.users2_name, value.attached_count, value.comment_count, value.retribute_count, value.favorite_count, value.is_favorite, value.is_retribute);
						appendAdd(append_text);
					});
					imagesLoadListener(document.body, function() {
							past_posts.forEach(function(value ){
								value.height = $('#post_'+value.id).outerHeight();
								page_height = page_height+ value.height;
								posts.push(value);
								console.log(value.height);
								console.log(document.body.getBoundingClientRect().height);
							});
							past_posts = [];
							load_count=0;
							get_flag = true;
							console.log(page_height);
							console.log($('#content').height());
					});
					console.log(existsSameValue(posts));
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {       // HTTPエラー時
					console.log("Server Error. Pleasy try again later.");
					console.log(data);
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				},
				complete: function() {      // 成功・失敗に関わらず通信が終了した際の処理
                get_flag = true;
				bottomPos = $(document).height() - $(window).height() - 1;    
				}
			});
		};
		function existsSameValue(a){//配列重複チェック
		  var s = new Set(a);
		  return s.size != a.length;
		}
		
		var get_flag = true;
		var favorite_flag =true;
		var retribute_flag =true;
		var follow_flag =true;
		var follow_remove_flag =true;
		var bottomPos = $(document).height() - $(window).height() - 1;    //画面下位置を取得
		var beforeHeight;
		$(window).scroll(function () {
		    scrollHeight = $('.content').outerHeight();
		    scrollPosition = $('.content').height() + $('.content').scrollTop();
			
			if ($(this).scrollTop() >= bottomPos && get_flag ==true ) {
				console.log("bottomPos");
				get_flag = false;
				
				get_posts();
			}else if($(this).scrollTop() <=0 && get_flag == true){
				console.log("topPos");
				beforeHeight = $('.content').get(0).scrollHeight;
				get_flag = false;
				get_latest_posts();
			}
		});
		function appendAdd(text) {		//addChatLogsに追加
			$(".content").append(text);
        }
		function prependAdd(text) {		//addChatLogsに追加
			$(".content").prepend(text);
			var speed = 0;
			$img = $('img');
			$img.originSrc = $img.src;
			$img.src = ""; // これで一旦クリアできます！
			var nowHeight=$('.content').get(0).scrollHeight;
			var minusHeight= nowHeight - beforeHeight;
			$(window).scrollTop(minusHeight);
			// コールバックを設定
			$img.bind('load', function(){
				var nowHeight=$('.content').get(0).scrollHeight;
				var minusHeight= nowHeight - beforeHeight;
				$(window).scrollTop(minusHeight);
			});

			// 画像読み込み開始
			$img.src = $img.originSrc;
			//$('#content').animate({scrollTop:minusHeight}, speed, 'swing');
        }
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
		function favorite(t){
			console.log(favorite_flag);
			if(favorite_flag ==true){
				favorite_flag = false;
				var id = $(t).data('id');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/favorite",        // POST送信先のURL
					dataType: 'json',
					data : {post_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					$(t).attr('class', function(index, classNames) {
						return classNames + ' heart-favorite';
					});
					$(t).attr('class', function(index, classNames) {
						return classNames.replace('heart', '');
					});
					$(t).attr("onclick", "favorite_remove(this)");
					var num = Number($(t).parent().find('span').text());
					num = num + 1;
					$(t).parent().find('span').text(num);
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				favorite_flag = true;
			}
		}
		function favorite_remove(t){
			console.log("くそやろう");
			console.log($(t).parent().find('span').text());
			if(favorite_flag ==true){
				favorite_flag = false;
				var id = $(t).data('id');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/favorite/remove",        // POST送信先のURL
					dataType: 'json',
					data : {post_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					$(t).attr('class', function(index, classNames) {
						return classNames + ' heart';
					});
					$(t).attr('class', function(index, classNames) {
						return classNames.replace('heart-favorite', '');
					});
					$(t).attr("onclick", "favorite(this)");
					var num = Number($(t).parent().find('span').text());
					num = num - 1;
					if(num <= 0){
						num="";
					}
					$(t).parent().find('span').text(num);
					console.log("favoremove");
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				favorite_flag = true;
			}
		}
		function retribute(t){
			console.log(retribute_flag);
			
			if(retribute_flag ==true){
				retribute_flag = false;
				var id = $(t).data('id');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/retribute",        // POST送信先のURL
					dataType: 'json',
					data : {post_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					$(t).attr('class', function(index, classNames) {
						return classNames + ' diffusion-retribute';
					});
					$(t).attr('class', function(index, classNames) {
						return classNames.replace('diffusion', '');
					});
					$(t).attr("onclick", "retribute_remove(this)");
					var num = Number($(t).parent().find('span').text());
					num = num + 1;
					$(t).parent().find('span').text(num);
					console.log("retribute");
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				retribute_flag = true;
			}
		}
		function retribute_remove(t){
			console.log("くそやろう");
			
			if(retribute_flag ==true){
				retribute_flag = false;
				var id = $(t).data('id');
				$.ajax({
					type:"post",                // method = "POST"
					url:"/retribute/remove",        // POST送信先のURL
					dataType: 'json',
					data : {post_id: id},
					async : false,   // ← asyncをfalseに設定する
					timeout:3000,
				}).done(function(data) {
					$(t).attr('class', function(index, classNames) {
						return classNames + ' diffusion';
					});
					$(t).attr('class', function(index, classNames) {
						return classNames.replace('diffusion-retribute', '');
					});
					$(t).attr("onclick", "retribute(this)");
					var num = Number($(t).parent().find('span').text());
					num = num - 1;
					if(num <= 0){
						num="";
					}
					$(t).parent().find('span').text(num);
					console.log("retributeremove");
				}).fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log("Server Error. Pleasy try again later.");
					console.log("XMLHttpRequest : " + XMLHttpRequest.status);
					console.log("textStatus     : " + textStatus);
					console.log("errorThrown    : " + errorThrown.message);
				})
				retribute_flag = true;
			}
		}
	</script>
@endsection
