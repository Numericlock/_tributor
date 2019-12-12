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

public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }


    public function home (Request $request){
		$posts = User_post::select('users_posts.*','users.id as users_id', 'users.name as users_name')
		->leftjoin('posts_vaild_disclosure_lists', 'users_posts.id', '=', 'posts_vaild_disclosure_lists.post_id')
		->leftjoin('users_follows', 'users_follows.followed_user_id', '=', 'users_posts.post_user_id')
        ->leftjoin('users', 'users_posts.post_user_id', '=', 'users.id')
		->leftjoin('disclosure_lists_users', 'disclosure_lists_users.list_id', '=', 'posts_vaild_disclosure_lists.list_id')
		->where('users_follows.subject_user_id',$request->base_user->user_id)
		->where('disclosure_lists_users.user_id',$request->base_user->user_id)
		->orWhere('users_follows.subject_user_id',$request->base_user->user_id)
		->whereNull('disclosure_lists_users.user_id')
		->distinct()
		->latest()
		->offset(0)
		->limit(25)
		->get();
		Log::debug($posts."foloowwwdｗｗｗｗｗｗだああｗｗｗ2");
        $user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('home',compact('posts','user','lists'));

	}
}
