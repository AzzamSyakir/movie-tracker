<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController
{
    public function SignIn(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('HomeView');
        }
    
        return redirect()->back()->withInput()->with('error', 'Email or password incorrect');
    }
    
    public function SignUp(){
        try {
            $new_user = new User();
            $new_user->id = Str::uuid();
            $new_user->name = request('name');
            $new_user->email = request('email');
            $new_user->password = Hash::make(request('password'));
            $new_user->save();
            return redirect()->route('SignInView');
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
