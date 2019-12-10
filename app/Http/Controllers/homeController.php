<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;


class HomeController extends Controller
{
	    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	
    public function home (Request $request){
		$user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('home',compact('user','lists'));
	}
}
