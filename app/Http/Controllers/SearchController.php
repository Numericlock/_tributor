<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use Log;

class SearchController extends Controller
{
	public function users_search (Request $request){
		$users = User::select('id as users_id','name as users_name')
		->where('id', 'LIKE', $request->str."%")
		->orWhere('name', 'LIKE', $request->str."%")	
		->get();
		Log::debug($users."さーちりくえすと");
		return $users;
	}
}
