<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Part;
use App\Role;
use App\Droid;
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
    public function __construct()
    {
        //
    }

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

        if($order == null)
        {
            $order = 'class';
        }
        if($direction == null)
        {
            $direction = 'asc';
        }
        if($search!="")
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
        $headerRead = false;
        $headerLength = 0;
        if (($handle = fopen($path, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if (!$headerRead)
                {
                    $headerLength = count($row);
                    $headerRead = true;
                    $rowCount++;
                    continue;
                }

                // Count each row
                if (count($row) != $headerLength)
                {
                    return redirect()->back()->with('error', "Row {$rowCount} in the CSV file is missing one or more items");
                }

                foreach($row as $item)
                {
                    if (trim($item) == "")
                    {
                        return redirect()->back()->with('error', "Row {$rowCount} of the CSV file has one or more blank items");
                    }
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
            $filename = $newDroid->id . "_" . $request->image->getClientOriginalName();
            $request->image->storeAs('img', $filename, 'public');
            $newDroid->image = "/img/" . $filename;
            $newDroid->save();

            // Import the CSV file
            $path = $request->file('partslist')->getRealPath();
            $delimiter = ",";
            $rowCount = 0;
            if (($handle = fopen($path, 'r')) !== FALSE)
            {
                $headerRead = false;
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                {
                    if (!$headerRead)
                    {
                        $headerRead = true;
                        continue;
                    }

                    $part = new Part([
                        'droids_id' => $newDroid->id,
                        'droid_version' => $row[0],
                        'droid_section' => $row[1],
                        'sub_section' => $row[2],
                        'part_name' => $row[3],
                        'file_path' => $row[4]
                    ]);
                    $part->save();
                    $rowCount++;
                }
                fclose($handle);
            }

            return $newDroid;
        });
        $user = User::get();
        dd($user->email);

        Mail::to($user->email)->send(new NewDroid());

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
        $droids = Droid::where('droids.id', '=', $id)->get();
        return view('droids.edit', [
            'droids' => $droids,
        ]);
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
        $updateDroid = Droid::where('droids.id', '=', '$id')
            ->update([
                'class' => $request->input('class'),
                'description' => $request->input('description'),

            ]);
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
