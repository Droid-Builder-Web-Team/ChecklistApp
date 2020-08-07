<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Role;
use App\Droid;
use App\DroidUser;
use App\DroidDetail;

use App\BuildProgress;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class DroidsUsersController extends Controller
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
        $user = auth()->user();

        $my_droids = DB::table('droid_user')
            ->join('droids', 'droid_id', '=', 'droids.id')
            ->select('droid_user.id', 'droids.class', 'droids.image', 'droid_user.progress')
            ->where('droid_user.user_id', '=', $user->id)
            ->get();


        return view('droids.user.index', [
            'my_droids' => $my_droids,
        ]);
    }

    /**
     * Show the form for creating a new resource. This connects to the page 'create' !
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tester = "Testing123";


        //Get Dome Types R2 Full, R2 Split, R2 mk2, r2 mk3

        //RAW SQL: SELECT DISTINCT class FROM `custom_option_list` USE GROUP BY toaccess all fields!!!
        //SELECT * FROM `custom_option_list` WHERE section = 'Dome' group by class
/*
        $domes = DB::table('custom_option_list')
        ->distinct()
        ->where('section', '=', 'Dome')
        ->get(['class']);


        $domes = DB::table('custom_option_list')
        ->where('section', '=', 'Dome')
        ->groupby('class')
        ->get();

*/
        //Get Dome Types R2 Full, R2 Split, R2 mk2, r2 mk3
        $domes = DB::table('custom_option_list')
        ->where('section', '=', 'Dome')
        ->get();

        //Get Body Types
        $bodies = DB::table('custom_option_list')
        ->where('section', '=', 'Body')
        ->get();

        //Get Legs
        $legs = DB::table('custom_option_list')
        ->where('section', '=', 'Legs')
        ->get();

        //Get Feet
        $feets = DB::table('custom_option_list') //feets... i know.. need it for the foreach loop!
        ->where('section', '=', 'Feet')
        ->get();

        //Greebles???

        return view('droids.user.create', [

            //for testing
            'tester' => $tester,
            'domes' => $domes,
            'bodies' => $bodies,
            'legs' => $legs,
            'feets' => $feets,
        ]);


    }

    public function populateSubMenu(Request $request)
    {

    }

    public function assignCustomDroid(Request $request)
    {
        $dome = $request->dome;
        $body = $request->body;
        $legs = $request->leg;
        $feets = $request->feet;

        $buffer = $dome ." : ". $body. " : ".$legs. " : ".$feets;
      //  dd($buffer);


        //--Get Parts
        //Get Dome
        $domeBits= DB::table('parts')
        ->where('droid_version', '=', $dome)
        ->where('Droid_Section', '=', 'Dome')
        ->get();

        //Get body
        $bodyBits= DB::table('parts')
        ->where('droid_version', '=', $body)
        ->where('Droid_Section', '=', 'Body')
        ->get();

        //get legs
        $legBits= DB::table('parts')
        ->where('droid_version', '=', $legs)
        ->where('Droid_Section', '=', 'Legs')
        ->get();

        //get feet
        $feetBits= DB::table('parts')
        ->where('droid_version', '=', $feets)
        ->where('Droid_Section', '=', 'Feet')
        ->get();

        //---------
        //--Add droid to user list
        $newBuild = new DroidUser();
        $newBuild->user_id = auth()->user()->id;
        $newBuild->droid_id = 11; //custom droid
        $newBuild->save();

        $udroid_id = $newBuild->id; //get the id from the new droid_user
        $userid = auth()->user()->id; //quicker then getting referenc everytime?

        //loop through the part list and assign to the build progress.
        foreach($domeBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroid_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now();   //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach($bodyBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroid_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now();   //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach($legBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroid_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now();   //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach($feetBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroid_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now();   //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }



        //Sends a blank Droid Detail form into the database
        $user = $userid;
        $droidDetailForm = $newBuild->id;
        $newDroidDetails = new DroidDetail();
        $newDroidDetails->droid_user_id = $droidDetailForm;
        $newDroidDetails->droids_id = $udroid_id;
        $newDroidDetails->save();

        return redirect()->route('droid.user.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Assigns a Droid to a user
        $newDroidBuild = $request->input('droidIdentification');
        $newBuild = new DroidUser();
        $newBuild->user_id=auth()->user()->id;
        $newBuild->droid_id=$newDroidBuild;
        $newBuild->save();


        //Debugging Stuff
        //                  USer ID                 Droid ID
        //$buffer = auth()->user()->id . " : ". $newDroidBuild;
        //dd($buffer);

        //---------------- Warning!!! what if a user is creating 2 of the same droids!!! we need to deal with duplicates!
        //get droid user id from DB , is this already available and easier to acceess??
        //*raw sql --> SELECT * FROM `droid_user` WHERE droid_id = 1 and user_id = 1

        $droiduserid = DB::table('droid_user')
        ->select('id', 'droid_id', 'user_id') //dont need all three! to be confirmed.
        ->where('droid_id', '=', $newDroidBuild)
        ->where('user_id', '=' , auth()->user()->id)
        ->get();


        //------------
        //Get parts list, IDs only for this droid
        $versionParts = DB::table('parts')
        ->select('parts.id')
        ->where('droids_id', '=', $droiduserid[0]->droid_id)
        ->get();

       // dd($versionParts);

        //Add Checklist files to database - all assosiated, no customisation
        //warning no customisation!

        //loop through the part list and assign to the build progress.
        foreach($versionParts as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $droiduserid[0]->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now();   //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }


        //Sends a blank Droid Detail form into the database
        $user = auth()->user();
        $droidDetailForm = $newBuild->id;
        $newDroidDetails = new DroidDetail();
        $newDroidDetails->droid_user_id = $droidDetailForm;
        $newDroidDetails->droids_id = $newDroidBuild;
        $newDroidDetails->save();

        return redirect()->route('droid.user.index');
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
    public function edit(Request $request, $id)
    {
        //Returns checklist for that droid
        $currentBuilds = DB::table('droid_user')
            ->join('droids', 'droid_id', '=', 'droids.id')
            ->select('droids.class', 'droids.id')
            ->where('droid_user.id', '=', $id)
            ->get();

        //Displays parts for current droid
        $Parts = DB::table('parts')
            ->join('droid_user', 'droid_user.droid_id', '=', 'parts.droids_id')
            ->where('droid_user.id', '=', $id)
            ->select('parts.id', 'droid_section', 'sub_section', 'part_name')
            ->orderBy('droid_section', 'DESC')
            ->orderBy('sub_section')
            ->get();

        $userDroidVersion = 'MK3';
        $versionParts = DB::table('parts')
        ->select('parts.droid_version', 'parts.droid_section', 'parts.sub_section', 'parts.part_name', 'parts.id')
        ->join('droid_details', 'droid_details.droids_id', '=', 'parts.droids_id')
        ->where('droid_user_id', '=', $id)
       // ->where('parts.droid_version', '=', $userDroidVersion)
        ->orderBy('droid_section', 'DESC')
        ->orderBy('sub_section')
        ->get();


        //----------------
        //partList To replace version parts on checklist
        $partsList = DB::table('parts')
	    ->select('parts.droid_version','parts.id', 'part_name', 'parts.droid_section', 'parts.sub_section','file_path', 'build_progress.completed', 'build_progress.NA')
        ->join('build_progress','build_progress.part_id', '=' , 'parts.id' )
        ->where('droid_user_id', '=', $id)
        ->orderBy('droid_section', 'DESC')
        ->orderBy('sub_section')
        ->get();

        $NAList = DB::table('parts')
        ->select('parts.droid_version','parts.id', 'build_progress.NA')
        ->join('build_progress','build_progress.part_id', '=' , 'parts.id' )
        ->where('droid_user_id', '=', $id)
        ->where('NA','=',1)
        ->get();

        //count the completed items... feels clumsy!
        $completedList = DB::table('parts')
        ->select('parts.droid_version','parts.id', 'part_name', 'parts.droid_section', 'parts.sub_section','file_path', 'build_progress.completed')
        ->join('build_progress','build_progress.part_id', '=' , 'parts.id' )
        ->where('droid_user_id', '=', $id)
        ->where('completed','=',1)
        ->orderBy('droid_section', 'DESC')
        ->orderBy('sub_section')
        ->get();


        //Filters Droid Details table by current droid_user_id
        $droidDetails = DB::table('droid_details')
            ->where('droid_user_id', '=', $id)
            ->get();


        $numOfParts = $partsList->count();
        $numOfNAParts = $NAList->count();
        $completedParts = $completedList->count();
        $percentComplete = ((100/($numOfParts-$numOfNAParts))*$completedParts);
        $percentComplete = round($percentComplete, 2);


        //update progress of droid... is this the best place? should it be in the update part bit?
         //Update users checkList partlist
         $progrss = DB::table('droid_user')
         ->where('droid_user.id', '=', $id)
         ->update([
             'progress' => $percentComplete,
         ]);



        return view('droids.user.edit', [
            'currentBuilds' => $currentBuilds,
            'Parts' => $Parts,
            'droidDetails' => $droidDetails,
            'versionParts' => $versionParts,

            'partsList' => $partsList, //replaces versionParts
            'partsNum' => $numOfParts-$numOfNAParts,
            'partsPrinted' => $completedParts,
            'percentComplete' => $percentComplete,

        ]);
    }

    public function updatePart(Request $request)
    {
        //dd($request->partid);
        $parts = $request->partid;
        $nas = $request->na;
        $num = count($parts);

        foreach($parts as $part)
        {
            //Update users checkList partlist
            $droidInfo = DB::table('build_progress')
            ->where('part_id', '=', $part)
            ->update([
                'completed' => "1",
            ]);
        }

        foreach($nas as $na)
        {
            //Update users checkList partlist
            $droidInfo = DB::table('build_progress')
            ->where('part_id', '=', $na)
            ->update([
                'NA' => "1",
            ]);
        }

        echo '<script language="javascript">';
        echo 'alert('.$num. '" Records Updated ")';
        echo '</script>';

        return back();
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
        //Update users Droid Information
        $droidInfo = DroidDetail::where('droid_user_id', '=', $id)
            ->update([
                'droid_designation' => $request->input('droid_designation'),
                'builder_name' => $request->input('builder_name'),
                'description' => $request->input('description'),
                'droid_version' => $request->input('droid_version'),
                'colors' => $request->input('colors'),
                'mobility' => $request->input('mobility'),
                'electronics' => $request->input('electronics'),
                'control_system' => $request->input('control_system'),
                'drive_system' => $request->input('drive_system'),
                'power' => $request->input('power'),
            ]
        );

        return back();
    }

    public function uploadImage(Request $request)
    {

        //some help from... https://www.itsolutionstuff.com/post/laravel-6-file-upload-tutorial-exampleexample.html

        $request->validate(['image' => 'required|mimes:png,jpeg,jpg,gif|max:2048',]); //2mb limit (confirm?)

        //$file->getSize(); may use to warn user... todo?
        $file = $request->file('image'); //get the image

        $newImageName = time().'_'.$file->getClientOriginalName(); //add time to make file name unique? replace with better method?

        $request->image->move(public_path('/img/BuilderImg/'), $newImageName); //copy to public folder with new name


        //add image name to text file
        $file_name = "imageList.txt";
        $file_url = 'public/img/BuilderImg/'. $file_name;
        $content = file_get_contents(base_path($file_url)); //open all file

        $content = $content . "\r\n".$newImageName;         //add new image name
        file_put_contents(base_path($file_url), $content);  //save all back to file (overwrites!)

        return back()

            ->with('success','Image successfully transmitted.')
            ->with('file',$file->getClientOriginalName());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //---------------TODO!-------------
        //NEED TO DELETE BUILD PROGRESS TOO!!!!!

        //Deletes Droid from droid_user table
        $my_droids = DB::table('droid_user')->where('droid_user.id', '=', $id);
        $my_droids->delete();

        return redirect()->route('droid.user.index');
    }
}
