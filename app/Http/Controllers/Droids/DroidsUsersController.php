<?php

namespace App\Http\Controllers\Droids;

use App\BuildProgress;
use App\DroidDetail;
use App\DroidUser;
use App\Http\Controllers\Controller;
use App\User;
use App\Part;
use Auth;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DroidsUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $my_droids = DB::table('droid_user')
            ->join('droids', 'droids_id', '=', 'droids.id')
            ->select('droid_user.id', 'droids.class', 'droids.image', 'droid_user.progress')
            ->where('droid_user.user_id', '=', $user->id)
            ->orderBy('droid_user.created_at', 'DESC')
            ->get();

        if ($my_droids->isEmpty())
        {
            return view('droids.user.index', ['my_droids' => $my_droids])->with(['error' => 'No Droids :(']);
        }
        else
        {
            return view('droids.user.index', ['my_droids' => $my_droids]);
        }
    }

    /**
     * Returns this droids progress
     */
    public function getDroidProgress($id)
    {
        $stats = $this->getDroidPrintedStats($id);
        return response()->json($stats);
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePart(Request $request, $id)
    {
        $request->validate([
            "completed" => "required|boolean",
            "na" => "required|boolean",
        ]);

        $buildProgress = BuildProgress::find($id);

        DB::transaction(function () use ($request, $buildProgress, $id)
        {
            BuildProgress::where('id', $id)->update([
                "completed" => $request->input("completed"),
                "NA" => $request->input("na"),
            ]);

            $droidUser = DroidUser::find($buildProgress->droid_user_id);
            $stats = $this->getDroidPrintedStats($buildProgress->droid_user_id);

            $totalToComplete = $stats["partsTotal"] - $stats["partsNA"];
            if ($totalToComplete <= 0)
            {
                $progress = 100;
            }
            else
            {
                $progress = ($stats["partsPrinted"] / $totalToComplete) * 100;
            }
            $droidUser->progress = $progress;
            $droidUser->save();
        });

        $part = Part::find($buildProgress->part_id);
        $stats = $this->getSubSectionPrintedStats($buildProgress->droid_user_id, $part->sub_section);

        return response()->json($stats);
    }

    /**
     * Marks an entire subsection as complete/incomplete
     *
     * @id is the droid_user_id
     */
    public function completeAllSubsection(Request $request, $id, $subsection)
    {
        // TODO: make sure the auth user can update this droid!

        $request->validate([
            "completed" => "required|boolean",
            "ids" => "required"
        ]);

        DB::transaction(function () use ($request, $id, $subsection)
        {
            $droidUser = DroidUser::find($id);

            // We need to update ONLY the parts within that subsection
            // so query for the part_ids from the parts table;
            $partIds = Part::where('sub_section', $subsection)
                ->where('droids_id', $droidUser->droids_id)
                ->pluck('id')->toArray();

            // Update all the parts to completed/incompleted
            BuildProgress::where('droid_user_id', $id)
                ->whereIn('part_id', $partIds)
                ->update(["completed" => $request->input("completed")]);

            $stats = $this->getDroidPrintedStats($id);

            $totalToComplete = $stats["partsTotal"] - $stats["partsNA"];
            if ($totalToComplete <= 0)
            {
                $progress = 100;
            }
            else
            {
                $progress = ($stats["partsPrinted"] / $totalToComplete) * 100;
            }
            $droidUser->progress = $progress;
            $droidUser->save();
        });

        $stats = $this->getSubSectionPrintedStats($id, $subsection);

        return response()->json($stats);
    }

    /**
     * Marks an entire subsection as complete/incomplete
     *
     * @id is the droid_user_id
     */
    public function naAllSubsection(Request $request, $id, $subsection)
    {
        // TODO: make sure the auth user can update this droid!

        $request->validate([
            "na" => "required|boolean",
            "ids" => "required"
        ]);

        DB::transaction(function () use ($request, $id, $subsection)
        {
            $droidUser = DroidUser::find($id);

            // We need to update ONLY the parts within that subsection
            // so query for the part_ids from the parts table;
            $partIds = Part::where('sub_section', $subsection)
                ->where('droids_id', $droidUser->droids_id)
                ->pluck('id')->toArray();

            // Update all the parts to NA
            BuildProgress::where('droid_user_id', $id)
                ->whereIn('part_id', $partIds)
                ->update(["NA" => $request->input("na")]);

            $stats = $this->getDroidPrintedStats($id);

            $totalToComplete = $stats["partsTotal"] - $stats["partsNA"];
            if ($totalToComplete <= 0)
            {
                $progress = 100;
            }
            else
            {
                $progress = ($stats["partsPrinted"] / $totalToComplete) * 100;
            }
            $droidUser->progress = $progress;
            $droidUser->save();
        });

        $stats = $this->getSubSectionPrintedStats($id, $subsection);

        return response()->json($stats);
    }

    /**
     * Show the form for creating a new resource. This connects to the page 'create' !
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

            'domes' => $domes,
            'bodies' => $bodies,
            'legs' => $legs,
            'feets' => $feets,
        ]);

    }

    /**
     * Returns the number of parts printed, number of NA parts, and total parts for
     * the specified sub section.
     */
    public function getSubSectionPrintedStats($droidUserId, $subSection)
    {
        $droidUser = DroidUser::find($droidUserId);

        // Get all parts for the subsection belonging to this droid
        $partIds = Part::where('sub_section', $subSection)
            ->where('droids_id', $droidUser->droids_id)
            ->pluck('id')->toArray();

        // Get the parts printed
        $partsPrinted = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('completed', true)
            ->count();

        // Get the parts marked NA
        $partsNA = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('NA', true)
            ->count();

        // Get the total parts for this droid
        $partsTotal = count($partIds);

        return [
            "partsPrinted" => $partsPrinted,
            "partsNA" => $partsNA,
            "partsTotal" => $partsTotal
        ];
    }

    /**
     * Returns the number of parts printed, number of NA parts, and total parts for
     * the specified droid.
     */
    public function getDroidPrintedStats($droidUserId)
    {
        $droidUser = DroidUser::find($droidUserId);

        // Get all of the part ids for this droid
        $partIds = Part::where('droids_id', $droidUser->droids_id)->pluck('id')->toArray();

        // Get the parts printed
        $partsPrinted = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('completed', true)
            ->count();

        // Get the parts marked NA
        $partsNA = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('NA', true)
            ->count();

        // Get the total parts for this droid
        $partsTotal = count($partIds);//Part::where('droids_id', $droidUser->droids_id)->count();

        return [
            "partsPrinted" => $partsPrinted,
            "partsNA" => $partsNA,
            "partsTotal" => $partsTotal
        ];
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

        //--Get Parts
        //Get Dome
        $domeBits = DB::table('parts')
            ->where('droid_version', '=', $dome)
            ->where('Droid_Section', '=', 'Dome')
            ->get();

        //Get body
        $bodyBits = DB::table('parts')
            ->where('droid_version', '=', $body)
            ->where('Droid_Section', '=', 'Body')
            ->get();

        //get legs
        $legBits = DB::table('parts')
            ->where('droid_version', '=', $legs)
            ->where('Droid_Section', '=', 'Legs')
            ->get();

        //get feet
        $feetBits = DB::table('parts')
            ->where('droid_version', '=', $feets)
            ->where('Droid_Section', '=', 'Feet')
            ->get();

        //---------
        //--Add droid to user list
        $newBuild = new DroidUser();
        $newBuild->user_id = auth()->user()->id;
        $newBuild->droids_id = 20; //custom droid
        $newBuild->save();

        $udroids_id = $newBuild->id; //get the id from the new droid_user
        $userid = auth()->user()->id; //quicker then getting referenc everytime?

        //loop through the part list and assign to the build progress.
        foreach ($domeBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroids_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($bodyBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroids_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($legBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroids_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($feetBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $udroids_id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        //Sends a blank Droid Detail form into the database
        $user = $userid;
        $droidDetailForm = $newBuild->id;
        $newDroidDetails = new DroidDetail();
        $newDroidDetails->droid_user_id = $droidDetailForm;
        $newDroidDetails->droids_id = $udroids_id;
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
        $newBuild->user_id = auth()->user()->id;
        $newBuild->droids_id = $newDroidBuild;
        $newBuild->save();

        $droiduserid = DB::table('droid_user')
            ->select('id', 'droids_id', 'user_id') //dont need all three! to be confirmed.
            ->where('droids_id', '=', $newDroidBuild)
            ->where('user_id', '=', auth()->user()->id)
    	    ->orderBy('id', 'desc')
            ->get();

        //------------
        //Get parts list, IDs only for this droid
        $versionParts = DB::table('parts')
            ->select('parts.id')
            ->where('droids_id', '=', $droiduserid[0]->droids_id)
            ->get();

        //Add Checklist files to database - all assosiated,

        //loop through the part list and assign to the build progress.
        foreach ($versionParts as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $droiduserid[0]->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
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
        $droidUser = \App\DroidUser::find($id);
        $currentBuild = \App\Droid::find($droidUser->droids_id);

        //----------------
        //partList To replace version parts on checklist
        $partsList = DB::table('parts')
            ->select('build_progress.id', 'parts.droid_version', 'parts.id as part_id', 'part_name', 'parts.droid_section', 'parts.sub_section', 'file_path', 'build_progress.completed', 'build_progress.NA')
            ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
            ->where('build_progress.droid_user_id', '=', $id)
            ->orderBy('droid_section', 'DESC')
            ->orderBy('sub_section')
            ->get();

        /**
         * Build up an array of sections and their parts. Each section has a name, id, and array of Parts.
         */
        $sections = [];

        // Used for the href attribute of the expand anchor tag
        $index = 0;

        $totalParts = 0;
        $totalCompleted = 0;
        $totalNA = 0;

        foreach($partsList as $part)
        {
            if (!array_key_exists($part->sub_section, $sections))
            {
                $subSection = new \stdClass();
                $subSection->index = "section_" . $index++;
                $subSection->parts = [];
                $subSection->partCount = 0; // This will be the number of parts subtracting the NA parts
                $subSection->title = $part->sub_section;
                $sections[$part->sub_section] = $subSection;
            }
            array_push($sections[$part->sub_section]->parts, $part);
        }

        // Calculate the number of completed parts
        foreach($sections as $key => $subSection)
        {
            // Get ready to subtract the NA parts
            $subSection->partCount = count($subSection->parts);
            $totalParts = $totalParts + $subSection->partCount;

            $subSection->numCompleted = array_reduce($subSection->parts, function($carry, $part)
            {
                if ($part->completed)
                {
                    $carry = $carry + 1;
                }
                return $carry;
            });

            // Aggregate the number of completed parts in every subsection
            $totalCompleted = $totalCompleted + $subSection->numCompleted;

            $numNa = array_reduce($subSection->parts, function($carry, $part)
            {
                if ($part->NA)
                {
                    $carry = $carry + 1;
                }
                return $carry;
            });

            // Aggregate the number of NA parts in every subsection
            $totalNA = $totalNA + $numNa;

            $subSection->partCount = $subSection->partCount- $numNa;

            // If no parts are printed it defaults to undefined so we need to
            // explicitely give it a 0
            if (!isset($subSection->numCompleted))
            {
                $subSection->numCompleted = 0;
            }
        }

        // Calculate the percentage complete
        if (($totalParts- $totalNA) <= 0)
        {
            $percentComplete = 0;
        }
        else
        {
            $percentComplete = $totalCompleted / ($totalParts- $totalNA) * 100;
            $percentComplete = round($percentComplete, 2);
        }

        //update progress of droid... is this the best place? should it be in the update part bit?
        //Update users checkList partlist
        $progrss = DB::table('droid_user')
            ->where('droid_user.id', '=', $id)
            ->update([
                'progress' => $percentComplete,
            ]);

        $droidDetails = DroidDetail::where(['droid_user_id' => $droidUser->id])->first();

        return view('droids.user.edit', [
            'currentBuild' => $currentBuild,
            'droidDetails' => $droidDetails,
            'sections' => $sections,
            'partsNum' => $totalParts - $totalNA,
            'partsPrinted' => $totalCompleted,
            'percentComplete' => $percentComplete
        ]);
    }


    /**
     * Returns the percantage completed
     */
    public function getDroidBuildPercentComplete($droidUserId)
    {
        $partsList = DB::table('parts')
            ->select('parts.droid_version', 'parts.id', 'part_name', 'parts.droid_section', 'parts.sub_section', 'file_path', 'build_progress.completed', 'build_progress.NA')
            ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
            ->where('build_progress.droid_user_id', '=', $droidUserId)
            ->orderBy('droid_section', 'DESC')

            ->orderBy('sub_section')
            ->get();

        $NAList = DB::table('parts')
            ->select('parts.droid_version', 'parts.id', 'build_progress.NA')
            ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
            ->where('build_progress.droid_user_id', '=', $droidUserId)
            ->where('NA', '=', 1)
            ->get();

        $completedList = DB::table('parts')
            ->select('parts.droid_version', 'parts.id', 'part_name', 'parts.droid_section', 'parts.sub_section', 'file_path', 'build_progress.completed')
            ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
            ->where('build_progress.droid_user_id', '=', $droidUserId)
            ->where('completed', '=', 1)
            ->orderBy('droid_section', 'DESC')
            ->orderBy('sub_section')
            ->get();

        $numOfParts = $partsList->count();
        $numOfNAParts = $NAList->count();
        $completedParts = $completedList->count();
        if ($numOfParts > 0)
        {
            $percentComplete = ((100 / ($numOfParts - $numOfNAParts)) * $completedParts);
            $percentComplete = round($percentComplete, 2);
        }
        else
        {
            $percentComplete = 0;
        }

        return [
            'partsNum' => $numOfParts - $numOfNAParts,
            'partsPrinted' => $completedParts,
            'percentComplete' => $percentComplete
        ];
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

        $request->validate(['image' => 'required|mimes:png,jpeg,jpg,gif|max:2048']); //2mb limit (confirm?)

        //$file->getSize(); may use to warn user... todo?
        $file = $request->file('image'); //get the image

        $newImageName = time() . '_' . $file->getClientOriginalName(); //add time to make file name unique? replace with better method?

        $request->image->move(public_path('/img/BuilderImg/'), $newImageName); //copy to public folder with new name

        //add image name to text file
        $file_name = "imageList.txt";
        $file_url = 'public/img/BuilderImg/' . $file_name;
        $content = file_get_contents(base_path($file_url)); //open all file

        $content = $content . "\r\n" . $newImageName; //add new image name
        file_put_contents(base_path($file_url), $content); //save all back to file (overwrites!)

        return back()

            ->with('success', 'Image successfully transmitted.')
            ->with('file', $file->getClientOriginalName());

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
