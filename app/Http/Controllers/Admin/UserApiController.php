<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DataTables;

class UserApiController extends Controller
{
    public function getUsersTable()
    {
        $users = User::latest()->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row)
        {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)class="edit btn btn-success btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
