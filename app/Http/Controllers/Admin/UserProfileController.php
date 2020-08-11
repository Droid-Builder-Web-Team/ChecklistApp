<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use Auth;
use App\User;
use App\UserProfile;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = User::with('profile')->find(Auth::id());
        

        if ($user)
        {
            return view('admin.users.profile')->withUser($user);
        }
        else
        {
            // TODO: maybe show an error message
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "email" => "required|email",
            "fname" => "required",
            "lname" => "required",
            "uname" => "required"
        ]);

        // TODO: check email

        DB::transaction(function ()
        {
            $user = User::with('profile')->find(Auth::id());
            User::where('id', Auth::user()->id)
                ->update([
                    "fname" => request('fname', Auth::user()->fname),
                    "lname" => request('lname', Auth::user()->lname),
                    "uname" => request('uname', Auth::user()->uname),
                ]);

            // User Profile
            UserProfile::where('user_id', Auth::user()->id)
                ->update([
                    "bio" => request('bio'),
                    "location" => request('location'),
                    "homepage" => request('homepage'),
                    "facebook" => request('facebook'),
                    "github" => request('github'),
                    "instagram" => request('instagram'),
                ]);
        });

        $user = User::with('profile')->find(Auth::id());

        $request->session()->flash('profile_updated', true);
        return view('admin.users.profile')->withUser($user);
    }
}
