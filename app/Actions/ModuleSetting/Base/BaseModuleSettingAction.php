<?php

namespace App\Actions\ModuleSetting\Base;

use App\Actions\BaseAction;
use App\Models\ModuleSetting;

abstract class BaseModuleSettingAction extends BaseAction
{
	protected string $attribute = 'setting';

	protected string $class = ModuleSetting::class;

	public string $cacheTag = 'module_settings';

	abstract public function execute(array $args = []);
}
