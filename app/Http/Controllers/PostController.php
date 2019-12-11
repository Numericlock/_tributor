<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
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
	//	User_post::create([
	//		'post_user_id' => $request->base_user->user_id,
	//		'content_text' => $request->content_text,
	//		'is_deleted' => 0
	//	]);
        foreach($request->lists as $list){
            Post_valid_disclosure_list::create([
                'list_id'=> $list,
                'post_id'=> $id,
                'is_hidden'=> 0
            ]);
        }
		return User_post::where('post_user_id', $request->base_user->user_id)->get();
	}
}
