<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;

class CountTrashedAction extends BaseRecordAction
{
	/**
	 * @param array|null $args
	 * @return $this
	 */
	public function execute(?array $args = []): self
	{

		$this->success = true;
		$this->data = Record::query()
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
