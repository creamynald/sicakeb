<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @param  string|null  $message Pesan khusus untuk akses yang tidak diizinkan
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role, $message = null)
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Gunakan pesan khusus jika disediakan, jika tidak gunakan pesan default
            $message = $message ?: 'Akses Ditolak: Anda tidak memiliki peran yang benar.';
            // Redirect ke /admin/dashboard dengan pesan error
            return Redirect::to('/admin/dashboard')->with('error', $message);
        }

        return $next($request);
    }
}
