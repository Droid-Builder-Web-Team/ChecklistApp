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
}
