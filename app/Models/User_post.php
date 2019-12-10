<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_post extends Model
{
    protected $table = 'users_posts';
	protected $fillable = ['post_user_id', 'content_text', 'parent_post_id', 'is_deleted', 'longitude', 'latitude'];
}
