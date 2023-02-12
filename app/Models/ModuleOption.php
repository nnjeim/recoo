<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleOption extends Model
{
	protected $fillable = [
		'optionable_type',
		'params',
		'tenant_id',
	];

	protected $casts = [
		'params' => 'array',
	];

	protected $hidden = ['optionable_type', 'created_at', 'updated_at'];
}
