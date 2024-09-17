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
    public function GoogleRedirect()
{
        return Socialite::driver('google')->redirect();
}
    public function GoogleCallback()
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
  //facebook authentication
  public function FacebookRedirect()
  {
          return Socialite::driver('facebook')->redirect();
  }
      public function FacebookCallback()
  {
      $userFromFacebook = Socialite::driver('facebook')->user();
      $userFromDatabase = User::where('social_id', $userFromFacebook->getId())->first();
    if (!$userFromDatabase) {
          $newUser = new User([
              'id' =>  Str::uuid(),
              'social_id' => $userFromFacebook->getId(),
              'name' => $userFromFacebook->getName(),            
              'oauth_provider' => 'facebook'
          ]);
          if ($userFromFacebook->getEmail() == null) {
            $newUser->email = $userFromFacebook->getName() . '@facebook.com';
        }  
  
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
