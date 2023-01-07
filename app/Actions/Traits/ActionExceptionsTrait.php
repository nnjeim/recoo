<?php

namespace App\Actions\Traits;

use App\Exceptions\UnprocessableException;
use App\Exceptions\RecordNotFoundException;

trait ActionExceptionsTrait
{
	/**
	 * @param string $attribute
	 * @param bool $plural
	 * @return mixed
	 * @throws RecordNotFoundException
	 */
	public function modelNotFound(string $attribute = 'record', bool $plural = false): mixed
	{
		throw new RecordNotFoundException(
			trans(
				'response.exceptions.not_found',
				[
					'attribute' => trans_choice("response.attributes.$attribute", (int) $plural + 1),
				]
			)
		);
	}

	/**
	 * @param string $action
	 * @param string $attribute
	 * @param bool $plural
	 * @return mixed
	 * @throws UnprocessableException
	 */
	public function unprocessableAction(string $action, string $attribute, bool $plural = false): mixed
	{
		throw new UnprocessableException(
			trans(
				"response.actions.$action." . 0,
				[
					'attribute' => trans_choice("response.attributes.$attribute", (int) $plural + 1),
				]
			)
		);
	}
}
