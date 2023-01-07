<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Queries\PaginateQuery;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;

class SelectAllAction extends BaseRecordAction
{
	/**
	 * @param array $args
	 * @return $this
	 * @throws RecordNotFoundException
	 */
	public function execute(array $args = []): self
	{
		$recordIds = invoke(PaginateQuery::class, $args)
			->orderBy('records.id', 'asc')
			->pluck('id')
			->toArray();

		if (! count($recordIds)) {
			$this->modelNotFound($this->attribute);
		}

		$this->success = count($recordIds) > 0;
		$this->data = $recordIds;

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
