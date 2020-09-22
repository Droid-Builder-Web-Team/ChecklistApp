<?php

// +-------------+---------------------+------+-----+---------+----------------+
// | Field       | Type                | Null | Key | Default | Extra          |
// +-------------+---------------------+------+-----+---------+----------------+
// | id          | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
// | class       | varchar(191)        | NO   |     | NULL    |                |
// | description | varchar(191)        | NO   |     | NULL    |                |
// | image       | varchar(191)        | YES  |     | NULL    |                |
// | created_at  | timestamp           | YES  |     | NULL    |                |
// | updated_at  | timestamp           | YES  |     | NULL    |                |
// +-------------+---------------------+------+-----+---------+----------------+

namespace App;

use DB;
use App\Part;
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

    public function droidUser()
    {
        return $this->hasMany(DroidUser::class);
    }

    public function getPartCount()
    {
        return \App\Part::where('droids_id', $this->id)->count();
    }

}
