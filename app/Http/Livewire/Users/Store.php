<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Users\Traits\Store\ActionsTrait;
use App\Http\Livewire\Users\Traits\Store\StateTrait;
use App\Http\Livewire\Users\Traits\Store\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Illuminate\View\View;
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

	/**
	 * @return View
	 */
	public function render(): View
	{
		return view('components.users.store');
	}
}
