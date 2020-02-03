<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_follow;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
use App\Models\Disclosure_list;
use App\Models\Disclosure_list_user;
use App\Http\Requests\PostFormRequest;
use Log;


class HomeController extends Controller
{

	public function __construct(){
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }


    public function home (Request $request){
		$user = $request->base_user;
		$posts = User_post::ofPosts($user->user_id)->latest()->offset(0)->limit(25)->get();
		$posts = $posts->unique('posts_id');
        $userIds = $posts->unique('users_id'); 
        Log::debug($userIds."ごみごみごみごみごみごみ");
		$lists = $request->base_user_lists;
		return view('home',compact('posts', 'userIds', 'user','lists'));

	}
}
