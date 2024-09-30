<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;

// Default route to welcome page
Route::get('/', function () {
    $users = User::all(); // Get all users from the database
    return view('welcome', compact('users')); // Pass users to the view
});

// Show registration form
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');

// Handle registration
Route::post('register', [AuthController::class, 'register']);

// Show login form
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login
Route::post('login', [AuthController::class, 'login']);

// Protected welcome route for authenticated users only
Route::get('welcome', [AuthController::class, 'welcome'])->name('welcome')->middleware('auth');

// Logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');