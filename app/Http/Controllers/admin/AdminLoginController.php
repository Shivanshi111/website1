<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login'); // Show the login form
    }

    public function authenticate(Request $request)
    {
        // Validate the login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            // Redirect back with validation errors
            return redirect()
                ->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        $remember = $request->get('remember', false); // Check if "remember me" is set

        if (Auth::attempt($credentials, $remember)) {
            $admin = Auth::user(); // Get the authenticated user

            // Check if the user has an admin role
            if ($admin->role == 1) {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            }
             else {
                Auth::logout(); // Logout non-admin users
                return redirect()
                    ->route('admin.login')
                    ->with('error', 'You are not authorized to access the admin panel.');
            }
        }

        // If authentication fails
        return redirect()
            ->route('admin.login')
            ->with('error', 'Invalid email or password.')
            ->withInput($request->only('email'));
    }
}
