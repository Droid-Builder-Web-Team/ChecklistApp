<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Socialite;
use Str;
use App\User;


class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);        $user->save();        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user || !Has::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided crentials are incorrect']
            ]);
        }

        return $user->createToken('Auth Token')->accessToken;
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function twitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function githubRedirect()
    {
        $user = Socialite::driver('github')->stateless()->user();
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/');
    }

    public function googleRedirect()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/');

    }

    public function facebookRedirect()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();
        //$nickname = $user->getNickname()

        $user = User::firstOrCreate([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make(Str::random(24)),
            'avatar' => $avatar,
        ]);
        Auth::login($user, true);

        return redirect('/');
    }

    public function twitterRedirect()
    {
        $user = Socialite::driver('twitter')->stateless()->user();
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $user->name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/');
    }
}
