<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Role extends Middleware
{
    public function handle($request, \Closure $next, ... $roles)
    {
        if(!Auth::guest())
            foreach($roles as $role) {
                if(Auth::user()->hasRole($role))
                    return $next($request);
            }
        return response()->view('errors.403');
    }
}
