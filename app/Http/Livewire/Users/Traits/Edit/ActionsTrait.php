<?php

namespace App\Http\Livewire\Users\Traits\Edit;

use App\Actions\User;
use App\Actions\Role;

trait ActionsTrait
{
	/**
	 * @return void
	 */
	public function fetchRoles()
	{
		$action = trigger(Role\IndexAction::class, []);

		if ($action->success) {
			$this->roles = $action->data->toArray();
		}
	}

	/**
	 * @return void
	 */
	public function showUser(): void
	{
		// permission
		if (! can('show_user')) {
			$this->notifyAction(
				false,
				trans('partials/actions.show_failure', ['attribute' => trans_choice('partials/attributes.user', 1)])
			);
			return;
		}

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
		// permission
		if (! can('update_user')) {
			$this->notifyAction(
				false,
				trans('partials/actions.update_failure', ['attribute' => trans_choice('partials/attributes.user', 1)])
			);
			return;
		}

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
