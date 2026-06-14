<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!$request->session()->has('id')) {
            // Lempar balik ke halaman login
            return redirect('/login')->with('pesan', 'Kamu harus login dulu!');
        }

        // Kalau SUDAH LOGIN, boleh lanjut
        return $next($request);
    }
}