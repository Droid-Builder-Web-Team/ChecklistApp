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
        return Datatables::of($users)->addIndexColumn()->addColumn('action', function ($row)
        {
            // Create the edit and delete buttons
            return UserApiController::createEditButton($row->id) . UserApiController::createDeleteButton($row->id);
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public static function createEditButton($userId)
    {
        $href = route('admin.users.edit', $userId);
        return "<a href={$href} class='edit btn btn-success btn-sm mr-1'>Edit</a>";
    }

    private static function createDeleteButton($userId)
    {
        return "<a href='javascript:void(0)' class='edit btn btn-danger btn-sm'>Delete</a>";
    }
}
