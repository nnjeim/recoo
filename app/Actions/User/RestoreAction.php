<?php

namespace App\Actions\User;

use App\Actions\User\Base\BaseUserAction;
use App\Events\User\UserRestoredEvent;
use App\Exceptions\UnprocessableException;
use App\Http\Response\ResponseBuilder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class RestoreAction extends BaseUserAction
{
	protected string $action = 'restore';

	/**
	 * @param array $args
	 * @return $this
	 * @throws Throwable
	 * @throws UnprocessableException
	 */
	public function execute(array $args = []): self
	{
		$user = null;

		// exist
		$userBuilder = $this->validateModel($args + ['showDeleted' => true]);

		// transaction
		DB::beginTransaction();
		try {
			$user = $userBuilder->first();

			if (! $user->trashed()) {
				$this->unprocessableAction($this->action, $this->attribute);
			}

			$user->restore();

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
			event(new UserRestoredEvent($user));
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
