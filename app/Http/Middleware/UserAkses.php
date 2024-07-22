<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    public function handle($request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role == $role) {
        return $next($request);
    }

    return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}
}

