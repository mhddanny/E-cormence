<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        //JADI KITA CEK, JIKA GUARD CUSTOMER BELUM LOGIN
        if (!auth()->guard('admin')->check()) {
            //MAKA REDIRECT KE HALAMAN LOGIN
            return redirect(route('admin.login'));
        }
        //JIKA SUDAH MAKA REQUEST YANG DIMINTA AKAN DISEDIAKAN

        return $next($request);
    }
}
