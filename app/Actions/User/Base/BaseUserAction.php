<?php

namespace App\Actions\User\Base;

use App\Actions\BaseAction;
use App\Models\User;

abstract class BaseUserAction extends BaseAction
{
	protected string $class = User::class;

	protected string $cacheTag = 'users';

	protected string $attribute = 'user';

	abstract public function execute(array $args = []);
}
