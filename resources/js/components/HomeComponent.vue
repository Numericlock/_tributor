<template>
	<div  class="content-wrapper">
		<div class="content-title">
			 <span>ホーム</span>
		</div>
		<div class="content" id="content" >
			<div class="modal">
			</div>
			<div id="lists-add-modal-content" class=modal-content>
				<div class="modal-title">
					<span id="modal-title">リストを作成</span>
					<svg class="modal-closeButton" id="modal_cancel" version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 512 512" xml:space="preserve">
						<g>
							<polygon class="st0" points="512,52.535 459.467,0.002 256.002,203.462 52.538,0.002 0,52.535 203.47,256.005 0,459.465
								52.533,511.998 256.002,308.527 459.467,511.998 512,459.475 308.536,256.005 	"/>
						</g>
					</svg>
				</div>
				<div class="lists-add-modal-list-wrapper">
					<div class="lists-add-modal-list" v-for="list in posts.lists">
						<div class="lists-add-modal-list-icon">
							<img src="/img/2.jpg">
						</div>					
						<div class="lists-add-modal-list-name">
							<span>{{ list.name }}</span>
						</div>					
						<div class="lists-add-modal-list-checkbox">
							<div>
								<input class="add-modal-list-checkbox" type="checkbox" :id="'add-list-id-'+list.id" :data-listid="list.id" :name="'add-list-id-'+list.id" :value="'add-list-id-'+list.id" />
								<label class="checkbox-label" :for="'add-list-id-'+list.id">
									<span class="checkbox-span"><!-- This span is needed to create the "checkbox" element --></span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-control">
					<button class="modal-positive-button" id="add_modal_submit" type='button'>適応</button>
				</div>
			</div>
			<div :id="userid.users_id" class="users-modal-wrapper" onmouseenter="users_content_modal_close_reset()" onmouseleave="users_content_modal_close_comp(this)" :data-modalid="userid.users_id" v-for="userid in posts.userIds">
				<div class="users-modal">
					<div class="users-modal-top-wrapper" >
						<div class="users-modal-icon">
							<img :src="'/img/icon_img/'+userid.users_id+'.png'">
						</div>
						<div class="users-modal-button">
							<div class="users-modal-button-follow" :id="'followbutton_'+userid.users_id">
								<button class="follow-button" onclick="follow(this)" :data-followid="userid.users_id" v-if="userid.is_canceled==1 && userid.users_id != posts.user.user_id">フォロー</button>
								<button class="follow-remove-button" onclick="follow_remove(this)" :data-followid="userid.users_id" v-else-if="userid.subject_user_id == posts.user.user_id">フォロー中</button>
								<button class="follow-button" onclick="follow(this)" :data-followid="userid.users_id" v-else>フォロー</button>
							</div>
							<button class="follow-button" onclick="show_list_add_modal(this)" :data-followid="userid.users_id" :data-followname="userid.users_name">リストに追加</button>
						</div>
					</div>
					<div class="users-modal-middle-wrapper">
						<span class="users-modal-name">{{ userid.users_name }}</span>
						<div>
						<span class="users-modal-id">@{{ userid.users_id }}</span>
							<span class="followed-span" v-if="userid.users_followed_count ==1">フォローされています</span>
						</div>
					</div>
					<div class="users-modal-bottom-wrapper">
						<div class="users-modal-introduction"></div>
					</div>
					<div class="users-modal-end-wrapper">
						<div class="users-modal-follow">
							<span>フォロー数/{{ userid.subject_count }}</span>
						</div>
						<div class="users-modal-follower">
							<span>フォロワー数/{{ userid.followed_count }}</span>
						</div>
					</div>
				</div>
			</div>
				<timeline-component v-for="post in posts.posts" :key="n" :post="post" :user="posts.user" >
                </timeline-component>
		</div>
	</div>
</template>
<script>
	export default {
        name: 'home-component',
		data: function () {
			return {
				posts: [],
                users_modal_timer:0,
                users_modal_timer_close:0,
                users_modal_timer_close_comp:0,
			}
		},

		computed: {
			howManyTimeAgo(dateTime){
				moment.lang('ja');
				return moment(dateTime).fromNow();
			}
		},
		methods: {
			getPosts() {
				axios.get('/api/home')
					.then((res) => {
					this.posts = res.data;
					console.log(res.data.user.user_id);
				});
			},
			setPostImageUrl(id,count){
				if(count > 0){
					return "/img/post_img/"+id+"_0.png";
				}else{
					return "";
				}
			},
            usersContentModalOpen(over){
                clearTimeout(this.users_modal_timer);
                clearTimeout(this.users_modal_timer_close);
                var id = "#"+$(over).data("modalid");
                var height =  $(id).height();
                var off = $(over).offset();	
                this.users_modal_timer = setTimeout(function(){
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
            },
            usersContentModalCloseReset(){
                clearTimeout(this.users_modal_timer_close);
            }
		},
		mounted() {
			this.getPosts();
		},
        beforeMount() {
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
        },
        beforeUpdate(){
		var last_post_at =this.posts.last_post.post_at;
		var start_post_at =this.posts.start_post.post_at;
		var users_modal_timer;
		var users_modal_timer_close;
		var users_modal_timer_close_comp;
        var user_id = this.posts.user.user_id;
		
		var page_height = 0;
		var past_posts_height = 0;

        var post_users = this.posts.userIds;
        var posts=  this.posts.posts;
        var past_posts=  [];
        var latest_posts=  [];
		var post_users_ids = this.posts.userIds.users_id;
		
		var base_checked_array = [];
		var checked_array = [];
		var notchecked_array = [];
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
        $(".users-information-name").mouseenter(function(){
            users_content_modal_open(this); 
            users_content_modal_close_reset();
        });

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
        }
	}

</script>