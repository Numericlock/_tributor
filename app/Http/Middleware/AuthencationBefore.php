<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserSession;

class AuthencationBefore
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
				$request->merge(['base_user' => $user]);
				return $next($request);
			}else{
				setcookie('session','',time()-1);
				return redirect('/login');
			}
		}else{
			return redirect('/login');
		}
    }
}
