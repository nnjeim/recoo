<?php

namespace App\Models\Traits\Relations;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait PermissionRelations
{
	/**
	 * @return BelongsToMany
	 */
	public function roles(): BelongsToMany
	{
		return $this->belongsToMany(Role::class)->withTimestamps();
	}

	/**
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}

	/**
	 * @return MorphMany
	 */
	public function logs(): MorphMany
	{
		return $this->morphMany(Log::class, 'logable');
	}
}
