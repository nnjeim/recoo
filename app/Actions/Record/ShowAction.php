<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Transformers\ShowTransformer;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ShowAction extends BaseRecordAction
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
		$recordBuilder = $this->validateModel($args);

		$this->success = true;
		$this->data = $this->formData($recordBuilder, $args);

		return $this;
	}

	/**
	 * @param  Builder  $recordBuilder
	 * @param  array  $args
	 * @return Collection
	 */
	private function formData(Builder $recordBuilder, array $args): Collection
	{
		if (! $this->isCacheEnabled()) {
			return $this->transform($recordBuilder->first());
		}
		// cache
		$this->setCacheTag($this->cacheTag)->formCacheKey('record', $args['id']);

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->transform($recordBuilder->first()));
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
