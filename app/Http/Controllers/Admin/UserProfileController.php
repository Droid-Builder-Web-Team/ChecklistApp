<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use App\User;
use App\UserProfile;
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
            "uname" => "required",
        ]);

        $user = User::with('profile')->find(Auth::id());

        // If the user is changing their email we need to validate that the new address
        // isn't already being used by someone else
        if ($user->email !== request('email'))
        {
            if (User::where('email', '=', request('email'))->exists())
            {
                throw ValidationException::withMessages(['email' => 'Email address already in use']);
            }
        }

        // If the user is changing their email we need to validate that the new address
        // isn't already being used by someone else
        if ($user->uname !== request('uname'))
        {
            if (User::where('uname', '=', request('uname'))->exists())
            {
                throw ValidationException::withMessages(['uname' => 'Username already in use']);
            }
        }

        error_log(json_encode($request->all()));

        DB::transaction(function ()
        {
            // Update user table record
            User::where('id', Auth::user()->id)
                ->update([
                    "email" => request('email'),
                    "fname" => request('fname'),
                    "lname" => request('lname'),
                    "uname" => request('uname'),
                ]);

            // Update user_profiles record
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

    public function UploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|file', //|size:1024|dimensions:max_width=500,max_height=500',
        ]);

        DB::transaction(function () use ($request)
        {
            // Read file contents
            $contents = file_get_contents($request->file('avatar')->path());
            $extension = $request->file('avatar')->extension();
            $filename = Str::uuid() . "." . $extension;

            $profile = Auth::user()->getProfile();

            // Remove old one first
            if (Storage::disk('public')->exists('avatars/' . $profile->avatar))
            {
                Storage::disk('public')->delete('avatars/' . $profile->avatar);
            }

            // Store the new avatar
            $path = $request->avatar->storeAs('avatars', $filename, 'public');

            // Update the profile with the filename
            $profile->avatar = $filename;
            $profile->save();
        });

        return response("Avatar updated!");
    }
}
