<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomOption extends Model
{
    protected $guarded = [];

    protected $table = 'custom_option_list';

    protected $fillable = [
        'class',
        'version',
        'section',
        'image',
    ];
}
