<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class GenerateRolePermissionsCommand extends Command
{
	protected $signature = 'permissions:roles';

	protected $description = 'Generate role permissions';

	public function handle()
	{
		$this->getOutput()->block('Generating role permissions');

		$basePermissions = config('permissions.roles');

		$this->getOutput()->progressStart(count(array_keys($basePermissions)));

		foreach ($basePermissions as $roleName => $permissions) {
			$role = Role::where('name', $roleName)->first();

			foreach ($permissions as $permissionName) {
				$permission = Permission::where('name', $permissionName)->first();

				if (! $permission?->roles()->get()->contains($role->id)) {
					$permission?->roles()->attach($role->id);
				}
			}

			$this->getOutput()->progressAdvance();
		}

		$this->getOutput()->progressFinish();

		$this->getOutput()->block('The end!');
	}
}
