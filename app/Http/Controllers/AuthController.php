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
        User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

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
            //redirect to dashboard
            return redirect()->route('dashboard')->with('success', "Logged in succesfully!");
        }


        //redirect to dashboard
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
