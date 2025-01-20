<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show the login form for both admin and user
    public function login()
    {
        return view('front.account.login'); // Show the login form
    }

    // Handle login submission for both admin and user
    public function loginSubmit(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Get the authenticated user

            // Check user role and redirect accordingly
            if ($user->role == 1) {
                // Redirect to the admin dashboard if the user is an admin
                return redirect()->route('admin.dashboard')->with('success', 'Admin Login successful!');
            } else {
                // Redirect to the home page if the user is a regular user
                return redirect()->route('front.home')->with('success', 'Login successful!');
            }
        }

        // If authentication fails, redirect back with error message
        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }

    // Show the registration form for both admin and user
    public function register()
    {
        return view('front.account.register');
    }

    // Handle registration submission for both admin and user
    public function registerSubmit(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Determine the user role, assume it's user (role=0) by default
        $role = 0;

        // If you want to set admin role during registration, you can manually set it here
        if ($request->has('is_admin') && $request->is_admin == true) {
            $role = 1;
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role, // Set the role (admin or regular user)
            'password' => Hash::make($request->password), // Hash the password
        ]);

        // Redirect to login page after successful registration
        return redirect()->route('account.login')->with('success', 'Registration successful! Please login.');
    }

    // Handle logout
    public function logout()
    {
        auth()->logout(); // Log out the user
        return redirect()->route('account.login')->with('success', 'Logged out successfully');
    }
}
