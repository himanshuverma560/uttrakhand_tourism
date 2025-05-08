<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        
        $pilgrimType = $request->input('pilgrim_type');

        if ($pilgrimType === 'Indian Pilgrim') {
            $rules['mobile'] = 'required|digits:10';
        } else {
            $rules['email'] = 'required|email|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
       
        
        // Try to find the user by email or mobile
        $user = User::where('email', $request->email)
            ->orWhere('mobile', $request->mobile)
            ->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Check login logic based on pilgrim type
        if ($user->pilgrim_type === 'Indian Pilgrim') {
            // Authenticate using mobile
            if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
                return redirect()->intended('user/dashboard');
            }
        } elseif ($user->pilgrim_type === 'Foreign Pilgrim') {
            // Authenticate using email
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('user/dashboard');
            }
        }

        return back()->with('error', 'Invalid credentials for selected pilgrim type.');
    }

    public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to login page or any other page after logout
        return redirect('/');
    }
}