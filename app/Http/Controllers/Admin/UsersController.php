<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use DB;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;

class UsersController extends Controller
{
    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('manage-users'))
        {
            return redirect(route('home'));
        }

        $users = User::all();

        return view('admin.users.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        if (Gate::denies('edit-users'))
        {
            return redirect(route('admin.users.index'));
        }

        if (Gate::denies('delete-users'))
        {
            return redirect(route('admin.users.index'));
        }

        $role = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Gate::denies('edit-users'))
        {
            return redirect(route('admin.users.index'));
        }

        $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string|email',
        ]);

        DB::transaction(function () use ($request, $user)
        {
            if(isset($request->verified) && !$user->isVerified())
            {
                $user->email_verified_at = Carbon::now();
            }
            $user->roles()->sync($request->roles);
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;

            if ($user->save())
            {
                $request->session()->flash('success', $user->name() . ' has been updated');
            }
            else
            {
                $request->session()->flash('error', 'There was an error updating the user.');
            }
            return redirect()->route('admin.users.index');

            $droids = $request->get('droids', []);

            $user = User::findOrFail($id);
            $user->droids()->sync($droids); // this does the trick
        });

        return redirect()->back()->with('info', 'success');

    }

    public function show()
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if (Gate::denies('delete-users'))
        {
            $request->session()->flash('error', "Only Admins may delete users");
            return redirect(route('admin.admin.dashboard'));
        }

        DB::transaction(function () use ($user)
        {
            $user->roles()->detach();
            $user->profile->delete();
            $user->delete();
        });

        $request->session()->flash('success', $user->fname . ' has been deleted');
        return redirect()->route('admin.admin.dashboard');
    }

    // public function notify($id)
    // {
    //     return view('admin.users.notifications');
    // }

    public function unverifiedUsers()
    {
        $users = User::where('email_verified_at', NULL)->get();

        return view('admin.users.unverified', compact('users'));
    }

    public function sendReminderEmail(Request $request)
    {
        $user = User::find($request->id);
        $user->notify(new \App\Notifications\VerificationReminder($user));

        return redirect()->back();
    }
}
