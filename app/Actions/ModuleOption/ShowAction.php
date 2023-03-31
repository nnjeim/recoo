<?php

namespace App\Actions\ModuleOption;

use App\Actions\ModuleOption\Base\BaseModuleOptionAction;
use App\Http\Response\ResponseBuilder;
use App\Models\ModuleOption;

class ShowAction extends BaseModuleOptionAction
{
	/**
	 * @param array $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		['optionable_type' => $optionable_type] = $args;

		if (! $this->isCacheEnabled()) {
			$this->data = $this->formData($optionable_type);
			$this->success = ! empty($this->data);

			return $this;
		}
		// cache
		$this
			->setCacheTag($this->cacheTag)
			->setCacheKey($optionable_type);

		$this->data = $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->formData($optionable_type));
		$this->success = ! empty($this->data);

		return $this;
	}

	/**
	 * @param  string  $optionable_type
	 * @return mixed
	 */
	private function formData(string $optionable_type)
	{
		return ModuleOption::query()
			->where('optionable_type', '=', $optionable_type)
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
