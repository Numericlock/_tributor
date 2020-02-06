@extends('layouts.app')
@section('title', 'プロフィール')
@section('cssJs')
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/home_nav_icon.css">
	<link rel="stylesheet" href="/css/users_modal.css">
    <link rel="stylesheet" href="/css/profile.css">
    
@endsection
@section('content')
	<div class="content-wrapper">
		<div class="content-title">
			 <span>プロフィール</span>
		</div>
        <div class="setting">
            <button type="button" class="setting" name="aaa" value="aaa">
                <img src="/img/setting.png"><br>
            </button>
        </div>
		<div class="profile">
 
			
				<div class="profile-icon" >
					<img src="img/icon_img/{{$current_user->user_id}}.png">
				</div>
			
			<span class="profile-userName">{{ $current_user->name }}</span>
			<span class="profile-userId">{{ "@".$current_user->user_id }}</span>
			<h4>{{ $current_user->introduction }}</h4>
			<div class="information">
				<span>フォロー中 - {{ $current_user->subject_count }}</span>
				<span>フォロワー - {{ $current_user->followed_count }}</span>
			</div>
			<div class="users-modal-button-follow" id="followbutton_{{ $current_user->user_id }}">
				@if($user->user_id === $current_user->user_id )
				@elseif($current_user->is_canceled === 1)
					<button class="follow-button" onclick="follow(this)" data-followid="{{ $current_user->user_id }}">フォロー</button>
				@elseif ($current_user->subject_user_id === $user->user_id )
					<button class="follow-remove-button" onclick="follow_remove(this)" data-followid="{{ $current_user->user_id }}">フォロー中</button>
				@else
					<button class="follow-button" onclick="follow(this)" data-followid="{{ $current_user->user_id }}">フォロー</button>
				@endif
			</div>
		</div>
		<div class="tab-wrapper">
			<button type='button' id="my_post">投稿</button>
			<button type='button' id="reply_button">返信</button>
			<button type='button' id="img_post">メディア</button>
			<button type='button' id="reply_button">いいね</button>
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
		</div>

		
		
		
		
		
		<div class="my_post">
		@foreach ($myPosts as $post)
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
		
		
		
		
			
			
			
			
            
             <div class="img_post">
				@foreach ($imgPosts as $post)

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
    <div class="profile-modal">
	</div>
	<div id="profile-modal_content" class="profile-modal-content">
        <div class="profile-modal-title">
            <span>プロファイル編集</span>
            <svg class="profile-modal-closeButton profile-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
		<div class="profile-modal-parentPost">
			<div class="profile-modal-parentPost-icon">
                <label>
				<img class="profile-image" id="preview" src="/img/icon_img/{{ $user->user_id }}.png"class="nav-icon common-user-icon">>
                <input type="file" id="profile-modal_next2" accept="image/*" stylesheet="display:none"hidden>
                </label>
			</div>

		</div>
        <div class="profile-modal-textarea">
  
            <div class="profile-modal-textarea-userImage">
                <label>
                    <img src="/img/icon_img/{{ $user->user_id }}.png" id="crop">
                    <input type="file" id="profile-modal_next" accept="image/*" stylesheet="display:none"hidden>
                </label>
            </div>
			<div class="profile-modal-textarea-input">
                <span>名前</span>
                <input type="text" id="name">
                <br>
                <span>自己紹介</span>
				<textarea id="introduction" name="post_message" title="自己紹介" aria-label="自己紹介" placeholder="自己紹介" maxlength="256" wrap="soft"></textarea>

			</div>
			
        </div>
        <div class="counter">
			<div>
                <span class="show-count">0</span><span>/256</span>
			</div>
        </div>
        <div class="profile-modal-control">
            <button class="profile-modal-positive-button" id="profile-modal_post" type='button'>変更</button>
        </div>
	</div>
	<div id="profile-modal_content_next" class="profile-modal-img">
        <div class="profile-modal-title">
            
            <svg class="profile-modal-closeButton profile-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
		
            <input id='scal' type='range' value='' min='10' max='400' oninput="scaling(value)" style='width: 300px;'><br>
            <canvas id='cvs' width='300' height='400'></canvas><br>
            <canvas id='out' width='200' height='200' style="display:none"></canvas>
		

		<div class="profile-modal-control">
			<button class="profile-modal-negative-button" id="profile-modal_back" type='button'onclick='crop_img()'>適応</button>
		</div>
	</div>
    
    <div id="profile-modal_content" class="profile-modal-content">
        <div class="profile-modal-title">
            <span>投稿</span>
            <svg class="profile-modal-closeButton profile-modal_cancel" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
                        52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
                </g>
            </svg>
        </div>
        <div class="profile-modal-textarea">
            <div class="profile-modal-textarea-userImage">
                <img src="/img/2.jpg">
            </div>
            <textarea  id="textarea" name="post_message" title="今何してる？"　aria-label="今何してる？"　placeholder="今何してる？" maxlength="256"></textarea>

        </div>
        <div class="counter">
            <span class="show-count">0</span>/256
         </div>
        <div class="profile-modal-control">

            <span>内容が消えてしまいますがよろしいですか？</span>
			<button class="profile-modal-negative-button" id="profile-modal_back" type='button'>いいえ</button>
			<button class="profile-modal-positive-button" id="profile-modal_post" type='button'>はい</button>
            
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
        var posts=  @json($myPosts);
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
			//get_latest_posts();
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
				
				//get_posts();
			}else if($(this).scrollTop() <=0 && get_flag == true){
				console.log("topPos");
				beforeHeight = $('.content').get(0).scrollHeight;
				get_flag = false;
				//get_latest_posts();
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
        
        $('#img_post').on('click',function(){
			$('.img_post').fadeIn(500);
			$('.my_post').hide();
			$("html, body").animate({scrollTop:0}, 250, "swing");
		});	
		$('#my_post').on('click',function(){
			$('.my_post').fadeIn(500);
			$('.img_post').hide();
			$("html, body").animate({scrollTop:0}, 250, "swing");
		});	
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
					$(".profile-modal-inputFiles-left").css({
						'display':'block',
						'width':'100%'
					});
					$(".profile-modal-inputFiles-right").css({
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
					$(".profile-modal-inputFiles-left,.profile-modal-inputFiles-right").css({
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
					$(".profile-modal-inputFiles-left,.profile-modal-inputFiles-right").css({
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
					$(".profile-modal-inputFiles-left,.profile-modal-inputFiles-right").css({
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
		

		$('.setting').on('click',function(){
			profile_modal_open();
		});
		function comment(t){
			var id = $(t).data("id");
			var content = $(t).data("content");
			var user_id = $(t).data("userid");
			var user_name = $(t).data("username");
			var time = $(t).data("time");
			//var post = $('#post_'+id).clone();
			//post.css("background","white");
			$('#parentPost_usericon').attr('src', '/img/icon_img/'+user_id+'.png');
			$('#parentPost_username').text(user_name);
			$('#parentPost_userid').text(user_id);
			$('#parentPost_time').text(time);
			$('#parentPost_sentence').text(content);
			//$('.profile-modal-textarea').before(post);
			$('.profile-modal-parentPost').css("display","flex");
			parent_post_id = id;
			profile_modal_open();
		}
		
		function profile_modal_open(){
			$('.profile-modal').stop(true, true).fadeIn('500');
			$('#profile-modal_content').show().stop(true, true).animate({
				top: "50%",
				
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#profile-modal_content_next').show().stop(true, true).animate({
				left: "120%",
				top:"50%",
				display: "fixed",
				opacity: 0
			}, 500, function(){
				$('#profile-modal_content_next').hide();
			});
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
		
		$('.profile-modal, .profile-modal_cancel').on('click',function(){
			if(is_blank($('#textarea').val()) && !Object.keys(file_array).length &&  !Object.keys(lists_array).length){
				console.log(!Object.keys(file_array).length);
				console.log(!Object.keys(lists_array).length);
				console.log(is_blank($('#textarea').val()));
				profile_modal_close();
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
			profile_modal_close();
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
		function profile_modal_close(){
			$('.profile-modal').stop(true, true).fadeOut('500');
			$('#profile-modal_content').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('#profile-modal_content').hide();
			
				$('#textarea').val("");
				$('.show-count').text("0");
				lists_array=[];
				file_array=[];
				reader_array  = [];
				preview_array = [];
				imgFiles=[];
				parent_post_id=null;
				$('.profile-modal-list-checkbox').prop('checked',false);
				$("#preview-0, #preview-1, #preview-2, #preview-3").css({
					'display':'none'
				});
				$('#textarea').height('50px');
				$('.profile-modal-parentPost').css("display","none");
				
			});
			$('.profile-modal').stop(true, true).fadeOut('500');
			$('#profile-modal_content_next').stop(true, true).animate({
				top: "-100px",
				left:"50%",
				opacity: 0
			}, 500, function(){
				$('#profile-modal_content_next').hide();
			});
		}

		$('#profile-modal_next').on('change',function(e){
             var reader = new FileReader();
             var file = e.target.files[0];

                reader.onload = function(e){
                console.log(e.target.result);
                load_img(e.target.result);
                };
                reader.readAsDataURL(file);

			$('#profile-modal_content_next').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#profile-modal_content').stop(true, true).animate({
				left: "-100px",
				opacity: 0
			}, 500, function(){
				$('#profile-modal_content').hide();
			});
            
		});
		$('#profile-modal_back').on('click',function(){
			$('#profile-modal_content').show().stop(true, true).animate({
				left: "50%",
				display: "fixed",
				opacity: 1.0
			}, 500);
			$('#profile-modal_content_next').stop(true, true).animate({
				left: "120%",
				opacity: 0
			}, 500, function(){
				$('#profile-modal_content_next').hide();
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
				$('.profile-modal-list-area').slideUp();
				document.getElementById("disclose_status").innerHTML="公開";
				$('#disclose_status').css('color','#8ce196');
			}else{
				//$(".cmn-toggle-small").prop("checked", true);
				$('.profile-modal-list-area').slideDown();
				document.getElementById("disclose_status").innerHTML="非公開";
				$('#disclose_status').css('color','#a61a37');
			}
		});
		var textarea;
		var lists_array=[];


		$(".profile-modal-list-checkbox").change(function() {
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
        $("#search_text").on("input", function() {
            searchStr = $(this).val();
            clearTimeout(searchTimer);
            searchTimer = window.setTimeout(search_for, 700);
        });
		$('#profile-modal_post').on('click',function(){
			console.log($('input[name="disclose"]:checkbox').prop('checked'));
            if(lists_array != "" || $('input[name="disclose"]:checkbox').prop('checked') == false){
				tribute_postForm();
            }else{
                alert("リストが選択されていません")
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
         if(img.width>=img.height){
       	    document.getElementById( 'scal' ).min = (100/iy)*100
        }else{
        	document.getElementById( 'scal' ).min = (100/ix)*100
        }
        scaling( scl )
    }
    function load_img( _url ){  // 画像の読み込み
        img.src = (_url);
    }
    
    function scaling( _v ) {        // スライダーが変った

        v = parseInt( _v ) * 0.01        	  
        draw_canvas( ix, iy )  
        console.log(v);
             
    }
      
      $("input[type=range]").on("input",function(){
          var val = $(this).val();
          $(this).attr("value",val);
        v = parseInt(val) * 0.01        	  
        draw_canvas( ix, iy )  
        console.log(v);
          
          });

    function draw_canvas( _x, _y ){     // 画像更新
    	console.log(_x);
    	console.log(_y);
        const ctx = cvs.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, cw, ch )    // 背景を塗る

       	  if( _x <= 100/v){
              _x=100/v+1;
       	 }
      	  if(_x >= img.width-(100/v)){
				_x = img.width-(100/v+1 );
      	  }

        if( _y <= 100/v){
			_y=(100/v+1);
        }
        if( _y >= img.height-(100/v )){
			_y=img.height-(100/v+1);
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
     
    function crop_img(){      
        // 画像切り取り
        const ctx = out.getContext( '2d' )
        ctx.fillStyle = 'rgb(200, 200, 200)'
        ctx.fillRect( 0, 0, ow, oh )    // 背景を塗る
        ctx.drawImage( img, 0, 0, img.width, img.height,(ow/2)-ix*v, (oh/2)-iy*v, img.width*v, img.height*v,)
               
      base64 = out.toDataURL("public/img/png").replace("public/img/png", "public/img/octet-stream");
    document.getElementById("crop").src = base64;
    $('#dotRadius2').val('');
 
   
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
 		iy += (sy-_ev.pageY)/v;
       
		if( ix <= 100/v ){
			ix=(100/v+1);
   
        if(ix >= img.width-(100/v)){
			ix = img.width-(100*v+1);
        }
        if( iy <= 100/v ){
			iy=(100/v+1);
        }
        if( iy >= img.height-(101/v)){
			iy=img.height-(100/v+1);
        }
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

        scaling( scl)
        return false // イベントを伝搬しない
    }
        
	</script>
@endsection
