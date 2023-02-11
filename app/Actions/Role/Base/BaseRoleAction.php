<?php

namespace App\Actions\Role\Base;

use App\Actions\BaseAction;
use App\Models\Role;

abstract class BaseRoleAction extends BaseAction
{
	protected string $attribute = 'role';

	protected string $class = Role::class;

	public string $cacheTag = 'roles';

	abstract public function execute(array $args = []);
}
