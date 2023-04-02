<?php

namespace App\Models;

use App\Models\Traits\Relations\TenantRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
	use SoftDeletes;
	use TenantRelations;

	protected $fillable = [
		'name',
		'params',
		'status',
		'token',
	];

	protected $casts = [
		'params' => 'array',
		'deleted_at' => 'datetime',
	];
}
