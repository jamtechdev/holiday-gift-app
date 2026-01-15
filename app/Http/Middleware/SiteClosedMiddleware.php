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
     * When site is closed:
     * - Admin routes (/admin/*) remain accessible (including admin login)
     * - User routes (/user/*) and public routes are blocked
     * - Role-based access control is still enforced by RoleMiddleware
     * 
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if site is closed by looking for status file
        if (Storage::exists('site-closed.txt')) {
            // Allow admin routes to pass through even when site is closed
            // This includes:
            // - /admin/login (public, allows admins to log in)
            // - /admin/* (protected routes, RoleMiddleware will verify admin role)
            if ($request->is('admin*')) {
                return $next($request);
            }
            
            // Block all other routes (user routes and public routes)
            // User role users cannot access their routes when site is closed
            return response()->view('site-closed');
        }
        
        // Site is open, continue with request
        return $next($request);
    }
}
