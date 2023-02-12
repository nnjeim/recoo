<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Transformers\ShowTransformer;
use App\Events\User\UserRegisteredEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterAction extends BaseUserAction
{
	use ShowTransformer;

	protected string $action = 'register';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		[
			'options' => $options,
		] = $args + [
			'options' => null,
		];

		// transaction
		DB::beginTransaction();
		try {
			$user = tap(
				User::create($args),
				function(User $user) {
					// user roles
					if (empty($args['roles'])) {
						// set default user role if none set.
						$args['roles'] = [
							[
								'id' => $user->defaultRoleId(),
								'name' => $user->defaultRoleName(),
							],
						];
					}

					$user->syncRoles($args['roles']);
					// user options
					if (! isset($options) || ! is_array($options)) {
						$options = config('userOptions');
					}

					$user
						->options()
						->create([
							'params' => $options,
						]);
				}
			);

			DB::commit();
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		$this->success = true;
		$this->data = $this->transform($user->refresh());

		// post action
		$this->postAction($user);

		return $this;
	}

	/**
	 * @param User $user
	 * @return void
	 */
	private function postAction(User $user): void
	{
		if ($this->success) {
			// event
			event(new UserRegisteredEvent($user));
			// login registered user
			Auth::loginUsingId($user->id);
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
			->setData($this->data)
			->setErrors()
			->setStatusCreated();
	}
}
