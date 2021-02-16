<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = [
        'droid_id',
        'instruction_label',
        'instruction_url'
    ];

    public function droid()
    {
        return $this->belongsToMany(Droid::class);
    }
}