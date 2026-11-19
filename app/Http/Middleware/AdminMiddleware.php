<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //kondisi untuk cek role admin
       if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

    //jika bukan admin
    abort(403, 'Akses diTolak! Halaman ini khusus untuk admin!');

    }
}
