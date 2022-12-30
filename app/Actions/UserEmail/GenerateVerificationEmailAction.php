<?php

namespace App\Actions\UserEmail;

use App\Actions\User\Base\BaseUserAction;
use App\Events\UserEmail\VerifyEmailEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class GenerateVerificationEmailAction extends BaseUserAction
{
	protected string $action = 'email';

	/**
	 * @param array $args
	 * @return $this
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
		event(new VerifyEmailEvent(
			$user,
			$this->verificationUrl($user),
		));

		$this->success = true;

		return $this;
	}

	/**
	 * @param User $user
	 * @return string
	 */
	protected function verificationUrl(User $user): string
	{
		return URL::temporarySignedRoute(
			'verification.verify',
			Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
			[
				'id' => $user->getKey(),
				'hash' => sha1($user->getEmailForVerification()),
			]
		);
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
