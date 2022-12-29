<?php

namespace App\Actions\Record;

use App\Actions\Record\Base\BaseRecordAction;
use App\Actions\Record\Transformers\ShowTransformer;
use App\Http\Response\ResponseBuilder;

class ShowAction extends BaseRecordAction
{
	use ShowTransformer;

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		// exists
		$recordBuilder = $this->validateModel($args);

		$this->success = true;
		$this->data = $this->transform($recordBuilder->first());

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
