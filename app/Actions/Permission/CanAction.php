<?php

namespace App\Actions\Permission;

use App\Actions\Permission\Base\BasePermissionAction;
use App\Exceptions\AuthorizationException;
use App\Http\Response\ResponseBuilder;
use App\Models\Permission;
use App\Models\User;

class CanAction extends BasePermissionAction
{
	/**
	 * @param  string  $name
	 * @return $this
	 * @throws AuthorizationException
	 */
	public function execute(string $name): self
	{
		$this->success = true;
		$this->data = $this->formData($name);

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setAttributeMessage($this->attribute)
			->setData($this->data);
	}

	/**
	 * @return bool
	 * @throws AuthorizationException
	 */
	private function formData(string $name): bool
	{
		$user = request()->user();

		if ($user->isSuper()) {
			return true;
		}

		if (! $this->isCacheEnabled()) {
			return $this->computeUserPermission($user, $name);
		}
		// cache
		$this->setCacheTag($this->cacheTag)->formCacheKey('user', $user->id, $name);

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->computeUserPermission($user, $name));
	}

	/**
	 * @param  User  $user
	 * @param  string  $name
	 * @return bool
	 * @throws AuthorizationException
	 */
	private function computeUserPermission(User $user, string $name): bool
	{
		$permission_id = $this->validatePermission($name);
		// Validate role permissions.
		if ($this->validateRolePermissions($user, $permission_id)) {
			return true;
		}
		// Validate the user permissions.
		if ($this->validateUserPermissions($user, $permission_id)) {
			return true;
		}

		return false;
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
			throw new AuthorizationException(trans('core::response.exceptions.not_authorized'));
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
