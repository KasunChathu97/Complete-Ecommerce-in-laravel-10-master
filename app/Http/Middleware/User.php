<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
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
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }
        else{
            $response = $next($request);

            // Prevent protected pages being shown from browser cache after logout.
            if ($response instanceof Response) {
                $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
                $response->headers->set('Pragma', 'no-cache');
                $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
            }

            return $response;
        }
    }
}
