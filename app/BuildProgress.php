<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildProgress extends Model
{
    protected $guarded = [];

    protected $table = 'build_progress';

    protected $fillable = [
        'droid_user_id',
        'part_id',
        'created_at',
        'updated_at',
        'completed',
    ];

    public static function getSectionCompletedCount($subSection, $droidUserId)
    {
        $partIds = Part::where('sub_section', $subSection)->pluck('id')->toArray();
        $partCount = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('completed', true)
            ->count();
        return $partCount;
    }

    public static function getSectionNACount($subSection, $droidUserId)
    {
        $partIds = Part::where('sub_section', $subSection)->pluck('id')->toArray();
        $partCount = BuildProgress::where('droid_user_id', $droidUserId)
            ->whereIn('part_id', $partIds)
            ->where('NA', true)
            ->count();
        return $partCount;
    }
}
