<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Disclosure_list_user extends Model
{
	protected $table = 'disclosure_lists_users';
	protected $fillable = ['list_id', 'user_id'];
}
