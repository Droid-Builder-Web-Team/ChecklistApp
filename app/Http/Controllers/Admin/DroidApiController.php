<?php

namespace App\Http\Controllers\Admin;

use App\Droid;
use App\Http\Controllers\Controller;
use DataTables;

class DroidApiController extends Controller
{
    public function getDroidsTable()
    {
        $droids = Droid::latest()->get();

        foreach ($droids as $droid)
        {
            $droid->parts = $droid->getPartCount();
        }

        return Datatables::of($droids)->addIndexColumn()->addColumn('action', function ($row)
        {
            return DroidApiController::createEditButton($row->id) . DroidApiController::createDeleteButton($row->id);
        })
            ->rawColumns(['action'])
            ->make(true);
    }

    public static function createEditButton($droidId)
    {
        $href = route('droids.index.edit', $droidId);
        return "<a href={$href} class='edit btn btn-success btn-sm mr-1'>Edit</a>";
    }

    private static function createDeleteButton($droidId)
    {
        return '<button class="btn btn-danger btn-delete btn-sm" data-droidid="' . $droidId . '">Delete</button>';
    }
}
