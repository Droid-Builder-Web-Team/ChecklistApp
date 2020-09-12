<?php

namespace App\Http\Controllers;

use App\Part;
use App\BuildProgress;
use DB;
use Illuminate\Http\Request;

class BuildProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $completedCount = BuildProgress::getCompletedCount($id);
        $naCount = BuildProgress::getNACount($id);
        $total = BuildProgress::where('droid_user_id', $id)->count();

        $partCount = $total - $naCount;

        return response()->json([
            'completedCount' => $completedCount,
            'na' => $naCount,
            'partCount' => $partCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            "completed" => "required|boolean",
            "na" => "required|boolean",
        ]);

        DB::transaction(function () use ($request, $id)
        {
            $progress = BuildProgress::where('id', $id)->update([
                "completed" => $request->input("completed"),
                "NA" => $request->input("na"),
            ]);
        });

        $progress = BuildProgress::find($id);
        $part = Part::find($progress->part_id);
        $completedParts = BuildProgress::getSectionCompletedCount($part->sub_section, $progress->droid_user_id);
        $naParts = BuildProgress::getSectionNACount($part->sub_section, $progress->droid_user_id);
        $partCount = Part::where('sub_section', $part->sub_section)
            ->where('droids_id', $part->droids_id)
            ->count();

        $partCount = $partCount - $naParts;

        return response()->json([
            'completedCount' => $completedParts,
            'na' => $naParts,
            'partCount' => $partCount
        ]);
    }

    public function completeAll(Request $request, $id, $section)
    {
        $request->validate([
            "completed" => "required|boolean",
            "ids" => "required"
        ]);

        DB::transaction(function () use ($request, $id) {
            BuildProgress::where('droid_user_id', $id)
                ->update(["completed" => $request->input("completed")]);
        });

        // $progress = BuildProgress::find($id);
        // $part = Part::find($progress->part_id);
        // $completedParts = BuildProgress::getSectionCompletedCount($part->sub_section, $progress->droid_user_id);
        // $naParts = BuildProgress::getSectionNACount($part->sub_section, $progress->droid_user_id);
        // $partCount = Part::where('sub_section', $part->sub_section)
        //     ->where('droids_id', $part->droids_id)
        //     ->count();

        // $partCount = $partCount - $naParts;

        // return response()->json([
        //     'completedCount' => $completedParts,
        //     'na' => $naParts,
        //     'partCount' => $partCount
        // ]);
    }

    public function naAll(Request $request, $id, $section)
    {
        $request->validate([
            "na" => "required|boolean",
            "ids" => "required"
        ]);

        DB::transaction(function () use ($request, $id) {
            BuildProgress::where('droid_user_id', $id)
                ->update(["NA" => $request->input("na")]);
        });

        // $progress = BuildProgress::find($id);
        // $part = Part::find($progress->part_id);
        // $completedParts = BuildProgress::getSectionCompletedCount($part->sub_section, $progress->droid_user_id);
        // $naParts = BuildProgress::getSectionNACount($part->sub_section, $progress->droid_user_id);
        // $partCount = Part::where('sub_section', $part->sub_section)
        //     ->where('droids_id', $part->droids_id)
        //     ->count();

        // $partCount = $partCount - $naParts;

        // return response()->json([
        //     'completedCount' => $completedParts,
        //     'na' => $naParts,
        //     'partCount' => $partCount
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
