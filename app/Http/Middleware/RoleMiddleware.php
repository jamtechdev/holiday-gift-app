<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  array<int, string>|string|null  $roles
     */
    public function handle(Request $request, Closure $next, array|string|null $roles = null): Response|RedirectResponse
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $roleList = collect(is_array($roles) ? $roles : explode('|', (string) $roles))
            ->filter()
            ->map(fn ($role) => trim($role))
            ->all();

        if ($roleList === [] || $user->hasRole(...$roleList)) {
            return $next($request);
        }

        abort(403, 'You are not authorized to access this area.');
    }
}

