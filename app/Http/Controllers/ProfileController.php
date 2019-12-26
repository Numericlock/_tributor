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
	
	public function profile (Request $request){
		$user = $request->base_user;
		$lists = $request->base_user_lists;
		
		return view('profile',compact('user','lists'));
	}
}
