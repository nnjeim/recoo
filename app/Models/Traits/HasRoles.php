<?php

namespace App\Models\Traits;

use App\Models\Role;
use Illuminate\Support\Arr;

trait HasRoles
{
	/**
	 * @return string
	 */
	public function defaultRoleName(): string
	{
		$roleSettings = Arr::get(config('moduleSettings'), Role::class);

		['name' => $name] = Arr::first($roleSettings['roles'], fn ($role) => $role['default']);

		return $name;
	}

	/**
	 * @return int
	 */
	public function defaultRoleId(): int
	{
		return Role::whereName($this->defaultRoleName())->value('id');
	}

	/**
	 * @param  string  $name
	 * @return int
	 */
	public function getRoleId(string $name): int
	{
		$role = Arr::first(Role::all(), fn ($role) => $role['name'] === $name);

		return $role->id;
	}

	/**
	 * @param string $roleName
	 * @return bool
	 */
	public function hasRole(string $roleName): bool
	{
		$rolesArray = $this
			->roles()
			->get()
			->toArray();

		return in_array($roleName, array_map('strtolower', array_column($rolesArray, 'name')));
	}

	/**
	 * @param array $roleNames
	 * @return bool
	 */
	public function hasRoles(array $roleNames): bool
	{
		$response = false;

		foreach ($roleNames as $roleName) {
			if ($this->hasRole($roleName)) {
				$response = true;

				break;
			}
		}

		return $response;
	}

	/**
	 * @return bool
	 */
	public function isSuperUser(): bool
	{
		return (int) $this->id === 1;
	}

	/**
	 * @return bool
	 */
	public function isSuperAdmin(): bool
	{
		return $this->hasRole('superadmin');
	}

	/**
	 * @return bool
	 */
	public function isSuper(): bool
	{
		return $this->isSuperUser() || $this->isSuperAdmin();
	}

	/**
	 * @return bool
	 */
	public function isAdmin(): bool
	{
		return $this->hasRoles(['superadmin', 'admin']);
	}

	/**
	 * @param array $roles
	 */
	public function syncRoles(array $roles): void
	{
		$this
			->roles()
			->sync(array_column($roles, 'id'));
	}
}
