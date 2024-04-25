<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //validate
        $validated = request()->validate([
            'last_name' => 'required|min:3|max:40',
            'first_name' => 'required|min:3|max:40',
            'middle_name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        //create the user
        $user = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // log in the user
        auth()->login($user);

        //redirect to dashboard
        return redirect()->route('home')->with('success', "Account created successfully!");
    }

    public function authenticate()
    {
        //validate
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            // Check user role and redirect accordingly
            if (auth()->user()->role === 'Admin') {
                return redirect()->route('adminhome')->with('success', "Logged in successfully!");
            } elseif (auth()->user()->role === 'Cashier') {
                return redirect()->route('cashierhome')->with('success', "Logged in successfully!");
            } elseif (auth()->user()->role === 'Receiving') {
                return redirect()->route('receivinghome')->with('success', "Logged in successfully!");
            } else {
                return redirect()->route('home')->with('success', "Logged in successfully!");
            }
        }

        //redirect to login page with error message
        return redirect()->route('login')->withErrors([
            'email' => "No matching user found with the provided email and password"
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
