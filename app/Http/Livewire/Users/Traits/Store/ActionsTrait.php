<?php

namespace App\Http\Livewire\Users\Traits\Store;

use App\Actions\User;

trait ActionsTrait
{
	/**
	 * @return void
	 */
	public function storeUser()
	{
		$message = '';

		$validator = $this->validateRecord();

		$this->setTabsErrors($validator);

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		$action = trigger(User\StoreAction::class, $this->user)->withResponse();

		if ($action->success) {
			$message = $action->message;

			$this->emit('saved');
			// notification
			$this->notifyAction($action->success, $message);

			return redirect()->route('users.edit', ['id' => $action->data['id']]);
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
