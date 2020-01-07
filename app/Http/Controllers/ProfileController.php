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
		$user = $request->base_user;
		$base_user_id =$user->user_id;
		$lists = $request->base_user_lists;
		$current_user = User::select('users.id as user_id','users.name as name','users.introduction as introduction','users_follows.is_canceled as is_canceled', 'users_follows.subject_user_id as subject_user_id',
		\DB::raw(//フォロー数
			"(SELECT COUNT(subject_user_id = users.id  OR NULL) AS subject_count FROM users_follows) AS subject_count "
		),
		\DB::raw(//フォロワー数
			"(SELECT COUNT(*) FROM users_follows WHERE followed_user_id = users.id) AS followed_count "
		),
		\DB::raw(//フォローされているかどうか
			"(SELECT COUNT(followed_user_id = '$base_user_id' OR NULL) FROM `users_follows` WHERE subject_user_id = '$user_id' AND is_canceled = 0) AS users_followed_count "
		),
		\DB::raw(//フォローしているかどうか
			"(SELECT COUNT(subject_user_id = '$base_user_id' OR NULL) FROM `users_follows` WHERE followed_user_id = '$user_id' AND is_canceled = 0) AS users_subject_count "
		)
		)
		->join('users_follows', 'users_follows.followed_user_id', '=', 'users.id')
		->where('users.id',$user_id)
		->first();

		Log::debug($user."LISTMEMBERあいでwwwwwwwwwwwー");
		return view('profile',compact('current_user', 'user', 'lists'));
	}
}
