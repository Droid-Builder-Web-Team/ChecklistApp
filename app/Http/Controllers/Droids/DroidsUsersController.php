<?php

namespace App\Http\Controllers\Droids;

use Illuminate\Support\Str;
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
     * Displays a list of all the user's current builds and progress.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $my_droids = DB::table('droid_user')
            ->leftJoin('droids', 'droids.id', '=', 'droid_user.droids_id')
            ->leftJoin('droid_details', function($join)
            {
                $join->on('droid_details.droids_id', '=', 'droids.id');
                $join->on('droid_details.droid_user_id', '=', 'droid_user.id');
            })
            ->select('droid_user.id', 'droids.class', 'droids.image', 'progress', 'droid_designation', 'droid_details.image as myImage')
            ->where('droid_user.user_id', '=', $user->id)
            ->orderBy('droid_user.created_at', 'DESC')
            ->get();

        // Set the correct image
        foreach ($my_droids as $droid)
        {
            if (isset($droid->myImage))
            {
                $droid->image = $droid->myImage;
            }
        }

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
            $partIds = DB::table("parts")
                ->join("build_progress", "build_progress.part_id", "=", "parts.id")
                ->where('sub_section', $subsection)
                ->where('build_progress.droid_user_id', $id)
                ->pluck('parts.id')
                ->toArray();

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
            $partIds = DB::table("parts")
                ->join("build_progress", "build_progress.part_id", "=", "parts.id")
                ->where('sub_section', $subsection)
                ->where('build_progress.droid_user_id', $id)
                ->pluck('parts.id')
                ->toArray();

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
        // Get all parts for the subsection belonging to this droid
        $partIds = Part::where('sub_section', $subSection)
            ->join("build_progress", "build_progress.part_id", "=", "parts.id")
            ->where('build_progress.droid_user_id', $droidUserId)
            ->pluck('parts.id')->toArray();

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
        $partIds = BuildProgress::where('droid_user_id', $droidUserId)->pluck('id')->toArray();

        // $partIds = Part::where('droids_id', $droidUser->droids_id)->pluck('id')->toArray();

        // Get the parts printed
        $partsPrinted = BuildProgress::where('droid_user_id', $droidUserId)
            ->where('completed', true)
            ->count();

        // Get the parts marked NA
        $partsNA = BuildProgress::where('droid_user_id', $droidUserId)
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

    public function assignCustomDroid(Request $request)
    {
        $dome = $request->dome;
        $body = $request->body;
        $legs = $request->leg;
        $feets = $request->feet;

        dd($dome, $body, $legs, $feets);

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

        //loop through the part list and assign to the build progress.
        foreach ($domeBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $newBuild->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($bodyBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $newBuild->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($legBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $newBuild->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        foreach ($feetBits as $vp)
        {
            $newPart = new BuildProgress(); //new build progress  Model
            $newPart->droid_user_id = $newBuild->id;
            $newPart->part_id = $vp->id;
            $newPart->created_at = now(); //remove date field from parts list??
            $newPart->updated_at = now();
            $newPart->completed = 0;
            $newPart->save();
        }

        //Sends a blank Droid Detail form into the database
        $newDroidDetails = new DroidDetail();
        $newDroidDetails->droid_user_id = $newBuild->id;
        $newDroidDetails->droids_id = $newBuild->droids_id;
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
        // Return a list of all main droid sections
        $droidSections = DB::table("parts")
            ->distinct()
            ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
            ->where("build_progress.droid_user_id", "=", $id)
            ->pluck("parts.droid_section")
            ->toArray();

        $totalParts = 0;
        $totalCompleted = 0;
        $totalNA = 0;

        $sections = [];
        foreach($droidSections as $droidSection)
        {
            $subsectionParts = DB::table('parts')
                ->select('build_progress.id', 'parts.droid_version', 'parts.id as part_id', 'part_name', 'parts.droid_section', 'parts.sub_section', 'file_path', 'build_progress.completed', 'build_progress.NA')
                ->join('build_progress', 'build_progress.part_id', '=', 'parts.id')
                ->where('build_progress.droid_user_id', '=', $id)
                ->where('parts.droid_section', $droidSection)
                ->orderBy('droid_section', 'DESC')
                ->orderBy('sub_section')
                ->get();

            $index = 0;
            $subsections = [];
            foreach($subsectionParts as $part)
            {
                if (!array_key_exists($part->sub_section, $subsections))
                {
                    $subSection = new \stdClass();
                    $subSection->index = "section_" . $index++;
                    $subSection->parts = [];
                    $subSection->partCount = 0; // This will be the number of parts subtracting the NA parts
                    $subSection->title = $part->sub_section;
                    $subsections[$part->sub_section] = $subSection;
                }
                array_push($subsections[$part->sub_section]->parts, $part);
            }

            // Calculate the number of completed parts
            foreach($subsections as $key => $subSection)
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

            array_push($sections, [
                'isExpanded' => false,
                'title' => $droidSection . " - " . $subsectionParts[0]->droid_version,
                'droid_section' => $droidSection,
                'subsections' => $subsections
            ]);
        }

        $droidUser = \App\DroidUser::find($id);
        $droidDetails = DroidDetail::where(['droid_user_id' => $droidUser->id])->first();
        $currentBuild = \App\Droid::find($droidUser->droids_id);

        return view('droids.user.edit', [
            'currentBuild' => $currentBuild,
            'droidDetails' => $droidDetails,
            'sections' => $sections,
            'partsNum' => $totalParts - $totalNA,
            'partsPrinted' => $totalCompleted
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
        DB::transaction(function () use ($request, $id)
        {
            $details = DroidDetail::find($id);

            // Delete the old custom image
            $image = request('image', null);

            if ($image == "" && isset($details->image))
            {
                if (file_exists($details->image))
                {
                    unlink(public_path($details->image));
                }
            }

            // Update the droid details
            $details->fill($request->all());

            // Upload a new custom image
            if ($request->hasFile('imagePicker'))
            {
                // Upload new image
                $ext = \File::extension($request->imagePicker->getClientOriginalName());
                $imageName = (string) Str::uuid() . "." . $ext;

                $request->imagePicker->move(public_path('/img/'), $imageName);

                $file_url = 'public/img/' . $imageName;
                $content = file_get_contents(base_path($file_url));

                $content = $content . "\r\n" . $imageName;
                file_put_contents(base_path($file_url), $content);

                $details->image = "/img/" . $imageName;
            }
            $details->save();
        });

        toastr()->success('Droid details updated');

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
