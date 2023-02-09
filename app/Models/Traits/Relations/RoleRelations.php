<?php

namespace App\Models\Traits\Relations;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait RoleRelations
{
	public static function bootRoleRelations()
	{
		static::deleting(function ($role) {
			if ($role->forceDeleting) {
				self::reassignRoles($role);
				// detach role permissions
				$role->permissions()->detach();
				// delete logs
				$role->logs()->delete();
			}
		});
	}

	/**
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'role_user')->withTimestamps();
	}

	/**
	 * @return MorphMany
	 */
	public function logs(): MorphMany
	{
		return $this->morphMany(Log::class, 'logable');
	}

	/**
	 * @return BelongsToMany
	 */
	public function permissions(): BelongsToMany
	{
		return $this->belongsToMany(Permission::class, 'permission_role')->withTimestamps();
	}

	/**
	 * Method to detach the deleted role from the users and add the defaultRole to the roles set.
	 * @param  Role  $role
	 * @return void
	 */
	private static function reassignRoles(Role $role): void
	{
		$users = $role
			->users()
			->get();

		foreach ($users as $user) {
			$currentRoleIds = $user
				->roles()
				->pluck('id')
				->toArray();

			$roleIndex = array_search($role->id, $currentRoleIds);

			if ($roleIndex) {
				unset($currentRoleIds[$roleIndex]);
			}

			$user->syncRoles($currentRoleIds + [$user->defaultRoleId()], $tenant_id);
		}
	}
}
