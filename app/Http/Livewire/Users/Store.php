<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Users\Traits\Store\ActionsTrait;
use App\Http\Livewire\Users\Traits\Store\StateTrait;
use App\Http\Livewire\Users\Traits\Store\ValidationTrait;
use App\Http\Livewire\Traits\WithToasts;
use App\Http\Livewire\Traits\WithVerticalTabs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
		$this->fetchRoles();
		// tabs
		$this->initTabs();
	}

	/**
	 * @return Application|Factory|View
	 */
	public function render(): Application|Factory|View
	{
		return view('components.users.store');
	}
}
