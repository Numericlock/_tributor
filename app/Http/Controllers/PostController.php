<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
use App\Models\Attached_content;
use App\Models\User_favorite;
use App\Http\Requests\PostFormRequest;
use Log;

class PostController extends Controller
{
    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	
	public function post (PostFormRequest $request){
		$post = new User_post;
		$post -> post_user_id = $request->base_user->user_id;
		$post -> content_text = $request->content_text;
		$post -> is_deleted = 0;
		$post -> save();
		$id = $post->id;
        foreach($request->lists as $list){	
            Post_valid_disclosure_list::create([
                'list_id'=> $list,
                'post_id'=> $id,
                'is_hidden'=> 0
            ]);
        }
		$files = $request->files;
        foreach($files as $file){
			Log::debug("_________");
        }
		return User_post::where('post_user_id', $request->base_user->user_id)->get();
	}
	
	public function get_posts (Request $request){
		$posts = User_post::select('users_posts.*','users.id as users_id', 'users.name as users_name')
		->leftjoin('posts_valid_disclosure_lists', 'users_posts.id', '=', 'posts_valid_disclosure_lists.post_id')
		->leftjoin('users_follows', 'users_follows.followed_user_id', '=', 'users_posts.post_user_id')
        ->leftjoin('users', 'users_posts.post_user_id', '=', 'users.id')
		->leftjoin('disclosure_lists_users', 'disclosure_lists_users.list_id', '=', 'posts_valid_disclosure_lists.list_id')
		->where('users_follows.subject_user_id',$request->base_user->user_id)
		->where('disclosure_lists_users.user_id',$request->base_user->user_id)
		->orWhere('users_follows.subject_user_id',$request->base_user->user_id)
		->whereNull('disclosure_lists_users.user_id')
		->distinct()
		->latest()
		->offset($request->num)
		->limit(25)
		->get();
		return $posts;
	}
	
	public function users_favorite (Request $request){
		Log::debug($request->post_id);
		User_favorite::create([
			'user_id'=>$request->base_user->user_id,
			'post_id'=>$request->post_id,
			'is_canceled'=>0
		]);
	}
}
