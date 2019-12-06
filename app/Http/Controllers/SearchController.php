<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
	public function users_search (Request $request){
		$users = User::where('id', 'LIKE', $request->str)
			->orWhere('name', 'LIKE', $request->str)	
			->get();

		return $users;
	}
}
