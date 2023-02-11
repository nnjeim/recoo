<?php

namespace App\Actions\Profile\Base;

use App\Actions\BaseAction;
use App\Models\User;

class BaseProfileAction extends BaseAction
{
	protected string $attribute = 'user';

	protected string $class = User::class;

	public string $cacheTag = 'users';
}
