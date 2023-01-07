<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Users\Traits\Edit\ActionsTrait;
use App\Http\Livewire\Users\Traits\Edit\StateTrait;
use App\Http\Livewire\Users\Traits\Edit\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Illuminate\View\View;
use Livewire\Component;

class Edit extends Component
{
	use StateTrait;
	use ActionsTrait;
	use WithToasts;
	use WithVerticalTabs;
	use ValidationTrait;

	public function mount()
	{
		$this->showUser();

		// tabs
		$this->initTabs();
	}

	/**
	 * @return View
	 */
	public function render(): View
	{
		return view('components.users.edit');
	}
}
