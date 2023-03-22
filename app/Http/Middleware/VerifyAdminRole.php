<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyAdminRole
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
        if (Auth::User()->role_id != '1') 
        {   
            return response()->json(['message'=>'Role not Assigned.',
            'status'=> false,]);
        }
        return $next($request);
    }
}
