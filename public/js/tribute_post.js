var tribute_flag = true;
var textarea;
var lists_array=[];	
function tribute_postForm(){
    if(tribute_flag == true){
        tribute_flag = false;
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
                if(window.hasOwnProperty('post_users_ids')){
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
                    get_latest_posts();
                    $('.content').prepend(
                        append_text
                    );
                    bottomPos = $(document).height() - $(window).height() - 1;    //画面下位置を取得
                }
                post_modal_close();
                get_flag = true;
                tribute_flag = true;
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
    }
};
function dom_post(posts_id, users_id, users_name, content_text, updated_at, share_at, post_at, id, users2_name, attached_count, comment_count, retribute_count, favorite_count, is_favorite, is_retribute){
	var append_text;
	if(attached_count > 0){
		append_text = '<div class="users-content" id="post_'+ posts_id +'" style="background-image:url(/img/post_img/'+ posts_id +'_0.png);">';
	}else{
		append_text = '<div class="users-content" id="post_'+ posts_id +'">';
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