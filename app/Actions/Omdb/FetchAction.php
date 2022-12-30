<?php

namespace App\Actions\Omdb;

use App\Actions\Omdb\Base\BaseOmdbAction;
use App\Http\Response\ResponseBuilder;

class FetchAction extends BaseOmdbAction
{
	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		$query = $this
			->httpClient
			->get($this->formQuery($args));

		$response = json_decode($query, true);

		$this->success = isset($response['Response']) && $response['Response'] === 'True';
		$this->data = $response;

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
			->setData($this->success ? $this->data : [])
			->setErrors(
				$this->success ? [] : ['message' => [$this->data['Error']]]
			)
			->setData($this->data);
	}
}
