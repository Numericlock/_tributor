<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attached_content;
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
    
	
	public function register_profile (){
		
		return view('register_profile');
		
	}
    
    	public function register_img (){
		
		return view('register_profile');
		
	}
	
	public function register_insert (RegisterFormRequest $request){
               //ヘッダに「data:image/png;base64,」が付いているので、それは外す
        $canvas = $request->input('base64');
        $canvas = preg_replace("/data:[^,]+,/i","",$canvas);
 Log::debug("デストロイ");
//残りのデータはbase64エンコードされているので、デコードする
        $canvas = base64_decode($canvas);
 
//まだ文字列の状態なので、画像リソース化
        $image = imagecreatefromstring($canvas);
 
//画像として保存（ディレクトリは任意）
        $savepath=$request->input('id');
        $path2 ='img/icon_img/';
        $path2 .=$savepath;
        $img_path =  self::unique_filename($path2);
        imagesavealpha($image, TRUE); // 透明色の有効
        imagepng($image ,$img_path);
        
        
        User::create([
            'id'=> $request->input('id'),
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            'e_mail'=>$request->input('email'),
            'birth_on' => "2019-10-28",
            'is_deleted' => 0
        ]);
        
 
        
		return view('login');
	}
    private static function unique_filename($org_path, $num=0){
     
            if( $num > 0){
                $info = pathinfo($org_path);
                $path = $info['dirname'] . "/" . $info['filename'] . "_" . $num;
                if(isset($info['extension'])) $path .= "." . $info['extension'];
            } else {
                $path = $org_path;
            }
     
            if(file_exists($path)){
                $num++;
                return unique_filename($org_path, $num);
            } else {
                $path.=".png";
                return $path ;
            }
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
