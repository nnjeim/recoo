<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
	protected $fillable = [
		'params',
	];

	protected $casts = [
		'params' => 'array',
	];
}
