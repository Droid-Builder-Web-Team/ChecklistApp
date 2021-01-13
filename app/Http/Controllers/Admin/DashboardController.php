<?php

namespace App\Http\Controllers\Admin;

use DB;
use PDO;
use Gate;
use App\User;
use App\Droid;
use App\DroidUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\PsrHttpMessage\Tests\Fixtures\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        // if (Gate::denies('edit-users'))
        // {
        //     return redirect(route('home'));
        // }

        if (Gate::allows('is-designer'))
            {
        //Datatables
        $users = User::latest()->get();
        $droids = Droid::latest()->get();

        //Stat Counts
        //$userAccounts = User::all();
        //$droidCount = Droid::all();
        $droidUserCount = DroidUser::count();
        $topFiveDroids = DroidUser::query()
        ->select(DB::raw('count(1) as OccurenceValue, droids_id'))
        ->with('droids')
        ->groupBy('droids_id')
        ->orderBy('OccurenceValue', 'DESC')
        ->limit(5)
        ->get();

        $totalUsers = count($users);
        $totalDroids = count($droids);
        // dd($topFiverUsers);
        return view('designer.dashboard', [
            'users' => $users,
            'droids' => $droids,
            'totalUsers' => $totalUsers,
            'totalDroids' => $totalDroids,
            'topFiveDroids' => $topFiveDroids,
            'totalDroidUsers' => $droidUserCount,
        ]);
    }        
        elseif (Gate::allows('is-admin'))
        {


            return view('admin.dashboard');
    }}

    public function upload()
    {
        return view('/designer/uploadImage');
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

        return redirect()->back()
            ->with('success', 'Image successfully transmitted.')
            ->with('file', $file->getClientOriginalName());

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
