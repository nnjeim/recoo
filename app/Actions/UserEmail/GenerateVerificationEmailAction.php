<?php

namespace App\Actions\UserEmail;

use App\Actions\User\Base\BaseUserAction;
use App\Events\UserEmail\VerifyEmailEvent;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;

class GenerateVerificationEmailAction extends BaseUserAction
{
	protected string $action = 'email';

	/**
	 * @param array $args
	 * @return $this
	 * @throws RecordNotFoundException
	 */
	public function execute(array $args = []): self
	{
		// exists
		$userBuilder = $this->validateModel($args);

		$user = $userBuilder->first();

		if ($user->hasVerifiedEmail()) {
			return $this;
		}

		// verify email event
		event(new VerifyEmailEvent($user));

		$this->success = true;

		return $this;
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setActionMessage($this->action, $this->attribute, $this->success);
	}
}
