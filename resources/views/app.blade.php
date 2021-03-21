<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>/-tributor</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
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
	<link rel="stylesheet" href="/css/home.css">
	<link rel="stylesheet" href="/css/home_nav_icon.css">
	<link rel="stylesheet" href="/css/users_modal.css">
</head>
<body>
<div class="wrapper" id="app">

</div>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}" defer></script>
<script src="/js/post_img_swiper.js"></script><!--投稿の画像と背景をスライドする-->
<script src="/js/other_nav_modal.js"></script><!--ナビゲーションの三点リードをクリックしたときのモーダルの制御-->
<script src="/js/attention_modal.js"></script><!--投稿時、なんらかの入力をした後、投稿せずにモーダルを消そうとしたときの処理-->
<script src="/js/attached_modal.js"></script><!--添付画像をクリック時に画面全体に画像を表示するモーダルの制御　表示した画像の切り替え処理も-->
<script src="/js/tribute_post.js"></script><!--投稿モーダルの表示から投稿までの処理-->
<script src="/js/post_input_img.js"></script><!--投稿に画像を添付する際のプレビュー処理と配列処理-->
<script src="/js/follow.js"></script><!--フォロー、フォロー解除処理-->
<script src="/js/retribute.js"></script><!--リトリビュート、リトリビュート解除処理-->
<script src="/js/favorite.js"></script><!--いいね、いいね解除処理-->
</body>
</html>