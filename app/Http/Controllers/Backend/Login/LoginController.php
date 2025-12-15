<?php

namespace App\Http\Controllers\Backend\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login()
    {
        return view('backend.login');
    }

    function loginstore(Request $request)
    {
        // Validate input
        $request->validate([
            'phone' => 'required|min:10',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('phone', 'password');

        // Attempt to login
        if (Auth::attempt($credentials)) {
            // Check role and redirect
            $user = Auth::user();

            if ($user->role_id == 1) {
                return redirect()->route('backend.dashboard'); // Admin
            }

            if ($user->role_id == 3) {
                return redirect()->route('backend.kill'); // Example role
            }

            // Default fallback
            return redirect()->route('backend.dashboard');
        }

        // If authentication fails
        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('backend.login');
    }
}
