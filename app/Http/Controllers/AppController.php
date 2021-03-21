<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_follow;
use App\Models\User_post;
use App\Models\UsersSharePost;
use App\Models\Post_valid_disclosure_list;
use App\Models\Disclosure_list;
use App\Models\Disclosure_list_user;
use App\Http\Requests\PostFormRequest;
use Log;


class AppController extends Controller
{

	public function __construct(){
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }


    public function app (Request $request){
		$user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('app',compact('user','lists'));

	}
}
