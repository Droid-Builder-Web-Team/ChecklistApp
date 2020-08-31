<?php

// +------------+---------------------+------+-----+---------------+----------------+
// | Field      | Type                | Null | Key | Default       | Extra          |
// +------------+---------------------+------+-----+---------------+----------------+
// | id         | bigint(20) unsigned | NO   | PRI | NULL          | auto_increment |
// | user_id    | bigint(20) unsigned | NO   | MUL | NULL          |                |
// | bio        | varchar(255)        | YES  |     | NULL          |                |
// | location   | varchar(255)        | YES  |     | NULL          |                |
// | homepage   | varchar(255)        | YES  |     | NULL          |                |
// | facebook   | varchar(255)        | YES  |     | NULL          |                |
// | github     | varchar(255)        | YES  |     | NULL          |                |
// | instagram  | varchar(255)        | YES  |     | NULL          |                |
// | avatar     | varchar(255)        | NO   |     | no-avatar.jpg |                |
// | created_at | timestamp           | YES  |     | NULL          |                |
// | updated_at | timestamp           | YES  |     | NULL          |                |
// +------------+---------------------+------+-----+---------------+----------------+

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ["user_id", "bio", "location", "homepage", "facebook", "github", "instagram", "avatar"];
}
