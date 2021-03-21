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