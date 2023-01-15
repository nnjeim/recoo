<?php

namespace App\Actions\Auth;

use App\Actions\User\Base\BaseUserAction;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class UpdatePasswordAction extends BaseUserAction
{
	protected string $action = 'update';

	protected string $attribute = 'password';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		['password' => $password] = $args;

		// exists
		$userBuilder = $this->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$user = tap(
				$userBuilder->first(),
				function (User $user) use ($password)
				{
					$user->update([
						'password' => $password,
						'remember_token' => Str::random(60),
					]);
				}
			);
			DB::commit();
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		$this->success = true;

		// post action
		$this->postAction($user);

		return $this;
	}

	/**
	 * @param User $user
	 */
	private function postAction(User $user): void
	{
		if ($this->success) {
			// event
			event(new PasswordReset($user));
		}
	}

	/**
	 * @return ResponseBuilder
	 */
	public function withResponse(): ResponseBuilder
	{
		return ResponseBuilder::make()
			->setSuccess($this->success)
			->setActionMessage($this->action, $this->attribute, $this->success)
			->setErrors()
			->setStatusAccepted();
	}
}
