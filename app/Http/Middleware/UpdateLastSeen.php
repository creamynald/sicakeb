<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $lastLogin = $user->last_login_at;
            $now = Carbon::now();

            // Cek jika `last_login_at` belum pernah dicatat atau lebih dari 5 menit yang lalu
            if (is_null($lastLogin) || $now->diffInMinutes($lastLogin) >= 5) {
                $user->update(['last_login_at' => $now]);
            }
        }
        return $next($request);
    }
}
