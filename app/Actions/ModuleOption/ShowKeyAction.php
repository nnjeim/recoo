<?php

namespace App\Actions\ModuleOption;

use App\Actions\ModuleOption\Base\BaseModuleOptionAction;
use App\Actions\ModuleOption\ShowAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Arr;

class ShowKeyAction extends BaseModuleOptionAction
{
	/**
	 * @param array $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		['key' => $key] = $args;

		$action = trigger(ShowAction::class, $args);

		$this->success = $action->success;
		$this->data = Arr::get($action->data, $key);

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
}
