<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;
use App\Models\User;

class CountTrashedAction extends BaseUserAction
{
	/**
	 * @param array|null $args
	 * @return $this
	 */
	public function execute(?array $args = []): self
	{
		$this->success = true;
		$this->data = User::query()
			->onlyTrashed()
			->count();

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
			->setData($this->data);
	}
}
