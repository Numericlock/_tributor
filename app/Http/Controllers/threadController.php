<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
use App\Models\Attached_content;
use App\Models\User_favorite;
use App\Http\Requests\PostFormRequest;
use Log;
class threadController extends Controller
{
    public function __construct(){
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }


    public function thread (Request $request,$users_id,$posts_id){
		$user = $request->base_user;
		$posts = User_post::threadPosts($user->user_id,$posts_id)->latest()->offset(0)->limit(25)->latest()->get();
        
		$posts = $posts->unique('posts_id');
        $userIds = $posts->unique('users_id'); 
        Log::debug($userIds."ごみごみごみごみごみごみ");
        
        $posts2 = User_post::parentPosts($user->user_id,$posts_id)->latest()->offset(0)->limit(25)->get();
        $posts2 = $posts2->unique('posts_id');
		$lists = $request->base_user_lists;
        return view('thread',compact('posts','posts2', 'userIds', 'user','lists'));

	}
}
