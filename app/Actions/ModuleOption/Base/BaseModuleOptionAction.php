<?php

namespace App\Actions\ModuleOption\Base;

use App\Actions\BaseAction;
use App\Models\ModuleOption;

abstract class BaseModuleOptionAction extends BaseAction
{
	protected string $attribute = 'option';

	protected string $class = ModuleOption::class;

	public string $cacheTag = 'module_options';

	abstract public function execute(array $args = []);
}
