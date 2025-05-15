<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get credentials from request
        $credentials = $request->only('email', 'password');

        // Attempt to log in
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication successful, redirect to intended page
            return redirect()->intended('admin/dashboard');
        }

        // If login failed, redirect back with an error message
        return back()->with('msg', 'Invalid email or password.');
    }
    
    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to login page or any other page after logout
        return redirect('/');
    }

    public function adminLogin(Request $request) {
        return view('admin.login');
    }
}