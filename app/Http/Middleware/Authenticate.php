<?php

namespace App\Http\Middleware;
use Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            $currentRouteName = $request->route()->getName();
    
            // Avoid showing the error on the logout route
            if ($currentRouteName !== 'logout' && $currentRouteName === 'CheckOutPage') {
                Session::flash('error', 'Before purchasing, you have to login first.');
            }else  if ($currentRouteName === 'addbussiness') {
                Session::flash('error', 'Before Add Bussiness, you have to login first.');
            }
            
    
            return route('login');
        }
    }
}
