<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DroidUser extends Model
{
    protected $guarded = [];

    protected $table = 'droid_user';

    protected $fillable = [
        'id',
        'droids_id',
        'user_id',
    ];

    public function droids()
    {
        return $this->belongsTo(Droid::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
