<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('homepage');
});


Route::group(['middleware' => 'auth.login.before', 'prefix' => ''], function() {
	Route::get('/login', 'AuthController@login');
	Route::post('/authentication', 'AuthController@authentication');
	Route::get('/login/password', 'AuthController@login_password');
	Route::get('/register', 'AuthController@register');
	Route::get('/register/password', 'AuthController@register_password');
	Route::get('/register/profile', 'AuthController@register_profile');
    Route::post('/register_img', 'AuthController@register_img');
	Route::get('/is_diplication', 'AuthController@is_diplication');
	Route::post('/register_insert', 'AuthController@register_insert');
});


Route::group(['middleware' => 'auth.before', 'prefix' => ''], function() {
	Route::get('/lists', 'ListsController@lists');
	Route::post('/lists', 'ListsController@lists_insert');
		Route::post('/lists/search', 'SearchController@users_search');
		Route::post('/lists/add_user', 'ListsController@user_add_lists');
		Route::get('/lists/add_user', 'ListsController@users_lists');
		Route::get('/lists/member', 'ListsController@lists_member');
		Route::post('/lists/member', 'ListsController@lists_member_post');
	
	Route::get('/home', 'HomeController@home');
	
	Route::post('/post', 'PostController@post');
	
	Route::get('/search', 'searchController@search');
	Route::post('/search', 'searchController@post_search');
	
	Route::post('/get_search_posts', 'searchController@get_search_posts');
	
	Route::post('/get_posts', 'PostController@get_posts');
	
	Route::post('/favorite', 'PostController@users_favorite');
	
	Route::post('/follow', 'FollowController@follow');
		Route::post('/follow/remove', 'FollowController@remove');
	
	Route::get('/profile', 'ProfileController@profile');
	
	Route::get('/notice', function () {
		return view('notice');
	});
});
Route::get('/logout', 'AuthController@logout');
