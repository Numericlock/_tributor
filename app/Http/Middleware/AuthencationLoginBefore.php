<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserSession;

class AuthencationLoginBefore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		session_start();
		if(isset($_COOKIE['session'])===true){
			$count = UserSession::where([
				['id', $_COOKIE['session']],
				['logout_at', null],
			])->count();
			if ($count == 1) {
				header("Location: /home");
				exit;
			}else{
				setcookie('session','',time()-1);
				return view('login');
			}
		}else{
			return $next($request);
		}
    }
}
