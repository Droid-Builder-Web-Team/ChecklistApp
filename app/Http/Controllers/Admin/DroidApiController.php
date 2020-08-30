<?php

namespace App\Http\Controllers\Admin;

Use Gate;
use App\User;
use App\Droid;
use DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DroidApiController extends Controller
{
    public function getDroidsTable()
    {
        $droids = Droid::latest()->get();

        foreach ($droids as $droid)
        {
            $droid->parts = $droid->getPartCount();
        }

        return Datatables::of($droids)
            ->addIndexColumn()
            ->addColumn('action', function($row)
            {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)class="edit btn btn-success btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
