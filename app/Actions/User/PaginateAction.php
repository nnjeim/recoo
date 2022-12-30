<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Queries\PaginateQuery;
use App\Actions\User\Transformers\PaginateTransformer;
use App\Http\Response\ResponseBuilder;
use App\Models\User;

class PaginateAction extends BaseUserAction
{
	use PaginateTransformer;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		$usersBuilder = invoke(PaginateQuery::class, $args);
		$users = $usersBuilder->paginate($args['perPage'] ?? 20);

		$users->withPath('/users');

		$users->getCollection()->transform(fn (User $user) => $this->transform($user));

		$this->success = true;
		$this->data = $users;

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
