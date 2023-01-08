<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Auth\Traits\Register\ActionTrait;
use App\Http\Livewire\Auth\Traits\Register\StateTrait;
use App\Http\Livewire\Auth\Traits\Register\ValidationTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Register extends Component
{
	use StateTrait;
	use ActionTrait;
	use ValidationTrait;

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.auth.register');
	}
}
