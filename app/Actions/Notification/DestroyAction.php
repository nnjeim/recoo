<?php

namespace App\Actions\Notification;

use App\Actions\Notification\Base\BaseNotificationAction;
use App\Http\Response\ResponseBuilder;
use Illuminate\Support\Facades\DB;
use Throwable;

class DestroyAction extends BaseNotificationAction
{
	protected string $action = 'destroy';

	/**
	 * @param  array  $args
	 * @return $this
	 * @throws Throwable
	 */
	public function execute(array $args = []): self
	{
		// exists
		$notificationBuilder = $this->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$notificationBuilder->delete();

			DB::commit();
			$this->success = true;
		} catch (Throwable $e) {
			DB::rollback();
			throw $e;
		}

		return $this;
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
