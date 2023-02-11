<?php

namespace App\Actions\Role;

use App\Actions\Role\Queries\IndexQuery;
use App\Actions\Role\Transformers\IndexTransformer;
use App\Actions\Role\Base\BaseRoleAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Collection;

class IndexAction extends BaseRoleAction
{
	use IndexTransformer;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		[
			'search' => $search,
			'limit' => $limit,
		] = $args + [
			'search' => null,
			'limit' => null,
		];

		// search
		$roles = $this->formData()
			->when($search !== null, fn ($q) => $q
				->filter(fn ($q) => (str_contains(strtolower($q['name']), strtolower($search))))
			)
			->when($limit !== null, fn ($q) => $q->take($limit))
			->values();

		$this->success = true;
		$this->data = $roles;

		return $this;
	}

	/**
	 * @return Collection
	 */
	private function formData(): Collection
	{
		if (! $this->isCacheEnabled()) {
			return $this->transform(invoke(IndexQuery::class));
		}
		// cache
		$this->setCacheTag($this->cacheTag)->formCacheKey('index');

		return $this->hasCacheKey()
			? $this->getCacheKey()
			: $this->rememberCacheForever($this->transform(invoke(IndexQuery::class)));
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
