<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
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
        
        return view('demo.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectFor(Auth::user());
        }

        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'terms' => ['accepted'],
        ]);

        // Allow login with "Graphtech" as username
        $email = $request->email;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strtolower($email) === 'graphtech') {
                $email = 'graphtech@thinkgraphtech.com';
            }
        }

        $credentials = ['email' => $email, 'password' => $request->password];
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectFor($request->user())
                ->with('success', 'Welcome to the demo site!');
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

        return redirect()->route('demo.login');
    }

    protected function redirectFor(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('demo.journey');
    }
}
