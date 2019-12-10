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
    try {
		DB::connection()->getPdo();
		if(DB::connection()->getDatabaseName())
		{
			echo "conncted sucessfully to database ".DB::connection()->getDatabaseName();
			echo "conncted sucessfully to database ".DB::table('users')->where('e_mail', 'tatsuki1@live.jp')->count();
		}
	} catch (\Exception $e) {
		die("Could not connect to the database.  Please check your configuration. error:" . $e );
	}
});


Route::group(['middleware' => 'auth.login.before', 'prefix' => ''], function() {
	Route::get('/login', 'AuthController@login');
	Route::post('/authentication', 'AuthController@authentication');
	Route::get('/login/password', 'AuthController@login_password');
	Route::get('/register', 'AuthController@register');
	Route::get('/register/password', 'AuthController@register_password');
	Route::get('/is_diplication', 'AuthController@is_diplication');
	Route::post('/register_insert', 'AuthController@register_insert');
});


Route::group(['middleware' => 'auth.before', 'prefix' => ''], function() {
	Route::get('/lists', 'ListsController@lists');
	Route::post('/lists', 'ListsController@lists_insert');
	Route::post('/lists/search', 'SearchController@users_search');

	Route::get('/lists/member', 'ListsController@lists_member');
	Route::post('/lists/member', 'ListsController@lists_member_post');	
	Route::get('/notice', function () {
		return view('notice');
	});
});
Route::get('/home','homeController@home');
Route::get('/logout', 'AuthController@logout');