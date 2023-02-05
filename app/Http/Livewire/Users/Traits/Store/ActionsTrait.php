<?php

namespace App\Http\Livewire\Users\Traits\Store;

use App\Actions\User;
use App\Actions\Role;
use Livewire\Redirector;

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
	 * Method to store a user.
	 *
	 * @return Redirector|null
	 */
	public function storeUser(): ?Redirector
	{
		$message = '';

		$validator = $this->validateRecord();

		$this->setTabsErrors($validator);

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return null;
		}

		$action = trigger(User\StoreAction::class, $this->user)->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->emit('saved');
			// notification
			$this->notifyAction($action->success, $message);

			return $this->redirectRoute('users.edit', ['id' => $action->data['id']]);
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);

		return null;
	}
}
