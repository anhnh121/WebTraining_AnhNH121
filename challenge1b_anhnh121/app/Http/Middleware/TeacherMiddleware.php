<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Util\Util;
class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function __construct()
//    {
//        $this->middleware('user');
//    }
//    
    public function handle(Request $request, Closure $next)
    {
        if ((Auth::guard('account')->user()->acc_role) === 0){
    //                $role = "Teacher";
            return $next($request);
        }
        else{
            $msg = 'Permission Denied';
            $util = new Util();
            $util->phpAlert($msg);
            return redirect('logout'); 
        }
    }
}