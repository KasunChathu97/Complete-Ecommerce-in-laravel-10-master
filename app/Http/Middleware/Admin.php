<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class Admin
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
        if(!$request->user()){
            return redirect()->route('home');
        }

        if($request->user()->role=='admin'){
            return $next($request);
        }
        else{
            request()->session()->flash('error','You do not have any permission to access this page');

            $roleRoute = $request->user()->role;
            if ($roleRoute && Route::has($roleRoute)) {
                return redirect()->route($roleRoute);
            }

            return redirect()->route('home');
        }
    }
}
