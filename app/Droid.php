<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Notifications\Notifiable;

class Droid extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $table = 'droids';

    protected $fillable = [
        'class',
        'description',
        'image',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function getImageAttribute()
    {
        return $this->path;
    }
}
