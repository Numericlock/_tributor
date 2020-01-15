<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class threadController extends Controller
{
    public function __construct(){
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }


    public function thread ($posts_id,$users_id){

    //
    return [$users_id,$posts_id];
}
}
