<?php

namespace App\Http\Controllers\Frontend\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function login()
    {
        return view('frontend.login');
    }

    function loginstore(Request $request)
    { // Validate input
        $request->validate([
            'phone' => 'required|min:10',
        ]);

        // Find user with phone and role_id = 2
        $user = User::where('phone', $request->phone)->where('role_id', 2)->first();

        if ($user) {
            // Generate OTP and expiration
            $user->update([
                'otp' => rand(1000, 9999),
                'otp_expires_at' => now()->addMinute(2),
            ]);


            // Optionally log the user in (optional)
            Auth::login($user);

            return redirect()->route('frontend.otp', ['phone' => $user->phone]);
        }

        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    function otp()
    {
        return view('frontend.otp');
    }

    function otpVerify(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required|digits:4',
        ]);

        // Find user
        $user = User::where('phone', $request->phone)
            ->where('role_id', 2)
            ->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Check OTP and expiration
        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Invalid OTP.');
        }

        // Check expiration using normal comparison
        if (!$user->otp_expires_at || $user->otp_expires_at < now()) {
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }

        // OTP valid, log the user in
        Auth::login($user);

        return redirect()->route('frontend.dashboard'); // change to your dashboard route
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.login');
    }
}
