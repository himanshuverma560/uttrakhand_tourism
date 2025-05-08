<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class WebsiteController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function registration() {
        return view('registration');
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:users,mobile',
            'country_code' => 'nullable|string|max:5',
            'email' => 'required|email|unique:users,email',
            'pilgrim_type' => 'required|in:Indian Pilgrim,Foreign Pilgrim',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
                'confirmed'           // matches confirm_password
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'country_code' => $request->country_code ?? '+91',
            'email' => $request->email,
            'pilgrim_type' => $request->pilgrim_type,
            'password' => Hash::make($request->password),
            'original_password' => $request->password,
            'company_name' => $request->company_name ?? '',
            'gst_number' => $request->gst_number,
            'state' => $request->state ?? ''
        ]);
    
        return redirect()->back()->with('success', 'Registration successful!');
    }


    public function dashboard() {
        return view('dashboard');
    }

    public function tour() {
        return view('registrationTour');
    }

    public function viewTour() {
        return view('viewTour');
    }

    public function addPligrim() {
        return view('add_pilgrim');
    }

    public function download() {
        return view('download');
    }
}
