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
	public function execute(array $args = [])
	{
		$response = $this
			->httpClient
			->get($this->formQuery($args));

		$this->success = $response->ok();
		$this->data = $response->json();

		if (! $this->success) {
			$this->errors = [];
		}

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
			->setErrors(
				$this->success
					? []
					: $this->errors
			)
			->setData($this->data);
	}
}
