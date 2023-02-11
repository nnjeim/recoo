<?php

namespace App\Actions\Permission\Base;

use App\Actions\BaseAction;
use App\Models\Permission;

abstract class BasePermissionAction extends BaseAction
{
	protected string $attribute = 'permission';

	protected string $class = Permission::class;

	public string $cacheTag = 'permissions';
}
