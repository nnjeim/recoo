<?php

namespace App\Models;

use App\Models\Traits\HasPermissions;
use App\Models\Traits\Relations\RoleRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use HasPermissions;
	use RoleRelations;
	use SoftDeletes;

	protected $fillable = [
		'name',
		'locked',
	];

	protected $dates = ['deleted_at'];

	protected $casts = [
		'locked' => 'bool',
	];

	protected $appends = ['deleted'];

	/*-- Accessors ---------------------------------------------------------------------------------------------------*/
	public function getDeletedAttribute(): bool
	{
		return $this->deleted_at !== null;
	}

	/*-- Mutators ----------------------------------------------------------------------------------------------------*/
	public function setNameAttribute($value)
	{
		$this->attributes['name'] = strtolower(str_replace(' ', '_', $value));
	}
}
