<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Util\Util;
class MyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('account')->check()){
            return $next($request);
        }else{
            $msg = 'Login Failed';
            $util = new Util();
            $util->phpAlert($msg);
            return redirect('getLogin');     
        }
        
    }
}
