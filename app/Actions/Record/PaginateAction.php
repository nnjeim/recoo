<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Queries\PaginateQuery;
use App\Actions\Record\Transformers\PaginateTransformer;
use App\Http\Response\ResponseBuilder;
use App\Models\Record;

class PaginateAction extends BaseRecordAction
{
	use PaginateTransformer;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		$recordsBuilder = invoke(PaginateQuery::class, $args);
		$records = $recordsBuilder->paginate($args['perPage'] ?? 20);

		$records->withPath('/records');

		$records->getCollection()->transform(fn (Record $record) => $this->transform($record));

		$this->success = true;
		$this->data = $records;

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
