<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman landing atau login
        // Anda bisa menyesuaikan ini sesuai kebutuhan
        if (Auth::check()) {
            // Jika sudah login tapi bukan admin, arahkan ke landing page
            return redirect('/landingPage')->with('error', 'Anda tidak memiliki akses sebagai Admin.');
        }

        // Jika belum login, arahkan ke halaman login
        return redirect('/login')->with('error', 'Silakan login untuk mengakses halaman ini.');
    }
}
