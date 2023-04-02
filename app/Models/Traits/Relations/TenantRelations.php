<?php

namespace App\Models\Traits\Relations;

use App\Models\Log;
use App\Models\ModuleOption;
use App\Models\ModuleSetting;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TenantRelations
{
	public static function bootTenantRelations()
	{
		static::deleting(function ($tenant) {
			if ($tenant->forceDeleting) {
				// delete module options
				$tenant->moduleOptions()->delete();
				// delete module settings
				$tenant->moduleSettings()->delete();
				// roles & permissions
				$tenant
					->roles
					->each(fn(Role $role) =>
						$role
							->permissions()
							->wherePivot('tenant_id', $tenant->id)
							->detach()
					);
				$tenant->roles()->detach();
				// logs
				$tenant->logs()->delete();
			}
		});
	}

	/**
	 * @return HasMany
	 */
	public function moduleOptions(): HasMany
	{
		return $this->hasMany(ModuleOption::class);
	}

	/**
	 * @return HasMany
	 */
	public function moduleSettings(): HasMany
	{
		return $this->hasMany(ModuleSetting::class);
	}

	/**
	 * @return BelongsToMany
	 */
	public function roles(): BelongsToMany
	{
		return $this->belongsToMany(Role::class, 'role_tenant')->withPivot('tenant_id')->withTimestamps();
	}

	/**
	 * @return MorphMany
	 */
	public function logs(): MorphMany
	{
		return $this->morphMany(Log::class, 'logable');
	}
}
