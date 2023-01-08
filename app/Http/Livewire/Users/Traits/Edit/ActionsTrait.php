<?php

namespace App\Http\Livewire\Users\Traits\Edit;

use App\Actions\User;

trait ActionsTrait
{
	/**
	 * @return void
	 */
	public function showUser(): void
	{
		$action = trigger(User\ShowAction::class, ['id' => $this->userId]);

		if ($action->success) {
			$this->user = $action->data->toArray();
		}
	}

	/**
	 * @return void
	 */
	public function updateUser(): void
	{
		$message = '';

		$validator = $this->validateRecord();

		$this->setTabsErrors($validator);

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(User\UpdateAction::class, $this->user)->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->emit('saved');
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);
	}
}
