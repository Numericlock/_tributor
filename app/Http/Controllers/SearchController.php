<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\searchRequest;
use App\Models\User;
use App\Models\UserSession;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
use Log;

class SearchController extends Controller
{
	public function __construct(){
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	public function search (Request $request){
		$posts = "";
        $user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('search',compact('posts','user','lists'));
	}
	
	public function post_search (searchRequest $request){
		$str = $request->str;
		$posts = User_post::select('users_posts.*','users.id as users_id', 'users.name as users_name')
		->leftjoin('posts_valid_disclosure_lists', 'users_posts.id', '=', 'posts_valid_disclosure_lists.post_id')
		->leftjoin('users_follows', 'users_follows.followed_user_id', '=', 'users_posts.post_user_id')
        ->leftjoin('users', 'users_posts.post_user_id', '=', 'users.id')
		->leftjoin('disclosure_lists_users', 'disclosure_lists_users.list_id', '=', 'posts_valid_disclosure_lists.list_id')
		->where('disclosure_lists_users.user_id',$request->base_user->user_id)
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->orWhereNull('disclosure_lists_users.user_id')
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->orWhere('users_posts.post_user_id',$request->base_user->user_id)
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->distinct()
		->latest()
		->offset(0)
		->limit(25)
		->get();
		//要修正
		Log::debug("さーちりくえすと");
        $user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('search',compact('posts','user','lists','str'));
	}	
	
	public function get_search_posts (searchRequest $request){
		$str = $request->str;
		$posts = User_post::select('users_posts.*','users.id as users_id', 'users.name as users_name')
		->leftjoin('posts_valid_disclosure_lists', 'users_posts.id', '=', 'posts_valid_disclosure_lists.post_id')
		->leftjoin('users_follows', 'users_follows.followed_user_id', '=', 'users_posts.post_user_id')
        ->leftjoin('users', 'users_posts.post_user_id', '=', 'users.id')
		->leftjoin('disclosure_lists_users', 'disclosure_lists_users.list_id', '=', 'posts_valid_disclosure_lists.list_id')
		->where('disclosure_lists_users.user_id',$request->base_user->user_id)
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->orWhereNull('disclosure_lists_users.user_id')
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->orWhere('users_posts.post_user_id',$request->base_user->user_id)
		->where('users_posts.post_user_id', 'LIKE', '%'.$str.'%')
		->orWhere('users_posts.content_text','LIKE', '%'.$str.'%')
		->orWhere('users.name','LIKE', '%'.$str.'%')
		->distinct()
		->latest()
		->offset($request->num)
		->limit(25)
		->get();
		//要修正
		Log::debug("さーちりくえすと");
		return $posts;
	}
	
	public function users_search (searchRequest $request){
		$users = User::select('id as users_id','name as users_name')
		->where('id', 'LIKE', $request->str."%")
		->orWhere('name', 'LIKE', $request->str."%")	
		->get();
		Log::debug($users."さーちりくえすと");
		return $users;
	}
}
