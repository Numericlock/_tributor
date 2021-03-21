
<template>

<div class="users-content" :id="'post_'+post.posts_id" :style="{ backgroundImage:'url('+setPostImageUrl(post.posts_id,post.attached_count)+')'}">
<!--	<div class="users-content" :id="'post_'+post.posts_id" v-else> -->
    <div class="content-information">
        <span v-if="post.share_at == post.post_at && post.users2_id != user.user_id">								
            <svg class="retribute-icon"  onclick="retribute(this)"  :data-id="post.id"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve" >
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
            {{post.users2_name}}さんがリトリビュート
        </span>
    </div> 
    <div class="users-content-wrapper">
        <div class="users-icon users-content-modal-open">
            <img :src="'img/icon_img/'+post.users_id+'.png'" v-on:click="users_href(this)" @mouseenter="usersContentModalOpen" v-on:mouseleave="users_content_modal_close(this)" :data-modalid="post.users_id">
        </div>
        <div class="users-information-wrapper">
            <div class="users-information">
                <div class="users-content-modal-open">
                    <span class="users-information-name" v-on:mouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" :data-modalid="post.users_id">{{ post.users_name }}</span>
                    <span class="users-information-id" v-on:mouseenter="users_content_modal_open(this); users_content_modal_close_reset()" onmouseleave="users_content_modal_close(this)" :data-modalid="post.users_id">@{{ post.users_id }}</span>
                </div>
                <div class="information">
                    <span>
                        <svg class="information-icon" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve" v-if="post.attached_count > 0">
                            <g>
                                <path class="st0" d="M0,45.178v421.644h512V45.178H0z M471.841,426.662H40.159V85.329h431.682V426.662z"></path>
                                <path class="st0" d="M326.128,207.728c-4.148-6.289-11.183-10.077-18.72-10.069c-7.544,0.007-14.57,3.803-18.71,10.1
                                l-72.226,109.914l-39.862-45.178c-4.619-5.238-11.426-8.022-18.397-7.52c-6.971,0.486-13.308,4.211-17.142,10.053L74.17,376.96
                                h363.659L326.128,207.728z"></path>
                                <path class="st0" d="M174.972,230.713c25.102,0,45.453-20.35,45.453-45.461c0-25.102-20.35-45.452-45.453-45.452
                                c-25.11,0-45.46,20.35-45.46,45.452C129.511,210.363,149.862,230.713,174.972,230.713z" ></path>
                            </g>
                        </svg>	
                        <svg class="information-icon" onclick="comment(this)" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 512 512" xml:space="preserve" v-else>
                            <g>
                                <path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
                                    l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
                                    c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
                                     M324,300v32H96v-32H324z"/>
                            </g>
                        </svg>
                        <!--{{howManyTimeAgo(post.updated_at)}}-->
                    </span>
                </div>
            </div>
            <div class="users-content-sentence">
                <div class="users-information-link">
                    <span>{{post.content_text}}</span>
                    <a :href="'/'+post.users_id+'/'+post.posts_id">aaaa</a>
                </div>
                <div class="swiper-container" :data-id="post.posts_id"  data-num="0"  :data-maxnum="post.attached_count" v-if="post.attached_count > 1">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide" style="margin:0 auto;" v-for="n of post.attached_count" :key="n">
                            <img :src="'/img/post_img/' + post.posts_id + '_' + n + '.png'" onclick="attached_modal_open(this)" :data-num="post.attached_count" >
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev" onclick="swiper_prev(this);" :data-id="post.posts_id"  data-num="0"  :data-maxnum="post.attached_count"></div>
                    <div class="swiper-button-next" onclick="swiper_next(this);"></div>
                </div>
                <img :src="'/img/post_img/' + post.posts_id + '_0.png'" onclick="attached_modal_open(this)" :data-num="post.attached_count" v-else-if="post.attached_count == 1">
            </div>	


            <div class="control">
                <button type='button'>
                    <svg class="control-icon comment" onclick="comment(this)" :data-id="post.id" :data-content="post.content_text" :data-userid="post.users_id" :data-username="post.users_name" :data-time="post.updated_at" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" xml:space="preserve">
                    <g>
                        <path class="st0" d="M447.139,16H64.859C29.188,16,0,45.729,0,82.063v268.519c0,36.334,29.188,66.063,64.859,66.063h155.192
                            l74.68,76.064c3.156,3.213,7.902,4.174,12.024,2.436c4.121-1.74,6.808-5.836,6.808-10.381v-68.119h133.576
                            c35.674,0,64.861-29.729,64.861-66.063V82.063C512,45.729,482.812,16,447.139,16z M96,132v-32h320v32H96z M96,232v-32h320v32H96z
                             M324,300v32H96v-32H324z"/>
                    </g>
                    </svg>
                    <span v-if="post.comment_count > 0">{{ post.comment_count }}</span>
                </button>
                <button type='button'>
                    <svg class="control-icon diffusion"  onclick="retribute(this)"  :data-id="post.id"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve" v-if="post.is_retribute == 0">
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
                    <svg class="control-icon diffusion-retribute"  onclick="retribute_remove(this)"  :data-id="post.id"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97;" xml:space="preserve" v-else>
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
                    <span v-if="post.retribute_count > 0">{{ post.retribute_count }}</span>
                </button>
                <button type='button'>
                    <svg class="control-icon heart" onclick="favorite(this)" :data-id="post.id" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" xml:space="preserve" v-if="post.is_favorite == 0">
                        <g>
                            <path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
                                c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
                                l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
                        </g>
                    </svg>
                    <svg class="control-icon heart-favorite" onclick="favorite_remove(this)" :data-id="post.id" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" xml:space="preserve" v-else>
                        <g>
                            <path class="st0" d="M473.984,74.248c-50.688-50.703-132.875-50.703-183.563,0c-17.563,17.547-29.031,38.891-34.438,61.391
                                c-5.375-22.5-16.844-43.844-34.406-61.391c-50.688-50.703-132.875-50.703-183.563,0c-50.688,50.688-50.688,132.875,0,183.547
                                l217.969,217.984l218-217.984C524.672,207.123,524.672,124.936,473.984,74.248z"/>
                        </g>
                    </svg>
                    <span v-if="post.favorite_count > 0">{{ post.favorite_count }}</span>
                </button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        name: 'timeline-component',
		data: function () {
			
			return {
                users_modal_timer:0,
                users_modal_timer_close:0,
                users_modal_timer_close_comp:0,
			}
		},
        props: ['key','post','user'],
		methods: {
			setPostImageUrl(id,count){
				if(count > 0){
					return "/img/post_img/"+id+"_0.png";
				}else{
					return "";
				}
			},
            usersContentModalOpen:function(over){
                clearTimeout(this.users_modal_timer);
                clearTimeout(this.users_modal_timer_close);
                var id = "#"+$(over).data("modalid");
                var height =  $(id).height();
                var off = $(over).offset();	
                console.log("aaaaaaaaaa"+id);
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
            }
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
        }
	}
</script>