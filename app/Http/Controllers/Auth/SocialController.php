<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Str;
class SocialController
{
    //google authentication
    public function Redirect()
{
        return Socialite::driver('google')->redirect();
}
    public function Callback()
{
    $userFromGoogle = Socialite::driver('google')->user();

    $userFromDatabase = User::where('social_id', $userFromGoogle->getId())->first();

    if (!$userFromDatabase) {
        $newUser = new User([
            'id' =>  Str::uuid(),
            'social_id' => $userFromGoogle->getId(),
            'name' => $userFromGoogle->getName(),
            'email' => $userFromGoogle->getEmail(),
            'oauth_provider' => 'google'
        ]);

        $newUser->save();

        Auth::login($newUser);
        session()->regenerate();

        return redirect('/');
    }

    Auth::login($userFromDatabase);
    session()->regenerate();

    return redirect()->route('HomeView');
}
}
