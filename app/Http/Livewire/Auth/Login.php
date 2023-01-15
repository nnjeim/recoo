<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Login extends Component
{
	public string $status = '';

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.auth.login');
	}
}
