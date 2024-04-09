<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function RedirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    // Redirect to Facebook

    public function HandleFacebookCallback()
    {
        try {
        $facebook_user = Socialite::driver('facebook')->user();
        $user = User::where('facebook_id', $facebook_user->getId())->first();
        if(!$user) {
            $new_user = User::create([
                'name' => $facebook_user->getName(),
                'email' => $facebook_user->getEmail(),
                'username' => $facebook_user->getEmail(),
                'facebook_id' => $facebook_user->getId(),
                'image' => $facebook_user->getAvatar(),
                'status' => 'active',
                'role' => 'subscriber',
            ]);

            Auth::login($new_user);
            return redirect()->route('home.page');
        }else{
            Auth::login($user);
            return redirect()->route('home.page');
        }

    } catch (\Exception $e) {
        return redirect()->route('login');
    }

    }

}
