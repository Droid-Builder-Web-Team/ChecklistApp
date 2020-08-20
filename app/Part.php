<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $guarded = [];

    protected $table = 'parts';

    protected $fillable = [
        'id',
        'droids_id',
        'droid_version',
        'droid_section',
        'sub_section',
        'part_name',
        'file_path',
    ];

}
