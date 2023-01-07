<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Auth\Traits\Register\ActionTrait;
use App\Http\Livewire\Auth\Traits\Register\StateTrait;
use App\Http\Livewire\Auth\Traits\Register\ValidationTrait;
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
	use StateTrait;
	use ActionTrait;
	use ValidationTrait;

	/**
	 * @return View
	 */
	public function render(): View
	{
		return view('components.register.index');
	}
}
