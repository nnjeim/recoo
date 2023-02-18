<?php

namespace App\Actions\UserOption\Base;

use App\Actions\BaseAction;
use App\Models\User;

class BaseUserOptionAction extends BaseAction
{
	protected string $attribute = 'user';

	protected string $class = User::class;

	public string $cacheTag = 'users';
}
