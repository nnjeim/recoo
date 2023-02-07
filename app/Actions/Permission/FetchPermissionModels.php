<?php

namespace App\Actions\Permission;

use App\Actions\Permission\Base\BasePermissionAction;
use App\Http\Response\ResponseBuilder;
use App\Models\Traits\HasPermissions;
use DirectoryIterator;
use ReflectionClass;
use ReflectionException;

class FetchPermissionModels extends BasePermissionAction
{
	/**
	 * @param  array|null  $args
	 * @return $this
	 * @throws ReflectionException
	 */
	public function execute(?array $args = []): self
	{
		$classesWithPermissions = [];
		$source = config('permissions.models.0');

		$models = new DirectoryIterator(base_path($source));
		$modelBasePath = ucfirst(str_replace('/', '\\', $source));

		foreach ($models as $model) {
			if ($model->getExtension() !== 'php') {
				continue;
			}

			list($className) = explode('.', $model->getFilename());

			$classFullPath = $modelBasePath . '\\' . $className;

			if (array_key_exists(
				HasPermissions::class,
				(new ReflectionClass($classFullPath))->getTraits()
			)) {
				$classesWithPermissions[] = $classFullPath;
			}
		}

		$this->success = true;
		$this->data = $classesWithPermissions;

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setAttributeMessage($this->attribute, true)
			->setData($this->data)
			->setStatusOk();
	}
}
