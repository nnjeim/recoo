<?php

namespace App\Http\Livewire\Profile;

use App\Actions\Profile\DestroyAction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\Redirector;

class DeleteUser extends Component
{
	public string $password = '';

	/**
	 * Method to delete a user account.
	 *
	 * @return Redirector|null
	 */
	public function deleteUser(): Redirector|null
	{
		$this->validate([
			'password' => [
				'required',
				'current_password'
			]
		]);

		$action = trigger(DestroyAction::class);

		if ($action->success) {
			return Redirect::to('/');
		}

		return null;
	}

	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.delete-user');
	}
}
