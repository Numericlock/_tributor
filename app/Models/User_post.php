<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_post extends Model
{
    protected $table = 'User_post';
	protected $fillable = ['name', 'owner_user_id', 'is_published', 'is_hidden'];
}
