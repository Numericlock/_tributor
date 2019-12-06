<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id', 'name', 'password', 'e_mail', 'birth_on'];
	//protected $guarded = ['id', 'password', 'created_at']
}
