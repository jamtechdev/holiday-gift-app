<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectFor(Auth::user());
        }
        
        return view('auth.login');
    }

    public function showAdminLogin(): View|RedirectResponse
    {
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
            return redirect()->route('admin.dashboard')
                ->with('success', 'Welcome back, Admin!');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please check your email and password.']);
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectFor(Auth::user());
        }

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'terms' => ['accepted'],
        ]);

        $credentials = $request->only('email', 'password');

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectFor($request->user())
                ->with('success', 'Welcome back! You have successfully logged in.');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please check your email and password.',
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

