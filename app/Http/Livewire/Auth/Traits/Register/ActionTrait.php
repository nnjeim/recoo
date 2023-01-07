<?php

namespace App\Http\Livewire\Auth\Traits\Register;

use App\Actions\User\RegisterAction;

trait ActionTrait
{
	/**
	 * Method to register a new user.
	 * @return void
	 */
	public function registerUser(): void
	{
		$validator = $this->validateRecord();

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}
		// registration action
		trigger(RegisterAction::class, $this->user);
	}
}
