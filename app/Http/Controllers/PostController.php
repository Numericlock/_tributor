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
		Log::debug("きてるきてるきてるきてるきてる");
		User_post::create([
			'post_user_id' => $request->base_user->user_id,
			'content_text' => $request->content_text,
			'parent_post_id' => "1",
			'is_deleted' => 0,
			'longitude' => null,
			'latitude' => null
		]);

	}
}
