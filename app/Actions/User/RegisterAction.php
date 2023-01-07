<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Transformers\ShowTransformer;
use App\Events\User\UserRegisteredEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
		// transaction
		DB::beginTransaction();
		try {
			$user = tap(
				User::create($args),
				function(User $user) {
					// auto verify superuser
					if ($user->id === 1) {
						$user->update([
							'email_verified_at' => now(),
						]);
					}
				}
			);

			DB::commit();
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		// post action
		$this->postAction($user);

		$this->success = true;
		$this->data = $this->transform($user->refresh());

		return $this;
	}

	/**
	 * @param User $user
	 * @return RedirectResponse|null
	 */
	private function postAction(User $user): RedirectResponse|null
	{
		if ($this->success) {
			// event
			event(new UserRegisteredEvent($user));
			// login registered user
			Auth::login($user);
			// redirect to home
			return Redirect::to(RouteServiceProvider::HOME);
		}

		return null;
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
