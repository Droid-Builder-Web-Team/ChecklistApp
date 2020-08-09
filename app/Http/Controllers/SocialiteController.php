<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class SocialiteController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = $this->create($getInfo,$provider);
        $auth()->login($user);
        return redirect()->to('/');
    }

    function create($getInfo, $provider)
    {
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'avatar' => $getInfo->avatar,
            ]);
        }
        return $user;
    }
}
