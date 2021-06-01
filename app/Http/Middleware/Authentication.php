<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // The user is logged in..
            if ($request->is('login')) {
                if (!$request->ajax()) {
                    return redirect('/');
                }
                return response()->json(['success' => false, 'message' => "You are logged in."], 200);
            }
            return $next($request);
        }
        // The user is not logged in..
        if (!$request->is('login')) {
            if (!$request->ajax()) {
                return redirect('login');
            }
            return response()->json(['success' => false, 'message' => "You are not logged in."], 401);
        }
        return $next($request);
    }
}
