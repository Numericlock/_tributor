<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSharePost extends Model
{
    protected $fillable = ['repost_user_id', 'origin_post_id', 'is_deleted'];
}
