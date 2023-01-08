<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PasswordReset extends Component
{
	/**
	 * @return Factory|View|Application
	 */
	public function render(): Factory|View|Application
	{
		return view('components.profile.password-reset');
	}
}
