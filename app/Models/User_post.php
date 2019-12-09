<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    protected $table = 'disclosure_lists';
	protected $fillable = ['name', 'owner_user_id', 'is_published', 'is_hidden'];
}
