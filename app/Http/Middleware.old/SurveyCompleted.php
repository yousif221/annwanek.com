<?php

namespace App\Http\Middleware;
use Closure;
use Session;
class SurveyCompleted extends Middleware{

   public function handle($request, Closure $next) {
      if(!Session::has('survey_completed')){
        return redirect()->route('survey');
      } 
           return $next($request);
   }
}
