<?php

namespace App\Actions\Role\Base;

use App\Actions\BaseAction;
use App\Models\Role;

abstract class BaseRoleAction extends BaseAction
{
	protected string $class = Role::class;

	protected string $cacheTag = 'roles';

	protected string $attribute = 'role';

	abstract public function execute(array $args = []);
}
