<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DroidDetail extends Model
{
    protected $guarded = [];

    protected $table = 'droid_details';

    protected $fillable = [
        'droid_user_id',
        'droids_id',
        'droid_designation',
        'builder_name',
        'description',
        'colors',
        'mobility',
        'electronics',
        'control_system',
        'drive_system',
        'power',
        'image',
        'notes'
    ];

}
