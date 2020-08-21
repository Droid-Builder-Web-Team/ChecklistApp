<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $guarded = [];

    protected $table = 'role_user';

    protected $fillable = [
        'role_id',
        'user_id',
    ];
}
