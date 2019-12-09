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
		Log::debug($request->base_user->user_id."ユーザーアイデー");
		$user = $request->base_user;
		$lists = Disclosure_list::where('owner_user_id', $user->user_id)->get();
		Log::debug($lists."ユーザーズリスツ");


		return view('lists',compact('user','lists'));
	}

	public function lists_insert(listFormRequest $request){
        Log::debug($request->name);
		$list = new Disclosure_list;
		$list->name = "hishida1";
		$list->owner_user_id = $request->base_user->user_id;
		$list->is_published = 1;
		$list->is_hidden = 0;
		$list->save();
		$id = $list->id;
         Disclosure_list_user::create([
            'list_id'=> 25,
            'user_id'=> "hishida2",
            'is_deleted'=> 0,
        ]);
      //  foreach($request->users as $user){
      //      Disclosure_list_user::create([
      //          'list_id'=> $id,
      //          'user_id'=> $user,
      //          'is_deleted'=> 0
      //      ]);
       // }


	}

	public function lists_member(){

	}
	public function lists_member_post(listMemberRequest $request){


		/*$lists = Disclosure_list::join('disclosure_lists_users', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists.id', $request->input('list_id'))
		->get();*/
		$lists = Disclosure_list::select('disclosure_lists.name as lists_name','disclosure_lists_users.user_id as users_id', 'users.name as users_name')
		->join('disclosure_lists_users', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists.id', $request->input('list_id'))
		->get();


		Log::debug($lists."LISTMEMBERあいでー");
		return view('lists_members',compact('lists'));
	}
}
