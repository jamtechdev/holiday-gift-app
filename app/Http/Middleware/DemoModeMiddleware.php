<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoModeMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Sets a flag in the request to indicate demo mode for routes under /2025season
     * 
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set demo mode flag in the request
        $request->attributes->set('demo_mode', true);
        
        // Also set it in session for easy access in views
        session(['demo_mode' => true]);
        
        return $next($request);
    }
}
