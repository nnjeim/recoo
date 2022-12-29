<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Events\User\UserDestroyedEvent;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class DestroyAction extends BaseUserAction
{
	protected string $action = 'destroy';

	/**
	 * @param  array  $args
	 * @return $this
	 */
	public function execute(array $args = [])
	{
		$user = null;

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
			$this->success = true;
		} catch (Exception $e) {
			DB::rollback();
			throw $e;
		}

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
