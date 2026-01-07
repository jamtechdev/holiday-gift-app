<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SiteClosedMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Site status is controlled by artisan commands:
     * - php artisan site:closed  (to close the site)
     * - php artisan site:run     (to open the site)
     * 
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if site is closed by looking for status file
        if (Storage::exists('site-closed.txt')) {
            return response()->view('site-closed');
        }
        
        // Site is open, continue with request
        return $next($request);
    }
}
