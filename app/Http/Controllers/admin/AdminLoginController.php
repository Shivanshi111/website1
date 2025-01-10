<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {
            //Redirect back with proper errors
          
        
    
        // Handle successful login logic here
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password'=>$request->password],$request->get('remember'))){ 
            $admin = Auth::guard('admin')->user();
            if($admin->role == 1){
                return redirect()->route('admin.dashboard');
            }
            else{
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error','you are not authorized to access admin panel.');    
            }
            
            // Adjust the route as per your dashboard
        }
        else{
          return redirect()->route('admin.login')->with('error','Either Emai/Password is incorrect');  
        }
    }
        else{
            return redirect()->route('admin.login')->withError($validator)->withInput($request->only('email'));
        }
    
    }
   
}
