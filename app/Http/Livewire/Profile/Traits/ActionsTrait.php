<?php

namespace App\Http\Livewire\Profile\Traits;

use App\Actions\User;

trait ActionsTrait
{
	/**
	 * Method to update the user.
	 * @return void
	 */
	public function updateUser()
	{
		$message = '';

		$validator = $this->validateRecord();

//		$this->setTabsErrors($validator);
//
		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(User\UpdateAction::class, $this->user)->withResponse();

		if ($action->success) {
			$message = $action->message;
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
