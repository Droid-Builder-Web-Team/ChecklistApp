<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Droid;
use App\Role;
use App\DroidUser;

use App\Part;

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
        $droids = Droid::orderBy('description')->get();
        // dd($droids);
        //Shows images
        // $droids = DB::table('droids')
        // ->select( 'id', 'class', 'description', 'image')
        // ->orderBy('description', 'DESC')
        // ->get();


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

        //Get and upload droid image
        $request->validate(['image' => 'required|mimes:png,jpeg,jpg,gif|max:2048',]); //2mb limit (confirm?)
            //$file->getSize(); may use to warn user... todo?
        $file = $request->file('image'); //get the image
        $newImageName = $file->getClientOriginalName(); //Not re-nameing!! Could overwrite!
        $request->image->move(public_path('/img/'), $newImageName); //copy to public folder


        //Stores new Droid to droids table
        $newClass = new Droid;
        $newClass['class'] = $request->class;
        $newClass['description'] = $request->description;
        $newClass['image'] = '/img/'. $newImageName;  //name from file plus local path folder
        $newClass->save();

        //Get CSV and move to temp folder
       // $request->validate(['partslist' => 'required|mimes:csv, xlsx',]); //doesnt work??
        $csv = $request->file('partslist'); //get the partlist spreadsheet
        $newImageName = $csv->getClientOriginalName();
        $request->partslist->move(public_path('/temp/'), $newImageName); //copy to public folder with new name

        //get the new droidid from the newclass->save
        $newDroid_ID = $newClass->id;

        //Open the CSV for reading
        $file=fopen(public_path('/temp/'.$newImageName),'r');

        //loop through all records - saves one record at a time - slow...
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
        {
            //No validation! assumes CSV is correctly formatted.
            $newPart = new Part;
            $newPart['droids_id'] = $newDroid_ID; //field in CSV ignored, replaced by new droid id from above insert
            $newPart['droid_version'] = $data[1];
            $newPart['droid_section'] = $data[2];
            $newPart['sub_section'] = $data[3];
            $newPart['part_name'] = $data[4];
            $newPart['file_path'] = $data[5];
            $newPart->save();

        }

        //delete temp CSV file
        unlink(public_path('/temp/'.$newImageName)) or die("Couldn't delete file");

        return back()->withMessage('Added new Droid with parts');
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

