<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Queries\PaginateQuery;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;

class SelectAllAction extends BaseUserAction
{
	/**
	 * @param array $args
	 * @return $this
	 * @throws RecordNotFoundException
	 */
	public function execute(array $args = []): self
	{
		$userIds = invoke(PaginateQuery::class, $args)
			->orderBy('users.id', 'asc')
			->pluck('id')
			->toArray();

		if (! count($userIds)) {
			$this->modelNotFound($this->attribute);
		}

		$this->success = count($userIds) > 0;
		$this->data = $userIds;

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
