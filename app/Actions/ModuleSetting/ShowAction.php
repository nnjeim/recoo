<?php

namespace App\Actions\ModuleSetting;

use App\Actions\ModuleSetting\Base\BaseModuleSettingAction;
use App\Http\Response\ResponseBuilder;
use App\Models\ModuleSetting;

class ShowAction extends BaseModuleSettingAction
{
	/**
	 * @param array $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		['settable_type' => $settable_type] = $args;

		if (! $this->isCacheEnabled()) {
			$this->data = $this->formData($settable_type);
			$this->success = ! empty($this->data);

			return $this;
		}
		// cache
		$this
			->setCacheTag($this->cacheTag)
			->setCacheKey($settable_type);

		$this->data = $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->formData($settable_type));
		$this->success = ! empty($this->data);

		return $this;
	}

	/**
	 * @param  string  $settable_type
	 * @return mixed
	 */
	private function formData(string $settable_type)
	{
		return ModuleSetting::query()
			->where('settable_type', '=', $settable_type)
			->value('params');
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setAttributeMessage($this->attribute, true)
			->setData($this->data);
	}
}
