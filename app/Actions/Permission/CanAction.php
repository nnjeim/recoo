<?php

namespace App\Actions\Permission;

use App\Actions\Permission\Base\BasePermissionAction;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class CanAction extends BasePermissionAction
{
	/**
	 * @param  string  $name
	 * @return bool
	 * @throws AuthorizationException
	 */
	public function execute(string $name): bool
	{
		$request = app('request');

		$user = $request->user();

		if ($user->isSuper()) {
			return true;
		}

		$permission_id = $this->validatePermission($name);

		$respond = fn ($bool) => $bool;
		// Validate role permissions.
		if ($this->validateRolePermissions($user, $permission_id)) {
			return $respond(true);
		}
		// Validate the user permissions.
		if ($this->validateUserPermissions($user, $permission_id)) {
			return $respond(true);
		}

		return $respond(false);
	}

	/**
	 * @param  string  $name
	 * @return int
	 * @throws AuthorizationException
	 */
	private function validatePermission(string $name): int
	{
		$permissionBuilder = Permission::where('name', '=', $name);

		if (! $permissionBuilder->exists()) {
			AuthorizationException::throw(trans('core::response.exceptions.not_authorized'));
		}

		return $permissionBuilder->value('id');
	}

	/**
	 * Method to validate if any of the user roles have the permission.
	 * @param  User  $user
	 * @param  int  $permission_id
	 * @return bool
	 */
	private function validateRolePermissions(User $user, int $permission_id): bool
	{
		$return = false;

		$roles = $user->roles()->get();

		foreach ($roles as $role) {
			$exists = $role
				->permissions()
				->wherePivot('permission_id', $permission_id)
				->exists();

			if ($exists) {
				$return = true;
				break;
			}
		}

		return $return;
	}

	/**
	 * Method to validate the user permission.
	 * @param  User  $user
	 * @param  int  $permission_id
	 * @return null
	 */
	private function validateUserPermissions(User $user, int $permission_id)
	{
		return $user->permissions?->contains($permission_id);
	}
}
