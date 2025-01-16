<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import your model
use Illuminate\Support\Facades\Hash; // For password hashing
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function login()
    {
        return view('front.account.login');
    }

    public function loginSubmit(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->route('front.home')->with('success', 'Login successful!');
        }
    
        // Authentication failed
        return back()->withErrors(['error' => 'Invalid credentials'])->withInput();
    }

    public function register()
    {
        return view('front.account.register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'=>0,
            'password' => Hash::make($request->password), // Hash the password
        ]);

      

        return redirect()->route('account.login')->with('success', 'Registration successful!');
    }

    public function logout()
    {
      
        auth()->logout();
        return redirect()->route('account.login')->with('success', 'Logged out successfully');
    }
}
