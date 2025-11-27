<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        // If user is already authenticated, redirect them to their appropriate page
        if (Auth::check()) {
            return $this->redirectFor(Auth::user());
        }
        
        return view('auth.login');
    }

    public function showAdminLogin(): View|RedirectResponse
    {
        // If user is already authenticated, redirect them to their appropriate page
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.journey');
        }
        
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        // If already authenticated, redirect to appropriate page
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('user.journey');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = $request->user();
            
            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Admin only.']);
            }

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function login(Request $request): RedirectResponse
    {
        // If already authenticated, redirect to appropriate page
        if (Auth::check()) {
            return $this->redirectFor(Auth::user());
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectFor($request->user());
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function redirectFor(User $user): RedirectResponse
    {
        return $user->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.journey');
    }
}

