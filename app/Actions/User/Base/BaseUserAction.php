<?php

namespace App\Actions\User\Base;

use App\Actions\BaseAction;
use App\Models\User;

abstract class BaseUserAction extends BaseAction
{
	protected string $attribute = 'user';

	protected string $class = User::class;

	public string $cacheTag = 'users';

	abstract public function execute(array $args = []);
}
