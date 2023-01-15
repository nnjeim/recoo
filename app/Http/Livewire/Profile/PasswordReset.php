<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Auth\UpdatePasswordAction;
use App\Http\Livewire\Traits\WithToasts;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PasswordReset extends Component
{
	use WithToasts;

	protected $errorBag = 'updatePassword';

	public string $current_password = '';

	public string $password = '';

	public string $password_confirmation = '';

	public array $user;

	public function mount()
	{
		$this->user = Auth::user()->toArray();
	}

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

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.password-reset');
	}
}
