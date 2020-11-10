<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Droid;
use App\DroidUser;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        if (Gate::denies('edit-users'))
        {
            return redirect(route('home'));
        }

        //Datatables
        $users = User::latest()->get();
        $droids = Droid::latest()->get();

        //Stat Counts
        $userAccounts = User::all();
        $droidCount = Droid::all();
        $droidUserCount = DroidUser::count();
        $topFiveDroids = DroidUser::query()->
        select(DB::raw('count(1) as OccurenceValue, droids_id'))
        ->with('droids')
        ->groupBy('droids_id')
        ->orderBy('OccurenceValue', 'DESC')
        ->limit(5)
        ->get();

        $totalUsers = count($userAccounts);
        $totalDroids = count($droidCount);
        // dd($topFiverUsers);
        return view('admin.dashboard', [
            'users' => $users,
            'droids' => $droids,
            'totalUsers' => $totalUsers,
            'totalDroids' => $totalDroids,
            'topFiveDroids' => $topFiveDroids,
            'totalDroidUsers' => $droidUserCount,
        ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
