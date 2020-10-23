<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Part;
use App\Role;
use App\Droid;
use App\BuildProgress;
use Validator;
use App\DroidUser;
use App\Notifications\NewDroid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class DroidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $order = $request->input('o');
        $direction = $request->input('d');

        if ($order == null)
        {
            $order = 'class';
        }

        if ($direction == null)
        {
            $direction = 'asc';
        }

        if ($search!="")
        {
            $droids = DB::table('droids')->where(function ($query) use ($search){
                $query  ->where('class', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->paginate(15);
            $droids->appends(['q' => $search]);
        } else {
            $droids = DB::table('droids')->orderBy('description', 'DESC')->get();
        }

        return view('droids.index', compact('droids'))
                    ->with('i', (request()->input('page', 1) -1) *15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        if(Gate::denies('add-droids'))
        {
            return redirect(route('home'));
        }

        return view('droids.add');
    }

    public static function validatePartsCSV($filepath)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class' => 'required|string',
            'description' => 'required|string',
            'partslist' => 'required|file',
            'image' => 'required|image'
        ]);

        // Validate CSV
        $path = $request->file('partslist')->getRealPath();
        $delimiter = ",";
        $rowCount = 1;
        $headerRow; // Cache the header
        $headerLength = 0;
        $hasHeader = false;
        if (($handle = fopen($path, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if ($row[0] == "droids_id" || $row[0] == "droid_version")
                {
                    $headerRow = $row;
                    $headerLength = count($row);
                    $rowCount++;
                    $hasHeader = true;
                    continue;
                }

                // Count each row
                if (count($row) != $headerLength && $hasHeader)
                {
                    return redirect()->back()->with('error', "Row {$rowCount} in the CSV file is missing one or more items");
                }

                $index = 0;
                foreach($row as $item)
                {
                    if (trim($item) == "")
                    {
                        // If the blank item is a sub_section then skip this check and deal with it when creating the droid parts
                        if ($headerRow[$index] != "sub_section")
                        {
                            return redirect()->back()->with('error', "Row {$rowCount} of the CSV file has one or more blank items");
                        }
                    }
                    $index++;
                }

                $rowCount++;
            }
        }

        $newDroid = DB::transaction(function () use ($request)
        {
            $newDroid = new Droid();
            $newDroid['class'] = $request->class;
            $newDroid['description'] = $request->description;
            $newDroid->save();

            // Droid Image Upload
            $imageName = $request->image->getClientOriginalName();
            $request->image->move(public_path('/img/'), $imageName);

            $file_url = 'public/img/' . $imageName;
            $content = file_get_contents(base_path($file_url));

            $content = $content . "\r\n" . $imageName;
            file_put_contents(base_path($file_url), $content);
            $newDroid->image = "/img/" . $imageName;
            $newDroid->save();

            // Import the CSV file
            $path = $request->file('partslist')->getRealPath();
            $delimiter = ",";
            $rowCount = 0;
            $hasIdOffset = 0;
            if (($handle = fopen($path, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                {
                    if ($row[0] == "droids_id" || $row[0] == "droid_version")
                    {
                        if ($row[0] == "droids_id")
                        {
                            $hasIdOffset = 1;
                        }
                        continue;
                    }

                    // Subsection cannot be blank
                    $subsection = $row[2 + $hasIdOffset];
                    if (trim($subsection) == "")
                    {
                        $subsection = "Print Files";
                    }

                    $part = new Part([
                        'droids_id' => $newDroid->id,
                        'droid_version' => $row[0 + $hasIdOffset],
                        'droid_section' => $row[1 + $hasIdOffset],
                        'sub_section' => $subsection,
                        'part_name' => $row[3 + $hasIdOffset],
                        'file_path' => $row[4 + $hasIdOffset]
                    ]);
                    $part->save();
                    $rowCount++;
                }
                fclose($handle);
            }

            return $newDroid;
        });
        // $user = User::get();
        // dd($user->email);

        // Mail::to($user->email)->send(new NewDroid());

        $message = "{$newDroid->class} added!";
        return redirect()->back()->with('message', $message);
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
            return redirect(route('admin.users.index'));
        }

        $droid = Droid::find($id);
    
        return view('droids.edit')->with('droid', $droid);
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
            return redirect(route('admin.users.index'));
        }

        DB::transaction(function () use ($request, $id)
        {
            $droid = Droid::find($id);
            $droid->class = request("class"); 
            $droid->description = request("description");
            $droid->save();

            // Droid image
            if ($request->hasFile('image'))
            {
                // // Delete old image
                // try
                // {
                //     unlink(public_path($droid->image));
                // }
                // catch (Exception $e)
                // {
                //     error_log(json_encode($e));
                // }
                
                // Upload new image
                $imageName = $droid->id . "_" . $request->image->getClientOriginalName();
                $request->image->move(public_path('/img/'), $imageName); //copy to public folder with new name

                $file_url = 'public/img/' . $imageName;
                $content = file_get_contents(base_path($file_url)); //open all file

                $content = $content . "\r\n" . $imageName; //add new image name
                file_put_contents(base_path($file_url), $content); //save all back to file (overwrites!)

                $droid->image = "/img/" . $imageName;
                $droid->save();
            }

            // Delete all the parts so we can redo them
            // Part::where("droids_id", $id)->delete();

            // Header: droid_version,droid_section,sub_section,part_name,file_path
            if ($request->hasFile('partslist'))
            {
                // Validate CSV
                $path = $request->file('partslist')->getRealPath();
                $delimiter = ",";
                $rowCount = 1;
                $headerRow; // Cache the header
                $headerLength = 0;
                $hasHeader = false;
                if (($handle = fopen($path, 'r')) !== FALSE)
                {
                    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                    {
                        if ($row[0] == "droids_id" || $row[0] == "droid_version")
                        {
                            $headerRow = $row;
                            $headerLength = count($row);
                            $rowCount++;
                            $hasHeader = true;
                            continue;
                        }

                        // Count each row
                        if (count($row) != $headerLength && $hasHeader)
                        {
                            return redirect()->back()->with('error', "Row {$rowCount} in the CSV file is missing one or more items");
                        }

                        $index = 0;
                        foreach($row as $item)
                        {
                            if (trim($item) == "")
                            {
                                // If the blank item is a sub_section then skip this check and deal with it when creating the droid parts
                                if ($headerRow[$index] != "sub_section")
                                {
                                    return redirect()->back()->with('error', "Row {$rowCount} of the CSV file has one or more blank items");
                                }
                            }
                            $index++;
                        }

                        $rowCount++;
                    }
                }

                // Work here
                $path = $request->file('partslist')->getRealPath();

                $delimiter = ",";
                if (($handle = fopen($path, 'r')) !== FALSE)
                {
                    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                    {
                        if ($row[0] == "droids_id" || $row[0] == "droid_version")
                        {
                            continue;
                        }

                        // Check if the part name exists
                        if (Part::where('part_name', '=', $row[3])->where('droids_id', '=', $id)->count() == 0)
                        {
                            // Subsection cannot be blank
                            if (trim($row[2]) == "")
                            {
                                $row[2] = "Print Files";
                            }

                            // Add the new part
                            $part = new Part();
                            $part->droids_id = $id;
                            $part->droid_version = $row[0];
                            $part->droid_section = $row[1];
                            $part->sub_section = $row[2];
                            $part->part_name = $row[3];
                            $part->file_path = $row[4];
                            $part->save();

                            // Add the part to all build progresses for this droid
                            $droidUsers = DroidUser::where('droids_id', '=', $id)->get();
                            foreach ($droidUsers as $droidUser)
                            {
                                $newPart = new BuildProgress();
                                $newPart->droid_user_id = $droidUser->id;
                                $newPart->part_id = $part->id;
                                $newPart->completed = 0;
                                $newPart->na = 0;
                                $newPart->save();
                            }
                        }
                    }
                }
            }
        });

        toastr()->success("Droid Updated");

        return back();
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

    public function search()
    {
        return view('droids.search');
        // if($request->ajax()) {

        //     $data = Droid::where('name', 'LIKE', $request->droid.'%')
        //         ->get();

        //     $output = '';

        //     if (count($data)>0) {

        //         $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

        //         foreach ($data as $row){

        //             $output .= '<li class="list-group-item">'.$row->name.'</li>';
        //         }

        //         $output .= '</ul>';
        //     }
        //     else {

        //         $output .= '<li class="list-group-item">'.'No results'.'</li>';
        //     }

        //     return $output;
        // }
    }

    public function autocomplete(Request $request)
    {
        $query = $request->query('query');
        $data = Droid::where("class", "LIKE", "%{$query}%")->pluck('class')->toArray();
        return response()->json($data);
    }
}
