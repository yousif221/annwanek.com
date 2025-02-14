<?php

namespace App\Http\Middleware;
use Closure;
use Session;

class SessionCustom {
   public function handle($request, Closure $next) {
      if(!Session::has('currency')) session(['currency' => 'USD']);
      return $next($request);
   }
}