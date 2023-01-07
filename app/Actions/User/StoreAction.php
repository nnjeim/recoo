<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Actions\User\Transformers\ShowTransformer;
use App\Events\User\UserStoredEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

class StoreAction extends BaseUserAction
{
	use ShowTransformer;

	protected string $action = 'store';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		if (! isset($args['password'])) {
			Arr::set($args, 'password', generatePassword());
		}
		// transaction
		DB::beginTransaction();
		try {
			$user = User::create($args);

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
	 */
	private function postAction(User $user): void
	{
		if ($this->success) {
			// event
			event(new UserStoredEvent($user));
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
