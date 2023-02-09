<?php

namespace App\Actions\Permission\Base;

use App\Actions\BaseAction;
use App\Models\Permission;

abstract class BasePermissionAction extends BaseAction
{
	protected string $class = Permission::class;

	protected string $cacheTag = 'permissions';

	protected string $attribute = 'permission';
}
