<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use DataTables;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
    public function getUsersTable()
    {
        $users = User::latest()->get();
        return Datatables::of($users)->editColumn('last_activity', function ($users) {
            if($users->last_activity == NULL) {
                return "N/A";
            } else {
                return $users->last_activity ? with(new Carbon($users->last_activity))->format('d/m/Y') : '';
            }
        })
        ->addIndexColumn()
        ->addColumn('action', function ($row)
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
        return '<button class="btn btn-danger btn-delete btn-sm" data-userid="' . $userId . '">Delete</button>';
    }
}
