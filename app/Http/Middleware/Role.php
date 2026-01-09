<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * Usage: ->middleware('role:admin,staff,salesman')
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home');
        }

        $allowedRoles = collect($roles)
            ->flatMap(function ($value) {
                return explode(',', (string) $value);
            })
            ->map(fn ($r) => trim($r))
            ->filter()
            ->values()
            ->all();

        if (empty($allowedRoles)) {
            return $next($request);
        }

        if (in_array($user->role, $allowedRoles, true)) {
            return $next($request);
        }

        request()->session()->flash('error', 'You do not have any permission to access this page');
        return redirect()->route('home');
    }
}
