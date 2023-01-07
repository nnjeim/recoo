<?php

namespace App\Http\Livewire\Auth\Traits\Register;

use App\Actions\User\RegisterAction;
use App\Providers\RouteServiceProvider;
use Livewire\Redirector;

trait ActionTrait
{
	/**
	 * @return null
	 */
	public function registerUser()
	{
		$validator = $this->validateRecord();

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return null;
		}
		// registration action
		$action = trigger(RegisterAction::class, $this->user);

		if ($action->success) {
			// redirect to home
			return $this->redirect(RouteServiceProvider::HOME);
		}

		return null;
	}
}
