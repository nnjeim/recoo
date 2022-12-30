<?php

namespace App\Http\Livewire\Auth;

use App\Actions\User\RegisterAction;
use App\Http\Livewire\Auth\Traits\Register\ValidationTrait;
use Livewire\Component;

class Register extends Component
{
	use ValidationTrait;

	public array $user = [
		'name' => '',
		'email' => '',
		'password' => '',
		'password_confirmation' => '',
	];

	/**
	 * @return void
	 */
	public function storeUser()
	{
		$validator = $this->validateRecord();

		$this->displayErrors($validator);

		if ($validator->fails()) {
			return;
		}

		trigger(RegisterAction::class, $this->user);
	}

	public function render()
	{
		return view('components.register.index');
	}
}
