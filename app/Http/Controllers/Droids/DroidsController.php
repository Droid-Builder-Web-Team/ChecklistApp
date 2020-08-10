<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Droid;
use App\Role;
use App\DroidUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class DroidsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Not showing the images?
        $droids = Droid::all()->sortByDesc('description');

        return view('droids.index', [
           'droids' => $droids,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //Returns Add Droid page
        return view('droids.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('add-droids'))
        {
            return redirect(route('droids.index.create'));
        }
        if(Gate::denies('delete-droids'))
        {
            return redirect(route('admin.users.index'));
        }
        //Stores new Droid
        $newClass = new Droid;
        $newClass['class'] = $request->class;
        $newClass['description'] = $request->description;
        $newClass['image'] = $request->file('file')->store('images');
        $newClass->save();
        return back()->withMessage('Image Uploaded');
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
        //Edit Droids to add/ remove checklist parts?
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
        //Update things like BoM etc?
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete Droid
    }
}

