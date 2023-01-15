<?php

namespace App\Http\Livewire\Profile\Traits\PasswordUpdate;

use App\Actions\Auth\UpdatePasswordAction;
use Illuminate\Validation\Rules\Password;

trait ActionsTrait
{
	/**
	 * Method to update a user's password.
	 *
	 * @return void
	 */
	public function updatePassword(): void
	{
		$message = '';

		$this->validate(
			[
				'current_password' => [
					'required',
					'current_password',
				],
				'password' => [
					'required',
					'confirmed',
					(new Password(8))
						->mixedCase()
						->numbers()
						->letters()
						->symbols(),
				],
			],
		);

		$action = trigger(
			UpdatePasswordAction::class,
			[
				'id' => $this->user['id'],
				'password' => $this->password,
			]
		)->withResponse();

		if ($action->success) {
			$this->reset(['current_password', 'password', 'password_confirmation']);

			$message = $action->message;
		}

		if ($action->errors) {
			foreach ($action->errors as $key => $error) {
				$message = $error[0];
			}
		}

		// notification
		$this->notifyAction($action->success, $message);

		if ($action->success) {
			// redirect to login page
			redirect()->route('login');
		}
	}
}
