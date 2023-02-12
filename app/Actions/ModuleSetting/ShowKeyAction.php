<?php

namespace App\Actions\ModuleSetting;

use App\Actions\ModuleSetting\Base\BaseModuleSettingAction;
use App\Actions\ModuleSetting\ShowAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Arr;

class ShowKeyAction extends BaseModuleSettingAction
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
