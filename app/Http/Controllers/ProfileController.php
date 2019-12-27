<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_follow;
use Log;

class ProfileController extends Controller
{
    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	
	public function profile ($user_id, Request $request){
		$base_user = $request->base_user;
		$lists = $request->base_user_lists;
		$user = User::select('id as user_id','name','introduction',
		\DB::raw(//フォロー数
			"(SELECT COUNT(subject_user_id = id  OR NULL) AS subject_count FROM users_follows) AS subject_count "
		),
		\DB::raw(//フォロワー数
			"(SELECT COUNT(*) FROM users_follows WHERE followed_user_id = id) AS followed_count "
		))
		->where('id',$user_id)->first();

		Log::debug($user."LISTMEMBERあいでwwwwwwwwwwwー");
		return view('profile',compact('user','lists'));
	}
}
