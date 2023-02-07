<?php

namespace App\Console\Commands;

use App\Actions\Permission\FetchPermissionModels;
use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GeneratePermissionsCommand extends Command
{
	protected $signature = 'permissions:generate';

	protected $description = 'Generate model permissions';

	public function handle()
	{
		$this->getOutput()->block('Generating permissions');

		$existingPermissionModels = Permission::query()
			->pluck('model')
			->unique()
			->values()
			->toArray();

		$action = trigger(FetchPermissionModels::class);

		$permissionPresets = config('permissions.presets') ?? [];

		$this->getOutput()->progressStart(count($action->data));

		foreach ($action->data as $className) {
			// Model default permisions
			$modelPermissions = array_key_exists($className, $permissionPresets)
				? $permissionPresets[$className]
				: config('permissions.defaults');

			foreach ($modelPermissions as $permission) {
				// Create model permissions if not exists
				if (! in_array($className, $existingPermissionModels)) {
					Permission::create([
						'model' => $className,
						'name' => sprintf(
							'%s_%s',
							strtolower(trim($permission)),
							strtolower(Str::snake(class_basename($className)))
						),
					]);
				}
			}

			$this->getOutput()->progressAdvance();
		}

		$this->getOutput()->progressFinish();

		$this->getOutput()->block('The end!');
	}
}
