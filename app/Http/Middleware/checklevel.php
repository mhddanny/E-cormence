<?php

namespace App\Http\Middleware;

use Closure;

class Checklevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next,...$level)
     {
       if (in_array($request->user()->level,$level)) {
         // code...
         return $next($request);
       }
         return redirect('/home');
     }

}
