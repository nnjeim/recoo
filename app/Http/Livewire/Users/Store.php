<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Users\Traits\Store\ActionsTrait;
use App\Http\Livewire\Users\Traits\Store\StateTrait;
use App\Http\Livewire\Users\Traits\Store\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Livewire\Component;

class Store extends Component
{
	use StateTrait;
	use ActionsTrait;
	use WithToasts;
	use WithVerticalTabs;
	use ValidationTrait;

	public function mount()
	{
		// tabs
		$this->initTabs();
	}

	public function render()
	{
		return view('components.users.store');
	}
}
