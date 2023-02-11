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
		['id' => $id] = $args;

		// exists
		$userBuilder = $this->validateModel($args);
		// cache
		$this
			->setCacheTag($this->cacheTag)
			->formCacheKey('user', $id);

		$this->success = true;
		$this->data = $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->transform($userBuilder->first()));

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
