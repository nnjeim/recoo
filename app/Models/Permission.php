<?php

namespace App\Models;

use App\Models\Traits\Relations\PermissionRelations;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	use PermissionRelations;

	protected $fillable = [
		'model',
		'name',
	];

	public $timestamps = false;
}
