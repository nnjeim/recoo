<?php

namespace App\Actions\Permission;

use App\Actions\Permission\Base\BasePermissionAction;
use App\Actions\Permission\CanAction;
use App\Http\Response\ResponseBuilder;
use App\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FetchUserPermissions extends BasePermissionAction
{
	/**
	 * @return $this
	 */
	public function execute(): self
	{
		$this->success = true;
		$this->data = $this->formData();

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setAttributeMessage($this->attribute)
			->setData($this->data);
	}

	/**
	 * @return Collection
	 */
	private function formData(): Collection
	{
		if (! $this->isCacheEnabled()) {
			return $this->getPermissions();
		}

		// cache
		$this->setCacheTag($this->cacheTag)->formCacheKey('user', Auth::id());

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->getPermissions());
	}

	/**
	 * @return Collection
	 */
	private function getPermissions(): Collection
	{
		return Permission::all()
			->map(function ($permission) {
				return [
					$permission->name => trigger(CanAction::class, $permission->name)->data,
				];
			})
			->collapse();
	}
}
