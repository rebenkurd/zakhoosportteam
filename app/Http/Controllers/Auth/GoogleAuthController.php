<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function RedirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function HandleGoogleCallback()
    {

        try {

        $google_user = Socialite::driver('google')->user();
        $user = User::where('google_id', $google_user->getId())->first();

        if(!$user) {
            $new_user = User::create([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'username' => $google_user->getEmail(),
                'google_id' => $google_user->getId(),
                'image' => $google_user->getAvatar(),
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
