<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class adminnmiddleware
{
      /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('sign-in');
        }
        $users=Auth::user();

       if (Auth::check() && $users->role == 'admin') {
            return $next($request);
        }else{
            Auth::logout();

        }
        return redirect()->route('sign-in
        ')->with('error', 'Admin tidak diizinkan mengakses halaman ini.');
        }
    }


