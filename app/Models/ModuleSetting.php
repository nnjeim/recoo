<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSetting extends Model
{
	protected $fillable = [
		'settable_type',
		'params',
		'tenant_id',
	];

	protected $casts = [
		'params' => 'array',
	];

	protected $hidden = ['settable_type', 'created_at', 'updated_at'];
}
