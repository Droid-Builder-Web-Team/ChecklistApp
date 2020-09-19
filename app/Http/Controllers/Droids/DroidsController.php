<?php

namespace App\Http\Controllers\Droids;

use Gate;
use App\User;
use App\Part;
use App\Role;
use App\Droid;
use App\DroidUser;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // $droids = DB::table('droids')
        // ->select( 'id', 'class', 'description', 'image')
        // ->orderBy('description', 'DESC')
        // ->get();

        // return view('droids.index', [
        //    'droids' => $droids,
        // ]);

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
        //New Droid
        $newDroid = new Droid();
        $newDroid['class'] = $request->class;
        $newDroid['description'] = $request->description;
        $newDroid->save();

        // Droid Image Upload
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('img', $filename, 'public');
            auth()->user()->update(['image' => '/img/' . $filename]);
        }

        // CSV Upload
        $validator = Validator::make($request->all(), [
            'partslist' => 'required|mimes:csv,txt'
        ]);

        if($validator->passes())
        {
            $dataTime = date('Ymd_His');
            $file = $request->file('partslist');
            $fileName = $dataTime . '-' . $file->getClientOriginalName();
            $savePath = public_path('/csvs/');
            $file->move($savePath, $fileName);
            return redirect()->back()
                ->with(['success'=>'Filed Uploaded Successfully.']);

        }else {
            return redirect()->back()
                ->with(['errors'=>$validator->errors()->all()]);
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
        // echo "test";
        $data = Droid::where('LOWER',"class", "LIKE", "%{$request->query}%")
                        ->get();
        return response()->json($data);
    }
}
