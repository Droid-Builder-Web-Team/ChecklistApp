<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $guarded = [];

    protected $table = 'parts';

    protected $fillable = [
        'id',
        'droids.id',
        'droid_user.id',
        'droidVersion',
        'droidSection',
        'subSection',
        'partName',
    ];

}
