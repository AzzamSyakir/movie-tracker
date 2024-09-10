<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function SignIn(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('home');
        }
    }
    public function SignUp(Request $request){
        $request = $request->only('email', 'password');
        
    }
}
