<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Transformers\ShowTransformer;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;

class ShowAction extends BaseUserAction
{
	use ShowTransformer;

	/**
	 * @param array $args
	 * @return $this
	 * @throws RecordNotFoundException
	 */
	public function execute(array $args = []): self
	{
		// exists
		$userBuilder = $this->validateModel($args);

		$this->success = true;
		$this->data = $this->transform($userBuilder->first());

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
