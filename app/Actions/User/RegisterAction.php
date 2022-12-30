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

class RegisterAction extends BaseUserAction
{
	use ShowTransformer;

	protected string $action = 'register';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = []): self
	{
		// transaction
		DB::beginTransaction();
		try {
			$user = User::create($args);

			DB::commit();
			$this->success = true;
		} catch (Exception $e) {
			DB::rollback();
			throw $e;
		}

		// post action
		$this->postAction($user);

		$this->data = $this->success
			? $this->transform($user->refresh())
			: [];

		return $this;
	}

	/**
	 * @param User $user
	 * @return RedirectResponse|void
	 */
	private function postAction(User $user): ?RedirectResponse
	{
		if ($this->success) {
			// event
			event(new UserRegisteredEvent($user));
			// login registered user
			Auth::login($user);
			// redirect to home
			return redirect(RouteServiceProvider::HOME);
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
