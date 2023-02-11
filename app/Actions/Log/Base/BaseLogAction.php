<?php

namespace App\Actions\Log\Base;

use App\Actions\BaseAction;
use App\Models\Log;

abstract class BaseLogAction extends BaseAction
{
	protected string $class = Log::class;

	protected string $attribute = 'log';

	abstract public function execute(array $args = []);
}
