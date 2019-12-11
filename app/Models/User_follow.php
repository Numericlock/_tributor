<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_follow extends Model
{
        protected $table = 'users_follows';
	protected $fillable = ['subject_user_id', 'followed_user_id', 'is_canceled'];
}
