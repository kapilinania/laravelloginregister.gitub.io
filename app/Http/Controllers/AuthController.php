<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to the welcome page if successful
            return redirect()->route('welcome');
        }

        // If unsuccessful, redirect back to the login form with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Show all users on the welcome page
    public function welcome()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect()->route('register'); 
    }
}

