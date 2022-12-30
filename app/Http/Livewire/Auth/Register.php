<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Auth\Traits\Register\ActionTrait;
use App\Http\Livewire\Auth\Traits\Register\StateTrait;
use App\Http\Livewire\Auth\Traits\Register\ValidationTrait;
use Livewire\Component;

class Register extends Component
{
	use StateTrait;
	use ActionTrait;
	use ValidationTrait;

	public function render()
	{
		return view('components.register.index');
	}
}
