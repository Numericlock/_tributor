<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_post;
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
		User_post::create([
			'post_user_id' => $request->base_user->user_id,
			'content_text' => $request->content_text,
			'is_deleted' => 0
		]);
        foreach($request->lists as $list){
            Disclosure_list_user::create([
                'list_id'=> $id,
                'user_id'=> $user,
                'is_deleted'=> 0
            ]);
        }
		return User_post::where('post_user_id', $request->base_user->user_id)->get();
	}
}
