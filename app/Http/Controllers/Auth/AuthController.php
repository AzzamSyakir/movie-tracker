<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function SignIn(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('Home');
        }
    }
    public function SignUp(Request $request){
        try {
            $request = $request->only('email', 'password');
            $user = User::create($request);
            return redirect()->intended('SignIn');
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
