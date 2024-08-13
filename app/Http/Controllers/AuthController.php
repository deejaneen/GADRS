<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store()
    {
        // Validate the request data
        $validated = request()->validate([
            'last_name' => 'required|min:2|max:15',
            'first_name' => 'required|min:2|max:15',
            'middle_name' => 'required|min:2|max:15',
            'email' => 'required|email|unique:users,email',
            'contact_number' => [
                'required',
                'regex:/^09[0-9]{9}$/',
                'unique:users,contact_number'
            ],
            'password' => 'required|confirmed'
        ]);

        // Create the user
        $user = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'],
            'password' => Hash::make($validated['password']),
        ]);


        // Fire the Registered event
        event(new Registered($user));

        // Log in the user
        auth()->login($user);

        // Redirect to verification notice
        return redirect()->route('verification.notice')->with('success', "Account created successfully! Please verify your email.");
    }

    public function authenticate()
    {
        // Validate the login form input
        $validated = request()->validate([
            'login_email' => 'required|email',
            'login_password' => 'required|min:8'
        ]);
    
        // Attempt to log the user in using the provided email and password
        if (auth()->attempt([
            'email' => $validated['login_email'], 
            'password' => $validated['login_password']
        ])) {
            request()->session()->regenerate();
    
            // Check user role and redirect accordingly
            if (auth()->user()->role === 'Admin') {
                return redirect()->route('adminhome')->with('success', "Logged in successfully!");
            } elseif (auth()->user()->role === 'Cashier') {
                return redirect()->route('cashierhome')->with('success', "Logged in successfully!");
            } elseif (auth()->user()->role === 'Receiving') {
                return redirect()->route('receivinghome')->with('success', "Logged in successfully!");
            } elseif (auth()->user()->role === 'Supply') {
                return redirect()->route('supplyhome')->with('success', "Logged in successfully!");
            } else {
                return redirect()->route('home')->with('success', "Logged in successfully!");
            }
        }
    
        // Redirect to login page with error message
        return redirect()->route('login')->withErrors([
            'login_email' => "No matching user found with the provided email and password"
        ]);
    }
    

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', "Logged out succesfully!");
    }
}
