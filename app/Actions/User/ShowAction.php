<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Transformers\ShowTransformer;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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
		$this->data = $this->formData($userBuilder, $args);

		return $this;
	}

	/**
	 * @param  Builder  $userBuilder
	 * @param  array  $args
	 * @return Collection
	 */
	private function formData(Builder $userBuilder, array $args): Collection
	{
		if (! $this->isCacheEnabled()) {
			return $this->transform($userBuilder->first());
		}
		// cache
		$this->setCacheTag($this->cacheTag)->formCacheKey('user', $args['id']);

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->transform($userBuilder->first()));
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
