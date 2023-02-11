<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Events\User\UserDestroyedEvent;
use App\Exceptions\UnprocessableException;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Throwable;

class DestroyAction extends BaseUserAction
{
	protected string $action = 'destroy';

	/**
	 * @param array $args
	 * @return $this
	 * @throws AuthorizationException
	 * @throws Throwable
	 * @throws UnprocessableException
	 */
	public function execute(array $args = []): self
	{
		['id' => $id] = $args;

		if ((int) $id === 1) {
			throw new AuthorizationException();
		}

		// exists
		$userBuilder = $this->validateModel($args + ['showDeleted' => true]);

		// delete mode
		$mode = $this->getDeleteMode($args);

		// transaction
		DB::beginTransaction();
		try {
			$user = $userBuilder->first();

			if ($mode === 'force') {
				$user->forceDelete();
			} else {
				if ($user->trashed()) {
					$this->unprocessableAction($this->action, $this->attribute);
				}

				$user->delete();
			}

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
			event(new UserDestroyedEvent($user));
			// cache
			$this->flushModuleCache();
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
