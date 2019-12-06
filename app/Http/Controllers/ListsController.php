<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use App\Models\Disclosure_list;
use App\Http\Requests\listFormRequest;
use App\Http\Requests\listMemberRequest;
use Log;

class ListsController extends Controller
{
	
    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	
	public function lists (Request $request){
		Log::debug($request->base_user->user_id."ユーザーアイデー");
		$user = $request->base_user;
		$lists = Disclosure_list::where('owner_user_id', $user->user_id)->get();
		Log::debug($lists."ユーザーズリスツ");

		return view('lists',compact('user','lists'));
	}
	
	public function lists_insert(listFormRequest $request){
		if(isset($_COOKIE['session'])===true){
			$count = UserSession::where([
				['id', $_COOKIE['session']],
				['logout_at', null],
			])->count();
			if ($count = 1) {
				$user = UserSession::join('users', 'users.id', '=', 'users_sessions.user_id')
					->where('users_sessions.id', $_COOKIE['session'])
					->whereNull('users_sessions.logout_at')
					->first();
			}else{
				setcookie('session','',time()-1);
				return view('login');
			}
		}else{
			return view('login');
		}
		$list = new Disclosure_list;
		$list->name = $request->input('name');
		$list->owner_user_id = $user->user_id;
		$list->is_published = 1;
		$list->is_hidden = 0;
		$list->save();
		$id = $list->id;
		Log::debug($id."LISTあいでー");
	}
	
	public function lists_member(){
		
	}	
	public function lists_member_post(listMemberRequest $request){
		$user = Disclosure_list::join('disclosure_lists_users', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id')
		->where('disclosure_lists.id', $request->input('list_id'))
		->get();
		return view('lists_members');
	}
}
