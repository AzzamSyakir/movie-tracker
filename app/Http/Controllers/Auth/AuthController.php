<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Watchlist;
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
            'remember' =>['nullable']
        ]);


        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            if ($request->boolean('remember')) {
                Auth::user()->setRememberToken(Str::random(60));
                Auth::user()->save();
            }
            else {
                Auth::user()->setRememberToken(null);
                Auth::user()->save();       
            }
            return redirect()->route('HomeView');
        }
    
        return redirect()->back()->withInput()->with('error', 'Email or password incorrect');
    }
    
    public function SignUp(){
        try {
            $newUser = new User([
                'id' =>  Str::uuid(),
                'name' => request('name'),
                'email' => request('email'),
                'password' => request('password'),
            ]);
            $newWatchlist = new Watchlist([
                'id' =>  Str::uuid(),
                'user_id' => $newUser->id
            ]);
            $newUser->save();
            $newWatchlist->save();
            return redirect()->route('SignInView');
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function SignOut(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
        return redirect()->route('HomeView');

    }
}
