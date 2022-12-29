<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOption extends Model
{
	protected $fillable = [
		'user_id',
		'params',
	];

	protected $casts = [
		'params' => 'array',
	];

	protected $hidden = ['created_at', 'updated_at'];
}
