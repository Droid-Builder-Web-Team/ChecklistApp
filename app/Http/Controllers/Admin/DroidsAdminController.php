<?php

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use App\Droid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DroidsAdminController extends Controller
{
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
        if (Gate::denies('add-droids'))
        {
            $request->session()->flash('error', "Only Admins may create a droid");
            return redirect(route('admin.admin.dashboard'));
        } else {
            return view('droids.add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('add-droids'))
        {
            $request->session()->flash('error', "Only Admins may create a droid");
            return redirect(route('admin.admin.dashboard'));
        } else {
            return view('droids.add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit-droids'))
        {
            $request->session()->flash('error', "Only Admins may edit a droid");
            return redirect(route('admin.admin.dashboard'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('edit-droids'))
        {
            $request->session()->flash('error', "Only Admins may edit a droid");
            return redirect(route('admin.admin.dashboard'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Gate::denies('delete-droids'))
        {
            $request->session()->flash('error', "Only Admins may delete droids");
            return redirect(route('admin.admin.dashboard'));
        }

        $droid = Droid::find($id);
        DB::transaction(function () use ($id)
        {
            Droid::destroy($id);
        });
    }
}
