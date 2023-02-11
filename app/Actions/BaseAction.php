<?php

namespace App\Actions;

use App\Actions\Traits\ActionExceptionsTrait;
use App\Actions\Traits\ActionHelpersTrait;
use App\Actions\Traits\ActionModelTrait;
use App\Services\Cache\PersistTrait;

abstract class BaseAction
{
	use ActionExceptionsTrait;
	use ActionHelpersTrait;
	use ActionModelTrait;
	use PersistTrait;

	public bool $success = false;

	public string $message = '';

	public array $errors = [];

	public mixed $data;
}
