<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Requests\LoginFormRequest;
use Log;

class AuthController extends Controller{
	
	public function login (){
		return view('login');
	}
	
	public function logout(){
		Log::debug("ログアウト");
		session_start();
		setcookie('session','',time()-1);
		session_destroy();
		return redirect('/');
	}
	
	public function login_password (){
		function random($length){
			return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
		}
		
		$challenge=random(32);
		while(true){
			if(UserSession::where('id', session_id())->count() != 0){
				session_regenerate_id();
				Log::debug(session_id()."while");
				continue;
			}else{
				break;
			}
		}
		UserSession::create([
			'id'=> session_id(),
			'challenge' => $challenge,
		]);
		return view('login_password',compact('challenge'));
		
	}
	
	public function authentication (LoginFormRequest $request){
		
		$user_id = $request->input('id');
		$password = $request->input('password');
		$session = UserSession::where('id', session_id())->first();
		$session->user_id = $user_id;
		$session->save();
		function challenge($user_id, $challenger){
			Log::debug("Auth");
			$password = "";
			$user = User::join('users_sessions', 'users.id', '=', 'users_sessions.user_id')
							->where('users_sessions.id', '=', session_id())
							->first();
			Log::debug($user->password);
			$password = $user->password.$user->challenge;
				Log::debug($user->password);
				Log::debug($user->challenge."チャレンジ");
				Log::debug($password);
				Log::debug(hash('sha256', $password)."元パス");
				Log::debug($challenger);
				Log::debug(Now());

			if(hash('sha256', $password) === $challenger){
				return true;
			}else{
				return false;
			}
		}
		
		function destroy(){
			$session = UserSession::where('id', session_id())->first();
			$session->logout_at = Now();
			$session->save();
			session_destroy();
		}
		
		if(challenge($user_id,$password)===true){
			$session = UserSession::where('id', session_id())->first();
			$session->login_at = Now();
			$session->save();
			Log::debug("クリア");
			setcookie('session',session_id(),time()+60*60*24*7);
			$_SESSION["user_id"] = $user_id;
		    header('Location: /home');  // メイン画面へ遷移
		    exit();  // 処理終了
		}else{
			Log::debug("デストロイ");
		    destroy();
		    header('Location: /login');  
		    exit();  // 処理終了
		}
	} 
	
	public function register (){
		return view('register');
		
	}
	
	public function register_password (){
		
		return view('register_password');
		
	}
    
	
	public function register_insert (RegisterFormRequest $request){
        User::create([
            'id'=> $request->input('id'),
            'name' => "",
            'password' => $request->input('password'),
            'e_mail'=>$request->input('email'),
            'birth_on' => "2019-10-28",
            'is_deleted' => 0
        ]);
		return view('login');
	}
	
	public function is_diplication (Request $request){
		
		$mailaddress= $request->input('mailaddress');
		$user_id= $request->input('user_id');
		
		//user_idデータ呼び出し
		if(isset($user_id)){
			
			return User::where('id', $user_id)->count();
			//return diplicationCheck;
			
		}
		//mailaddressデータ呼び出し
		if(isset($mailaddress)){			
			
			return User::where('e_mail', $mailaddress)->count();
		
		}
	}
}
