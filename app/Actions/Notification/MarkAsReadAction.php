<?php

namespace App\Actions\Notification;

use App\Actions\Notification\Base\BaseNotificationAction;
use App\Exceptions\RecordNotFoundException;
use App\Http\Response\ResponseBuilder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class MarkAsReadAction extends BaseNotificationAction
{
	protected string $action = 'update';

	/**
	 * @param  array  $args
	 * @return $this
	 * @throws Throwable
	 * @throws RecordNotFoundException
	 */
	public function execute(array $args = []): self
	{
		[
			'scope' => $scope,
		] = $args + [
			'scope' => null,
		];

		$user = Auth::user();
		// mark all as read
		if ($scope === 'all') {
			$user->unreadNotifications()->each(fn ($notification) => $notification->markAsRead());
			// response
			$this->success = true;

			return $this;
		}

		// exists
		$notificationBuilder = $this->validateModel($args);

		// transaction
		DB::beginTransaction();
		try {
			$notificationBuilder->update([
				'read_at' => Carbon::now(),
			]);

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
