<?php

namespace App\Actions\UserOption;

use App\Actions\UserOption\Base\BaseUserOptionAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Facades\Auth;

class ShowAction extends BaseUserOptionAction
{
	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		$user = Auth::user();

		$this->success = true;
		$this->data = $user->options?->params ?? [];

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
