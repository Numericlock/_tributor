<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use App\Models\Disclosure_list;
use App\Models\Disclosure_list_user;
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
		$user = $request->base_user;
		$lists = Disclosure_list::where('owner_user_id', $user->user_id)->get();
		return view('lists',compact('user','lists'));
	}

	public function lists_insert(listFormRequest $request){
		$list = new Disclosure_list;
		$list->name = $request->name;
		$list->owner_user_id = $request->base_user->user_id;
		$list->is_published = $request->publish;
		$list->is_hidden = $request->hidden;
		$list->save();
		$id = $list->id;
        foreach($request->users as $user){
            Disclosure_list_user::create([
                'list_id'=> $id,
                'user_id'=> $user,
                'is_deleted'=> 0
            ]);
        }
		return $list;
	}

	public function lists_member(){

	}
	public function lists_member_post(listMemberRequest $request){


		/*$lists = Disclosure_list::join('disclosure_lists_users', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists.id', $request->input('list_id'))
		->get();*/
		Log::debug($request->input('list_id')."LISTMEMBERあいでー");
		$lists = Disclosure_list::select('id as list_id','name')
		->where('id', $request->input('list_id'))
		->first();
		$lists_users = Disclosure_list_user::select('disclosure_lists_users.user_id as users_id', 'users.name as users_name')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists_users.list_id', $request->input('list_id'))
		->get();
		$count = $lists_users->count();


		Log::debug($lists."LISTMEMBERあいでー");
		return view('lists_members',compact('lists','lists_users', 'count'));
	}
}
